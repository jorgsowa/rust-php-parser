===source===
<?php
class D {
    #[ReturnTypeWillChange] #[ReturnTypeWillChange] public function m() {}
}
===errors >=8.1===
Attribute "ReturnTypeWillChange" must not be repeated
===php_error >=8.1===
PHP Fatal error:  Attribute "ReturnTypeWillChange" must not be repeated in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
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
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 84,
                      "end": 85
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "ReturnTypeWillChange"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 22,
                          "end": 42
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 42
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "ReturnTypeWillChange"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 46,
                          "end": 66
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 46,
                        "end": 66
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 90
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
