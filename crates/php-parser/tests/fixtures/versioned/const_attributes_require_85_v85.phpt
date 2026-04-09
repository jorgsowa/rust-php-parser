===config===
parse_version=8.5
===source===
<?php #[MyAttr] const VERSION = '8.5';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "VERSION",
            "value": {
              "kind": {
                "String": "8.5"
              },
              "span": {
                "start": 32,
                "end": 37,
                "start_line": 1,
                "start_col": 32
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "MyAttr"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 8,
                    "end": 14,
                    "start_line": 1,
                    "start_col": 8
                  }
                },
                "args": [],
                "span": {
                  "start": 8,
                  "end": 14,
                  "start_line": 1,
                  "start_col": 8
                }
              }
            ],
            "span": {
              "start": 22,
              "end": 37,
              "start_line": 1,
              "start_col": 22
            }
          }
        ]
      },
      "span": {
        "start": 16,
        "end": 38,
        "start_line": 1,
        "start_col": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38,
    "start_line": 1,
    "start_col": 0
  }
}
