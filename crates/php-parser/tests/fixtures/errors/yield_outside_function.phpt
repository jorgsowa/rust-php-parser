===source===
<?php yield;
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
              "value": null,
              "is_from": false
            }
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
