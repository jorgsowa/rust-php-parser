===config===
min_php=8.4
===source===
<?php class self {}
===errors===
cannot use 'self' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "self",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
===php_error===
PHP Fatal error:  Cannot use "self" as a class name as it is reserved in Standard input code on line 1
