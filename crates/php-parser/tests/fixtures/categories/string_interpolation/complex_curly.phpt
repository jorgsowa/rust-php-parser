===source===
<?php $x = "{$a[$b][$c]}"; 
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 13,
                                      "end": 15
                                    }
                                  },
                                  "index": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 18
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 13,
                                "end": 19
                              }
                            },
                            "index": {
                              "kind": {
                                "Variable": "c"
                              },
                              "span": {
                                "start": 20,
                                "end": 22
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 23
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
