===config===
parse_version=8.4
===source===
<?php $x = $value |> trim(...) |> strtolower(...);
===errors===
'pipe operator (|>)' requires PHP 8.5 or higher (targeting PHP 8.4)
'pipe operator (|>)' requires PHP 8.5 or higher (targeting PHP 8.4)
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "value"
                            },
                            "span": {
                              "start": 11,
                              "end": 17,
                              "start_line": 1,
                              "start_col": 11
                            }
                          },
                          "op": "Pipe",
                          "right": {
                            "kind": {
                              "CallableCreate": {
                                "kind": {
                                  "Function": {
                                    "kind": {
                                      "Identifier": "trim"
                                    },
                                    "span": {
                                      "start": 21,
                                      "end": 25,
                                      "start_line": 1,
                                      "start_col": 21
                                    }
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 21,
                              "end": 31,
                              "start_line": 1,
                              "start_col": 21
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 31,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "CallableCreate": {
                          "kind": {
                            "Function": {
                              "kind": {
                                "Identifier": "strtolower"
                              },
                              "span": {
                                "start": 34,
                                "end": 44,
                                "start_line": 1,
                                "start_col": 34
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 49,
                        "start_line": 1,
                        "start_col": 34
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 49,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 49,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50,
    "start_line": 1,
    "start_col": 0
  }
}
