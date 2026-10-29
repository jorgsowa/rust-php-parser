===source===
<?php interface self {}
===errors===
Cannot use "self" as an interface name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'self' as class name as it is reserved in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Cannot use "self" as an interface name as it is reserved in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "self",
            "span": {
              "start": 16,
              "end": 20
            }
          },
          "extends": [],
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
