===source===
<?php

class A {
    public string $a;
    protected static D $b;
    private ?float $c;
    readonly static public ?int $d;
}
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
static properties cannot be readonly
===errors >=8.1===
static properties cannot be readonly
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'readonly' (T_STRING), expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 7
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly", expecting "function" or "const" in Standard input code on line 7
===php_error >=8.1===
PHP Fatal error:  Static property A::$d cannot be readonly in Standard input code on line 7
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 13,
              "end": 14
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
                    "name": "a",
                    "span": {
                      "start": 35,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 28,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 34
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 37
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 62,
                      "end": 64
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "D"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 60,
                          "end": 61
                        }
                      }
                    },
                    "span": {
                      "start": 60,
                      "end": 61
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 64
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 85,
                      "end": 87
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 79,
                              "end": 84
                            }
                          }
                        },
                        "span": {
                          "start": 79,
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
                  "attributes": []
                }
              },
              "span": {
                "start": 70,
                "end": 87
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 121,
                      "end": 123
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true,
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 117,
                              "end": 120
                            }
                          }
                        },
                        "span": {
                          "start": 117,
                          "end": 120
                        }
                      }
                    },
                    "span": {
                      "start": 116,
                      "end": 120
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 93,
                "end": 123
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 126
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 126
  }
}
