===source===
<?php $a = [1, 2, 3;
===errors===
expected ']', found ';'
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 12,
                          "end": 13,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 13,
                        "start_line": 1,
                        "start_col": 12
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 15,
                          "end": 16,
                          "start_line": 1,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 16,
                        "start_line": 1,
                        "start_col": 15
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 18,
                          "end": 19,
                          "start_line": 1,
                          "start_col": 18
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 18,
                        "end": 19,
                        "start_line": 1,
                        "start_col": 18
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 11
                }
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
      },
      "span": {
        "start": 6,
        "end": 20,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20,
    "start_line": 1,
    "start_col": 0
  }
}
