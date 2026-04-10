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
                        "end": 10
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
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 17
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
