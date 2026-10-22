===source===
<?php
class ReadOnly {}
===errors >=8.1===
Cannot use "ReadOnly" as a class name as it is reserved
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting identifier in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "ReadOnly",
            "span": {
              "start": 12,
              "end": 20
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
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
