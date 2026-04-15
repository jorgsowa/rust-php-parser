===config===
min_php=8.5
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
              "end": 17
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
                        "end": 30
                      }
                    }
                  ]
                },
                "span": {
                  "start": 24,
                  "end": 31
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
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
              "end": 40
            }
          }
        ]
      },
      "span": {
        "start": 34,
        "end": 41
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
              "end": 53
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 42,
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
===php_error===
PHP Fatal error:  No code may exist outside of namespace {} in Standard input code on line 5
Stack trace:
#0 {main}
