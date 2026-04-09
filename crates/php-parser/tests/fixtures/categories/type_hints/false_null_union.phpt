===config===
min_php=8.2
===source===
<?php function f(): false|null { return null; }
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
                    "start": 40,
                    "end": 44,
                    "start_line": 1,
                    "start_col": 40
                  }
                }
              },
              "span": {
                "start": 33,
                "end": 46,
                "start_line": 1,
                "start_col": 33
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
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 26,
                        "end": 30,
                        "start_line": 1,
                        "start_col": 26
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 30,
                    "start_line": 1,
                    "start_col": 26
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 30,
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
        "end": 47,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47,
    "start_line": 1,
    "start_col": 0
  }
}
