===source===
<?php (new Foo(1, 2))->init()->run();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "Foo"
                                },
                                "span": {
                                  "start": 11,
                                  "end": 14,
                                  "start_line": 1,
                                  "start_col": 11
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
                                      "start": 15,
                                      "end": 16,
                                      "start_line": 1,
                                      "start_col": 15
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 15,
                                    "end": 16,
                                    "start_line": 1,
                                    "start_col": 15
                                  }
                                },
                                {
                                  "name": null,
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
                                  "by_ref": false,
                                  "span": {
                                    "start": 18,
                                    "end": 19,
                                    "start_line": 1,
                                    "start_col": 18
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 20,
                            "start_line": 1,
                            "start_col": 7
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 21,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "init"
                      },
                      "span": {
                        "start": 23,
                        "end": 27,
                        "start_line": 1,
                        "start_col": 23
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 29,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "run"
                },
                "span": {
                  "start": 31,
                  "end": 34,
                  "start_line": 1,
                  "start_col": 31
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 36,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37,
    "start_line": 1,
    "start_col": 0
  }
}
