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
                    "Echo": [
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 26,
                          "end": 27,
                          "start_line": 2,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 21,
                    "end": 29,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                {
                  "kind": "Error",
                  "span": {
                    "start": 29,
                    "end": 29,
                    "start_line": 3,
                    "start_col": 0
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
        "end": 37,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}
