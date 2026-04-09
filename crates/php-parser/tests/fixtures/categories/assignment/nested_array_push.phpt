===source===
<?php $arr[][] = 'deep';
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
                        "end": 12,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "deep"
                },
                "span": {
                  "start": 17,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24,
    "start_line": 1,
    "start_col": 0
  }
}
