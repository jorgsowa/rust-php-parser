===source===
<?php $arr[0][1];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "arr"
                      },
                      "span": {
                        "start": 6,
                        "end": 10,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 11,
                        "end": 12,
                        "start_line": 1,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "index": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 14,
                  "end": 15,
                  "start_line": 1,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17,
    "start_line": 1,
    "start_col": 0
  }
}
