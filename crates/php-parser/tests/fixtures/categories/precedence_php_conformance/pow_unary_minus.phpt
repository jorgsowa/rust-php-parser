===source===
<?php
// PHP: -(2 ** 3) = -8. ** binds tighter than unary minus.
-2 ** 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Negate",
              "operand": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 66,
                        "end": 67
                      }
                    },
                    "op": "Pow",
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
                  "start": 66,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 65,
            "end": 72
          }
        }
      },
      "span": {
        "start": 65,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
