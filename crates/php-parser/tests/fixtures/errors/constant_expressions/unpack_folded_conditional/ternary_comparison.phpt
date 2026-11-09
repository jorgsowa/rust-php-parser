===source===
<?php
$a = [...(1 < 2 ? 1 : [])];
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
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "Int": 1
                                          },
                                          "span": {
                                            "start": 16,
                                            "end": 17
                                          }
                                        },
                                        "op": "Less",
                                        "right": {
                                          "kind": {
                                            "Int": 2
                                          },
                                          "span": {
                                            "start": 20,
                                            "end": 21
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 21
                                    }
                                  },
                                  "then_expr": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 24,
                                      "end": 25
                                    }
                                  },
                                  "else_expr": {
                                    "kind": {
                                      "Array": []
                                    },
                                    "span": {
                                      "start": 28,
                                      "end": 30
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 16,
                                "end": 30
                              }
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
