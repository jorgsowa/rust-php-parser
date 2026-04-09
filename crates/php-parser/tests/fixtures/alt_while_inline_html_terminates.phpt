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
              "end": 17,
              "start_line": 1,
              "start_col": 13
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
                    "start": 22,
                    "end": 28,
                    "start_line": 1,
                    "start_col": 22
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 44,
              "start_line": 1,
              "start_col": 6
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
