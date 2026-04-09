===source===
<?php

try {

} catch (Exception) {

}
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
                    "end": 32,
                    "start_line": 5,
                    "start_col": 9
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 22,
                "end": 38,
                "start_line": 5,
                "start_col": 8
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 7,
        "end": 38,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
