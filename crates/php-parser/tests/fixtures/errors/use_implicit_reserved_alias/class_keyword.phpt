===source===
<?php
use A\Self;
===errors===
Cannot use A\Self as Self because 'Self' is a special class name
===php_error===
PHP Fatal error:  Cannot use A\Self as Self because 'Self' is a special class name in Standard input code on line 2
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
                  "Self"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 16
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 16
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
