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
                      "end": 11
                    }
                  },
                  "index": {
                    "kind": {
                      "Variable": "key"
                    },
                    "span": {
                      "start": 12,
                      "end": 16
                    }
                  }
                }
              },
              "span": {
                "start": 7,
                "end": 17
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
