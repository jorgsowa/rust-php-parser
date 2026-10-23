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
        "end": 33
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 34,
        "end": 37
      }
    },
    {
      "kind": {
        "InlineHtml": "<p>Some HTML</p>\n"
      },
      "span": {
        "start": 37,
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
        "end": 73
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 74,
        "end": 77
      }
    },
    {
      "kind": {
        "InlineHtml": "</body>\n</html>"
      },
      "span": {
        "start": 77,
        "end": 92
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 92
  }
}
