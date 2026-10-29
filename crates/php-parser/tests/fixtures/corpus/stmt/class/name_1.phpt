===source===
<?php class self {}
===errors <=8.3===
Cannot use 'self' as class name as it is reserved
===errors >=8.4===
Cannot use "self" as a class name as it is reserved
===php_error <=8.3===
PHP Fatal error:  Cannot use 'self' as class name as it is reserved in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Cannot use "self" as a class name as it is reserved in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "self",
            "span": {
              "start": 12,
              "end": 16
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
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
