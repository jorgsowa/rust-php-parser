===source===
<?php
$a = 1_000_000;
$b = 0xFF_FF;
$c = 0b1010_0101;
$d = 0o77_77;
$e = 1_000.50;
$f = 1_0e1_0;
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
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1000000
                },
                "span": {
                  "start": 11,
                  "end": 20,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 2,
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
                  "Variable": "b"
                },
                "span": {
                  "start": 22,
                  "end": 24,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 65535
                },
                "span": {
                  "start": 27,
                  "end": 34,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 34,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 36,
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
                  "Variable": "c"
                },
                "span": {
                  "start": 36,
                  "end": 38,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 165
                },
                "span": {
                  "start": 41,
                  "end": 52,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 52,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 36,
        "end": 54,
        "start_line": 4,
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
                  "Variable": "d"
                },
                "span": {
                  "start": 54,
                  "end": 56,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 4095
                },
                "span": {
                  "start": 59,
                  "end": 66,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 54,
            "end": 66,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 54,
        "end": 68,
        "start_line": 5,
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
                  "Variable": "e"
                },
                "span": {
                  "start": 68,
                  "end": 70,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Float": 1000.5
                },
                "span": {
                  "start": 73,
                  "end": 81,
                  "start_line": 6,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 81,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 68,
        "end": 83,
        "start_line": 6,
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
                  "Variable": "f"
                },
                "span": {
                  "start": 83,
                  "end": 85,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Float": 100000000000.0
                },
                "span": {
                  "start": 88,
                  "end": 95,
                  "start_line": 7,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 95,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 83,
        "end": 96,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96,
    "start_line": 1,
    "start_col": 0
  }
}
