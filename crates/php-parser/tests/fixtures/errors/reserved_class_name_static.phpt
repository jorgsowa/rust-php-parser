===source===
<?php class static {}
===errors===
Cannot use 'static' as a class name as it is reserved
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "static",
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
PHP Parse error:  syntax error, unexpected token "static", expecting identifier in Standard input code on line 1
