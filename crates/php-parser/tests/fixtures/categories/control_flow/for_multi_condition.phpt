===source===
<?php for ($i=0; $a, $b; $i++) {}
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
                "Variable": "a"
              },
              "span": {
                "start": 17,
                "end": 19
              }
            },
            {
              "kind": {
                "Variable": "b"
              },
              "span": {
                "start": 21,
                "end": 23
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
                      "start": 25,
                      "end": 27
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 25,
                "end": 29
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 31,
              "end": 33
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
