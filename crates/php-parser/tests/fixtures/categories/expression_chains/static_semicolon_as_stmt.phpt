===source===
<?php static;
===errors===
Cannot use 'static' as a standalone expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting "::" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "static"
              ],
              "kind": "Unqualified",
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
      },
      "span": {
        "start": 6,
        "end": 13
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13
  }
}
