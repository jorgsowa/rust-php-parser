===source===
<?php declare(ticks=1): ?>body<?php enddeclare ?>
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
                    "InlineHtml": "body"
                  },
                  "span": {
                    "start": 26,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 46
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
