===source===
<?php
print $a;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Print": {
              "kind": {
                "Variable": "a"
              },
              "span": {
                "start": 12,
                "end": 14,
                "start_line": 2,
                "start_col": 6
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15,
    "start_line": 1,
    "start_col": 0
  }
}
