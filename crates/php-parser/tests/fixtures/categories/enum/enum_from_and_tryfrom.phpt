===source===
<?php Status::from(1); Status::tryFrom(99);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Status"
                },
                "span": {
                  "start": 6,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": "from",
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 19,
                      "end": 20,
                      "start_line": 1,
                      "start_col": 19
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 19,
                    "end": 20,
                    "start_line": 1,
                    "start_col": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 21,
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
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Status"
                },
                "span": {
                  "start": 23,
                  "end": 29,
                  "start_line": 1,
                  "start_col": 23
                }
              },
              "method": "tryFrom",
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 99
                    },
                    "span": {
                      "start": 39,
                      "end": 41,
                      "start_line": 1,
                      "start_col": 39
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 39,
                    "end": 41,
                    "start_line": 1,
                    "start_col": 39
                  }
                }
              ]
            }
          },
          "span": {
            "start": 23,
            "end": 42,
            "start_line": 1,
            "start_col": 23
          }
        }
      },
      "span": {
        "start": 23,
        "end": 43,
        "start_line": 1,
        "start_col": 23
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 43,
    "start_line": 1,
    "start_col": 0
  }
}
