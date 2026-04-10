===source===
<?php
(1 + 2);
isset($a, $b);
empty($x);
eval('code');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Parenthesized": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 7,
                      "end": 8
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 11,
                      "end": 12
                    }
                  }
                }
              },
              "span": {
                "start": 7,
                "end": 12
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 21,
                  "end": 23
                }
              },
              {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 25,
                  "end": 27
                }
              }
            ]
          },
          "span": {
            "start": 15,
            "end": 28
          }
        }
      },
      "span": {
        "start": 15,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Empty": {
              "kind": {
                "Variable": "x"
              },
              "span": {
                "start": 36,
                "end": 38
              }
            }
          },
          "span": {
            "start": 30,
            "end": 39
          }
        }
      },
      "span": {
        "start": 30,
        "end": 40
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Eval": {
              "kind": {
                "String": "code"
              },
              "span": {
                "start": 46,
                "end": 52
              }
            }
          },
          "span": {
            "start": 41,
            "end": 53
          }
        }
      },
      "span": {
        "start": 41,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
