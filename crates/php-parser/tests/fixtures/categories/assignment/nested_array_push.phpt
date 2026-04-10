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
                              "end": 10
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 12
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "deep"
                },
                "span": {
                  "start": 17,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
