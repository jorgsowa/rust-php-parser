===source===
<?php
// PHP: "x" . ($a - 1).
"x" . $a - 1;
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
                  "start": 30,
                  "end": 33
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 36,
                        "end": 38
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 41,
                        "end": 42
                      }
                    }
                  }
                },
                "span": {
                  "start": 36,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 42
          }
        }
      },
      "span": {
        "start": 30,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
