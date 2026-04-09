===source===
<?php if (true) { ?> <?php }
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
                    "InlineHtml": " "
                  },
                  "span": {
                    "start": 20,
                    "end": 21,
                    "start_line": 1,
                    "start_col": 20
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 28,
              "start_line": 1,
              "start_col": 16
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}
