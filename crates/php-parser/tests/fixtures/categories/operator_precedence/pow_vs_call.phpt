===description===
PHP: `10 ** foo()` is `10 ** (foo())`. A call on the `**` right operand binds tighter than `**`.
===source===
<?php
10 ** foo();
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
                  "Int": 10
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "foo"
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
