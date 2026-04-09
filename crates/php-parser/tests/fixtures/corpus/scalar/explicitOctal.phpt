===source===
<?php
0o123;
0O123;
0o1_2_3;
0o1000000000000000000000;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 83
          },
          "span": {
            "start": 6,
            "end": 11,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 83
          },
          "span": {
            "start": 13,
            "end": 18,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 13,
        "end": 20,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 83
          },
          "span": {
            "start": 20,
            "end": 27,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 20,
        "end": 29,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 9.223372036854776e+18
          },
          "span": {
            "start": 29,
            "end": 53,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 29,
        "end": 54,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54,
    "start_line": 1,
    "start_col": 0
  }
}
