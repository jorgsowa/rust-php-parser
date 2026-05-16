===source===
<?php
// PHP: ($a instanceof Foo) < 5. instanceof above comparison.
$a instanceof Foo < 5;
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
                        "start": 68,
                        "end": 70
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 82,
                        "end": 85
                      }
                    }
                  }
                },
                "span": {
                  "start": 68,
                  "end": 85
                }
              },
              "op": "Less",
              "right": {
                "kind": {
                  "Int": 5
                },
                "span": {
                  "start": 88,
                  "end": 89
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 89
          }
        }
      },
      "span": {
        "start": 68,
        "end": 90
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 90
  }
}
