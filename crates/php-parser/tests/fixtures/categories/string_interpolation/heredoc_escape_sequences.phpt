===config===
min_php=8.1
===source===
<?php
$a = <<<EOT
\n\r\t\v\e\f
EOT;
$b = <<<EOT
\\
EOT;
$c = <<<EOT
\$dollar
EOT;
$d = <<<EOT
Mixed \n newline \u{41} unicode
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
                        "Literal": "\n\r\t\u000b\u001b\f"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
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
                  "start": 36,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "\\"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 41,
                  "end": 54
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 54
          }
        }
      },
      "span": {
        "start": 36,
        "end": 55
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
                  "start": 56,
                  "end": 58
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "$dollar"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 61,
                  "end": 80
                }
              }
            }
          },
          "span": {
            "start": 56,
            "end": 80
          }
        }
      },
      "span": {
        "start": 56,
        "end": 81
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 82,
                  "end": 84
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "EOT",
                    "parts": [
                      {
                        "Literal": "Mixed \n newline A unicode"
                      }
                    ]
                  }
                },
                "span": {
                  "start": 87,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 82,
            "end": 129
          }
        }
      },
      "span": {
        "start": 82,
        "end": 130
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 130
  }
}
