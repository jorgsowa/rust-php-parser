===source===
<?php
0o123;
0O123;
0o1_2_3;
0o1000000000000000000000;
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "o123" in Standard input code on line 2
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
        "end": 12
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
        "end": 19
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
        "end": 28
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
