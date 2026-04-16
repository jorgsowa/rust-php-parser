===source===
<?php interface PARENT {}
===errors===
cannot use 'PARENT' as interface name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "PARENT",
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
===php_error===
PHP Fatal error:  Cannot use "PARENT" as an interface name as it is reserved in Standard input code on line 1
