===source===
<?php declare(strict_types 1);
===errors===
expected '=', found integer
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '1' (T_LNUMBER), expecting '=' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected integer "1", expecting "=" in Standard input code on line 1
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
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
