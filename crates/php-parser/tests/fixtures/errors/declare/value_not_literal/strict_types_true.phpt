===source===
<?php
declare(strict_types=true);
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
                  "Bool": true
                },
                "span": {
                  "start": 27,
                  "end": 31
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
