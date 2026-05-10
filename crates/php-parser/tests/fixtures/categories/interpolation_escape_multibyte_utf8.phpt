===config===
min_php=7.4
===source===
<?php
$str = "test\è";
$str = "{$x["key\è"]}";
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
                  "Variable": "str"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "test\\è"
                },
                "span": {
                  "start": 13,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "str"
                },
                "span": {
                  "start": 24,
                  "end": 28
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
                                "Variable": "x"
                              },
                              "span": {
                                "start": 33,
                                "end": 35
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "key\\è"
                              },
                              "span": {
                                "start": 36,
                                "end": 44
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 45
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 31,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 47
          }
        }
      },
      "span": {
        "start": 24,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
