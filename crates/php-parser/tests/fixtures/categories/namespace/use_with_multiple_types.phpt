===source===
<?php use function A\foo; use const SOME_CONST; use B\C;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "foo"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 19,
                  "end": 24
                }
              },
              "alias": null,
              "span": {
                "start": 19,
                "end": 24
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 25
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
                  "SOME_CONST"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 46
                }
              },
              "alias": null,
              "span": {
                "start": 36,
                "end": 46
              }
            }
          ]
        }
      },
      "span": {
        "start": 26,
        "end": 47
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
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 52,
                  "end": 55
                }
              },
              "alias": null,
              "span": {
                "start": 52,
                "end": 55
              }
            }
          ]
        }
      },
      "span": {
        "start": 48,
        "end": 56
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56
  }
}
