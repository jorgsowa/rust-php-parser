===source===
<?php [...[...[1, 2]], 3];
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
                    "Array": [
                      {
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
                                    "start": 15,
                                    "end": 16,
                                    "start_line": 1,
                                    "start_col": 15
                                  }
                                },
                                "unpack": false,
                                "span": {
                                  "start": 15,
                                  "end": 16,
                                  "start_line": 1,
                                  "start_col": 15
                                }
                              },
                              {
                                "key": null,
                                "value": {
                                  "kind": {
                                    "Int": 2
                                  },
                                  "span": {
                                    "start": 18,
                                    "end": 19,
                                    "start_line": 1,
                                    "start_col": 18
                                  }
                                },
                                "unpack": false,
                                "span": {
                                  "start": 18,
                                  "end": 19,
                                  "start_line": 1,
                                  "start_col": 18
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 14,
                            "end": 20,
                            "start_line": 1,
                            "start_col": 14
                          }
                        },
                        "unpack": true,
                        "span": {
                          "start": 11,
                          "end": 20,
                          "start_line": 1,
                          "start_col": 11
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 10,
                    "end": 21,
                    "start_line": 1,
                    "start_col": 10
                  }
                },
                "unpack": true,
                "span": {
                  "start": 7,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 7
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 3
                  },
                  "span": {
                    "start": 23,
                    "end": 24,
                    "start_line": 1,
                    "start_col": 23
                  }
                },
                "unpack": false,
                "span": {
                  "start": 23,
                  "end": 24,
                  "start_line": 1,
                  "start_col": 23
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}
