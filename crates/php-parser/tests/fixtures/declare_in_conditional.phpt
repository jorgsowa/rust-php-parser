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
              "end": 14
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
                              "end": 33
                            }
                          }
                        ]
                      ],
                      "body": null
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 35
                  }
                }
              ]
            },
            "span": {
              "start": 16,
              "end": 37
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
