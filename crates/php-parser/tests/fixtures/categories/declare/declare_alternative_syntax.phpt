===source===
<?php declare(ticks=1): echo 'tick'; enddeclare;
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
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "tick"
                        },
                        "span": {
                          "start": 29,
                          "end": 35,
                          "start_line": 1,
                          "start_col": 29
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 37,
                    "start_line": 1,
                    "start_col": 24
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 48,
              "start_line": 1,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48,
    "start_line": 1,
    "start_col": 0
  }
}
