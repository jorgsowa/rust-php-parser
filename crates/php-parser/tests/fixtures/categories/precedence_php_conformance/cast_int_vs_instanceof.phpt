===description===
PHP: ((int)$a) instanceof Foo. Cast binds tighter than instanceof.
===source===
<?php
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
                        "start": 11,
                        "end": 13
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 13
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 25,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
