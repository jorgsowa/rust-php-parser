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
                        "end": 10
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
                              "end": 13
                            }
                          },
                          "op": "PostIncrement"
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
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
                        "end": 21
                      }
                    },
                    "op": "PostDecrement"
                  }
                },
                "span": {
                  "start": 19,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
