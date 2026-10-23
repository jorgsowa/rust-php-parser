===source===
<?php

try {

} catch (Exception) {

}
===errors <=7.4===
'non-capturing catch' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')', expecting '|' or variable (T_VARIABLE) in Standard input code on line 5
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
                    "start": 23,
                    "end": 32
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 16,
                "end": 38
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 7,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
