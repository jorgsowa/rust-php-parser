===source===
<?php
const A = (1 + 1)(...);
const B = (true)(...);
const C = (-1)(...);
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors 8.1-8.4===
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Cannot use dynamic function name in constant expression
Cannot use dynamic function name in constant expression
Cannot use dynamic function name in constant expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error 8.1-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use dynamic function name in constant expression in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 17,
                                  "end": 18
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 21,
                                  "end": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 17,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 23
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 28
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 28
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 29
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 36,
                "end": 37
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Bool": true
                          },
                          "span": {
                            "start": 41,
                            "end": 45
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 46
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 40,
                "end": 51
              }
            },
            "attributes": [],
            "span": {
              "start": 36,
              "end": 51
            }
          }
        ]
      },
      "span": {
        "start": 30,
        "end": 52
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 59,
                "end": 60
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "UnaryPrefix": {
                              "op": "Negate",
                              "operand": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 65,
                                  "end": 66
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 64,
                            "end": 66
                          }
                        }
                      },
                      "span": {
                        "start": 63,
                        "end": 67
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 63,
                "end": 72
              }
            },
            "attributes": [],
            "span": {
              "start": 59,
              "end": 72
            }
          }
        ]
      },
      "span": {
        "start": 53,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
