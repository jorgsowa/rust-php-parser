===config===
min_php=8.5
===source===
<?php
$x = $a |> $b |> $c;
$y = $a + $b |> $c;
$z = $a |> $b + $c;
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
                  "start_line": 2,
                  "start_col": 0
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
                              "Variable": "a"
                            },
                            "span": {
                              "start": 11,
                              "end": 13,
                              "start_line": 2,
                              "start_col": 5
                            }
                          },
                          "op": "Pipe",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 17,
                              "end": 19,
                              "start_line": 2,
                              "start_col": 11
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 19,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 23,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 17
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 25,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 2,
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
                  "Variable": "y"
                },
                "span": {
                  "start": 27,
                  "end": 29,
                  "start_line": 3,
                  "start_col": 0
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
                              "Variable": "a"
                            },
                            "span": {
                              "start": 32,
                              "end": 34,
                              "start_line": 3,
                              "start_col": 5
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 37,
                              "end": 39,
                              "start_line": 3,
                              "start_col": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 32,
                        "end": 39,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 43,
                        "end": 45,
                        "start_line": 3,
                        "start_col": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 45,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 45,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 27,
        "end": 47,
        "start_line": 3,
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
                  "Variable": "z"
                },
                "span": {
                  "start": 47,
                  "end": 49,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 52,
                        "end": 54,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "op": "Pipe",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 58,
                              "end": 60,
                              "start_line": 4,
                              "start_col": 11
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 63,
                              "end": 65,
                              "start_line": 4,
                              "start_col": 16
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 58,
                        "end": 65,
                        "start_line": 4,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 52,
                  "end": 65,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 65,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 47,
        "end": 66,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 66,
    "start_line": 1,
    "start_col": 0
  }
}
