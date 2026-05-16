===source===
<?php
// PHP: 2 ** (3 ** 2) = 512. ** is right-associative.
2 ** 3 ** 2;
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
                  "Int": 2
                },
                "span": {
                  "start": 60,
                  "end": 61
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 65,
                        "end": 66
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 70,
                        "end": 71
                      }
                    }
                  }
                },
                "span": {
                  "start": 65,
                  "end": 71
                }
              }
            }
          },
          "span": {
            "start": 60,
            "end": 71
          }
        }
      },
      "span": {
        "start": 60,
        "end": 72
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72
  }
}
