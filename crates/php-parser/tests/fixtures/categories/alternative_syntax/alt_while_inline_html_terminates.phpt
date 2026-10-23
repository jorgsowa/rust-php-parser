===source===
<?php while (true): ?> HTML <?php endwhile; ?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 13,
              "end": 17
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": "Nop",
                  "span": {
                    "start": 20,
                    "end": 22
                  }
                },
                {
                  "kind": {
                    "InlineHtml": " HTML "
                  },
                  "span": {
                    "start": 22,
                    "end": 28
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 43
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 43
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 44,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
