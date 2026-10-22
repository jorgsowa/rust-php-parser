===source===
<?php try { } catch { }
===errors <=7.4===
expected '(', found '{'
expected identifier, found '{'
'non-capturing catch' requires PHP 8.0 or higher
expected ')', found '{'
===errors >=8.0===
expected '(', found '{'
expected identifier, found '{'
expected ')', found '{'
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
                    "start": 20,
                    "end": 21
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 20,
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
