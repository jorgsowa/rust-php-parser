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
                    "end": 30,
                    "start_line": 1,
                    "start_col": 20
                  }
                }
              ],
              "var": "e",
              "body": [
                {
                  "kind": {
                    "InlineHtml": " "
                  },
                  "span": {
                    "start": 38,
                    "end": 39,
                    "start_line": 1,
                    "start_col": 38
                  }
                },
                {
                  "kind": "Nop",
                  "span": {
                    "start": 45,
                    "end": 46,
                    "start_line": 1,
                    "start_col": 45
                  }
                }
              ],
              "span": {
                "start": 19,
                "end": 46,
                "start_line": 1,
                "start_col": 19
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
