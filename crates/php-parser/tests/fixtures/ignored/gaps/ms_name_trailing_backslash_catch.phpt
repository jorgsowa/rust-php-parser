===source===
<?php
try {} catch (A\ $e) {}
===errors >=8.5===
expected identifier, found variable
===php_error===
PHP Parse error:  syntax error, unexpected token "\", expecting ")" in Standard input code on line 2
===ast >=8.5===
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
                "start": 19,
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
