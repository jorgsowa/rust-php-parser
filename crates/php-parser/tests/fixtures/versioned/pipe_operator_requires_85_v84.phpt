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
                  "end": 8
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
                              "end": 17
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
                                      "end": 25
                                    }
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 21,
                              "end": 30
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 30
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
                                "end": 44
                              }
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 49
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 49
          }
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
