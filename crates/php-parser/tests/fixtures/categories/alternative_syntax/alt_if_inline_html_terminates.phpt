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
                  "kind": "Nop",
                  "span": {
                    "start": 17,
                    "end": 19
                  }
                },
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
          "else_branch": null,
          "uses_alternative": true
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 38,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
