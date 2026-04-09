===source===
<?php
// Basic heredoc
$text = <<<EOT
Hello World
EOT;

// Heredoc with interpolation
$name = "PHP";
$msg = <<<EOT
Hello $name!
EOT;

// Nowdoc (no interpolation)
$raw = <<<'EOT'
Hello $name!
EOT;

// Heredoc in expression context
echo <<<EOT
output
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
                  "Variable": "text"
                },
                "span": {
                  "start": 23,
                  "end": 28,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "Hello World"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 31,
                  "end": 53,
                  "start_line": 3,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 53,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 23,
        "end": 86,
        "start_line": 3,
        "start_col": 0
      }
    },
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
                  "start": 86,
                  "end": 91,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "PHP"
                },
                "span": {
                  "start": 94,
                  "end": 99,
                  "start_line": 8,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 86,
            "end": 99,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 86,
        "end": 101,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "msg"
                },
                "span": {
                  "start": 101,
                  "end": 105,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "Hello "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "name"
                          },
                          "span": {
                            "start": 121,
                            "end": 126,
                            "start_line": 10,
                            "start_col": 6
                          }
                        }
                      },
                      {
                        "Literal": "!"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 108,
                  "end": 131,
                  "start_line": 9,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 101,
            "end": 131,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 101,
        "end": 163,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "raw"
                },
                "span": {
                  "start": 163,
                  "end": 167,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Nowdoc": {
                    "label": "EOT",
                    "value": "Hello $name!"
                  }
                },
                "span": {
                  "start": 170,
                  "end": 195,
                  "start_line": 14,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 163,
            "end": 195,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 163,
        "end": 231,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Heredoc": {
                "label": "EOT",
                "parts": [
                  {
                    "Literal": "output"
                  }
                ]
              }
            },
            "span": {
              "start": 236,
              "end": 253,
              "start_line": 19,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 231,
        "end": 254,
        "start_line": 19,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 254,
    "start_line": 1,
    "start_col": 0
  }
}
