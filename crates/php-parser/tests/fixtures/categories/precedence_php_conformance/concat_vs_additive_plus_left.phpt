===source===
<?php
// PHP: (1 + 2) . 3 = "33". + binds tighter than concat (currently same level, accidentally correct).
1 + 2 . 3;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 108,
                        "end": 109
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 112,
                        "end": 113
                      }
                    }
                  }
                },
                "span": {
                  "start": 108,
                  "end": 113
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 116,
                  "end": 117
                }
              }
            }
          },
          "span": {
            "start": 108,
            "end": 117
          }
        }
      },
      "span": {
        "start": 108,
        "end": 118
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 118
  }
}
