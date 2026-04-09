===source===
<?php

unset($a);
unset($b, $c);
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
              "start": 13,
              "end": 15,
              "start_line": 3,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 18,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 24,
              "end": 26,
              "start_line": 4,
              "start_col": 6
            }
          },
          {
            "kind": {
              "Variable": "c"
            },
            "span": {
              "start": 28,
              "end": 30,
              "start_line": 4,
              "start_col": 10
            }
          }
        ]
      },
      "span": {
        "start": 18,
        "end": 32,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32,
    "start_line": 1,
    "start_col": 0
  }
}
