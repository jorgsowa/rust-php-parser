===source===
<?php
use A\int;
===errors===
Cannot use A\int as int because 'int' is a special class name
===php_error===
PHP Fatal error:  Cannot use A\int as int because 'int' is a special class name in Standard input code on line 2
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
                  "int"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 15
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 15
              }
            }
          ]
        }
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
