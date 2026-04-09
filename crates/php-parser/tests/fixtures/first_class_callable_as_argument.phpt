===source===
<?php array_map(strlen(...), array_filter($arr, is_string(...)));
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
                  "Identifier": "array_map"
                },
                "span": {
                  "start": 6,
                  "end": 15,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "Function": {
                            "kind": {
                              "Identifier": "strlen"
                            },
                            "span": {
                              "start": 16,
                              "end": 22,
                              "start_line": 1,
                              "start_col": 16
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 27,
                      "start_line": 1,
                      "start_col": 16
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 27,
                    "start_line": 1,
                    "start_col": 16
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Identifier": "array_filter"
                          },
                          "span": {
                            "start": 29,
                            "end": 41,
                            "start_line": 1,
                            "start_col": 29
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 42,
                                "end": 46,
                                "start_line": 1,
                                "start_col": 42
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 42,
                              "end": 46,
                              "start_line": 1,
                              "start_col": 42
                            }
                          },
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "CallableCreate": {
                                  "kind": {
                                    "Function": {
                                      "kind": {
                                        "Identifier": "is_string"
                                      },
                                      "span": {
                                        "start": 48,
                                        "end": 57,
                                        "start_line": 1,
                                        "start_col": 48
                                      }
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 48,
                                "end": 62,
                                "start_line": 1,
                                "start_col": 48
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 48,
                              "end": 62,
                              "start_line": 1,
                              "start_col": 48
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 63,
                      "start_line": 1,
                      "start_col": 29
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 29,
                    "end": 63,
                    "start_line": 1,
                    "start_col": 29
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 64,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 65,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65,
    "start_line": 1,
    "start_col": 0
  }
}
