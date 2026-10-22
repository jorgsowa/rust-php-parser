===source===
<?php match ($x) {
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
expected '}', found end of file
expected ';' after expression
===errors >=8.0===
expected '}', found end of file
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  Unclosed '{' in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              },
              "arms": []
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
