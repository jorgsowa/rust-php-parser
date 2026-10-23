===source===
<?php clone($a
===errors===
expected ')', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '(' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "Variable": "a"
              },
              "span": {
                "start": 12,
                "end": 14
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
