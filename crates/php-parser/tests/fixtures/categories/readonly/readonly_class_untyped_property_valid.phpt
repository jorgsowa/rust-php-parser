===source===
<?php
readonly class C {
    public int $b;
    public function __construct(public int $d, $e) {}
}
===errors <=7.4===
'readonly class' requires PHP 8.2 or higher
'constructor property promotion' requires PHP 8.0 or higher
===errors 8.0-8.1===
'readonly class' requires PHP 8.2 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting end of file in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "b",
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 39
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 29,
                "end": 42
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 64,
                      "end": 75
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "d",
                        "span": {
                          "start": 87,
                          "end": 89
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 83,
                              "end": 86
                            }
                          }
                        },
                        "span": {
                          "start": 83,
                          "end": 86
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
                        "start": 76,
                        "end": 89
                      }
                    },
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 91,
                          "end": 93
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 91,
                        "end": 93
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 48,
                "end": 97
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 99
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99
  }
}
