===source===
<?php
class A extends match {}
===errors >=8.0===
expected class name, found 'match'
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "match" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "match"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 27
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30
  }
}
