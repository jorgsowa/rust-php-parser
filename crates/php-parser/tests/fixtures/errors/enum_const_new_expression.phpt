===config===
min_php=8.1
===source===
<?php
enum E: int {
    case A = 1;
    const X = new Foo();
}
===errors===
New expressions are not supported in this context
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": "E",
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 14,
              "end": 17
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "A",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 33,
                      "end": 34
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 35
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "X",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 54,
                            "end": 57
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 50,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
===php_error===
PHP Fatal error:  New expressions are not supported in this context in Standard input code on line 4
