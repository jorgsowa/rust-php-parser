===source===
<?php
interface int {}
===errors===
Cannot use "int" as an interface name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'int' as class name as it is reserved in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Cannot use "int" as an interface name as it is reserved in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "int",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
