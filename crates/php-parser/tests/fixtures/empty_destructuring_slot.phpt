===source===
<?php [$a, , $c] = $arr;
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
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 7,
                          "end": 9,
                          "start_line": 1,
                          "start_col": 7
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 9,
                        "start_line": 1,
                        "start_col": 7
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 11,
                          "end": 12,
                          "start_line": 1,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 12,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 13,
                          "end": 15,
                          "start_line": 1,
                          "start_col": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 13,
                        "end": 15,
                        "start_line": 1,
                        "start_col": 13
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 16,
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
                  "start": 19,
                  "end": 23,
                  "start_line": 1,
                  "start_col": 19
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
