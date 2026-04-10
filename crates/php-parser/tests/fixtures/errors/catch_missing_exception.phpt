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
                    "end": 19
                  }
                }
              ],
              "var": null,
              "body": [],
              "span": {
                "start": 20,
                "end": 23
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23
  }
}
