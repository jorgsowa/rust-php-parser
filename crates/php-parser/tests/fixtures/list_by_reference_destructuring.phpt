===source===
<?php
[&$a, &$b] = $arr;
list(&$x, &$y) = $pair;
[&$first, $second] = $mixed;
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
                          "start": 8,
                          "end": 10,
                          "start_line": 2,
                          "start_col": 2
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 7,
                        "end": 10,
                        "start_line": 2,
                        "start_col": 1
                      }
                    },
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
                      "by_ref": true,
                      "span": {
                        "start": 12,
                        "end": 15,
                        "start_line": 2,
                        "start_col": 6
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 16,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 19,
                  "end": 23,
                  "start_line": 2,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
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
                          "start": 31,
                          "end": 33,
                          "start_line": 3,
                          "start_col": 6
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 30,
                        "end": 33,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "y"
                        },
                        "span": {
                          "start": 36,
                          "end": 38,
                          "start_line": 3,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 35,
                        "end": 38,
                        "start_line": 3,
                        "start_col": 10
                      }
                    }
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 39,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "pair"
                },
                "span": {
                  "start": 42,
                  "end": 47,
                  "start_line": 3,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 47,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 49,
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
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "first"
                        },
                        "span": {
                          "start": 51,
                          "end": 57,
                          "start_line": 4,
                          "start_col": 2
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 50,
                        "end": 57,
                        "start_line": 4,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "second"
                        },
                        "span": {
                          "start": 59,
                          "end": 66,
                          "start_line": 4,
                          "start_col": 10
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 59,
                        "end": 66,
                        "start_line": 4,
                        "start_col": 10
                      }
                    }
                  ]
                },
                "span": {
                  "start": 49,
                  "end": 67,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "mixed"
                },
                "span": {
                  "start": 70,
                  "end": 76,
                  "start_line": 4,
                  "start_col": 21
                }
              }
            }
          },
          "span": {
            "start": 49,
            "end": 76,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 49,
        "end": 77,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 77,
    "start_line": 1,
    "start_col": 0
  }
}
