===source===
<?php
$foo instanceof
===errors===
expected expression, found end of file
expected ';' after expression
===php_error===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": "Error",
                "span": {
                  "start": 21,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
