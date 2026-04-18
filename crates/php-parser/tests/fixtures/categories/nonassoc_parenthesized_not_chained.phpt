===source===
<?php
($a < $b) > $c;
$a ?? $b instanceof X;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        },
                        "op": "Less",
                        "right": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 12,
                            "end": 14
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "Greater",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 18,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 28,
                        "end": 30
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "X"
                      },
                      "span": {
                        "start": 42,
                        "end": 43
                      }
                    }
                  }
                },
                "span": {
                  "start": 28,
                  "end": 43
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 43
          }
        }
      },
      "span": {
        "start": 22,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
