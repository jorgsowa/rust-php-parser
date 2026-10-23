===source===
<?php
try {
} catch (Exception) {
}
===errors <=7.4===
'non-capturing catch' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting '|' or variable (T_VARIABLE) in Standard input code on line 3
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
                "start": 14,
                "end": 35
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
