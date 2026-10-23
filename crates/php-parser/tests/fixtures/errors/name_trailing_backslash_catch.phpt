===source===
<?php
try {} catch (A\ $e) {}
===errors===
expected identifier, found variable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$e' (T_VARIABLE), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "\", expecting ")" in Standard input code on line 2
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
                    "A"
                  ],
                  "kind": "Qualified",
                  "span": {
                    "start": 20,
                    "end": 21
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 23,
                  "end": 25
                }
              },
              "body": [],
              "span": {
                "start": 13,
                "end": 29
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29
  }
}
