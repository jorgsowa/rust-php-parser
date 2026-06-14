===config===
min_php=7.4
===source===
<?php
try {
} catch (Exception) {
}
===errors===
'non-capturing catch' requires PHP 8.0 or higher (targeting PHP 7.4)
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
