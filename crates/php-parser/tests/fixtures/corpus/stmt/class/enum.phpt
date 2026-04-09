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
                "end": 32,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 33,
        "start_line": 3,
        "start_col": 0
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
                "end": 55,
                "start_line": 6,
                "start_col": 18
              }
            },
            {
              "parts": [
                "Baz"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 57,
                "end": 61,
                "start_line": 6,
                "start_col": 23
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 34,
        "end": 64,
        "start_line": 6,
        "start_col": 0
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
              "end": 77,
              "start_line": 8,
              "start_col": 8
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
                "end": 92,
                "start_line": 8,
                "start_col": 23
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
                      "end": 110,
                      "start_line": 9,
                      "start_col": 15
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 112,
                "start_line": 9,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 65,
        "end": 113,
        "start_line": 8,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113,
    "start_line": 1,
    "start_col": 0
  }
}
