===source===
<?php $x = "hello $name"; 
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "hello "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 18,
                          "end": 23,
                          "start_line": 1,
                          "start_col": 18
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}
