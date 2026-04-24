===source===
<?php if ($x): ?>hello<?php endif ?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 10,
              "end": 12
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "InlineHtml": "hello"
                  },
                  "span": {
                    "start": 17,
                    "end": 22
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 27
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
