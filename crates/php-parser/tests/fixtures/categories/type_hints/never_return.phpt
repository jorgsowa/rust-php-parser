===source===
<?php function abort(): never { throw new Exception(); }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "abort",
          "params": [],
          "body": [
            {
              "kind": {
                "Throw": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Identifier": "Exception"
                        },
                        "span": {
                          "start": 42,
                          "end": 51,
                          "start_line": 1,
                          "start_col": 42
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 38,
                    "end": 53,
                    "start_line": 1,
                    "start_col": 38
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 55,
                "start_line": 1,
                "start_col": 32
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "never"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 24,
                  "end": 29,
                  "start_line": 1,
                  "start_col": 24
                }
              }
            },
            "span": {
              "start": 24,
              "end": 29,
              "start_line": 1,
              "start_col": 24
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 56,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 56,
    "start_line": 1,
    "start_col": 0
  }
}
