===source===
<?php try { } catch { }
===errors===
expected '(', found '{'
expected identifier, found '{'
expected ')', found '{'
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
===php_error===
PHP Parse error:  syntax error, unexpected token "{", expecting "(" in Standard input code on line 1
