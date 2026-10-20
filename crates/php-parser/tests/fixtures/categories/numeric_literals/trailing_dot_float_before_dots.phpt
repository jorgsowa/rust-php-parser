===source===
<?php
$a = 1...2;
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Float": 1.0
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "Float": 0.2
                      },
                      "span": {
                        "start": 14,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
