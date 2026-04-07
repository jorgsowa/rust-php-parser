===source===
<?php (int)$a + (string)$b;
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
                        "start": 24,
                        "end": 26
                      }
                    }
                  ]
                },
                "span": {
                  "start": 16,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27
  }
}
