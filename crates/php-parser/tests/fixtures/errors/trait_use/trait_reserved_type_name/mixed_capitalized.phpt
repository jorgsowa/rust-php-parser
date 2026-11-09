===source===
<?php
trait Mixed {}
===errors >=8.0===
Cannot use "Mixed" as a trait name as it is reserved
===php_error 8.0-8.3===
PHP Fatal error:  Cannot use 'Mixed' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "Mixed" as a trait name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "Mixed",
            "span": {
              "start": 12,
              "end": 17
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
