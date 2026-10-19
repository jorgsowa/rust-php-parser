===source===
<?php if ($a) { return ?>x<?php }
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
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
                    "Return": null
                  },
                  "span": {
                    "start": 16,
                    "end": 22
                  }
                },
                {
                  "kind": {
                    "InlineHtml": "x"
                  },
                  "span": {
                    "start": 25,
                    "end": 26
                  }
                }
              ]
            },
            "span": {
              "start": 14,
              "end": 33
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
