===source===
<?php

A;
A\B;
\A\B;
namespace\A\B;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "A"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 7,
                "end": 8
              }
            }
          },
          "span": {
            "start": 7,
            "end": 8
          }
        }
      },
      "span": {
        "start": 7,
        "end": 9
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "A",
                "B"
              ],
              "kind": "Qualified",
              "span": {
                "start": 10,
                "end": 13
              }
            }
          },
          "span": {
            "start": 10,
            "end": 13
          }
        }
      },
      "span": {
        "start": 10,
        "end": 14
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "A",
                "B"
              ],
              "kind": "FullyQualified",
              "span": {
                "start": 15,
                "end": 19
              }
            }
          },
          "span": {
            "start": 15,
            "end": 19
          }
        }
      },
      "span": {
        "start": 15,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "A",
                "B"
              ],
              "kind": "Relative",
              "span": {
                "start": 21,
                "end": 34
              }
            }
          },
          "span": {
            "start": 21,
            "end": 34
          }
        }
      },
      "span": {
        "start": 21,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
