===source===
<?php try { } catch (Exception { }
===errors===
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
                  "parts": [
                    "Exception"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 21,
                    "end": 30
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 20,
                "end": 34
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 1
