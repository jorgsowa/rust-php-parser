===config===
min_php=8.2
===source===
<?php function f(): true|null { return null; }
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
                  "kind": "Null",
                  "span": {
                    "start": 39,
                    "end": 43,
                    "start_line": 1,
                    "start_col": 39
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 45,
                "start_line": 1,
                "start_col": 32
              }
            }
          ],
          "return_type": {
            "kind": {
              "Union": [
                {
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
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 25,
                        "end": 29,
                        "start_line": 1,
                        "start_col": 25
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 29,
                    "start_line": 1,
                    "start_col": 25
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 29,
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
        "end": 46,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46,
    "start_line": 1,
    "start_col": 0
  }
}
