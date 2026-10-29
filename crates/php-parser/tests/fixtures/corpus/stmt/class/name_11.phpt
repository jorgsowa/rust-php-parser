===source===
<?php interface PARENT {}
===errors <=8.3===
Cannot use 'PARENT' as class name as it is reserved
===errors >=8.4===
Cannot use "PARENT" as an interface name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'PARENT' as class name as it is reserved in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Cannot use "PARENT" as an interface name as it is reserved in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "PARENT",
            "span": {
              "start": 16,
              "end": 22
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
