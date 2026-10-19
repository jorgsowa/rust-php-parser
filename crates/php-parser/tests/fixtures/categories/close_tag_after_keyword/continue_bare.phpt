===source===
<?php while (1) { continue ?>x<?php }
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 13,
              "end": 14
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Continue": null
                  },
                  "span": {
                    "start": 18,
                    "end": 26
                  }
                },
                {
                  "kind": {
                    "InlineHtml": "x"
                  },
                  "span": {
                    "start": 29,
                    "end": 30
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 37
            }
          }
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
