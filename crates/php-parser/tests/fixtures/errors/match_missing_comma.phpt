===source===
<?php match($x) { 1 => 'a' 2 => 'b' }
===errors===
expected '}', found integer
expected ';' after expression
expected ';' after expression
expected expression
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14,
                  "start_line": 1,
                  "start_col": 12
                }
              },
              "arms": [
                {
                  "conditions": [
                    {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 18,
                        "end": 19,
                        "start_line": 1,
                        "start_col": 18
                      }
                    }
                  ],
                  "body": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 23,
                      "end": 26,
                      "start_line": 1,
                      "start_col": 23
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 26,
                    "start_line": 1,
                    "start_col": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 27,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 27,
            "end": 28,
            "start_line": 1,
            "start_col": 27
          }
        }
      },
      "span": {
        "start": 27,
        "end": 29,
        "start_line": 1,
        "start_col": 27
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 29,
        "end": 36,
        "start_line": 1,
        "start_col": 29
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 36,
        "end": 36,
        "start_line": 1,
        "start_col": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
