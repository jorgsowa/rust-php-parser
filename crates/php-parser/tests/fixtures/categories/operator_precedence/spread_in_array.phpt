===source===
<?php [...$a, ...$b, 1, 2];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Variable": "a"
                  },
                  "span": {
                    "start": 10,
                    "end": 12,
                    "start_line": 1,
                    "start_col": 10
                  }
                },
                "unpack": true,
                "span": {
                  "start": 7,
                  "end": 12,
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
                    "start": 17,
                    "end": 19,
                    "start_line": 1,
                    "start_col": 17
                  }
                },
                "unpack": true,
                "span": {
                  "start": 14,
                  "end": 19,
                  "start_line": 1,
                  "start_col": 14
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 21,
                    "end": 22,
                    "start_line": 1,
                    "start_col": 21
                  }
                },
                "unpack": false,
                "span": {
                  "start": 21,
                  "end": 22,
                  "start_line": 1,
                  "start_col": 21
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 24,
                    "end": 25,
                    "start_line": 1,
                    "start_col": 24
                  }
                },
                "unpack": false,
                "span": {
                  "start": 24,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 24
                }
              }
            ]
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
