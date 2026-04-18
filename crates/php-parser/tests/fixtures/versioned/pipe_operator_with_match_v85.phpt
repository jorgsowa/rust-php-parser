===config===
min_php=8.5
===source===
<?php $x |> match(true) { default => 'a' };
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
                  "Match": {
                    "subject": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 18,
                        "end": 22
                      }
                    },
                    "arms": [
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 37,
                            "end": 40
                          }
                        },
                        "span": {
                          "start": 26,
                          "end": 40
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 12,
                  "end": 42
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 42
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43
  }
}
