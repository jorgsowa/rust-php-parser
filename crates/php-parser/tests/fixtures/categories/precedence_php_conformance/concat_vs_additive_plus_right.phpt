===description===
PHP: 1 . (2 + 3) = "15". + binds tighter than concat.
===source===
<?php
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
                  "start": 6,
                  "end": 7
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
                        "start": 10,
                        "end": 11
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 14,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
