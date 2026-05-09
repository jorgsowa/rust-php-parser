===source===
<?php
$массив = ["ключ" => "значение"];
echo "Value: $массив[ключ]";
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
                  "Variable": "массив"
                },
                "span": {
                  "start": 6,
                  "end": 19
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "ключ"
                        },
                        "span": {
                          "start": 23,
                          "end": 33
                        }
                      },
                      "value": {
                        "kind": {
                          "String": "значение"
                        },
                        "span": {
                          "start": 37,
                          "end": 55
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 23,
                        "end": 55
                      }
                    }
                  ]
                },
                "span": {
                  "start": 22,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 56
          }
        }
      },
      "span": {
        "start": 6,
        "end": 57
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Value: "
                },
                {
                  "Expr": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "массив"
                          },
                          "span": {
                            "start": 71,
                            "end": 84
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "ключ"
                          },
                          "span": {
                            "start": 85,
                            "end": 93
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 71,
                      "end": 94
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 63,
              "end": 95
            }
          }
        ]
      },
      "span": {
        "start": 58,
        "end": 96
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96
  }
}
