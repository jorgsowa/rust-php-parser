===source===
<?php
class C implements I, {}
===errors===
expected class name, found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting identifier (T_STRING) or namespace (T_NAMESPACE) or \\ (T_NS_SEPARATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
          "extends": null,
          "implements": [
            {
              "parts": [
                "I"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 25,
                "end": 26
              }
            }
          ],
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
