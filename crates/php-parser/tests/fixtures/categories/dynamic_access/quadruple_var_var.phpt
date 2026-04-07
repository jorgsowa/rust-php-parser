===source===
<?php $$$$quad = 1;
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
                  "VariableVariable": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "VariableVariable": {
                            "kind": {
                              "Variable": "quad"
                            },
                            "span": {
                              "start": 9,
                              "end": 14
                            }
                          }
                        },
                        "span": {
                          "start": 8,
                          "end": 14
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14
                    }
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
                  "Int": 1
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
