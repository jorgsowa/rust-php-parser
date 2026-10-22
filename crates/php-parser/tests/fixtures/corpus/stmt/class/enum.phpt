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
===errors <=8.0===
'enums' requires PHP 8.1 or higher
'class' cannot be used as an enum case name
'enums' requires PHP 8.1 or higher
'enums' requires PHP 8.1 or higher
===errors >=8.1===
'class' cannot be used as an enum case name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'A' (T_STRING) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "A" in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  A class constant must not be called 'class'; it is reserved for class name fetching in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "class",
                    "span": {
                      "start": 25,
                      "end": 30
                    }
                  },
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
          "name": {
            "name": "B",
            "span": {
              "start": 39,
              "end": 40
            }
          },
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
          "name": {
            "name": "C",
            "span": {
              "start": 70,
              "end": 71
            }
          },
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
                  "name": {
                    "name": "Foo",
                    "span": {
                      "start": 103,
                      "end": 106
                    }
                  },
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
