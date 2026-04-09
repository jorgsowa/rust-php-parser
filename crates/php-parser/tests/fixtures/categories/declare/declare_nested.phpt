===source===
<?php declare(ticks=1) { declare(ticks=2); }
===ast===
{
  "stmts": [
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
                  "start": 20,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 20
                }
              }
            ]
          ],
          "body": {
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
                              "Int": 2
                            },
                            "span": {
                              "start": 39,
                              "end": 40,
                              "start_line": 1,
                              "start_col": 39
                            }
                          }
                        ]
                      ],
                      "body": null
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 43,
                    "start_line": 1,
                    "start_col": 25
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 44,
              "start_line": 1,
              "start_col": 23
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
