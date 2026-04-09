===source===
<?php if (true) { declare(ticks=1); }
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
                    "Declare": {
                      "directives": [
                        [
                          "ticks",
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 32,
                              "end": 33,
                              "start_line": 1,
                              "start_col": 32
                            }
                          }
                        ]
                      ],
                      "body": null
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 36,
                    "start_line": 1,
                    "start_col": 18
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 37,
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
