===source===
<?php
const class = 1;
===errors===
cannot use 'class' as constant name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'class' (T_CLASS), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "class", expecting identifier in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "class",
              "span": {
                "start": 12,
                "end": 17
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 20,
                "end": 21
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
