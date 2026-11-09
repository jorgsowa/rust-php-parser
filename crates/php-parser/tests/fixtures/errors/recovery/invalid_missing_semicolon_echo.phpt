===source===
<?php
echo "hello"
echo "world";
===errors===
expected ';' after echo statement
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'echo' (T_ECHO), expecting ';' or ',' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "echo", expecting "," or ";" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "hello"
            },
            "span": {
              "start": 11,
              "end": 18
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "world"
            },
            "span": {
              "start": 24,
              "end": 31
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
