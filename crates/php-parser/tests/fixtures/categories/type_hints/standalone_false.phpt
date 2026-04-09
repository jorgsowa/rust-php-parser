===config===
min_php=8.2
===source===
<?php function f(): false { return false; }
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
                    "Bool": false
                  },
                  "span": {
                    "start": 35,
                    "end": 40,
                    "start_line": 1,
                    "start_col": 35
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 42,
                "start_line": 1,
                "start_col": 28
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "false"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 20,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 20
                }
              }
            },
            "span": {
              "start": 20,
              "end": 25,
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
        "end": 43,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}
