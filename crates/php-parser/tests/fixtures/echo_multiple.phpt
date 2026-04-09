===source===
<?php echo 1, 2, 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 11,
              "end": 12,
              "start_line": 1,
              "start_col": 11
            }
          },
          {
            "kind": {
              "Int": 2
            },
            "span": {
              "start": 14,
              "end": 15,
              "start_line": 1,
              "start_col": 14
            }
          },
          {
            "kind": {
              "Int": 3
            },
            "span": {
              "start": 17,
              "end": 18,
              "start_line": 1,
              "start_col": 17
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19,
    "start_line": 1,
    "start_col": 0
  }
}
