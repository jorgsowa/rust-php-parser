===source===
<?php class A extends self {}
===errors===
cannot use 'self' as class name
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
              "self"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 26
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
===php_error===
PHP Fatal error:  Cannot use "self" as class name, as it is reserved in Standard input code on line 1
