===source===
<?php
$obj = new readonly class(1, 2) {
    public function __construct(
        public int $x,
        public int $y,
    ) {}
};
===errors <=7.4===
'readonly anonymous classes' requires PHP 8.3 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors 8.0-8.2===
'readonly anonymous classes' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===php_error 8.1-8.2===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                      "start": 60,
                                      "end": 71
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
                                          "start": 92,
                                          "end": 94
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
                                              "start": 88,
                                              "end": 91
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 88,
                                          "end": 91
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
                                        "start": 81,
                                        "end": 94
                                      }
                                    },
                                    {
                                      "name": {
                                        "name": "y",
                                        "span": {
                                          "start": 115,
                                          "end": 117
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
                                              "start": 111,
                                              "end": 114
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 111,
                                          "end": 114
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
                                        "start": 104,
                                        "end": 117
                                      }
                                    }
                                  ],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 44,
                                "end": 127
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 129
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 32,
                              "end": 33
                            }
                          }
                        },
                        "span": {
                          "start": 32,
                          "end": 33
                        }
                      },
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 35,
                              "end": 36
                            }
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 36
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 13,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 129
          }
        }
      },
      "span": {
        "start": 6,
        "end": 130
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 130
  }
}
