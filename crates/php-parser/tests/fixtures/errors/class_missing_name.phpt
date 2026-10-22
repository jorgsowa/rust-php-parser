===source===
<?php class { }
===errors===
expected class name, found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting identifier (T_STRING) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{", expecting identifier in Standard input code on line 1
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
