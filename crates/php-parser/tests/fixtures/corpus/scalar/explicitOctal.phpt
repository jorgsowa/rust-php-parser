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
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
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
            "end": 18
          }
        }
      },
      "span": {
        "start": 13,
        "end": 20
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
            "end": 27
          }
        }
      },
      "span": {
        "start": 20,
        "end": 29
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
            "end": 53
          }
        }
      },
      "span": {
        "start": 29,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
