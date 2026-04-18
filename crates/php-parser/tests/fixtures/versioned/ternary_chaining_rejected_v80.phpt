===config===
min_php=8.0
===source===
<?php
$a = $x ? $y ? 1 : 2 : 3;
$b = $x ? 1 : $y ? 2 : 3;
===errors===
Unparenthesized `a ? b ? c : d : e` is not supported. Use parentheses to make the order explicit.
Unparenthesized `a ? b : c ? d : e` is not supported. Use parentheses to make the order explicit.
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 16,
                              "end": 18
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 21,
                              "end": 22
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 25,
                              "end": 26
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 26
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 32,
                  "end": 34
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 37,
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
                              "Variable": "y"
                            },
                            "span": {
                              "start": 46,
                              "end": 48
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 48
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 51,
                        "end": 52
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 55,
                        "end": 56
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 56
          }
        }
      },
      "span": {
        "start": 32,
        "end": 57
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 57
  }
}
