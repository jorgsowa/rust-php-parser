===source===
<?php
(void) 5 |> foo(...);
(void) $x + 1;
(void) $x && $y;
(void) $a * $b + $c;
===errors <=8.0===
'void cast' requires PHP 8.5 or higher
'pipe operator (|>)' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'void cast' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
===errors 8.1-8.4===
'void cast' requires PHP 8.5 or higher
'pipe operator (|>)' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
'void cast' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '5' (T_LNUMBER) in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected integer "5" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 5
                      },
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Function": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "foo"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 18,
                                    "end": 21
                                  }
                                }
                              },
                              "span": {
                                "start": 18,
                                "end": 21
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 26
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 26
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 35,
                        "end": 37
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 40,
                        "end": 41
                      }
                    }
                  }
                },
                "span": {
                  "start": 35,
                  "end": 41
                }
              }
            ]
          },
          "span": {
            "start": 28,
            "end": 41
          }
        }
      },
      "span": {
        "start": 28,
        "end": 42
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 50,
                        "end": 52
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 56,
                        "end": 58
                      }
                    }
                  }
                },
                "span": {
                  "start": 50,
                  "end": 58
                }
              }
            ]
          },
          "span": {
            "start": 43,
            "end": 58
          }
        }
      },
      "span": {
        "start": 43,
        "end": 59
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 67,
                              "end": 69
                            }
                          },
                          "op": "Mul",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 72,
                              "end": 74
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 67,
                        "end": 74
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 77,
                        "end": 79
                      }
                    }
                  }
                },
                "span": {
                  "start": 67,
                  "end": 79
                }
              }
            ]
          },
          "span": {
            "start": 60,
            "end": 79
          }
        }
      },
      "span": {
        "start": 60,
        "end": 80
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 80
  }
}
