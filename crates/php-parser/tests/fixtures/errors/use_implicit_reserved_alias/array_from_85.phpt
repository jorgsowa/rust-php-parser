===source===
<?php
use A\array;
===errors <=7.4===
'reserved keyword in namespaced name' requires PHP 8.0 or higher
===errors >=8.5===
Cannot use A\array as array because 'array' is a special class name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY), expecting identifier (T_STRING) or '{' in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Cannot use A\array as array because 'array' is a special class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "array"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 17
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 17
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
