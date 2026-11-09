===source===
<?php
interface I extends A, {}
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
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [
            {
              "parts": [
                "A"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 26,
                "end": 27
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
