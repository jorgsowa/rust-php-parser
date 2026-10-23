===source===
<?php

class Foo {
    private(set) string $type;
    protected(set) int $count = 0;
    public(set) string $label;

    public function __construct(
        private(set) string $name,
        protected(set) int $age,
    ) {}
}
===errors <=7.4===
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors 8.0-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(', expecting variable (T_VARIABLE) in Standard input code on line 4
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
            "name": "Foo",
            "span": {
              "start": 13,
              "end": 16
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
                    "name": "type",
                    "span": {
                      "start": 43,
                      "end": 48
                    }
                  },
                  "modifiers": {
                    "set_visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 42
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 42
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 48
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "count",
                    "span": {
                      "start": 73,
                      "end": 79
                    }
                  },
                  "modifiers": {
                    "set_visibility": "Protected"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 69,
                          "end": 72
                        }
                      }
                    },
                    "span": {
                      "start": 69,
                      "end": 72
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 82,
                      "end": 83
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 83
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "label",
                    "span": {
                      "start": 108,
                      "end": 114
                    }
                  },
                  "modifiers": {
                    "set_visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 101,
                          "end": 107
                        }
                      }
                    },
                    "span": {
                      "start": 101,
                      "end": 107
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 89,
                "end": 114
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 137,
                      "end": 148
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "name",
                        "span": {
                          "start": 178,
                          "end": 183
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
                              "start": 171,
                              "end": 177
                            }
                          }
                        },
                        "span": {
                          "start": 171,
                          "end": 177
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
                        "start": 158,
                        "end": 183
                      }
                    },
                    {
                      "name": {
                        "name": "age",
                        "span": {
                          "start": 212,
                          "end": 216
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
                              "start": 208,
                              "end": 211
                            }
                          }
                        },
                        "span": {
                          "start": 208,
                          "end": 211
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
                        "start": 193,
                        "end": 216
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 121,
                "end": 226
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 228
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 228
  }
}
