===source===
<?php class Test implements { }
===errors===
expected identifier, found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting identifier (T_STRING) or namespace (T_NAMESPACE) or \\ (T_NS_SEPARATOR) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 12,
              "end": 16
            }
          },
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
