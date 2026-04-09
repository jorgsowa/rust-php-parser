===source===
<?php
$x = match ($status) {
    200 => 'ok',
    404 => throw new NotFoundException(),
    default => throw new RuntimeException('Unexpected'),
};
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "status"
                      },
                      "span": {
                        "start": 18,
                        "end": 25,
                        "start_line": 2,
                        "start_col": 12
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 200
                            },
                            "span": {
                              "start": 33,
                              "end": 36,
                              "start_line": 3,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "ok"
                          },
                          "span": {
                            "start": 40,
                            "end": 44,
                            "start_line": 3,
                            "start_col": 11
                          }
                        },
                        "span": {
                          "start": 33,
                          "end": 44,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 404
                            },
                            "span": {
                              "start": 50,
                              "end": 53,
                              "start_line": 4,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "ThrowExpr": {
                              "kind": {
                                "New": {
                                  "class": {
                                    "kind": {
                                      "Identifier": "NotFoundException"
                                    },
                                    "span": {
                                      "start": 67,
                                      "end": 84,
                                      "start_line": 4,
                                      "start_col": 21
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 63,
                                "end": 86,
                                "start_line": 4,
                                "start_col": 17
                              }
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 86,
                            "start_line": 4,
                            "start_col": 11
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 86,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "ThrowExpr": {
                              "kind": {
                                "New": {
                                  "class": {
                                    "kind": {
                                      "Identifier": "RuntimeException"
                                    },
                                    "span": {
                                      "start": 113,
                                      "end": 129,
                                      "start_line": 5,
                                      "start_col": 25
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "String": "Unexpected"
                                        },
                                        "span": {
                                          "start": 130,
                                          "end": 142,
                                          "start_line": 5,
                                          "start_col": 42
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 130,
                                        "end": 142,
                                        "start_line": 5,
                                        "start_col": 42
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 109,
                                "end": 143,
                                "start_line": 5,
                                "start_col": 21
                              }
                            }
                          },
                          "span": {
                            "start": 103,
                            "end": 143,
                            "start_line": 5,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 92,
                          "end": 143,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 11,
                  "end": 146,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 146,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 147,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 147,
    "start_line": 1,
    "start_col": 0
  }
}
