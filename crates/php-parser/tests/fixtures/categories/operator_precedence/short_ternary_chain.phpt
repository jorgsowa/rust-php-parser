===source===
<?php
$a = $w ?: $x ?: $y ?: $z;
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
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Ternary": {
                                "condition": {
                                  "kind": {
                                    "Variable": "w"
                                  },
                                  "span": {
                                    "start": 11,
                                    "end": 13
                                  }
                                },
                                "then_expr": null,
                                "else_expr": {
                                  "kind": {
                                    "Variable": "x"
                                  },
                                  "span": {
                                    "start": 17,
                                    "end": 19
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 11,
                              "end": 19
                            }
                          },
                          "then_expr": null,
                          "else_expr": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 23,
                              "end": 25
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 25
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "Variable": "z"
                      },
                      "span": {
                        "start": 29,
                        "end": 31
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
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
