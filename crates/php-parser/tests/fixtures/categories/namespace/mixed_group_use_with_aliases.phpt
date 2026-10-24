===source===
<?php
use A\B\{C as D, function e as f, const G as H};
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
                  "B",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 15,
                  "end": 16
                }
              },
              "alias": {
                "name": "D",
                "span": {
                  "start": 20,
                  "end": 21
                }
              },
              "span": {
                "start": 15,
                "end": 21
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "e"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 32,
                  "end": 33
                }
              },
              "alias": {
                "name": "f",
                "span": {
                  "start": 37,
                  "end": 38
                }
              },
              "kind": "Function",
              "span": {
                "start": 23,
                "end": 38
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "B",
                  "G"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 46,
                  "end": 47
                }
              },
              "alias": {
                "name": "H",
                "span": {
                  "start": 51,
                  "end": 52
                }
              },
              "kind": "Const",
              "span": {
                "start": 40,
                "end": 52
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
