===source===
<?php class static {}
===errors <=8.3===
Cannot use 'static' as class name as it is reserved
===errors >=8.4===
Cannot use "static" as a class name as it is reserved
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC), expecting identifier (T_STRING) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "static", expecting identifier in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "static",
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
