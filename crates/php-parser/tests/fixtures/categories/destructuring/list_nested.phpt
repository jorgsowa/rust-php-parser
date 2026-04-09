===source===
<?php list($a, list($b, $c)) = $arr;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 11,
                          "end": 13,
                          "start_line": 1,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 11,
                        "end": 13,
                        "start_line": 1,
                        "start_col": 11
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 20,
                                  "end": 22,
                                  "start_line": 1,
                                  "start_col": 20
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 20,
                                "end": 22,
                                "start_line": 1,
                                "start_col": 20
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "c"
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
                                "start": 24,
                                "end": 26,
                                "start_line": 1,
                                "start_col": 24
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 15,
                          "end": 27,
                          "start_line": 1,
                          "start_col": 15
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 15,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 15
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 28,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 31,
                  "end": 35,
                  "start_line": 1,
                  "start_col": 31
                }
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
      },
      "span": {
        "start": 6,
        "end": 36,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36,
    "start_line": 1,
    "start_col": 0
  }
}
