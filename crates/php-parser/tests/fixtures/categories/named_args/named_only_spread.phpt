===source===
<?php foo(...['name' => $x]);
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
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "name"
                            },
                            "span": {
                              "start": 14,
                              "end": 20,
                              "start_line": 1,
                              "start_col": 14
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 24,
                              "end": 26,
                              "start_line": 1,
                              "start_col": 24
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 14,
                            "end": 26,
                            "start_line": 1,
                            "start_col": 14
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 13,
                      "end": 27,
                      "start_line": 1,
                      "start_col": 13
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 27,
                    "start_line": 1,
                    "start_col": 10
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 28,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 29,
    "start_line": 1,
    "start_col": 0
  }
}
