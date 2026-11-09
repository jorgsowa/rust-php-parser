===source===
<?php
class A {
    public readonly int $b;
    public function __construct(public readonly int $d = 3) {}
}
===errors <=7.4===
'readonly properties' requires PHP 8.1 or higher
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
===errors 8.0===
'readonly properties' requires PHP 8.1 or higher
'readonly parameters' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'int' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
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
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
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
                "start": 20,
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
                          "start": 96,
                          "end": 98
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
                              "start": 92,
                              "end": 95
                            }
                          }
                        },
                        "span": {
                          "start": 92,
                          "end": 95
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 101,
                          "end": 102
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 76,
                        "end": 102
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
                "end": 106
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 108
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 108
  }
}
