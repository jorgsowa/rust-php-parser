===source===
<?php
try {} catch (array $e) {}
===errors===
expected class name, found 'array'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'array' (T_ARRAY), expecting identifier (T_STRING) or namespace (T_NAMESPACE) or \\ (T_NS_SEPARATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "array" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "array"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 20,
                    "end": 25
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 26,
                  "end": 28
                }
              },
              "body": [],
              "span": {
                "start": 13,
                "end": 32
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
