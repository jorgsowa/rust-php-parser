===source===
<?php
declare(ticks=1) {
    echo 'tick';
}
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
                          "start": 34,
                          "end": 40
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 29,
                    "end": 42
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 43
            }
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
