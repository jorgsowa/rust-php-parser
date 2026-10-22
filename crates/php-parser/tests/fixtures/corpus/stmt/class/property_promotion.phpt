===source===
<?php

class Point {
    public function __construct(
        public float $x = 0.0,
        protected array $y = [],
        private string $z = 'hello',
        public readonly int $a = 0,
        public $h { set => $value; },
        public $g = 1 { get => 2; },
        final $i,
    ) {}
}
===errors <=7.4===
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'final promoted properties' requires PHP 8.5 or higher
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors 8.0===
'readonly parameters' requires PHP 8.1 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'final promoted properties' requires PHP 8.5 or higher
===errors 8.1-8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'final promoted properties' requires PHP 8.5 or higher
===errors 8.4===
'final promoted properties' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 5
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 8
===php_error 8.1-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 9
===php_error 8.4===
PHP Fatal error:  Cannot use the final modifier on a parameter in Standard input code on line 11
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Point",
            "span": {
              "start": 13,
              "end": 18
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
                      "start": 41,
                      "end": 52
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
                          "start": 75,
                          "end": 77
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
                              "start": 69,
                              "end": 74
                            }
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 74
                        }
                      },
                      "default": {
                        "kind": {
                          "Float": 0.0
                        },
                        "span": {
                          "start": 80,
                          "end": 83
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 62,
                        "end": 83
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 109,
                          "end": 111
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 103,
                              "end": 108
                            }
                          }
                        },
                        "span": {
                          "start": 103,
                          "end": 108
                        }
                      },
                      "default": {
                        "kind": {
                          "Array": []
                        },
                        "span": {
                          "start": 114,
                          "end": 116
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 93,
                        "end": 116
                      }
                    },
                    {
                      "name": {
                        "name": "z",
                        "span": {
                          "start": 141,
                          "end": 143
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
                              "start": 134,
                              "end": 140
                            }
                          }
                        },
                        "span": {
                          "start": 134,
                          "end": 140
                        }
                      },
                      "default": {
                        "kind": {
                          "String": "hello"
                        },
                        "span": {
                          "start": 146,
                          "end": 153
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 126,
                        "end": 153
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 183,
                          "end": 185
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
                              "start": 179,
                              "end": 182
                            }
                          }
                        },
                        "span": {
                          "start": 179,
                          "end": 182
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 188,
                          "end": 189
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
                        "start": 163,
                        "end": 189
                      }
                    },
                    {
                      "name": {
                        "name": "h",
                        "span": {
                          "start": 206,
                          "end": 208
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Set",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Variable": "value"
                              },
                              "span": {
                                "start": 218,
                                "end": 224
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 211,
                            "end": 225
                          }
                        }
                      ],
                      "span": {
                        "start": 199,
                        "end": 227
                      }
                    },
                    {
                      "name": {
                        "name": "g",
                        "span": {
                          "start": 244,
                          "end": 246
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 249,
                          "end": 250
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 260,
                                "end": 261
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 253,
                            "end": 262
                          }
                        }
                      ],
                      "span": {
                        "start": 237,
                        "end": 264
                      }
                    },
                    {
                      "name": {
                        "name": "i",
                        "span": {
                          "start": 280,
                          "end": 282
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "is_final": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 274,
                        "end": 282
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 25,
                "end": 292
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 294
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 294
  }
}
