===description===
PHP: "x" . ($a - 1).
===source===
<?php
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
                  "start": 6,
                  "end": 9
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
                        "start": 12,
                        "end": 14
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
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
