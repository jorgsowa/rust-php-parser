===source===
<?php
$переменная = "heredoc";
$x = <<<EOT
Значение: $переменная конец
EOT;
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
                  "Variable": "переменная"
                },
                "span": {
                  "start": 6,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "heredoc"
                },
                "span": {
                  "start": 30,
                  "end": 39
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    },
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
                  "start": 41,
                  "end": 43
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "Значение: "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "переменная"
                          },
                          "span": {
                            "start": 71,
                            "end": 92
                          }
                        }
                      },
                      {
                        "Literal": " конец"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 46,
                  "end": 107
                }
              }
            }
          },
          "span": {
            "start": 41,
            "end": 107
          }
        }
      },
      "span": {
        "start": 41,
        "end": 108
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 108
  }
}
