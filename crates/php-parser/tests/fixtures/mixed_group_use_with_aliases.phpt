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
                  "start": 10,
                  "end": 17
                }
              },
              "alias": "D",
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
                  "start": 10,
                  "end": 34
                }
              },
              "alias": "f",
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
                  "start": 10,
                  "end": 48
                }
              },
              "alias": "H",
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
