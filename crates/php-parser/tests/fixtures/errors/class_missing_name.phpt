===source===
<?php class { }
===errors===
expected class name, found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": null,
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
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "{", expecting identifier in Standard input code on line 1
