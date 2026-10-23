===source===
<?php try {} catch (Exception $e) { ?> <?php }
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
                    "start": 20,
                    "end": 29
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 30,
                  "end": 32
                }
              },
              "body": [
                {
                  "kind": "Nop",
                  "span": {
                    "start": 36,
                    "end": 38
                  }
                },
                {
                  "kind": {
                    "InlineHtml": " "
                  },
                  "span": {
                    "start": 38,
                    "end": 39
                  }
                }
              ],
              "span": {
                "start": 19,
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
