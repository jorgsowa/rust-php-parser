===source===
<?php
// PHP: (int)($a ** 2). ** binds tighter than cast.
// STATUS: parser correct (cast operand parse uses bp 41, ** has left_bp 60). Pinned.
(int)$a ** 2;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 149,
                        "end": 151
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 155,
                        "end": 156
                      }
                    }
                  }
                },
                "span": {
                  "start": 149,
                  "end": 156
                }
              }
            ]
          },
          "span": {
            "start": 144,
            "end": 156
          }
        }
      },
      "span": {
        "start": 144,
        "end": 157
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 157
  }
}
