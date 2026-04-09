===source===
<?php
if ($x > 1) {
    echo "hello";
===errors===
unclosed ''}'' opened at 2:12
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Binary": {
                "left": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 10,
                    "end": 12,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                "op": "Greater",
                "right": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 15,
                    "end": 16,
                    "start_line": 2,
                    "start_col": 9
                  }
                }
              }
            },
            "span": {
              "start": 10,
              "end": 16,
              "start_line": 2,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "hello"
                        },
                        "span": {
                          "start": 29,
                          "end": 36,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 37,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 18,
              "end": 37,
              "start_line": 2,
              "start_col": 12
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 37,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}
