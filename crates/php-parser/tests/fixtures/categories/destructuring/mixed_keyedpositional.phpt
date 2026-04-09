===source===
<?php [0 => $first, 'key' => $val] = $arr;
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 7,
                          "end": 8,
                          "start_line": 1,
                          "start_col": 7
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "first"
                        },
                        "span": {
                          "start": 12,
                          "end": 18,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 18,
                        "start_line": 1,
                        "start_col": 7
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "key"
                        },
                        "span": {
                          "start": 20,
                          "end": 25,
                          "start_line": 1,
                          "start_col": 20
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "val"
                        },
                        "span": {
                          "start": 29,
                          "end": 33,
                          "start_line": 1,
                          "start_col": 29
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 20,
                        "end": 33,
                        "start_line": 1,
                        "start_col": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 37,
                  "end": 41,
                  "start_line": 1,
                  "start_col": 37
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 41,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42,
    "start_line": 1,
    "start_col": 0
  }
}
