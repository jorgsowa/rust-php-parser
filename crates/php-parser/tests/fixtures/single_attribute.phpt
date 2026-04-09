===source===
<?php #[Pure] function foo() {}
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
                  "Pure"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 8
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 12,
                "start_line": 1,
                "start_col": 8
              }
            }
          ]
        }
      },
      "span": {
        "start": 14,
        "end": 31,
        "start_line": 1,
        "start_col": 14
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
