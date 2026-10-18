===config===
min_php=8.4
===source===
<?php interface PARENT {}
===errors===
cannot use 'PARENT' as interface name
===php_error===
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
