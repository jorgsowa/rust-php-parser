===source===
<?php for (;;; ) {} while (true) { break; }
===errors===
expected expression
unclosed '')'' opened at 1:10
expected expression
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [
            {
              "kind": "Error",
              "span": {
                "start": 13,
                "end": 14,
                "start_line": 1,
                "start_col": 13
              }
            }
          ],
          "body": {
            "kind": "Nop",
            "span": {
              "start": 13,
              "end": 14,
              "start_line": 1,
              "start_col": 13
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 15,
        "end": 18,
        "start_line": 1,
        "start_col": 15
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 18,
        "end": 18,
        "start_line": 1,
        "start_col": 18
      }
    },
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 27,
              "end": 31,
              "start_line": 1,
              "start_col": 27
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 35,
                    "end": 42,
                    "start_line": 1,
                    "start_col": 35
                  }
                }
              ]
            },
            "span": {
              "start": 33,
              "end": 43,
              "start_line": 1,
              "start_col": 33
            }
          }
        }
      },
      "span": {
        "start": 20,
        "end": 43,
        "start_line": 1,
        "start_col": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}
