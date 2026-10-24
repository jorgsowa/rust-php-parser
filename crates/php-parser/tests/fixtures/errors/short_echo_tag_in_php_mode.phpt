===source===
<?php
echo 1;
<?= 2;
===errors===
expected expression, found '<'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '<', expecting end of file in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "<", expecting end of file in Standard input code on line 3
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
        "end": 13
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 14,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 18,
            "end": 19
          }
        }
      },
      "span": {
        "start": 18,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
