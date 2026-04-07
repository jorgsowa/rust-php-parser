===source===
<?php try { ?> <?php } catch (Exception $e) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "InlineHtml": " "
              },
              "span": {
                "start": 14,
                "end": 15
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 21,
                "end": 22
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Exception"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 30,
                    "end": 40
                  }
                }
              ],
              "var": "e",
              "body": [],
              "span": {
                "start": 29,
                "end": 46
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
