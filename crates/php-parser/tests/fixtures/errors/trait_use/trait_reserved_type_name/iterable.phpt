===source===
<?php
trait iterable {}
===errors===
Cannot use "iterable" as a trait name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'iterable' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "iterable" as a trait name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "iterable",
            "span": {
              "start": 12,
              "end": 20
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
