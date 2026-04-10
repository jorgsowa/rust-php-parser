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
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 19
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
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 27
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
              "end": 38
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
                        "end": 51
                      }
                    }
                  ]
                },
                "span": {
                  "start": 45,
                  "end": 53
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 27,
        "end": 54
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
              "end": 61
            }
          }
        ]
      },
      "span": {
        "start": 55,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
