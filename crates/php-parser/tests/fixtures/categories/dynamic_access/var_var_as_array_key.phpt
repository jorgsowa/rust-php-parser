===source===
<?php $arr[$$key] = 1;
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
                    "index": {
                      "kind": {
                        "VariableVariable": {
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
                      },
                      "span": {
                        "start": 11,
                        "end": 16,
                        "start_line": 1,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 20
                }
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
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22,
    "start_line": 1,
    "start_col": 0
  }
}
