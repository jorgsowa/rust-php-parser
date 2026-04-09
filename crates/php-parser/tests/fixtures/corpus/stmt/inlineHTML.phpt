===source===
<?php
$a;
?>
B
<?php
$c;
?>
<?php
$d;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "a"
          },
          "span": {
            "start": 6,
            "end": 8,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "InlineHtml": "\nB\n"
      },
      "span": {
        "start": 12,
        "end": 15,
        "start_line": 3,
        "start_col": 2
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "c"
          },
          "span": {
            "start": 21,
            "end": 23,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 21,
        "end": 25,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "InlineHtml": "\n"
      },
      "span": {
        "start": 27,
        "end": 28,
        "start_line": 7,
        "start_col": 2
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "d"
          },
          "span": {
            "start": 34,
            "end": 36,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 34,
        "end": 37,
        "start_line": 9,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}
