===source===
<?php ['x' => $x, 'y' => $y] = getPoint();
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
                          "String": "x"
                        },
                        "span": {
                          "start": 7,
                          "end": 10,
                          "start_line": 1,
                          "start_col": 7
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 14,
                          "end": 16,
                          "start_line": 1,
                          "start_col": 14
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 16,
                        "start_line": 1,
                        "start_col": 7
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "y"
                        },
                        "span": {
                          "start": 18,
                          "end": 21,
                          "start_line": 1,
                          "start_col": 18
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "y"
                        },
                        "span": {
                          "start": 25,
                          "end": 27,
                          "start_line": 1,
                          "start_col": 25
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 18,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 18
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 28,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "getPoint"
                      },
                      "span": {
                        "start": 31,
                        "end": 39,
                        "start_line": 1,
                        "start_col": 31
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 31,
                  "end": 41,
                  "start_line": 1,
                  "start_col": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 41,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42,
    "start_line": 1,
    "start_col": 0
  }
}
