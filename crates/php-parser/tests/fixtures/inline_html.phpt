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
        "end": 14
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
              "end": 32
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 34
      }
    },
    {
      "kind": {
        "InlineHtml": "\n<p>Some HTML</p>\n"
      },
      "span": {
        "start": 36,
        "end": 54
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
              "end": 72
            }
          }
        ]
      },
      "span": {
        "start": 60,
        "end": 74
      }
    },
    {
      "kind": {
        "InlineHtml": "\n</body>\n</html>"
      },
      "span": {
        "start": 76,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
