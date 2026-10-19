===source===
<?php
namespace A\__halt_compiler;
use B\__halt_compiler;
use C\__halt_compiler as D;
use function E\__halt_compiler;
echo 1;
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A",
              "__halt_compiler"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 33
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "B",
                  "__halt_compiler"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 39,
                  "end": 56
                }
              },
              "alias": null,
              "span": {
                "start": 39,
                "end": 56
              }
            }
          ]
        }
      },
      "span": {
        "start": 35,
        "end": 57
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "C",
                  "__halt_compiler"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 62,
                  "end": 79
                }
              },
              "alias": {
                "name": "D",
                "span": {
                  "start": 83,
                  "end": 84
                }
              },
              "span": {
                "start": 62,
                "end": 84
              }
            }
          ]
        }
      },
      "span": {
        "start": 58,
        "end": 85
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "E",
                  "__halt_compiler"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 99,
                  "end": 116
                }
              },
              "alias": null,
              "span": {
                "start": 99,
                "end": 116
              }
            }
          ]
        }
      },
      "span": {
        "start": 86,
        "end": 117
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
              "start": 123,
              "end": 124
            }
          }
        ]
      },
      "span": {
        "start": 118,
        "end": 125
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 125
  }
}
