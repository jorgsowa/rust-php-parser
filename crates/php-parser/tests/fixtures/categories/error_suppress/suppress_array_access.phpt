===source===
<?php @$arr[$key];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "ArrayAccess": {
                  "array": {
                    "kind": {
                      "Variable": "arr"
                    },
                    "span": {
                      "start": 7,
                      "end": 11,
                      "start_line": 1,
                      "start_col": 7
                    }
                  },
                  "index": {
                    "kind": {
                      "Variable": "key"
                    },
                    "span": {
                      "start": 12,
                      "end": 16,
                      "start_line": 1,
                      "start_col": 12
                    }
                  }
                }
              },
              "span": {
                "start": 7,
                "end": 17,
                "start_line": 1,
                "start_col": 7
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
      },
      "span": {
        "start": 6,
        "end": 18,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18,
    "start_line": 1,
    "start_col": 0
  }
}
