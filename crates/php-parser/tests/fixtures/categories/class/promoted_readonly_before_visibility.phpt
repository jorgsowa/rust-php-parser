===source===
<?php
class Foo {
    public function __construct(
        readonly protected string $a,
        readonly private int $b,
        private readonly int $c,
    ) {}
}
===errors <=7.4===
'readonly parameters' requires PHP 8.1 or higher
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
'readonly parameters' requires PHP 8.1 or higher
'readonly parameters' requires PHP 8.1 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'protected' (T_PROTECTED), expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "protected", expecting variable in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "__construct",
                    "span": {
                      "start": 38,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 85,
                          "end": 87
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 78,
                              "end": 84
                            }
                          }
                        },
                        "span": {
                          "start": 78,
                          "end": 84
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Protected",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 59,
                        "end": 87
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 118,
                          "end": 120
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
                              "start": 114,
                              "end": 117
                            }
                          }
                        },
                        "span": {
                          "start": 114,
                          "end": 117
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 97,
                        "end": 120
                      }
                    },
                    {
                      "name": {
                        "name": "c",
                        "span": {
                          "start": 151,
                          "end": 153
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
                              "start": 147,
                              "end": 150
                            }
                          }
                        },
                        "span": {
                          "start": 147,
                          "end": 150
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 130,
                        "end": 153
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 163
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 165
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 165
  }
}
