===source===
<?php
declare(ticks=1,);
===errors===
expected identifier, found ')'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ")", expecting identifier in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
