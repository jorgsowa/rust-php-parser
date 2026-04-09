===source===
<?php
1 + 2 . 3 + 4;
1 << 2 . 3 << 4;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
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
                              "start": 6,
                              "end": 7,
                              "start_line": 2,
                              "start_col": 0
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 10,
                              "end": 11,
                              "start_line": 2,
                              "start_col": 4
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 11,
                        "start_line": 2,
                        "start_col": 0
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 14,
                        "end": 15,
                        "start_line": 2,
                        "start_col": 8
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 2,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
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
                        "end": 22,
                        "start_line": 3,
                        "start_col": 0
                      }
                    },
                    "op": "ShiftLeft",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 26,
                              "end": 27,
                              "start_line": 3,
                              "start_col": 5
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 30,
                              "end": 31,
                              "start_line": 3,
                              "start_col": 9
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 31,
                        "start_line": 3,
                        "start_col": 5
                      }
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 31,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "ShiftLeft",
              "right": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 35,
                  "end": 36,
                  "start_line": 3,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 36,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 21,
        "end": 37,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}
