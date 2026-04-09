===source===
<?php use B as PARENT;
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
                  "B"
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
            "Identifier": "parent"
          },
          "span": {
            "start": 15,
            "end": 21,
            "start_line": 1,
            "start_col": 15
          }
        }
      },
      "span": {
        "start": 15,
        "end": 22,
        "start_line": 1,
        "start_col": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
