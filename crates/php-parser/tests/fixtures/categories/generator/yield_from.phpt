===source===
<?php function gen() { yield from [1, 2, 3]; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 35,
                                  "end": 36,
                                  "start_line": 1,
                                  "start_col": 35
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 35,
                                "end": 36,
                                "start_line": 1,
                                "start_col": 35
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 38,
                                  "end": 39,
                                  "start_line": 1,
                                  "start_col": 38
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 38,
                                "end": 39,
                                "start_line": 1,
                                "start_col": 38
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 3
                                },
                                "span": {
                                  "start": 41,
                                  "end": 42,
                                  "start_line": 1,
                                  "start_col": 41
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 41,
                                "end": 42,
                                "start_line": 1,
                                "start_col": 41
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 34,
                          "end": 43,
                          "start_line": 1,
                          "start_col": 34
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 43,
                    "start_line": 1,
                    "start_col": 23
                  }
                }
              },
              "span": {
                "start": 23,
                "end": 45,
                "start_line": 1,
                "start_col": 23
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46,
    "start_line": 1,
    "start_col": 0
  }
}
