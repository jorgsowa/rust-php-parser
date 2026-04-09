===source===
<?php
$arrays = [[1, 2], [3, 4]];
$flat = [...$arrays[0], ...$arrays[1], 5];
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
                  "Variable": "arrays"
                },
                "span": {
                  "start": 6,
                  "end": 13,
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
                                  "start": 18,
                                  "end": 19,
                                  "start_line": 2,
                                  "start_col": 12
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 18,
                                "end": 19,
                                "start_line": 2,
                                "start_col": 12
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 21,
                                  "end": 22,
                                  "start_line": 2,
                                  "start_col": 15
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 21,
                                "end": 22,
                                "start_line": 2,
                                "start_col": 15
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 17,
                          "end": 23,
                          "start_line": 2,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 17,
                        "end": 23,
                        "start_line": 2,
                        "start_col": 11
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
                                  "Int": 3
                                },
                                "span": {
                                  "start": 26,
                                  "end": 27,
                                  "start_line": 2,
                                  "start_col": 20
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 26,
                                "end": 27,
                                "start_line": 2,
                                "start_col": 20
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 4
                                },
                                "span": {
                                  "start": 29,
                                  "end": 30,
                                  "start_line": 2,
                                  "start_col": 23
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 29,
                                "end": 30,
                                "start_line": 2,
                                "start_col": 23
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 25,
                          "end": 31,
                          "start_line": 2,
                          "start_col": 19
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 25,
                        "end": 31,
                        "start_line": 2,
                        "start_col": 19
                      }
                    }
                  ]
                },
                "span": {
                  "start": 16,
                  "end": 32,
                  "start_line": 2,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34,
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
                  "Variable": "flat"
                },
                "span": {
                  "start": 34,
                  "end": 39,
                  "start_line": 3,
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
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arrays"
                              },
                              "span": {
                                "start": 46,
                                "end": 53,
                                "start_line": 3,
                                "start_col": 12
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 54,
                                "end": 55,
                                "start_line": 3,
                                "start_col": 20
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 46,
                          "end": 56,
                          "start_line": 3,
                          "start_col": 12
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 43,
                        "end": 56,
                        "start_line": 3,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arrays"
                              },
                              "span": {
                                "start": 61,
                                "end": 68,
                                "start_line": 3,
                                "start_col": 27
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 69,
                                "end": 70,
                                "start_line": 3,
                                "start_col": 35
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 61,
                          "end": 71,
                          "start_line": 3,
                          "start_col": 27
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 58,
                        "end": 71,
                        "start_line": 3,
                        "start_col": 24
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 5
                        },
                        "span": {
                          "start": 73,
                          "end": 74,
                          "start_line": 3,
                          "start_col": 39
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 73,
                        "end": 74,
                        "start_line": 3,
                        "start_col": 39
                      }
                    }
                  ]
                },
                "span": {
                  "start": 42,
                  "end": 75,
                  "start_line": 3,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 75,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 34,
        "end": 76,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76,
    "start_line": 1,
    "start_col": 0
  }
}
