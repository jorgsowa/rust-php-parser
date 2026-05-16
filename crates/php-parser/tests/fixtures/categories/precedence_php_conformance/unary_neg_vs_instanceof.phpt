===source===
<?php
// PHP: (-$a) instanceof Foo. - binds tighter than instanceof.
-$a instanceof Foo;
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
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 70,
                        "end": 72
                      }
                    }
                  }
                },
                "span": {
                  "start": 69,
                  "end": 72
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 84,
                  "end": 87
                }
              }
            }
          },
          "span": {
            "start": 69,
            "end": 87
          }
        }
      },
      "span": {
        "start": 69,
        "end": 88
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88
  }
}
