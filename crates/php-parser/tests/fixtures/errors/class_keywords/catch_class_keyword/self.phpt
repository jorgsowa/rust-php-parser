===source===
<?php
try {
} catch (self $e) {
}
===errors===
Bad class name in the catch statement
===php_error===
PHP Fatal error:  Bad class name in the catch statement in Standard input code on line 3
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
                    "self"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 21,
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
                "start": 14,
                "end": 33
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
