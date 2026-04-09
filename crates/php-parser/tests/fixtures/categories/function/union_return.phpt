===source===
<?php function foo(): int|string { return 1; }
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
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 42,
                    "end": 43,
                    "start_line": 1,
                    "start_col": 42
                  }
                }
              },
              "span": {
                "start": 35,
                "end": 45,
                "start_line": 1,
                "start_col": 35
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
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 22,
                        "end": 25,
                        "start_line": 1,
                        "start_col": 22
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 25,
                    "start_line": 1,
                    "start_col": 22
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "string"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 32,
                        "start_line": 1,
                        "start_col": 26
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 32,
                    "start_line": 1,
                    "start_col": 26
                  }
                }
              ]
            },
            "span": {
              "start": 22,
              "end": 32,
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
