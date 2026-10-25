===description===
`"x" . 16 >> 2` parses as `"x" . (16 >> 2)`: `>>` binds tighter than `.`.
===source===
<?php
"x" . 16 >> 2;
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "x"
                      },
                      "span": {
                        "start": 6,
                        "end": 9
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Int": 16
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "ShiftRight",
              "right": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 18,
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
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 16
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "op": "ShiftRight",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  }
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
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
