===source===
<?php
// PHP: ($a ** $b) instanceof Foo. ** is highest binary op.
$a ** $b instanceof Foo;
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 66,
                        "end": 68
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 72,
                        "end": 74
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 74
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "Foo"
                },
                "span": {
                  "start": 86,
                  "end": 89
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 89
          }
        }
      },
      "span": {
        "start": 66,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}
