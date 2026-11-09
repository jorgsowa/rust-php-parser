===source===
<?php declare(strict_types=1, , ticks=1);
===errors===
expected identifier, found ','
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',', expecting identifier (T_STRING) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ",", expecting identifier in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
                  "end": 28
                }
              }
            ]
          ],
          "body": {
            "kind": "Error",
            "span": {
              "start": 30,
              "end": 41
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
