===source===
<?php $arr[$i++] = $j--;
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "arr"
                      },
                      "span": {
                        "start": 6,
                        "end": 10,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "index": {
                      "kind": {
                        "UnaryPostfix": {
                          "operand": {
                            "kind": {
                              "Variable": "i"
                            },
                            "span": {
                              "start": 11,
                              "end": 13,
                              "start_line": 1,
                              "start_col": 11
                            }
                          },
                          "op": "PostIncrement"
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 15,
                        "start_line": 1,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPostfix": {
                    "operand": {
                      "kind": {
                        "Variable": "j"
                      },
                      "span": {
                        "start": 19,
                        "end": 21,
                        "start_line": 1,
                        "start_col": 19
                      }
                    },
                    "op": "PostDecrement"
                  }
                },
                "span": {
                  "start": 19,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
