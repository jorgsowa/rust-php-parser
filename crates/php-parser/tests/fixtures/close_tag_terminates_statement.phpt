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
              "end": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "InlineHtml": "<html>"
      },
      "span": {
        "start": 15,
        "end": 21
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
              "end": 33
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
