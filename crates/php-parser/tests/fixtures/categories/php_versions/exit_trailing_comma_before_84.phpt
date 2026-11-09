===source===
<?php exit(1,);
===errors <=8.3===
'exit function call' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',', expecting ')' in Standard input code on line 1
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token ",", expecting ")" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 11,
                "end": 12
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
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
