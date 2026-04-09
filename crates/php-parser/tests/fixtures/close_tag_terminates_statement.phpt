===source===
<?php echo 1 ?><html><?php echo 2 ?>
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
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 13,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "InlineHtml": "<html>"
      },
      "span": {
        "start": 15,
        "end": 21,
        "start_line": 1,
        "start_col": 15
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 2
            },
            "span": {
              "start": 32,
              "end": 33,
              "start_line": 1,
              "start_col": 32
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 34,
        "start_line": 1,
        "start_col": 27
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
