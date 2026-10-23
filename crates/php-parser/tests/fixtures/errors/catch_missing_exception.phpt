===source===
<?php try { } catch { }
===errors <=7.4===
expected '(', found '{'
'non-capturing catch' requires PHP 8.0 or higher
===errors >=8.0===
expected '(', found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting '(' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "{", expecting "(" in Standard input code on line 1
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
                  "parts": [],
                  "kind": "Error",
                  "span": {
                    "start": 19,
                    "end": 19
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 14,
                "end": 23
              }
            }
          ],
          "finally": null
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
