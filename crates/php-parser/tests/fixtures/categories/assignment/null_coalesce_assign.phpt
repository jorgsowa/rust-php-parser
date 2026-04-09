===source===
<?php $a ??= 'default';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "String": "default"
                },
                "span": {
                  "start": 13,
                  "end": 22,
                  "start_line": 1,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23,
    "start_line": 1,
    "start_col": 0
  }
}
