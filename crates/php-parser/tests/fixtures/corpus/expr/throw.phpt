===source===
<?php
test(throw $x);
$a ?? throw new Exception;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "test"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "ThrowExpr": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 17,
                          "end": 19,
                          "start_line": 2,
                          "start_col": 11
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
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 11,
                    "end": 19,
                    "start_line": 2,
                    "start_col": 5
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 22,
                  "end": 24,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "right": {
                "kind": {
                  "ThrowExpr": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Exception"
                          },
                          "span": {
                            "start": 38,
                            "end": 47,
                            "start_line": 3,
                            "start_col": 16
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 47,
                      "start_line": 3,
                      "start_col": 12
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 47,
                  "start_line": 3,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 47,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 48,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
