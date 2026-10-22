===source===
<?php
new;
===errors===
expected identifier, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 2
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 2
===php_error >=8.3===
PHP Parse error:  syntax error, unexpected token ";", expecting "class" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": "Error",
                "span": {
                  "start": 9,
                  "end": 10
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 9
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
