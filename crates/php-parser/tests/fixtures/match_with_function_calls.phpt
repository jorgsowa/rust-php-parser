===source===
<?php
$label = match (getStatus()) {
    isActive() => 'active',
    isPending() => 'pending',
    default => throw new LogicException('Unknown'),
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
                  "Variable": "label"
                },
                "span": {
                  "start": 6,
                  "end": 12,
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
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "getStatus"
                            },
                            "span": {
                              "start": 22,
                              "end": 31,
                              "start_line": 2,
                              "start_col": 16
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 33,
                        "start_line": 2,
                        "start_col": 16
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Identifier": "isActive"
                                  },
                                  "span": {
                                    "start": 41,
                                    "end": 49,
                                    "start_line": 3,
                                    "start_col": 4
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 52,
                              "start_line": 3,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "active"
                          },
                          "span": {
                            "start": 55,
                            "end": 63,
                            "start_line": 3,
                            "start_col": 18
                          }
                        },
                        "span": {
                          "start": 41,
                          "end": 63,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Identifier": "isPending"
                                  },
                                  "span": {
                                    "start": 69,
                                    "end": 78,
                                    "start_line": 4,
                                    "start_col": 4
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 69,
                              "end": 81,
                              "start_line": 4,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "pending"
                          },
                          "span": {
                            "start": 84,
                            "end": 93,
                            "start_line": 4,
                            "start_col": 19
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 93,
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
                                      "Identifier": "LogicException"
                                    },
                                    "span": {
                                      "start": 120,
                                      "end": 134,
                                      "start_line": 5,
                                      "start_col": 25
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "String": "Unknown"
                                        },
                                        "span": {
                                          "start": 135,
                                          "end": 144,
                                          "start_line": 5,
                                          "start_col": 40
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 135,
                                        "end": 144,
                                        "start_line": 5,
                                        "start_col": 40
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 116,
                                "end": 145,
                                "start_line": 5,
                                "start_col": 21
                              }
                            }
                          },
                          "span": {
                            "start": 110,
                            "end": 145,
                            "start_line": 5,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 99,
                          "end": 145,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 15,
                  "end": 148,
                  "start_line": 2,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 148,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 149,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 149,
    "start_line": 1,
    "start_col": 0
  }
}
