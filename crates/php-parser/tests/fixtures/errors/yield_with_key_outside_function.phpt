===source===
<?php yield $key => $val;
===errors===
'yield' can only be used inside a function
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Yield": {
              "key": {
                "kind": {
                  "Variable": "key"
                },
                "span": {
                  "start": 12,
                  "end": 16
                }
              },
              "value": {
                "kind": {
                  "Variable": "val"
                },
                "span": {
                  "start": 20,
                  "end": 24
                }
              },
              "is_from": false
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
