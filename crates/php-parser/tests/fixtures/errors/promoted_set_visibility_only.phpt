===source===
<?php
class A {
    public function __construct(
        private(set) int $a,
        protected(set) int $b
    ) {}
}
===errors <=8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'private' (T_PRIVATE), expecting variable (T_VARIABLE) in Standard input code on line 4
===php_error 8.0-8.1===
PHP Parse error:  syntax error, unexpected token "(", expecting variable in Standard input code on line 4
===php_error 8.2-8.3===
PHP Parse error:  syntax error, unexpected token ")", expecting amp in Standard input code on line 4
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
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
                          "start": 74,
                          "end": 76
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
                              "start": 70,
                              "end": 73
                            }
                          }
                        },
                        "span": {
                          "start": 70,
                          "end": 73
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "set_visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 57,
                        "end": 76
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 105,
                          "end": 107
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
                              "start": 101,
                              "end": 104
                            }
                          }
                        },
                        "span": {
                          "start": 101,
                          "end": 104
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "set_visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 86,
                        "end": 107
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 116
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 118
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 118
  }
}
