===source===
<?php class A extends self {}
===errors <=7.4===
Cannot use 'self' as class name as it is reserved
===errors 8.0-8.3===
Cannot use 'self' as class name, as it is reserved
===errors >=8.4===
Cannot use "self" as class name, as it is reserved
===php_error <=7.4===
PHP Fatal error:  Cannot use 'self' as class name as it is reserved in Standard input code on line 1
===php_error >=8.0===
PHP Fatal error:  Cannot use "self" as class name, as it is reserved in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
