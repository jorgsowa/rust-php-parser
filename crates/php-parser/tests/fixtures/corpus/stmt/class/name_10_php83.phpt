===config===
max_php=8.3
===source===
<?php interface self {}
===errors===
cannot use 'self' as interface name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "self",
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
===php_error===
PHP Fatal error:  Cannot use 'self' as class name as it is reserved in Standard input code on line 1
