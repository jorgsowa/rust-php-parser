===source===
<?php
class C extends P {
    #[Override] const Y = 2;
}
===errors 8.3-8.4===
Attribute "Override" cannot target class constant (allowed targets: method)
===errors 8.5===
Attribute "Override" cannot target class constant (allowed targets: method, property)
===php_error 8.3-8.4===
PHP Fatal error:  Attribute "Override" cannot target class constant (allowed targets: method) in Standard input code on line 3
===php_error 8.5===
PHP Fatal error:  Attribute "Override" cannot target class constant (allowed targets: method, property) in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 48,
                      "end": 49
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 52,
                      "end": 53
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 32,
                          "end": 40
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 32,
                        "end": 40
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 54
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
