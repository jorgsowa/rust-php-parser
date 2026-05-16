===description===
PHP: (1 << 2) . "3" = "43". Shift binds tighter than concat.
===source===
<?php
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
                        "start": 6,
                        "end": 7
                      }
                    },
                    "op": "ShiftLeft",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "3"
                },
                "span": {
                  "start": 15,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
