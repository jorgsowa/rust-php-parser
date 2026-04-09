===source===
<?php unset($a, $b, $c);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 12,
              "end": 14,
              "start_line": 1,
              "start_col": 12
            }
          },
          {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 16,
              "end": 18,
              "start_line": 1,
              "start_col": 16
            }
          },
          {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 20,
              "end": 22,
              "start_line": 1,
              "start_col": 20
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
