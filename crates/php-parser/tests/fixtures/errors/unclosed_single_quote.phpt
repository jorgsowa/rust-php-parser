===source===
<?php 'unclosed string
===errors===
expected ';' after expression
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "unclosed"
          },
          "span": {
            "start": 7,
            "end": 15,
            "start_line": 1,
            "start_col": 7
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16,
        "start_line": 1,
        "start_col": 7
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "string"
          },
          "span": {
            "start": 16,
            "end": 22,
            "start_line": 1,
            "start_col": 16
          }
        }
      },
      "span": {
        "start": 16,
        "end": 22,
        "start_line": 1,
        "start_col": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
