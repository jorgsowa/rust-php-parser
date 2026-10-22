===source===
<?php
class C {
    final public int $x = 1;
    final protected string $y = "z";
    public final float $z = 1.0;
}
===errors <=8.3===
'final properties' requires PHP 8.4 or higher
'final properties' requires PHP 8.4 or higher
'final properties' requires PHP 8.4 or higher
===php_error <=8.0===
PHP Fatal error:  Cannot declare property C::$x final, the final modifier is allowed only for methods and classes in Standard input code on line 3
===php_error 8.1-8.2===
PHP Fatal error:  Cannot declare property C::$x final, the final modifier is allowed only for methods, classes, and class constants in Standard input code on line 3
===php_error 8.3===
PHP Fatal error:  Cannot use the final modifier on a property in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "x",
                    "span": {
                      "start": 37,
                      "end": 39
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 33,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 36
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 43
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "y",
                    "span": {
                      "start": 72,
                      "end": 74
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_final": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 65,
                          "end": 71
                        }
                      }
                    },
                    "span": {
                      "start": 65,
                      "end": 71
                    }
                  },
                  "default": {
                    "kind": {
                      "String": "z"
                    },
                    "span": {
                      "start": 77,
                      "end": 80
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 80
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "z",
                    "span": {
                      "start": 105,
                      "end": 107
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 99,
                          "end": 104
                        }
                      }
                    },
                    "span": {
                      "start": 99,
                      "end": 104
                    }
                  },
                  "default": {
                    "kind": {
                      "Float": 1.0
                    },
                    "span": {
                      "start": 110,
                      "end": 113
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 86,
                "end": 113
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 116
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 116
  }
}
