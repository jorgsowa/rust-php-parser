===source===
<?php
namespace A;
use Foo\Bar;
use ArrayIterator;

namespace B;
use Foo\Bar;
use ArrayIterator;
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
        "end": 18
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
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 23,
                  "end": 30
                }
              },
              "alias": null,
              "span": {
                "start": 23,
                "end": 30
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 31
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
                  "ArrayIterator"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 49
                }
              },
              "alias": null,
              "span": {
                "start": 36,
                "end": 49
              }
            }
          ]
        }
      },
      "span": {
        "start": 32,
        "end": 50
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
              "start": 62,
              "end": 63
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 52,
        "end": 64
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
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 69,
                  "end": 76
                }
              },
              "alias": null,
              "span": {
                "start": 69,
                "end": 76
              }
            }
          ]
        }
      },
      "span": {
        "start": 65,
        "end": 77
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
                  "ArrayIterator"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 82,
                  "end": 95
                }
              },
              "alias": null,
              "span": {
                "start": 82,
                "end": 95
              }
            }
          ]
        }
      },
      "span": {
        "start": 78,
        "end": 96
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96
  }
}
