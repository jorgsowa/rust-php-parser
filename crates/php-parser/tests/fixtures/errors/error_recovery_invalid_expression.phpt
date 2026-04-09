===source===
<?php + ; $x = 1;
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Plus",
              "operand": {
                "kind": "Error",
                "span": {
                  "start": 8,
                  "end": 9,
                  "start_line": 1,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 9,
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
    },
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
                  "start": 10,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 10
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 15,
                  "end": 16,
                  "start_line": 1,
                  "start_col": 15
                }
              }
            }
          },
          "span": {
            "start": 10,
            "end": 16,
            "start_line": 1,
            "start_col": 10
          }
        }
      },
      "span": {
        "start": 10,
        "end": 17,
        "start_line": 1,
        "start_col": 10
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17,
    "start_line": 1,
    "start_col": 0
  }
}
