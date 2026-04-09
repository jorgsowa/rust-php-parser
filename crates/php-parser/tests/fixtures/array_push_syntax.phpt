===source===
<?php $arr[] = 'new'; $matrix[][] = 1;
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
                    "index": null
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "new"
                },
                "span": {
                  "start": 15,
                  "end": 20,
                  "start_line": 1,
                  "start_col": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    },
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
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "matrix"
                            },
                            "span": {
                              "start": 22,
                              "end": 29,
                              "start_line": 1,
                              "start_col": 22
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 31,
                        "start_line": 1,
                        "start_col": 22
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 22,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 22
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 36,
                  "end": 37,
                  "start_line": 1,
                  "start_col": 36
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 37,
            "start_line": 1,
            "start_col": 22
          }
        }
      },
      "span": {
        "start": 22,
        "end": 38,
        "start_line": 1,
        "start_col": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
