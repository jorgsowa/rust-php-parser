===source===
<?php
[[$a, [$b, $c]], $d] = $data;
[[[$e, $f], $g], [$h, $i]] = $matrix;
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
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 8,
                                  "end": 10,
                                  "start_line": 2,
                                  "start_col": 2
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 8,
                                "end": 10,
                                "start_line": 2,
                                "start_col": 2
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
                                          "Variable": "b"
                                        },
                                        "span": {
                                          "start": 13,
                                          "end": 15,
                                          "start_line": 2,
                                          "start_col": 7
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 13,
                                        "end": 15,
                                        "start_line": 2,
                                        "start_col": 7
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "c"
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
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 12,
                                  "end": 20,
                                  "start_line": 2,
                                  "start_col": 6
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 12,
                                "end": 20,
                                "start_line": 2,
                                "start_col": 6
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 7,
                          "end": 21,
                          "start_line": 2,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 21,
                        "start_line": 2,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "d"
                        },
                        "span": {
                          "start": 23,
                          "end": 25,
                          "start_line": 2,
                          "start_col": 17
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 23,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 17
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
                  "Variable": "data"
                },
                "span": {
                  "start": 29,
                  "end": 34,
                  "start_line": 2,
                  "start_col": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36,
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
                                          "Variable": "e"
                                        },
                                        "span": {
                                          "start": 39,
                                          "end": 41,
                                          "start_line": 3,
                                          "start_col": 3
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 39,
                                        "end": 41,
                                        "start_line": 3,
                                        "start_col": 3
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "f"
                                        },
                                        "span": {
                                          "start": 43,
                                          "end": 45,
                                          "start_line": 3,
                                          "start_col": 7
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 43,
                                        "end": 45,
                                        "start_line": 3,
                                        "start_col": 7
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 38,
                                  "end": 46,
                                  "start_line": 3,
                                  "start_col": 2
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 38,
                                "end": 46,
                                "start_line": 3,
                                "start_col": 2
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "g"
                                },
                                "span": {
                                  "start": 48,
                                  "end": 50,
                                  "start_line": 3,
                                  "start_col": 12
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 48,
                                "end": 50,
                                "start_line": 3,
                                "start_col": 12
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 37,
                          "end": 51,
                          "start_line": 3,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 37,
                        "end": 51,
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
                                  "Variable": "h"
                                },
                                "span": {
                                  "start": 54,
                                  "end": 56,
                                  "start_line": 3,
                                  "start_col": 18
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 54,
                                "end": 56,
                                "start_line": 3,
                                "start_col": 18
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "i"
                                },
                                "span": {
                                  "start": 58,
                                  "end": 60,
                                  "start_line": 3,
                                  "start_col": 22
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 58,
                                "end": 60,
                                "start_line": 3,
                                "start_col": 22
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 53,
                          "end": 61,
                          "start_line": 3,
                          "start_col": 17
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 53,
                        "end": 61,
                        "start_line": 3,
                        "start_col": 17
                      }
                    }
                  ]
                },
                "span": {
                  "start": 36,
                  "end": 62,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "matrix"
                },
                "span": {
                  "start": 65,
                  "end": 72,
                  "start_line": 3,
                  "start_col": 29
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 72,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 36,
        "end": 73,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73,
    "start_line": 1,
    "start_col": 0
  }
}
