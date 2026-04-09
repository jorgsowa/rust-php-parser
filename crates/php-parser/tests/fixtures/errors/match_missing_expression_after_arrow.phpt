===source===
<?php match($x) { 1 => }
===errors===
expected expression
expected ';' after expression
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
                    "kind": "Error",
                    "span": {
                      "start": 23,
                      "end": 24,
                      "start_line": 1,
                      "start_col": 23
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 24,
                    "start_line": 1,
                    "start_col": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
