===source===
<?php
namespace A {}
declare(ticks=1);
foo();
namespace B {}
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
              "end": 18,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 35,
                  "end": 36,
                  "start_line": 3,
                  "start_col": 14
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 21,
        "end": 39,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 39,
                  "end": 42,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 39,
            "end": 44,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 39,
        "end": 46,
        "start_line": 4,
        "start_col": 0
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
              "start": 56,
              "end": 58,
              "start_line": 5,
              "start_col": 10
            }
          },
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 46,
        "end": 60,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60,
    "start_line": 1,
    "start_col": 0
  }
}
