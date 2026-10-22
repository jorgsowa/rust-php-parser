===source===
<?php
readonly class Point {
    public function __construct(
        public int $x,
        public int $y,
        public int $z = 0,
    ) {}
}
===errors <=7.4===
'readonly class' requires PHP 8.2 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
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
            "name": "Point",
            "span": {
              "start": 21,
              "end": 26
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
                      "start": 49,
                      "end": 60
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 81,
                          "end": 83
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
                              "start": 77,
                              "end": 80
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 80
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
                        "start": 70,
                        "end": 83
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 104,
                          "end": 106
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
                              "start": 100,
                              "end": 103
                            }
                          }
                        },
                        "span": {
                          "start": 100,
                          "end": 103
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
                        "start": 93,
                        "end": 106
                      }
                    },
                    {
                      "name": {
                        "name": "z",
                        "span": {
                          "start": 127,
                          "end": 129
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
                              "start": 123,
                              "end": 126
                            }
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 126
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 132,
                          "end": 133
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 116,
                        "end": 133
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 143
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 145
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 145
  }
}
