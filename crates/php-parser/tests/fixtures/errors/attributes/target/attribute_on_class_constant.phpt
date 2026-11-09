===source===
<?php
class C {
    #[Attribute] const X = 1;
}
===errors >=8.0===
Attribute "Attribute" cannot target class constant (allowed targets: class)
===php_error >=8.0===
PHP Fatal error:  Attribute "Attribute" cannot target class constant (allowed targets: class) in Standard input code on line 3
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
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
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
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attribute"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 31
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 31
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
