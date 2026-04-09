===source===
<?php (new Collection([1,2,3]))[0];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Collection"
                          },
                          "span": {
                            "start": 11,
                            "end": 21,
                            "start_line": 1,
                            "start_col": 11
                          }
                        },
                        "args": [
                          {
                            "name": null,
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
                                  },
                                  {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "Int": 2
                                      },
                                      "span": {
                                        "start": 25,
                                        "end": 26,
                                        "start_line": 1,
                                        "start_col": 25
                                      }
                                    },
                                    "unpack": false,
                                    "span": {
                                      "start": 25,
                                      "end": 26,
                                      "start_line": 1,
                                      "start_col": 25
                                    }
                                  },
                                  {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "Int": 3
                                      },
                                      "span": {
                                        "start": 27,
                                        "end": 28,
                                        "start_line": 1,
                                        "start_col": 27
                                      }
                                    },
                                    "unpack": false,
                                    "span": {
                                      "start": 27,
                                      "end": 28,
                                      "start_line": 1,
                                      "start_col": 27
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 22,
                                "end": 29,
                                "start_line": 1,
                                "start_col": 22
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 22,
                              "end": 29,
                              "start_line": 1,
                              "start_col": 22
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 30,
                      "start_line": 1,
                      "start_col": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 31,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 32,
                  "end": 33,
                  "start_line": 1,
                  "start_col": 32
                }
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
