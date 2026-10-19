===source===
<?php while (1) { break ?>x<?php }
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
                    "Break": null
                  },
                  "span": {
                    "start": 18,
                    "end": 23
                  }
                },
                {
                  "kind": {
                    "InlineHtml": "x"
                  },
                  "span": {
                    "start": 26,
                    "end": 27
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 34
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
