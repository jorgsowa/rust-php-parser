===source===
<?php
const A = ('strlen')(...);
const B = ('str' . 'len')(...);
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors 8.1-8.4===
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error 8.1-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
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
                            "String": "strlen"
                          },
                          "span": {
                            "start": 17,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 26
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 31
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 31
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 39,
                "end": 40
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
                                  "String": "str"
                                },
                                "span": {
                                  "start": 44,
                                  "end": 49
                                }
                              },
                              "op": "Concat",
                              "right": {
                                "kind": {
                                  "String": "len"
                                },
                                "span": {
                                  "start": 52,
                                  "end": 57
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 44,
                            "end": 57
                          }
                        }
                      },
                      "span": {
                        "start": 43,
                        "end": 58
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 43,
                "end": 63
              }
            },
            "attributes": [],
            "span": {
              "start": 39,
              "end": 63
            }
          }
        ]
      },
      "span": {
        "start": 33,
        "end": 64
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 64
  }
}
