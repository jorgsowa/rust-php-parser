===source===
<?php #[\App\Attr] function foo() {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "App",
                  "Attr"
                ],
                "kind": "FullyQualified",
                "span": {
                  "start": 8,
                  "end": 17,
                  "start_line": 1,
                  "start_col": 8
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 17,
                "start_line": 1,
                "start_col": 8
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 36,
        "start_line": 1,
        "start_col": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
