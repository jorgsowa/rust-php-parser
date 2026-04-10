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
                  "end": 21
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
                          "end": 35
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 24,
                    "end": 36
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 48
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
