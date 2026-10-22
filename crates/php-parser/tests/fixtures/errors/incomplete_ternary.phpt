===source===
<?php $x ?
===errors===
expected expression, found end of file
expected ':', found end of file
expected expression, found end of file
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
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
                  "end": 8
                }
              },
              "then_expr": {
                "kind": "Error",
                "span": {
                  "start": 10,
                  "end": 10
                }
              },
              "else_expr": {
                "kind": "Error",
                "span": {
                  "start": 10,
                  "end": 10
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10
  }
}
