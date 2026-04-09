===source===
<?php
function gen() {
    $received = yield 'value';
    $received = yield $key => $value;
}
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
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "received"
                        },
                        "span": {
                          "start": 27,
                          "end": 36,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Yield": {
                            "key": null,
                            "value": {
                              "kind": {
                                "String": "value"
                              },
                              "span": {
                                "start": 45,
                                "end": 52,
                                "start_line": 3,
                                "start_col": 22
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 39,
                          "end": 52,
                          "start_line": 3,
                          "start_col": 16
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 52,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 58,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "received"
                        },
                        "span": {
                          "start": 58,
                          "end": 67,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Yield": {
                            "key": {
                              "kind": {
                                "Variable": "key"
                              },
                              "span": {
                                "start": 76,
                                "end": 80,
                                "start_line": 4,
                                "start_col": 22
                              }
                            },
                            "value": {
                              "kind": {
                                "Variable": "value"
                              },
                              "span": {
                                "start": 84,
                                "end": 90,
                                "start_line": 4,
                                "start_col": 30
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 70,
                          "end": 90,
                          "start_line": 4,
                          "start_col": 16
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 90,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 58,
                "end": 92,
                "start_line": 4,
                "start_col": 4
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
        "end": 93,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 93,
    "start_line": 1,
    "start_col": 0
  }
}
