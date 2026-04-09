===source===
<?php function noop(): void {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "noop",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 23,
                  "end": 27,
                  "start_line": 1,
                  "start_col": 23
                }
              }
            },
            "span": {
              "start": 23,
              "end": 27,
              "start_line": 1,
              "start_col": 23
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 30,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30,
    "start_line": 1,
    "start_col": 0
  }
}
