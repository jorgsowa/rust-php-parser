===source===
<?php foo(1, 'bar', name: $val, count: 5);
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
                      "String": "bar"
                    },
                    "span": {
                      "start": 13,
                      "end": 18,
                      "start_line": 1,
                      "start_col": 13
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 13,
                    "end": 18,
                    "start_line": 1,
                    "start_col": 13
                  }
                },
                {
                  "name": "name",
                  "value": {
                    "kind": {
                      "Variable": "val"
                    },
                    "span": {
                      "start": 26,
                      "end": 30,
                      "start_line": 1,
                      "start_col": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 30,
                    "start_line": 1,
                    "start_col": 20
                  }
                },
                {
                  "name": "count",
                  "value": {
                    "kind": {
                      "Int": 5
                    },
                    "span": {
                      "start": 39,
                      "end": 40,
                      "start_line": 1,
                      "start_col": 39
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 32,
                    "end": 40,
                    "start_line": 1,
                    "start_col": 32
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 41,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 42,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42,
    "start_line": 1,
    "start_col": 0
  }
}
