===source===
<?php
$a instanceof (1 . 2 + 3);
===errors <=7.4===
'instanceof with an expression' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(' in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 21,
                                  "end": 22
                                }
                              },
                              "op": "Concat",
                              "right": {
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
                            "start": 21,
                            "end": 26
                          }
                        },
                        "op": "Add",
                        "right": {
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
                      "start": 21,
                      "end": 30
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 25,
                                  "end": 26
                                }
                              },
                              "op": "Add",
                              "right": {
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
                            "start": 25,
                            "end": 30
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 21,
                      "end": 30
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
