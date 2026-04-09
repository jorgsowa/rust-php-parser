===source===
<?php list($a, $b) = $arr;
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
                          "start": 11,
                          "end": 13,
                          "start_line": 1,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 13,
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
                          "start": 15,
                          "end": 17,
                          "start_line": 1,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 17,
                        "start_line": 1,
                        "start_col": 15
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 18,
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
                  "start": 21,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
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
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}
