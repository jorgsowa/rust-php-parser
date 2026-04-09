===source===
<?php #[Route("/api")] function foo() {}
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
                  "Route"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 8
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": "/api"
                    },
                    "span": {
                      "start": 14,
                      "end": 20,
                      "start_line": 1,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 20,
                    "start_line": 1,
                    "start_col": 14
                  }
                }
              ],
              "span": {
                "start": 8,
                "end": 21,
                "start_line": 1,
                "start_col": 8
              }
            }
          ]
        }
      },
      "span": {
        "start": 23,
        "end": 40,
        "start_line": 1,
        "start_col": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40,
    "start_line": 1,
    "start_col": 0
  }
}
