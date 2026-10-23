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
              "end": 14
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
                    "end": 21
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 28
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
