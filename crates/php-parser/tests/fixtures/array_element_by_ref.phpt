===source===
<?php [&$a, $b] = $arr;
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
                          "start": 8,
                          "end": 10,
                          "start_line": 1,
                          "start_col": 8
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 7,
                        "end": 10,
                        "start_line": 1,
                        "start_col": 7
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 12,
                          "end": 14,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 14,
                        "start_line": 1,
                        "start_col": 12
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
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 18,
                  "end": 22,
                  "start_line": 1,
                  "start_col": 18
                }
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
      },
      "span": {
        "start": 6,
        "end": 23,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 23,
    "start_line": 1,
    "start_col": 0
  }
}
