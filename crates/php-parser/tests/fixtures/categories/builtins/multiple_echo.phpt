===source===
<?php echo $a, $b, $c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 11,
              "end": 13,
              "start_line": 1,
              "start_col": 11
            }
          },
          {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 15,
              "end": 17,
              "start_line": 1,
              "start_col": 15
            }
          },
          {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 19,
              "end": 21,
              "start_line": 1,
              "start_col": 19
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
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
