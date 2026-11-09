===source===
<?php
declare(strict_types=FOO);
===errors===
declare(strict_types) value must be a literal
===php_error===
PHP Fatal error:  declare(strict_types) value must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 27,
                      "end": 30
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 30
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
