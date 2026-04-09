===source===
<?php
foo(a: $b, c: $d);
bar(class: 0);
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
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "a",
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 13,
                      "end": 15,
                      "start_line": 2,
                      "start_col": 7
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 15,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                {
                  "name": "c",
                  "value": {
                    "kind": {
                      "Variable": "d"
                    },
                    "span": {
                      "start": 20,
                      "end": 22,
                      "start_line": 2,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 17,
                    "end": 22,
                    "start_line": 2,
                    "start_col": 11
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 23,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 25,
                  "end": 28,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "class",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 36,
                      "end": 37,
                      "start_line": 3,
                      "start_col": 11
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 29,
                    "end": 37,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              ]
            }
          },
          "span": {
            "start": 25,
            "end": 38,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 39,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 39,
    "start_line": 1,
    "start_col": 0
  }
}
