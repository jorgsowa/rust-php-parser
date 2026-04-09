===source===
<?php @$obj->riskyMethod(@$nested);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "MethodCall": {
                  "object": {
                    "kind": {
                      "Variable": "obj"
                    },
                    "span": {
                      "start": 7,
                      "end": 11,
                      "start_line": 1,
                      "start_col": 7
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "riskyMethod"
                    },
                    "span": {
                      "start": 13,
                      "end": 24,
                      "start_line": 1,
                      "start_col": 13
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "value": {
                        "kind": {
                          "ErrorSuppress": {
                            "kind": {
                              "Variable": "nested"
                            },
                            "span": {
                              "start": 26,
                              "end": 33,
                              "start_line": 1,
                              "start_col": 26
                            }
                          }
                        },
                        "span": {
                          "start": 25,
                          "end": 33,
                          "start_line": 1,
                          "start_col": 25
                        }
                      },
                      "unpack": false,
                      "by_ref": false,
                      "span": {
                        "start": 25,
                        "end": 33,
                        "start_line": 1,
                        "start_col": 25
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 7,
                "end": 34,
                "start_line": 1,
                "start_col": 7
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
