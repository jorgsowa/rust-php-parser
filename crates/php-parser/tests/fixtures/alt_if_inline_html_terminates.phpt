===source===
<?php if (true): ?> HTML <?php endif; ?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 10,
              "end": 14
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "InlineHtml": " HTML "
                  },
                  "span": {
                    "start": 19,
                    "end": 25
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 30
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
