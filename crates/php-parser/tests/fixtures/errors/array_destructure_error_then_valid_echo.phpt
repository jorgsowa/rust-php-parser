===source===
<?php [$a, , ,] = ; echo $a;
===errors===
expected expression
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
                        "kind": "Omit",
                        "span": {
                          "start": 13,
                          "end": 14,
                          "start_line": 1,
                          "start_col": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 13,
                        "end": 14,
                        "start_line": 1,
                        "start_col": 13
                      }
                    }
                  ]
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
                "kind": "Error",
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 18
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
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 25,
              "end": 27,
              "start_line": 1,
              "start_col": 25
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 28,
        "start_line": 1,
        "start_col": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28,
    "start_line": 1,
    "start_col": 0
  }
}
