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
                  "end": 21
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
                    "end": 34
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 35
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
