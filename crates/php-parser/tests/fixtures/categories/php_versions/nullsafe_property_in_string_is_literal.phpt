===source===
<?php
$a = "$b?->c";
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
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
                          "Variable": "b"
                        },
                        "span": {
                          "start": 12,
                          "end": 14
                        }
                      }
                    },
                    {
                      "Literal": "?->c"
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
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
                          "NullsafePropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 12,
                                "end": 14
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "c"
                              },
                              "span": {
                                "start": 17,
                                "end": 18
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 18
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 19
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 19
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
