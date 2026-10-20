===source===
<?php
use A as int;
===errors >=8.5===
Cannot use A as int because 'int' is a special class name
===php_error===
PHP Fatal error:  Cannot use A as int because 'int' is a special class name in Standard input code on line 2
===ast >=8.5===
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
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": {
                "name": "int",
                "span": {
                  "start": 15,
                  "end": 18
                }
              },
              "span": {
                "start": 10,
                "end": 18
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
