===source===
<?php
declare(STRICT_TYPES=PHP_INT_MAX);
===errors===
declare(STRICT_TYPES) value must be a literal
===php_error===
PHP Fatal error:  declare(STRICT_TYPES) value must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "STRICT_TYPES",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "PHP_INT_MAX"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 27,
                      "end": 38
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 38
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
