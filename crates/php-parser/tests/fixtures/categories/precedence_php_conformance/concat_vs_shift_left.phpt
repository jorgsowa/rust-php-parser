===source===
<?php
// PHP: (1 << 2) . "3" = "43". Shift binds tighter than concat.
1 << 2 . "3";
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
                        "start": 70,
                        "end": 71
                      }
                    },
                    "op": "ShiftLeft",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 75,
                        "end": 76
                      }
                    }
                  }
                },
                "span": {
                  "start": 70,
                  "end": 76
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "3"
                },
                "span": {
                  "start": 79,
                  "end": 82
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 82
          }
        }
      },
      "span": {
        "start": 70,
        "end": 83
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83
  }
}
