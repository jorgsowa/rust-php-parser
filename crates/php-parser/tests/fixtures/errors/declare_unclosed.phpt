===source===
<?php declare(strict_types=1
===errors===
expected ')', found end of file
expected statement
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
                  "end": 28,
                  "start_line": 1,
                  "start_col": 27
                }
              }
            ]
          ],
          "body": {
            "kind": "Error",
            "span": {
              "start": 28,
              "end": 28,
              "start_line": 0,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}
