===source===
<?php use A as self;
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
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 10
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 15,
                "start_line": 1,
                "start_col": 10
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 15,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "self"
          },
          "span": {
            "start": 15,
            "end": 19,
            "start_line": 1,
            "start_col": 15
          }
        }
      },
      "span": {
        "start": 15,
        "end": 20,
        "start_line": 1,
        "start_col": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20,
    "start_line": 1,
    "start_col": 0
  }
}
