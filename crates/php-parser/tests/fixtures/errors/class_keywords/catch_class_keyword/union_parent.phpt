===source===
<?php
try {
} catch (A | Parent $e) {
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
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 21,
                    "end": 22
                  }
                },
                {
                  "parts": [
                    "Parent"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 25,
                    "end": 31
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 32,
                  "end": 34
                }
              },
              "body": [],
              "span": {
                "start": 14,
                "end": 39
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 39
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39
  }
}
