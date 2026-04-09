===source===
<?php

[1, , 2];
array(1, , 2);
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
                    "Int": 1
                  },
                  "span": {
                    "start": 8,
                    "end": 9,
                    "start_line": 3,
                    "start_col": 1
                  }
                },
                "unpack": false,
                "span": {
                  "start": 8,
                  "end": 9,
                  "start_line": 3,
                  "start_col": 1
                }
              },
              {
                "key": null,
                "value": {
                  "kind": "Omit",
                  "span": {
                    "start": 11,
                    "end": 12,
                    "start_line": 3,
                    "start_col": 4
                  }
                },
                "unpack": false,
                "span": {
                  "start": 11,
                  "end": 12,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 13,
                    "end": 14,
                    "start_line": 3,
                    "start_col": 6
                  }
                },
                "unpack": false,
                "span": {
                  "start": 13,
                  "end": 14,
                  "start_line": 3,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 7,
            "end": 15,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 17,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 23,
                    "end": 24,
                    "start_line": 4,
                    "start_col": 6
                  }
                },
                "unpack": false,
                "span": {
                  "start": 23,
                  "end": 24,
                  "start_line": 4,
                  "start_col": 6
                }
              },
              {
                "key": null,
                "value": {
                  "kind": "Error",
                  "span": {
                    "start": 26,
                    "end": 27,
                    "start_line": 4,
                    "start_col": 9
                  }
                },
                "unpack": false,
                "span": {
                  "start": 26,
                  "end": 27,
                  "start_line": 4,
                  "start_col": 9
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 2
                  },
                  "span": {
                    "start": 28,
                    "end": 29,
                    "start_line": 4,
                    "start_col": 11
                  }
                },
                "unpack": false,
                "span": {
                  "start": 28,
                  "end": 29,
                  "start_line": 4,
                  "start_col": 11
                }
              }
            ]
          },
          "span": {
            "start": 17,
            "end": 30,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 17,
        "end": 31,
        "start_line": 4,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31,
    "start_line": 1,
    "start_col": 0
  }
}
