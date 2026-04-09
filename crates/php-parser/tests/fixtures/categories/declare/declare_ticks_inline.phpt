===source===
<?php declare(ticks=1) echo 'tick';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 20
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Echo": [
                {
                  "kind": {
                    "String": "tick"
                  },
                  "span": {
                    "start": 28,
                    "end": 34,
                    "start_line": 1,
                    "start_col": 28
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 35,
              "start_line": 1,
              "start_col": 23
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
