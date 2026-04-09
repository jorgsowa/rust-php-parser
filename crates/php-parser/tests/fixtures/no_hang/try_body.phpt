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
                "end": 15,
                "start_line": 1,
                "start_col": 14
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 21,
                "end": 22,
                "start_line": 1,
                "start_col": 21
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
                    "end": 40,
                    "start_line": 1,
                    "start_col": 30
                  }
                }
              ],
              "var": "e",
              "body": [],
              "span": {
                "start": 29,
                "end": 46,
                "start_line": 1,
                "start_col": 29
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 46,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46,
    "start_line": 1,
    "start_col": 0
  }
}
