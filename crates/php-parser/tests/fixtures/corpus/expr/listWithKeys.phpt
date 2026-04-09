===source===
<?php

list('a' => $b) = ['a' => 'b'];
list('a' => list($b => $c), 'd' => $e) = $x;
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
                      "key": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 12,
                          "end": 15,
                          "start_line": 3,
                          "start_col": 5
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 19,
                          "end": 21,
                          "start_line": 3,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 21,
                        "start_line": 3,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 7,
                  "end": 22,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 26,
                          "end": 29,
                          "start_line": 3,
                          "start_col": 19
                        }
                      },
                      "value": {
                        "kind": {
                          "String": "b"
                        },
                        "span": {
                          "start": 33,
                          "end": 36,
                          "start_line": 3,
                          "start_col": 26
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 26,
                        "end": 36,
                        "start_line": 3,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 37,
                  "start_line": 3,
                  "start_col": 18
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 37,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 39,
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 44,
                          "end": 47,
                          "start_line": 4,
                          "start_col": 5
                        }
                      },
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 56,
                                  "end": 58,
                                  "start_line": 4,
                                  "start_col": 17
                                }
                              },
                              "value": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 62,
                                  "end": 64,
                                  "start_line": 4,
                                  "start_col": 23
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 56,
                                "end": 64,
                                "start_line": 4,
                                "start_col": 17
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 51,
                          "end": 65,
                          "start_line": 4,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 44,
                        "end": 65,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "d"
                        },
                        "span": {
                          "start": 67,
                          "end": 70,
                          "start_line": 4,
                          "start_col": 28
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "e"
                        },
                        "span": {
                          "start": 74,
                          "end": 76,
                          "start_line": 4,
                          "start_col": 35
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 67,
                        "end": 76,
                        "start_line": 4,
                        "start_col": 28
                      }
                    }
                  ]
                },
                "span": {
                  "start": 39,
                  "end": 77,
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
                  "start": 80,
                  "end": 82,
                  "start_line": 4,
                  "start_col": 41
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 82,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 39,
        "end": 83,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83,
    "start_line": 1,
    "start_col": 0
  }
}
