===source===
<?php
// Missing semicolon
use Foo\{Bar}
use Bar\{Foo};
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
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 31,
                  "end": 39,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 36,
                "end": 39,
                "start_line": 3,
                "start_col": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 27,
        "end": 41,
        "start_line": 3,
        "start_col": 0
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
                  "Bar",
                  "Foo"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 45,
                  "end": 53,
                  "start_line": 4,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 50,
                "end": 53,
                "start_line": 4,
                "start_col": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 41,
        "end": 55,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 55,
    "start_line": 1,
    "start_col": 0
  }
}
