===source===
<?php
list($a, [[$b, $c]]) = [[1, [2, 3]]];
[$x, [$y, $z]] = $data;
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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 11,
                          "end": 13,
                          "start_line": 2,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 13,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "b"
                                        },
                                        "span": {
                                          "start": 17,
                                          "end": 19,
                                          "start_line": 2,
                                          "start_col": 11
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 17,
                                        "end": 19,
                                        "start_line": 2,
                                        "start_col": 11
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "c"
                                        },
                                        "span": {
                                          "start": 21,
                                          "end": 23,
                                          "start_line": 2,
                                          "start_col": 15
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 21,
                                        "end": 23,
                                        "start_line": 2,
                                        "start_col": 15
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 16,
                                  "end": 24,
                                  "start_line": 2,
                                  "start_col": 10
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 16,
                                "end": 24,
                                "start_line": 2,
                                "start_col": 10
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 15,
                          "end": 25,
                          "start_line": 2,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 9
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 26,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 31,
                                  "end": 32,
                                  "start_line": 2,
                                  "start_col": 25
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 31,
                                "end": 32,
                                "start_line": 2,
                                "start_col": 25
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 2
                                        },
                                        "span": {
                                          "start": 35,
                                          "end": 36,
                                          "start_line": 2,
                                          "start_col": 29
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 35,
                                        "end": 36,
                                        "start_line": 2,
                                        "start_col": 29
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 3
                                        },
                                        "span": {
                                          "start": 38,
                                          "end": 39,
                                          "start_line": 2,
                                          "start_col": 32
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 38,
                                        "end": 39,
                                        "start_line": 2,
                                        "start_col": 32
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 34,
                                  "end": 40,
                                  "start_line": 2,
                                  "start_col": 28
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 34,
                                "end": 40,
                                "start_line": 2,
                                "start_col": 28
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 30,
                          "end": 41,
                          "start_line": 2,
                          "start_col": 24
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 30,
                        "end": 41,
                        "start_line": 2,
                        "start_col": 24
                      }
                    }
                  ]
                },
                "span": {
                  "start": 29,
                  "end": 42,
                  "start_line": 2,
                  "start_col": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 42,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 45,
                          "end": 47,
                          "start_line": 3,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 45,
                        "end": 47,
                        "start_line": 3,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "y"
                                },
                                "span": {
                                  "start": 50,
                                  "end": 52,
                                  "start_line": 3,
                                  "start_col": 6
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 50,
                                "end": 52,
                                "start_line": 3,
                                "start_col": 6
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "z"
                                },
                                "span": {
                                  "start": 54,
                                  "end": 56,
                                  "start_line": 3,
                                  "start_col": 10
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 54,
                                "end": 56,
                                "start_line": 3,
                                "start_col": 10
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 49,
                          "end": 57,
                          "start_line": 3,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 49,
                        "end": 57,
                        "start_line": 3,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 44,
                  "end": 58,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "data"
                },
                "span": {
                  "start": 61,
                  "end": 66,
                  "start_line": 3,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 44,
            "end": 66,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 44,
        "end": 67,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67,
    "start_line": 1,
    "start_col": 0
  }
}
