===source===
<?php
$название = "Russian";
$город = "Moscow";
echo "Value: $название and $город end";
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
                  "Variable": "название"
                },
                "span": {
                  "start": 6,
                  "end": 23
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "Russian"
                },
                "span": {
                  "start": 26,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "город"
                },
                "span": {
                  "start": 37,
                  "end": 48
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "Moscow"
                },
                "span": {
                  "start": 51,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 37,
            "end": 59
          }
        }
      },
      "span": {
        "start": 37,
        "end": 60
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
                      "Variable": "название"
                    },
                    "span": {
                      "start": 74,
                      "end": 91
                    }
                  }
                },
                {
                  "Literal": " and "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "город"
                    },
                    "span": {
                      "start": 96,
                      "end": 107
                    }
                  }
                },
                {
                  "Literal": " end"
                }
              ]
            },
            "span": {
              "start": 66,
              "end": 112
            }
          }
        ]
      },
      "span": {
        "start": 61,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}
