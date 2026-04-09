===source===
<?php foreach ($arr as [$key, $value]) { echo $key; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "arr"
            },
            "span": {
              "start": 15,
              "end": 19,
              "start_line": 1,
              "start_col": 15
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "key"
                    },
                    "span": {
                      "start": 24,
                      "end": 28,
                      "start_line": 1,
                      "start_col": 24
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 24,
                    "end": 28,
                    "start_line": 1,
                    "start_col": 24
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "value"
                    },
                    "span": {
                      "start": 30,
                      "end": 36,
                      "start_line": 1,
                      "start_col": 30
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 30,
                    "end": 36,
                    "start_line": 1,
                    "start_col": 30
                  }
                }
              ]
            },
            "span": {
              "start": 23,
              "end": 37,
              "start_line": 1,
              "start_col": 23
            }
          },
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "Variable": "key"
                        },
                        "span": {
                          "start": 46,
                          "end": 50,
                          "start_line": 1,
                          "start_col": 46
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 41,
                    "end": 52,
                    "start_line": 1,
                    "start_col": 41
                  }
                }
              ]
            },
            "span": {
              "start": 39,
              "end": 53,
              "start_line": 1,
              "start_col": 39
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 53,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53,
    "start_line": 1,
    "start_col": 0
  }
}
