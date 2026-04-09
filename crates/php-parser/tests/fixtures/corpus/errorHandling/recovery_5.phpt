===source===
<?php
function test() {
    1 +
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 28,
                          "end": 29,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": "Error",
                        "span": {
                          "start": 32,
                          "end": 33,
                          "start_line": 4,
                          "start_col": 0
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 33,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 32,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33,
    "start_line": 1,
    "start_col": 0
  }
}
