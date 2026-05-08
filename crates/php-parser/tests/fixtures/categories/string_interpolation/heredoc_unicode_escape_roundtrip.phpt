===config===
min_php=8.1
===source===
<?php
$a = <<<EOT
\u{41}\u{42}\u{43}
EOT;
$b = <<<EOT
\u{7E}
EOT;
$c = <<<EOT
Normal text \u{41} with escape
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
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "ABC"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 40
          }
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 42,
                  "end": 44
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "~"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 47,
                  "end": 64
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 64
          }
        }
      },
      "span": {
        "start": 42,
        "end": 65
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 66,
                  "end": 68
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "Normal text A with escape"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 71,
                  "end": 112
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 112
          }
        }
      },
      "span": {
        "start": 66,
        "end": 113
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 113
  }
}
