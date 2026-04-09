===source===
<?php function f() { ?> <?php }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f",
          "params": [],
          "body": [
            {
              "kind": {
                "InlineHtml": " "
              },
              "span": {
                "start": 23,
                "end": 24,
                "start_line": 1,
                "start_col": 23
              }
            },
            {
              "kind": "Nop",
              "span": {
                "start": 30,
                "end": 31,
                "start_line": 1,
                "start_col": 30
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 31,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31,
    "start_line": 1,
    "start_col": 0
  }
}
