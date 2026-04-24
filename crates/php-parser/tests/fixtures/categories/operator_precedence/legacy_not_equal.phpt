===source===
<?php
if ($a <> $b) { echo 1; }
$r = ($x <> 5) ? 'a' : 'b';
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 10,
                    "end": 12
                  }
                },
                "op": "NotEqual",
                "right": {
                  "kind": {
                    "Variable": "b"
                  },
                  "span": {
                    "start": 16,
                    "end": 18
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 18
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 27,
                          "end": 28
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 22,
                    "end": 29
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 31
            }
          },
          "elseif_branches": [],
          "else_branch": null
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
                  "Variable": "r"
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
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 38,
                                  "end": 40
                                }
                              },
                              "op": "NotEqual",
                              "right": {
                                "kind": {
                                  "Int": 5
                                },
                                "span": {
                                  "start": 44,
                                  "end": 45
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 45
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 46
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 49,
                        "end": 52
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 55,
                        "end": 58
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 58
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 58
          }
        }
      },
      "span": {
        "start": 32,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
