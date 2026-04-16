===source===
<?php class A extends PARENT {}
===errors===
cannot use 'PARENT' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "PARENT"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 28
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
===php_error===
PHP Fatal error:  Cannot use "PARENT" as class name, as it is reserved in Standard input code on line 1
