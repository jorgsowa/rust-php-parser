===source===
<?php for ($i=0; $i<10; $i++, $j--, $k+=2) {}
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
                      "Variable": "i"
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
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 17,
                      "end": 19
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 20,
                      "end": 22
                    }
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 22
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 24,
                      "end": 26
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 24,
                "end": 28
              }
            },
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "j"
                    },
                    "span": {
                      "start": 30,
                      "end": 32
                    }
                  },
                  "op": "PostDecrement"
                }
              },
              "span": {
                "start": 30,
                "end": 34
              }
            },
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "k"
                    },
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "op": "Plus",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  }
                }
              },
              "span": {
                "start": 36,
                "end": 41
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 43,
              "end": 45
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
