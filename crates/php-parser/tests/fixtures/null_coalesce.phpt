===source===
<?php $x ?? $y ?? 'fallback';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "right": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 12,
                        "end": 14,
                        "start_line": 1,
                        "start_col": 12
                      }
                    },
                    "right": {
                      "kind": {
                        "String": "fallback"
                      },
                      "span": {
                        "start": 18,
                        "end": 28,
                        "start_line": 1,
                        "start_col": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 28,
                  "start_line": 1,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29,
    "start_line": 1,
    "start_col": 0
  }
}
