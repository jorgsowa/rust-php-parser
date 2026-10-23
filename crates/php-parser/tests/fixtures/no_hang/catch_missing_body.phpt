===source===
<?php try {} catch (E $e) 
===errors===
expected '{', found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected end of file, expecting '{' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected end of file, expecting "{" in Standard input code on line 1
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
                    "E"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 20,
                    "end": 21
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "body": [],
              "span": {
                "start": 13,
                "end": 25
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
