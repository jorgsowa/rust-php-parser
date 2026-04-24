===source===
<?php for ($i = 0; $i < 3; $i++): ?>x<?php endfor ?>
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
                      "start": 16,
                      "end": 17
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 17
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
                      "start": 19,
                      "end": 21
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 24,
                      "end": 25
                    }
                  }
                }
              },
              "span": {
                "start": 19,
                "end": 25
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
                      "start": 27,
                      "end": 29
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 27,
                "end": 31
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "InlineHtml": "x"
                  },
                  "span": {
                    "start": 36,
                    "end": 37
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 49
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
