===source===
<?php [[1, 2], [3, 4]]; ['a' => ['x' => 1], 'b' => ['y' => 2]];
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
                            "Int": 1
                          },
                          "span": {
                            "start": 8,
                            "end": 9,
                            "start_line": 1,
                            "start_col": 8
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 8,
                          "end": 9,
                          "start_line": 1,
                          "start_col": 8
                        }
                      },
                      {
                        "key": null,
                        "value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 11,
                            "end": 12,
                            "start_line": 1,
                            "start_col": 11
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 11,
                          "end": 12,
                          "start_line": 1,
                          "start_col": 11
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 7,
                    "end": 13,
                    "start_line": 1,
                    "start_col": 7
                  }
                },
                "unpack": false,
                "span": {
                  "start": 7,
                  "end": 13,
                  "start_line": 1,
                  "start_col": 7
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Array": [
                      {
                        "key": null,
                        "value": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 16,
                            "end": 17,
                            "start_line": 1,
                            "start_col": 16
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 16,
                          "end": 17,
                          "start_line": 1,
                          "start_col": 16
                        }
                      },
                      {
                        "key": null,
                        "value": {
                          "kind": {
                            "Int": 4
                          },
                          "span": {
                            "start": 19,
                            "end": 20,
                            "start_line": 1,
                            "start_col": 19
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 19,
                          "end": 20,
                          "start_line": 1,
                          "start_col": 19
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 15,
                    "end": 21,
                    "start_line": 1,
                    "start_col": 15
                  }
                },
                "unpack": false,
                "span": {
                  "start": 15,
                  "end": 21,
                  "start_line": 1,
                  "start_col": 15
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 22,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 25,
                    "end": 28,
                    "start_line": 1,
                    "start_col": 25
                  }
                },
                "value": {
                  "kind": {
                    "Array": [
                      {
                        "key": {
                          "kind": {
                            "String": "x"
                          },
                          "span": {
                            "start": 33,
                            "end": 36,
                            "start_line": 1,
                            "start_col": 33
                          }
                        },
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 40,
                            "end": 41,
                            "start_line": 1,
                            "start_col": 40
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 33,
                          "end": 41,
                          "start_line": 1,
                          "start_col": 33
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 32,
                    "end": 42,
                    "start_line": 1,
                    "start_col": 32
                  }
                },
                "unpack": false,
                "span": {
                  "start": 25,
                  "end": 42,
                  "start_line": 1,
                  "start_col": 25
                }
              },
              {
                "key": {
                  "kind": {
                    "String": "b"
                  },
                  "span": {
                    "start": 44,
                    "end": 47,
                    "start_line": 1,
                    "start_col": 44
                  }
                },
                "value": {
                  "kind": {
                    "Array": [
                      {
                        "key": {
                          "kind": {
                            "String": "y"
                          },
                          "span": {
                            "start": 52,
                            "end": 55,
                            "start_line": 1,
                            "start_col": 52
                          }
                        },
                        "value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 59,
                            "end": 60,
                            "start_line": 1,
                            "start_col": 59
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 52,
                          "end": 60,
                          "start_line": 1,
                          "start_col": 52
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 51,
                    "end": 61,
                    "start_line": 1,
                    "start_col": 51
                  }
                },
                "unpack": false,
                "span": {
                  "start": 44,
                  "end": 61,
                  "start_line": 1,
                  "start_col": 44
                }
              }
            ]
          },
          "span": {
            "start": 24,
            "end": 62,
            "start_line": 1,
            "start_col": 24
          }
        }
      },
      "span": {
        "start": 24,
        "end": 63,
        "start_line": 1,
        "start_col": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
