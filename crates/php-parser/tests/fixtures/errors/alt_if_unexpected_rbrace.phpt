===source===
<?php if (true):
    echo 1;
} endif;
===errors===
expected expression
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
                    "Echo": [
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 26,
                          "end": 27
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 21,
                    "end": 28
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 29,
                    "end": 28
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
          "else_branch": null
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
