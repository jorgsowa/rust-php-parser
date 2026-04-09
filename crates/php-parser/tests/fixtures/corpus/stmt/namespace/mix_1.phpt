===source===
<?php
namespace A;
echo 1;
namespace B {
    echo 2;
}
echo 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 24,
              "end": 25,
              "start_line": 3,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 27,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 37,
              "end": 39,
              "start_line": 4,
              "start_col": 10
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Echo": [
                    {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 50,
                        "end": 51,
                        "start_line": 5,
                        "start_col": 9
                      }
                    }
                  ]
                },
                "span": {
                  "start": 45,
                  "end": 53,
                  "start_line": 5,
                  "start_col": 4
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 27,
        "end": 54,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 3
            },
            "span": {
              "start": 60,
              "end": 61,
              "start_line": 7,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 55,
        "end": 62,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62,
    "start_line": 1,
    "start_col": 0
  }
}
