===source===
<?php
use \string;
===errors===
Cannot use string as string because 'string' is a special class name
===php_error===
PHP Warning:  The use statement with non-compound name 'string' has no effect in Standard input code on line 2
PHP Fatal error:  Cannot use string as string because 'string' is a special class name in Standard input code on line 2
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
                  "string"
                ],
                "kind": "FullyQualified",
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
