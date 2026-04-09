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
                      "end": 13,
                      "start_line": 1,
                      "start_col": 11
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 14,
                      "end": 15,
                      "start_line": 1,
                      "start_col": 14
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 15,
                "start_line": 1,
                "start_col": 11
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
                "end": 19,
                "start_line": 1,
                "start_col": 17
              }
            },
            {
              "kind": {
                "Variable": "b"
              },
              "span": {
                "start": 21,
                "end": 23,
                "start_line": 1,
                "start_col": 21
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
                      "end": 27,
                      "start_line": 1,
                      "start_col": 25
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 25,
                "end": 29,
                "start_line": 1,
                "start_col": 25
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 31,
              "end": 33,
              "start_line": 1,
              "start_col": 31
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33,
    "start_line": 1,
    "start_col": 0
  }
}
