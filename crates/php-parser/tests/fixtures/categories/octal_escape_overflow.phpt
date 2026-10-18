===source===
<?php
echo "\400\501", "a\777$x";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "\u0000A"
            },
            "span": {
              "start": 11,
              "end": 21
            }
          },
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Literal": "aÿ"
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 29,
                      "end": 31
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 32
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
