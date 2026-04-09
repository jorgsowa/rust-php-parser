===config===
min_php=8.2
===source===
<?php function f(): true { return true; }
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
                "Return": {
                  "kind": {
                    "Bool": true
                  },
                  "span": {
                    "start": 34,
                    "end": 38,
                    "start_line": 1,
                    "start_col": 34
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 40,
                "start_line": 1,
                "start_col": 27
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "true"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 20
                }
              }
            },
            "span": {
              "start": 20,
              "end": 24,
              "start_line": 1,
              "start_col": 20
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41,
    "start_line": 1,
    "start_col": 0
  }
}
