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
              "start": 6,
              "end": 51
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
