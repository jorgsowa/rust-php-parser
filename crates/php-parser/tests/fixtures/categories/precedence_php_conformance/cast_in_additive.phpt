===source===
<?php
// PHP: ((int)$a) + ((string)$b). Casts bind to immediate operand.
(int)$a + (string)$b;
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
                        "start": 78,
                        "end": 80
                      }
                    }
                  ]
                },
                "span": {
                  "start": 73,
                  "end": 80
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Cast": [
                    "String",
                    {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 91,
                        "end": 93
                      }
                    }
                  ]
                },
                "span": {
                  "start": 83,
                  "end": 93
                }
              }
            }
          },
          "span": {
            "start": 73,
            "end": 93
          }
        }
      },
      "span": {
        "start": 73,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
