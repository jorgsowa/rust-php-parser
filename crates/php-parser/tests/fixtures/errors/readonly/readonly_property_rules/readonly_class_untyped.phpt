===source===
<?php
readonly class B {
    public readonly $j;
}
===errors <=8.0===
'readonly class' requires PHP 8.2 or higher
===errors 8.1===
'readonly class' requires PHP 8.2 or higher
Readonly property B::$j must have type
===errors >=8.2===
Readonly property B::$j must have type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Readonly property B::$j must have type in Standard input code on line 3
===ast <=8.0===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "j",
                    "span": {
                      "start": 45,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "readonly"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 44
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "j",
                    "span": {
                      "start": 45,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
