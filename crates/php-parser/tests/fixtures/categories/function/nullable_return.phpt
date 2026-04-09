===source===
<?php function foo(): ?int { return null; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 36,
                    "end": 40,
                    "start_line": 1,
                    "start_col": 36
                  }
                }
              },
              "span": {
                "start": 29,
                "end": 42,
                "start_line": 1,
                "start_col": 29
              }
            }
          ],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 23,
                      "end": 26,
                      "start_line": 1,
                      "start_col": 23
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 23
                }
              }
            },
            "span": {
              "start": 22,
              "end": 26,
              "start_line": 1,
              "start_col": 22
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
