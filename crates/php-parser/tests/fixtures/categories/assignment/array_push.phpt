===source===
<?php $arr[] = 'new';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
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
                    "index": null
                  }
                },
                "span": {
                  "start": 6,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "new"
                },
                "span": {
                  "start": 15,
                  "end": 20,
                  "start_line": 1,
                  "start_col": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21,
    "start_line": 1,
    "start_col": 0
  }
}
