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
            "end": 8
          }
        }
      },
      "span": {
        "start": 6,
        "end": 9
      }
    },
    {
      "kind": {
        "InlineHtml": "\nB\n"
      },
      "span": {
        "start": 12,
        "end": 15
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
            "end": 23
          }
        }
      },
      "span": {
        "start": 21,
        "end": 24
      }
    },
    {
      "kind": {
        "InlineHtml": "\n"
      },
      "span": {
        "start": 27,
        "end": 28
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
            "end": 36
          }
        }
      },
      "span": {
        "start": 34,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
