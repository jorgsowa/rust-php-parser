===source===
<?php
@$a;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "Variable": "a"
              },
              "span": {
                "start": 7,
                "end": 9,
                "start_line": 2,
                "start_col": 1
              }
            }
          },
          "span": {
            "start": 6,
            "end": 9,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10,
    "start_line": 1,
    "start_col": 0
  }
}
