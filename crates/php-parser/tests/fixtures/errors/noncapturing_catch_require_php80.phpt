===source===
<?php
try {
} catch (Exception) {
}
===errors <=7.4===
'non-capturing catch' requires PHP 8.0 or higher
===ast >=7.4===
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
