===source===
<?php
class ReadOnly {}
===errors===
cannot use 'ReadOnly' as class name
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "ReadOnly",
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
PHP Parse error:  syntax error, unexpected token "readonly", expecting identifier in Standard input code on line 2
