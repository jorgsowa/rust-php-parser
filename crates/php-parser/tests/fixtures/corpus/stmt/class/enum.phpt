===source===
<?php

enum A {
    case class;
}
enum B implements Bar, Baz {
}
enum C: int implements Bar {
    case Foo = 1;
}
===errors===
'class' cannot be used as an enum case name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "A",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "class",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 31
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 33
      }
    },
    {
      "kind": {
        "Enum": {
          "name": "B",
          "scalar_type": null,
          "implements": [
            {
              "parts": [
                "Bar"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 52,
                "end": 55
              }
            },
            {
              "parts": [
                "Baz"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 57,
                "end": 60
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 34,
        "end": 64
      }
    },
    {
      "kind": {
        "Enum": {
          "name": "C",
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 73,
              "end": 76
            }
          },
          "implements": [
            {
              "parts": [
                "Bar"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 88,
                "end": 91
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Foo",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 109,
                      "end": 110
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 111
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 65,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}
