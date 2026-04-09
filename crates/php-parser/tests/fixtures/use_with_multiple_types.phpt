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
                  "end": 24,
                  "start_line": 1,
                  "start_col": 19
                }
              },
              "alias": null,
              "span": {
                "start": 19,
                "end": 24,
                "start_line": 1,
                "start_col": 19
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 1,
        "start_col": 6
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
                  "end": 46,
                  "start_line": 1,
                  "start_col": 36
                }
              },
              "alias": null,
              "span": {
                "start": 36,
                "end": 46,
                "start_line": 1,
                "start_col": 36
              }
            }
          ]
        }
      },
      "span": {
        "start": 26,
        "end": 48,
        "start_line": 1,
        "start_col": 26
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
                  "end": 55,
                  "start_line": 1,
                  "start_col": 52
                }
              },
              "alias": null,
              "span": {
                "start": 52,
                "end": 55,
                "start_line": 1,
                "start_col": 52
              }
            }
          ]
        }
      },
      "span": {
        "start": 48,
        "end": 56,
        "start_line": 1,
        "start_col": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56,
    "start_line": 1,
    "start_col": 0
  }
}
