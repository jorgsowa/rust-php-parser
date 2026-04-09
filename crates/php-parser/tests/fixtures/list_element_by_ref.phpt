===source===
<?php list(&$a, $b) = $arr;
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
                          "start": 12,
                          "end": 14,
                          "start_line": 1,
                          "start_col": 12
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 11,
                        "end": 14,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 16,
                          "end": 18,
                          "start_line": 1,
                          "start_col": 16
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 16,
                        "end": 18,
                        "start_line": 1,
                        "start_col": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 19,
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
                  "start": 22,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27,
    "start_line": 1,
    "start_col": 0
  }
}
