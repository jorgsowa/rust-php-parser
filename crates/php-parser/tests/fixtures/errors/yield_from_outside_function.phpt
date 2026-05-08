===source===
<?php yield from $gen;
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
              "key": null,
              "value": {
                "kind": {
                  "Variable": "gen"
                },
                "span": {
                  "start": 17,
                  "end": 21
                }
              },
              "is_from": true
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
