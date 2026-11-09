===source===
<?php
const = 1;
===errors===
expected constant name, found '='
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=', expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "=", expecting identifier in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": null,
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 14,
                "end": 15
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 15
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
