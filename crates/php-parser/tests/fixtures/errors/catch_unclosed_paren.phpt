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
                    "end": 31,
                    "start_line": 1,
                    "start_col": 21
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 20,
                "end": 34,
                "start_line": 1,
                "start_col": 20
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 34,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34,
    "start_line": 1,
    "start_col": 0
  }
}
