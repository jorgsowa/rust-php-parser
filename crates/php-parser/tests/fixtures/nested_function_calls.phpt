===source===
<?php implode(', ', array_map('strtoupper', explode(' ', $str)));
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
                  "Identifier": "implode"
                },
                "span": {
                  "start": 6,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": ", "
                    },
                    "span": {
                      "start": 14,
                      "end": 18,
                      "start_line": 1,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 14,
                    "end": 18,
                    "start_line": 1,
                    "start_col": 14
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Identifier": "array_map"
                          },
                          "span": {
                            "start": 20,
                            "end": 29,
                            "start_line": 1,
                            "start_col": 20
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "String": "strtoupper"
                              },
                              "span": {
                                "start": 30,
                                "end": 42,
                                "start_line": 1,
                                "start_col": 30
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 30,
                              "end": 42,
                              "start_line": 1,
                              "start_col": 30
                            }
                          },
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Identifier": "explode"
                                    },
                                    "span": {
                                      "start": 44,
                                      "end": 51,
                                      "start_line": 1,
                                      "start_col": 44
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "String": " "
                                        },
                                        "span": {
                                          "start": 52,
                                          "end": 55,
                                          "start_line": 1,
                                          "start_col": 52
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 52,
                                        "end": 55,
                                        "start_line": 1,
                                        "start_col": 52
                                      }
                                    },
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "Variable": "str"
                                        },
                                        "span": {
                                          "start": 57,
                                          "end": 61,
                                          "start_line": 1,
                                          "start_col": 57
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 57,
                                        "end": 61,
                                        "start_line": 1,
                                        "start_col": 57
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 44,
                                "end": 62,
                                "start_line": 1,
                                "start_col": 44
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 44,
                              "end": 62,
                              "start_line": 1,
                              "start_col": 44
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 63,
                      "start_line": 1,
                      "start_col": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 63,
                    "start_line": 1,
                    "start_col": 20
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
