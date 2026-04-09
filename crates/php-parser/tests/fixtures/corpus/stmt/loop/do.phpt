===source===
<?php

do {

} while ($a);
===ast===
{
  "stmts": [
    {
      "kind": {
        "DoWhile": {
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 10,
              "end": 14,
              "start_line": 3,
              "start_col": 3
            }
          },
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 22,
              "end": 24,
              "start_line": 5,
              "start_col": 9
            }
          }
        }
      },
      "span": {
        "start": 7,
        "end": 26,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}
