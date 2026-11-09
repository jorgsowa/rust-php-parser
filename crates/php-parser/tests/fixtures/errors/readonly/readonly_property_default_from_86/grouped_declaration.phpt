===source===
<?php
class A {
    public readonly ?A $b = null, $c = null;
}
===errors <=8.0===
'readonly properties' requires PHP 8.1 or higher
Readonly property A::$b cannot have default value
Readonly property A::$c cannot have default value
===errors 8.1-8.5===
Readonly property A::$b cannot have default value
Readonly property A::$c cannot have default value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?', expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "?", expecting variable in Standard input code on line 3
===php_error 8.1-8.5===
PHP Fatal error:  Readonly property A::$b cannot have default value in Standard input code on line 3
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
                      "start": 39,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 37,
                              "end": 38
                            }
                          }
                        },
                        "span": {
                          "start": 37,
                          "end": 38
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 44,
                      "end": 48
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 50,
                      "end": 52
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 37,
                              "end": 38
                            }
                          }
                        },
                        "span": {
                          "start": 37,
                          "end": 38
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 55,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 50,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
