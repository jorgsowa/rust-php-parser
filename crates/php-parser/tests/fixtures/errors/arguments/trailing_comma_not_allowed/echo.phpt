===source===
<?php
echo 1,;
===errors===
expected expression, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';' in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 11,
              "end": 12
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 14
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 14
  }
}
