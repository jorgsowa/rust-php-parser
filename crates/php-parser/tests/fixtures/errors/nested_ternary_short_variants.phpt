===source===
<?php
$a ? $b : $c ?: $d;
$a ?: $b ? $c : $d;
$a ?: $b ?: $c;
===errors >=8.0===
Unparenthesized `a ? b : c ?: d` is not supported. Use either `(a ? b : c) ?: d` or `a ? b : (c ?: d)`
Unparenthesized `a ?: b ? c : d` is not supported. Use either `(a ?: b) ? c : d` or `a ?: (b ? c : d)`
===php_error >=8.0===
PHP Fatal error:  Unparenthesized `a ? b : c ?: d` is not supported. Use either `(a ? b : c) ?: d` or `a ? b : (c ?: d)` in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 16,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "then_expr": null,
              "else_expr": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 22,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 26,
                        "end": 28
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 32,
                        "end": 34
                      }
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 34
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "else_expr": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 42,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 44
          }
        }
      },
      "span": {
        "start": 26,
        "end": 45
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 46,
                        "end": 48
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 52,
                        "end": 54
                      }
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 54
                }
              },
              "then_expr": null,
              "else_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 58,
                  "end": 60
                }
              }
            }
          },
          "span": {
            "start": 46,
            "end": 60
          }
        }
      },
      "span": {
        "start": 46,
        "end": 61
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 61
  }
}
