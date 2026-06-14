===source===
<?php
class class {}
===errors===
Cannot use "class" as a class name as it is reserved
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "class",
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
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "class", expecting identifier in Standard input code on line 2
