===source===
<?php
class callable {}
===errors===
Cannot use "callable" as a class name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'callable' (T_CALLABLE), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "callable", expecting identifier in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "callable",
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
