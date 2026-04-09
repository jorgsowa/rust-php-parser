===source===
<?php $x = 'unterminated
 echo 'hello';
===errors===
expected ';' after expression
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
                  "String": "unterminated\n echo "
                },
                "span": {
                  "start": 11,
                  "end": 32,
                  "start_line": 1,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "hello"
          },
          "span": {
            "start": 32,
            "end": 37,
            "start_line": 2,
            "start_col": 7
          }
        }
      },
      "span": {
        "start": 32,
        "end": 39,
        "start_line": 2,
        "start_col": 7
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39,
    "start_line": 1,
    "start_col": 0
  }
}
