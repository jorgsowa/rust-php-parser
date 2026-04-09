===config===
parse_version=8.0
===source===
<?php function f(): never { throw new \Exception(); }
===errors===
'never type' requires PHP 8.1 or higher (targeting PHP 8.0)
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
                "Throw": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Identifier": "\\Exception"
                        },
                        "span": {
                          "start": 38,
                          "end": 48,
                          "start_line": 1,
                          "start_col": 38
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 34,
                    "end": 50,
                    "start_line": 1,
                    "start_col": 34
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 52,
                "start_line": 1,
                "start_col": 28
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
        "end": 53,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
