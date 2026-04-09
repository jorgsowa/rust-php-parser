===source===
<?php

// This is legal.
list(($a), ((($b)))) = $x;
// This is illegal, but not a syntax error.
list(1 + 1) = $x;
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 31,
                              "end": 33,
                              "start_line": 4,
                              "start_col": 6
                            }
                          }
                        },
                        "span": {
                          "start": 30,
                          "end": 34,
                          "start_line": 4,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 30,
                        "end": 34,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Parenthesized": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 39,
                                      "end": 41,
                                      "start_line": 4,
                                      "start_col": 14
                                    }
                                  }
                                },
                                "span": {
                                  "start": 38,
                                  "end": 42,
                                  "start_line": 4,
                                  "start_col": 13
                                }
                              }
                            },
                            "span": {
                              "start": 37,
                              "end": 43,
                              "start_line": 4,
                              "start_col": 12
                            }
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 44,
                          "start_line": 4,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 36,
                        "end": 44,
                        "start_line": 4,
                        "start_col": 11
                      }
                    }
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 45,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 48,
                  "end": 50,
                  "start_line": 4,
                  "start_col": 23
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 50,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 96,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 101,
                                "end": 102,
                                "start_line": 6,
                                "start_col": 5
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 105,
                                "end": 106,
                                "start_line": 6,
                                "start_col": 9
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 101,
                          "end": 106,
                          "start_line": 6,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 101,
                        "end": 106,
                        "start_line": 6,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 96,
                  "end": 107,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 110,
                  "end": 112,
                  "start_line": 6,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 96,
            "end": 112,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 96,
        "end": 113,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113,
    "start_line": 1,
    "start_col": 0
  }
}
