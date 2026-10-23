===source===
<?php foreach ($a as $b): ?> HTML <?php endforeach; ?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 21,
              "end": 23
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": "Nop",
                  "span": {
                    "start": 26,
                    "end": 28
                  }
                },
                {
                  "kind": {
                    "InlineHtml": " HTML "
                  },
                  "span": {
                    "start": 28,
                    "end": 34
                  }
                }
              ]
            },
            "span": {
              "start": 24,
              "end": 39
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 52,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
