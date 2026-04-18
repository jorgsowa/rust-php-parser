===config===
min_php=8.5
===source===
<?php $x |> ($x ?? 'default');
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Pipe",
              "right": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "NullCoalesce": {
                        "left": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        },
                        "right": {
                          "kind": {
                            "String": "default"
                          },
                          "span": {
                            "start": 19,
                            "end": 28
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 28
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 29
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
