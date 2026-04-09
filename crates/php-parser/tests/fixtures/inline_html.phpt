===source===
<html>
<body>
<?php echo 'Hello'; ?>
<p>Some HTML</p>
<?php echo 'World'; ?>
</body>
</html>
===ast===
{
  "stmts": [
    {
      "kind": {
        "InlineHtml": "<html>\n<body>\n"
      },
      "span": {
        "start": 0,
        "end": 14,
        "start_line": 1,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "Hello"
            },
            "span": {
              "start": 25,
              "end": 32,
              "start_line": 3,
              "start_col": 11
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 34,
        "start_line": 3,
        "start_col": 6
      }
    },
    {
      "kind": {
        "InlineHtml": "\n<p>Some HTML</p>\n"
      },
      "span": {
        "start": 36,
        "end": 54,
        "start_line": 3,
        "start_col": 22
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "World"
            },
            "span": {
              "start": 65,
              "end": 72,
              "start_line": 5,
              "start_col": 11
            }
          }
        ]
      },
      "span": {
        "start": 60,
        "end": 74,
        "start_line": 5,
        "start_col": 6
      }
    },
    {
      "kind": {
        "InlineHtml": "\n</body>\n</html>"
      },
      "span": {
        "start": 76,
        "end": 92,
        "start_line": 5,
        "start_col": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92,
    "start_line": 1,
    "start_col": 0
  }
}
