===description===
PHP: (int)($a ** 2). ** binds tighter than cast.
STATUS: parser correct (cast operand parse uses bp 41, ** has left_bp 60). Pinned.
===source===
<?php
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
                        "start": 11,
                        "end": 13
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 17,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 18
                }
              }
            ]
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
