===source===
<?php
try {
} catch (\self $e) {
}
===errors===
'\self' is an invalid class name
===php_error===
PHP Fatal error:  '\self' is an invalid class name in Standard input code on line 3
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
                  "kind": "FullyQualified",
                  "span": {
                    "start": 21,
                    "end": 26
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 27,
                  "end": 29
                }
              },
              "body": [],
              "span": {
                "start": 14,
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
