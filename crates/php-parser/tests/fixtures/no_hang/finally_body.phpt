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
                "end": 26
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 32,
                "end": 33
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
