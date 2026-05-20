===source===
<?php 'hé

===errors===
unterminated string literal
expected ';' after expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "hé\n"
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 11
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 11
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected string content "hé", expecting end of file in Standard input code on line 1
