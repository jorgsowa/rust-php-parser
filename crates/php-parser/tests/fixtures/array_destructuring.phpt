===source===
<?php
[$a, $b] = $pair;
[$first, , $third] = $arr;
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
                          "start": 7,
                          "end": 9,
                          "start_line": 2,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 9,
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
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 14,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "pair"
                },
                "span": {
                  "start": 17,
                  "end": 22,
                  "start_line": 2,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
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
                          "Variable": "first"
                        },
                        "span": {
                          "start": 25,
                          "end": 31,
                          "start_line": 3,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 25,
                        "end": 31,
                        "start_line": 3,
                        "start_col": 1
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 33,
                          "end": 34,
                          "start_line": 3,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 33,
                        "end": 34,
                        "start_line": 3,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "third"
                        },
                        "span": {
                          "start": 35,
                          "end": 41,
                          "start_line": 3,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 35,
                        "end": 41,
                        "start_line": 3,
                        "start_col": 11
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 42,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 45,
                  "end": 49,
                  "start_line": 3,
                  "start_col": 21
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 49,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 24,
        "end": 50,
        "start_line": 3,
        "start_col": 0
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
