===description===
PHP rejects type-name aliases (int, string, void, etc.) as class names with
"Cannot use "string" as a class name as it is reserved".
===source===
<?php
class string {}
===errors >=8.5===
Cannot use "string" as a class name as it is reserved
===php_error >=8.5===
PHP Fatal error:  Cannot use "string" as a class name as it is reserved in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "string",
            "span": {
              "start": 12,
              "end": 18
            }
          },
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
