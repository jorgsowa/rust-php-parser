===source===
<?php
$value = $x ?? throw new InvalidArgumentException('Missing value');
$result = match ($status) {
    200 => 'ok',
    default => throw new RuntimeException('Unexpected status'),
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
                  "Variable": "value"
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
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 15,
                        "end": 17,
                        "start_line": 2,
                        "start_col": 9
                      }
                    },
                    "right": {
                      "kind": {
                        "ThrowExpr": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "InvalidArgumentException"
                                },
                                "span": {
                                  "start": 31,
                                  "end": 55,
                                  "start_line": 2,
                                  "start_col": 25
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "String": "Missing value"
                                    },
                                    "span": {
                                      "start": 56,
                                      "end": 71,
                                      "start_line": 2,
                                      "start_col": 50
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 56,
                                    "end": 71,
                                    "start_line": 2,
                                    "start_col": 50
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 27,
                            "end": 72,
                            "start_line": 2,
                            "start_col": 21
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 72,
                        "start_line": 2,
                        "start_col": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 15,
                  "end": 72,
                  "start_line": 2,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 72,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 74,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "result"
                },
                "span": {
                  "start": 74,
                  "end": 81,
                  "start_line": 3,
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
                        "start": 91,
                        "end": 98,
                        "start_line": 3,
                        "start_col": 17
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
                              "start": 106,
                              "end": 109,
                              "start_line": 4,
                              "start_col": 4
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "ok"
                          },
                          "span": {
                            "start": 113,
                            "end": 117,
                            "start_line": 4,
                            "start_col": 11
                          }
                        },
                        "span": {
                          "start": 106,
                          "end": 117,
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
                                      "start": 144,
                                      "end": 160,
                                      "start_line": 5,
                                      "start_col": 25
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "value": {
                                        "kind": {
                                          "String": "Unexpected status"
                                        },
                                        "span": {
                                          "start": 161,
                                          "end": 180,
                                          "start_line": 5,
                                          "start_col": 42
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 161,
                                        "end": 180,
                                        "start_line": 5,
                                        "start_col": 42
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 140,
                                "end": 181,
                                "start_line": 5,
                                "start_col": 21
                              }
                            }
                          },
                          "span": {
                            "start": 134,
                            "end": 181,
                            "start_line": 5,
                            "start_col": 15
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 181,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 84,
                  "end": 184,
                  "start_line": 3,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 74,
            "end": 184,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 74,
        "end": 185,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 185,
    "start_line": 1,
    "start_col": 0
  }
}
