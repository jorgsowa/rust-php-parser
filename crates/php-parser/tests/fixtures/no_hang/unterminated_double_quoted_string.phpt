===source===
<?php $x = "
===errors===
unterminated string literal
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
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": ""
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected end of file, expecting variable or string content or "${" or "{$" in Standard input code on line 1
