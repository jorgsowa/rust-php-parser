===source===
<?php
readonly class B {
    public function __construct(public readonly $l) {}
}
===errors <=7.4===
'readonly class' requires PHP 8.2 or higher
'constructor property promotion' requires PHP 8.0 or higher
===errors 8.0===
'readonly class' requires PHP 8.2 or higher
===errors 8.1===
'readonly class' requires PHP 8.2 or higher
Readonly property B::$l must have type
===errors >=8.2===
Readonly property B::$l must have type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Readonly property B::$l must have type in Standard input code on line 3
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 45,
                      "end": 56
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "l",
                        "span": {
                          "start": 73,
                          "end": 75
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "readonly"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 64,
                              "end": 72
                            }
                          }
                        },
                        "span": {
                          "start": 64,
                          "end": 72
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 57,
                        "end": 75
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 79
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 81
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 81
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 45,
                      "end": 56
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "l",
                        "span": {
                          "start": 73,
                          "end": 75
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 57,
                        "end": 75
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 79
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 81
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 81
  }
}
