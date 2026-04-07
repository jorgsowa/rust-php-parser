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
                  "end": 21
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
                              "end": 40
                            }
                          }
                        ]
                      ],
                      "body": null
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 43
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 44
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
