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
                "end": 15,
                "start_line": 3,
                "start_col": 6
              }
            }
          },
          "span": {
            "start": 7,
            "end": 15,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16,
    "start_line": 1,
    "start_col": 0
  }
}
