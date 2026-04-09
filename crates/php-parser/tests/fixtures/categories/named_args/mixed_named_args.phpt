===source===
<?php foo(1, 2, name: 'test', other: true);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 10,
                      "end": 11,
                      "start_line": 1,
                      "start_col": 10
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 11,
                    "start_line": 1,
                    "start_col": 10
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 13,
                      "end": 14,
                      "start_line": 1,
                      "start_col": 13
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 13,
                    "end": 14,
                    "start_line": 1,
                    "start_col": 13
                  }
                },
                {
                  "name": "name",
                  "value": {
                    "kind": {
                      "String": "test"
                    },
                    "span": {
                      "start": 22,
                      "end": 28,
                      "start_line": 1,
                      "start_col": 22
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 28,
                    "start_line": 1,
                    "start_col": 16
                  }
                },
                {
                  "name": "other",
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 37,
                      "end": 41,
                      "start_line": 1,
                      "start_col": 37
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 30,
                    "end": 41,
                    "start_line": 1,
                    "start_col": 30
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 42,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 43,
        "start_line": 1,
        "start_col": 6
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
