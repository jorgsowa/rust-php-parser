===source===
<?php
use A\readonly;
use A\enum;
use A\resource;
use function A\int;
use const A\string;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "readonly"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 20
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 20
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 21
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
                  "A",
                  "enum"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 26,
                  "end": 32
                }
              },
              "alias": null,
              "span": {
                "start": 26,
                "end": 32
              }
            }
          ]
        }
      },
      "span": {
        "start": 22,
        "end": 33
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
                  "A",
                  "resource"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 38,
                  "end": 48
                }
              },
              "alias": null,
              "span": {
                "start": 38,
                "end": 48
              }
            }
          ]
        }
      },
      "span": {
        "start": 34,
        "end": 49
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
                  "A",
                  "int"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 63,
                  "end": 68
                }
              },
              "alias": null,
              "span": {
                "start": 63,
                "end": 68
              }
            }
          ]
        }
      },
      "span": {
        "start": 50,
        "end": 69
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "string"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 80,
                  "end": 88
                }
              },
              "alias": null,
              "span": {
                "start": 80,
                "end": 88
              }
            }
          ]
        }
      },
      "span": {
        "start": 70,
        "end": 89
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89
  }
}
