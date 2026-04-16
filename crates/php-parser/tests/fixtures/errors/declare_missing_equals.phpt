===source===
<?php declare(strict_types 1);
===errors===
expected '=', found integer
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
===php_error===
PHP Parse error:  syntax error, unexpected integer "1", expecting "=" in Standard input code on line 1
