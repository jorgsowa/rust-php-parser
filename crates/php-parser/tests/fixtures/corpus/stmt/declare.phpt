===source===
<?php

declare (X='Y');

declare (A='B', C='D') {
    echo "foo";
}

declare (A='B', C='D'):
enddeclare;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "X",
              {
                "kind": {
                  "String": "Y"
                },
                "span": {
                  "start": 18,
                  "end": 21,
                  "start_line": 3,
                  "start_col": 11
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 7,
        "end": 25,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "A",
              {
                "kind": {
                  "String": "B"
                },
                "span": {
                  "start": 36,
                  "end": 39,
                  "start_line": 5,
                  "start_col": 11
                }
              }
            ],
            [
              "C",
              {
                "kind": {
                  "String": "D"
                },
                "span": {
                  "start": 43,
                  "end": 46,
                  "start_line": 5,
                  "start_col": 18
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "String": "foo"
                        },
                        "span": {
                          "start": 59,
                          "end": 64,
                          "start_line": 6,
                          "start_col": 9
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 54,
                    "end": 66,
                    "start_line": 6,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 48,
              "end": 67,
              "start_line": 5,
              "start_col": 23
            }
          }
        }
      },
      "span": {
        "start": 25,
        "end": 69,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "A",
              {
                "kind": {
                  "String": "B"
                },
                "span": {
                  "start": 80,
                  "end": 83,
                  "start_line": 9,
                  "start_col": 11
                }
              }
            ],
            [
              "C",
              {
                "kind": {
                  "String": "D"
                },
                "span": {
                  "start": 87,
                  "end": 90,
                  "start_line": 9,
                  "start_col": 18
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 69,
              "end": 104,
              "start_line": 9,
              "start_col": 0
            }
          }
        }
      },
      "span": {
        "start": 69,
        "end": 104,
        "start_line": 9,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 104,
    "start_line": 1,
    "start_col": 0
  }
}
