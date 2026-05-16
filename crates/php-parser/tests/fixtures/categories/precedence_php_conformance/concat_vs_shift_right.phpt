===source===
<?php
// PHP: "x" . (16 >> 2).
"x" . 16 >> 2;
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
                  "String": "x"
                },
                "span": {
                  "start": 31,
                  "end": 34
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 16
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    },
                    "op": "ShiftRight",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 43,
                        "end": 44
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 44
          }
        }
      },
      "span": {
        "start": 31,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
