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
                  "end": 12
                }
              },
              "method": {
                "kind": {
                  "Identifier": "isStarted"
                },
                "span": {
                  "start": 14,
                  "end": 23
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
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
                  "end": 33
                }
              },
              "method": {
                "kind": {
                  "Identifier": "isRunning"
                },
                "span": {
                  "start": 35,
                  "end": 44
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 27,
            "end": 46
          }
        }
      },
      "span": {
        "start": 27,
        "end": 48
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
                  "end": 54
                }
              },
              "method": {
                "kind": {
                  "Identifier": "isSuspended"
                },
                "span": {
                  "start": 56,
                  "end": 67
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 48,
            "end": 69
          }
        }
      },
      "span": {
        "start": 48,
        "end": 70
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 70
  }
}
