===config===
min_php=8.5
===source===
<?php clone(object: $x, withProperties: ['foo' => 1]);
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
                  "Identifier": "clone"
                },
                "span": {
                  "start": 6,
                  "end": 11,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": "object",
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 20,
                      "end": 22,
                      "start_line": 1,
                      "start_col": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 12,
                    "end": 22,
                    "start_line": 1,
                    "start_col": 12
                  }
                },
                {
                  "name": "withProperties",
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "foo"
                            },
                            "span": {
                              "start": 41,
                              "end": 46,
                              "start_line": 1,
                              "start_col": 41
                            }
                          },
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 50,
                              "end": 51,
                              "start_line": 1,
                              "start_col": 50
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 41,
                            "end": 51,
                            "start_line": 1,
                            "start_col": 41
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 40,
                      "end": 52,
                      "start_line": 1,
                      "start_col": 40
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 24,
                    "end": 52,
                    "start_line": 1,
                    "start_col": 24
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 53,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54,
    "start_line": 1,
    "start_col": 0
  }
}
