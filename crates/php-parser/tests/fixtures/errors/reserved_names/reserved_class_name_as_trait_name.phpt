===source===
<?php
trait int {}
===errors===
Cannot use "int" as a trait name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'int' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "int" as a trait name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "int",
            "span": {
              "start": 12,
              "end": 15
            }
          },
          "members": [],
          "attributes": []
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
