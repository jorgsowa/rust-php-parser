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
              "end": 14,
              "start_line": 1,
              "start_col": 10
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
                    "end": 25,
                    "start_line": 1,
                    "start_col": 19
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 31,
              "start_line": 1,
              "start_col": 6
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 38,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
