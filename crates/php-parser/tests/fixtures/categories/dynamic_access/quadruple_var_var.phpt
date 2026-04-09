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
                              "end": 14,
                              "start_line": 1,
                              "start_col": 9
                            }
                          }
                        },
                        "span": {
                          "start": 8,
                          "end": 14,
                          "start_line": 1,
                          "start_col": 8
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14,
                      "start_line": 1,
                      "start_col": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14,
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
                  "start": 17,
                  "end": 18,
                  "start_line": 1,
                  "start_col": 17
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
        }
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19,
    "start_line": 1,
    "start_col": 0
  }
}
