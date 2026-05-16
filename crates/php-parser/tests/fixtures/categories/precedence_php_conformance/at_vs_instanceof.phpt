===source===
<?php
// PHP: (@$a) instanceof Foo. @ is at the high unary tier (with ~ and casts), above instanceof.
@$a instanceof Foo;
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
                  "ErrorSuppress": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 103,
                      "end": 105
                    }
                  }
                },
                "span": {
                  "start": 102,
                  "end": 105
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 117,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 102,
            "end": 120
          }
        }
      },
      "span": {
        "start": 102,
        "end": 121
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 121
  }
}
