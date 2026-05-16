===source===
<?php
// PHP: 1 . (2 + 3) = "15". + binds tighter than concat.
1 . 2 + 3;
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
                  "Int": 1
                },
                "span": {
                  "start": 63,
                  "end": 64
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 67,
                        "end": 68
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 71,
                        "end": 72
                      }
                    }
                  }
                },
                "span": {
                  "start": 67,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 63,
            "end": 72
          }
        }
      },
      "span": {
        "start": 63,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
