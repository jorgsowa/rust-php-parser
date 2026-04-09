===config===
min_php=8.1
===source===
<?php $fiber->isStarted(); $fiber->isRunning(); $fiber->isSuspended();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "fiber"
                },
                "span": {
                  "start": 6,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "isStarted"
                },
                "span": {
                  "start": 14,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "fiber"
                },
                "span": {
                  "start": 27,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 27
                }
              },
              "method": {
                "kind": {
                  "Identifier": "isRunning"
                },
                "span": {
                  "start": 35,
                  "end": 44,
                  "start_line": 1,
                  "start_col": 35
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 27,
            "end": 46,
            "start_line": 1,
            "start_col": 27
          }
        }
      },
      "span": {
        "start": 27,
        "end": 48,
        "start_line": 1,
        "start_col": 27
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "fiber"
                },
                "span": {
                  "start": 48,
                  "end": 54,
                  "start_line": 1,
                  "start_col": 48
                }
              },
              "method": {
                "kind": {
                  "Identifier": "isSuspended"
                },
                "span": {
                  "start": 56,
                  "end": 67,
                  "start_line": 1,
                  "start_col": 56
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 48,
            "end": 69,
            "start_line": 1,
            "start_col": 48
          }
        }
      },
      "span": {
        "start": 48,
        "end": 70,
        "start_line": 1,
        "start_col": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70,
    "start_line": 1,
    "start_col": 0
  }
}
