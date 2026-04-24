===source===
<?php while ($x): ?>loop<?php endwhile ?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "While": {
          "condition": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 13,
              "end": 15
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "InlineHtml": "loop"
                  },
                  "span": {
                    "start": 20,
                    "end": 24
                  }
                }
              ]
            },
            "span": {
              "start": 6,
              "end": 38
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
