===source===
<?php 'single'; "double";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "single"
          },
          "span": {
            "start": 6,
            "end": 14,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "double"
          },
          "span": {
            "start": 16,
            "end": 24,
            "start_line": 1,
            "start_col": 16
          }
        }
      },
      "span": {
        "start": 16,
        "end": 25,
        "start_line": 1,
        "start_col": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25,
    "start_line": 1,
    "start_col": 0
  }
}
