===source===
<?php class Test implements { }
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
          "extends": null,
          "implements": [
            {
              "parts": [],
              "kind": "Error",
              "span": {
                "start": 28,
                "end": 29
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 1
