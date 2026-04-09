===source===
<?php
namespace A {
    echo 1;
}
echo 2;
namespace B;
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
              "end": 18,
              "start_line": 2,
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
                        "Int": 1
                      },
                      "span": {
                        "start": 29,
                        "end": 30,
                        "start_line": 3,
                        "start_col": 9
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 32,
                  "start_line": 3,
                  "start_col": 4
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 2
            },
            "span": {
              "start": 39,
              "end": 40,
              "start_line": 5,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 34,
        "end": 42,
        "start_line": 5,
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
              "start": 52,
              "end": 53,
              "start_line": 6,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 42,
        "end": 55,
        "start_line": 6,
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
