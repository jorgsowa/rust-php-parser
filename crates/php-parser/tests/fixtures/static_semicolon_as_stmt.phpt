===source===
<?php static;
===errors===
Cannot use 'static' as a standalone expression
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "::" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "static"
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
