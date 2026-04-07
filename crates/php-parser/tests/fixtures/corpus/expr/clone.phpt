===source===
<?php

clone $a;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "Variable": "a"
              },
              "span": {
                "start": 13,
                "end": 15
              }
            }
          },
          "span": {
            "start": 7,
            "end": 15
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
