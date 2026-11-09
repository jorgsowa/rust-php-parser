===source===
<?php
trait T {
    const X = __CLASS__ ? 1 : $a;
    const class = 1;
    final const Y = $b;
}
===errors <=8.0===
'constants in traits' requires PHP 8.2 or higher
'constants in traits' requires PHP 8.2 or higher
'constants in traits' requires PHP 8.2 or higher
'final class constants' requires PHP 8.1 or higher
===errors 8.1===
'constants in traits' requires PHP 8.2 or higher
'constants in traits' requires PHP 8.2 or higher
'constants in traits' requires PHP 8.2 or higher
===errors >=8.2===
Constant expression contains invalid operations
A class constant must not be called 'class'; it is reserved for class name fetching
Constant expression contains invalid operations
===php_error <=8.1===
PHP Fatal error:  Traits cannot have constants in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "MagicConst": "Class"
                          },
                          "span": {
                            "start": 30,
                            "end": 39
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 42,
                            "end": 43
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 46,
                            "end": 48
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 48
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 49
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "class",
                    "span": {
                      "start": 60,
                      "end": 65
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 68,
                      "end": 69
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 70
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 87,
                      "end": 88
                    }
                  },
                  "modifiers": {
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 91,
                      "end": 93
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 75,
                "end": 94
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 96
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96
  }
}
