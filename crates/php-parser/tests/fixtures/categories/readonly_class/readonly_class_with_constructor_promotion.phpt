===source===
<?php
readonly class Point {
    public function __construct(
        public float $x,
        public float $y,
        public float $z = 0.0,
    ) {}
}
===errors <=7.4===
'readonly class' requires PHP 8.2 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'trailing comma in parameter list' requires PHP 8.0 or higher
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
                          "start": 83,
                          "end": 85
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 77,
                              "end": 82
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 82
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
                        "end": 85
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 108,
                          "end": 110
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 102,
                              "end": 107
                            }
                          }
                        },
                        "span": {
                          "start": 102,
                          "end": 107
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
                        "start": 95,
                        "end": 110
                      }
                    },
                    {
                      "name": {
                        "name": "z",
                        "span": {
                          "start": 133,
                          "end": 135
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 127,
                              "end": 132
                            }
                          }
                        },
                        "span": {
                          "start": 127,
                          "end": 132
                        }
                      },
                      "default": {
                        "kind": {
                          "Float": 0.0
                        },
                        "span": {
                          "start": 138,
                          "end": 141
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 120,
                        "end": 141
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
                "end": 151
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 153
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 153
  }
}
