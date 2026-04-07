===source===
<?php for ($a=0, $b=1, $c=2; $a < 10; $a++) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 11,
                      "end": 13
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 14,
                      "end": 15
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 15
              }
            },
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 17,
                      "end": 19
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 21
              }
            },
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 23,
                      "end": 25
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 27
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 29,
                      "end": 31
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 36
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 38,
                      "end": 40
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 38,
                "end": 42
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 44,
              "end": 46
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
