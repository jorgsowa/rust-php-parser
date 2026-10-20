===source===
<?php class readonly {}
===errors===
Cannot use "readonly" as a class name as it is reserved
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting identifier in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "readonly",
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
