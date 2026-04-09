===source===
<?php const A = 1, B = 2, C = 3;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "A",
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 16,
                "end": 17,
                "start_line": 1,
                "start_col": 16
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 17,
              "start_line": 1,
              "start_col": 12
            }
          },
          {
            "name": "B",
            "value": {
              "kind": {
                "Int": 2
              },
              "span": {
                "start": 23,
                "end": 24,
                "start_line": 1,
                "start_col": 23
              }
            },
            "attributes": [],
            "span": {
              "start": 19,
              "end": 24,
              "start_line": 1,
              "start_col": 19
            }
          },
          {
            "name": "C",
            "value": {
              "kind": {
                "Int": 3
              },
              "span": {
                "start": 30,
                "end": 31,
                "start_line": 1,
                "start_col": 30
              }
            },
            "attributes": [],
            "span": {
              "start": 26,
              "end": 31,
              "start_line": 1,
              "start_col": 26
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 32,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32,
    "start_line": 1,
    "start_col": 0
  }
}
