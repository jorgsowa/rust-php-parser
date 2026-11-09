===source===
<?php
$a = [...((1 ?: 2) + 1)];
===errors===
Only arrays and Traversables can be unpacked, int given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, int given in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Ternary": {
                                            "condition": {
                                              "kind": {
                                                "Int": 1
                                              },
                                              "span": {
                                                "start": 17,
                                                "end": 18
                                              }
                                            },
                                            "then_expr": null,
                                            "else_expr": {
                                              "kind": {
                                                "Int": 2
                                              },
                                              "span": {
                                                "start": 22,
                                                "end": 23
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 17,
                                          "end": 23
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 24
                                    }
                                  },
                                  "op": "Add",
                                  "right": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 27,
                                      "end": 28
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 16,
                                "end": 28
                              }
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 29
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 29
                      }
                    }
                  ]
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
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
