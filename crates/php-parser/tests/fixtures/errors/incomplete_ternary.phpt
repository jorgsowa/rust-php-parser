===source===
<?php $x ?
===errors===
expected expression
expected ':', found end of file
expected expression
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
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
              "then_expr": {
                "kind": "Error",
                "span": {
                  "start": 10,
                  "end": 10,
                  "start_line": 0,
                  "start_col": 0
                }
              },
              "else_expr": {
                "kind": "Error",
                "span": {
                  "start": 10,
                  "end": 10,
                  "start_line": 0,
                  "start_col": 0
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 10,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10,
    "start_line": 1,
    "start_col": 0
  }
}
