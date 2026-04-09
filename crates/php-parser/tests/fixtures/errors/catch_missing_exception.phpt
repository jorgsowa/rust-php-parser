===source===
<?php try { } catch { }
===errors===
expected '(', found '{'
expected identifier, found '{'
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
                    "<error>"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 20,
                    "end": 20,
                    "start_line": 1,
                    "start_col": 20
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 20,
                "end": 23,
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
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23,
    "start_line": 1,
    "start_col": 0
  }
}
