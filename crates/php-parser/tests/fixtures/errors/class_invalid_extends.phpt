===source===
<?php class Test extends { }
===errors===
expected identifier, found '{'
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "<error>"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 25,
              "end": 26
            }
          },
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 1
