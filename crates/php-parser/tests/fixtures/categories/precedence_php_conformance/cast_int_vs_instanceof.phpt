===source===
<?php
// PHP: ((int)$a) instanceof Foo. Cast binds tighter than instanceof.
(int)$a instanceof Foo;
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
                  "Cast": [
                    "Int",
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 81,
                        "end": 83
                      }
                    }
                  ]
                },
                "span": {
                  "start": 76,
                  "end": 83
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 95,
                  "end": 98
                }
              }
            }
          },
          "span": {
            "start": 76,
            "end": 98
          }
        }
      },
      "span": {
        "start": 76,
        "end": 99
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99
  }
}
