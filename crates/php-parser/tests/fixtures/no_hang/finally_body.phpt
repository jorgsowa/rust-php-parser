===source===
<?php try {} finally { ?> <?php }
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [],
          "finally": [
            {
              "kind": {
                "InlineHtml": " "
              },
              "span": {
                "start": 25,
                "end": 26,
                "start_line": 1,
                "start_col": 25
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 32,
                "end": 33,
                "start_line": 1,
                "start_col": 32
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 33,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33,
    "start_line": 1,
    "start_col": 0
  }
}
