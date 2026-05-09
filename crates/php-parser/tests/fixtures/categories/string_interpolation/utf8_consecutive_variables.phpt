===source===
<?php
$α = "alpha";
$β = "beta";
$γ = "gamma";
echo "Vars: $α$β$γ";
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
                  "Variable": "α"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "alpha"
                },
                "span": {
                  "start": 12,
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
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "β"
                },
                "span": {
                  "start": 21,
                  "end": 24
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "beta"
                },
                "span": {
                  "start": 27,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 33
          }
        }
      },
      "span": {
        "start": 21,
        "end": 34
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "γ"
                },
                "span": {
                  "start": 35,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "gamma"
                },
                "span": {
                  "start": 41,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 35,
            "end": 48
          }
        }
      },
      "span": {
        "start": 35,
        "end": 49
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Vars: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "α"
                    },
                    "span": {
                      "start": 62,
                      "end": 65
                    }
                  }
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "β"
                    },
                    "span": {
                      "start": 65,
                      "end": 68
                    }
                  }
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "γ"
                    },
                    "span": {
                      "start": 68,
                      "end": 71
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 55,
              "end": 72
            }
          }
        ]
      },
      "span": {
        "start": 50,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
