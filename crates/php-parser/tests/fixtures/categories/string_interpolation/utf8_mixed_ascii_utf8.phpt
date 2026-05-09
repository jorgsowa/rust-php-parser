===source===
<?php
$name = "Alice";
$имя = "Bob";
echo "Names: $name and $имя together";
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
                  "Variable": "name"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "Alice"
                },
                "span": {
                  "start": 14,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "имя"
                },
                "span": {
                  "start": 23,
                  "end": 30
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "Bob"
                },
                "span": {
                  "start": 33,
                  "end": 38
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 38
          }
        }
      },
      "span": {
        "start": 23,
        "end": 39
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "Names: "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "name"
                    },
                    "span": {
                      "start": 53,
                      "end": 58
                    }
                  }
                },
                {
                  "Literal": " and "
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "имя"
                    },
                    "span": {
                      "start": 63,
                      "end": 70
                    }
                  }
                },
                {
                  "Literal": " together"
                }
              ]
            },
            "span": {
              "start": 45,
              "end": 80
            }
          }
        ]
      },
      "span": {
        "start": 40,
        "end": 81
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 81
  }
}
