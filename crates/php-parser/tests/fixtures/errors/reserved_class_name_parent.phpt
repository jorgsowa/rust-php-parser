===source===
<?php class parent {}
===errors===
cannot use 'parent' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "parent",
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
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
===php_error===
PHP Fatal error:  Cannot use "parent" as a class name as it is reserved in Standard input code on line 1
