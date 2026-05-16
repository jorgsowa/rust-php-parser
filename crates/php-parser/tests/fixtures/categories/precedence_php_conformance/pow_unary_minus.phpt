===description===
PHP: -(2 ** 3) = -8. ** binds tighter than unary minus.
===source===
<?php
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
                        "start": 7,
                        "end": 8
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
