===source===
<?php

isset(([0, 1] + [])[0]);
isset(['a' => 'b']->a);
isset("str"->a);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 0
                                        },
                                        "span": {
                                          "start": 15,
                                          "end": 16,
                                          "start_line": 3,
                                          "start_col": 8
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 15,
                                        "end": 16,
                                        "start_line": 3,
                                        "start_col": 8
                                      }
                                    },
                                    {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "Int": 1
                                        },
                                        "span": {
                                          "start": 18,
                                          "end": 19,
                                          "start_line": 3,
                                          "start_col": 11
                                        }
                                      },
                                      "unpack": false,
                                      "span": {
                                        "start": 18,
                                        "end": 19,
                                        "start_line": 3,
                                        "start_col": 11
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 14,
                                  "end": 20,
                                  "start_line": 3,
                                  "start_col": 7
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Array": []
                                },
                                "span": {
                                  "start": 23,
                                  "end": 25,
                                  "start_line": 3,
                                  "start_col": 16
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 14,
                            "end": 25,
                            "start_line": 3,
                            "start_col": 7
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 26,
                        "start_line": 3,
                        "start_col": 6
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 27,
                        "end": 28,
                        "start_line": 3,
                        "start_col": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 29,
                  "start_line": 3,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 7,
            "end": 30,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 32,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Array": [
                          {
                            "key": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 39,
                                "end": 42,
                                "start_line": 4,
                                "start_col": 7
                              }
                            },
                            "value": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 46,
                                "end": 49,
                                "start_line": 4,
                                "start_col": 14
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 39,
                              "end": 49,
                              "start_line": 4,
                              "start_col": 7
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 38,
                        "end": 50,
                        "start_line": 4,
                        "start_col": 6
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 52,
                        "end": 53,
                        "start_line": 4,
                        "start_col": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 53,
                  "start_line": 4,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 32,
            "end": 54,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 32,
        "end": 56,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "String": "str"
                      },
                      "span": {
                        "start": 62,
                        "end": 67,
                        "start_line": 5,
                        "start_col": 6
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 69,
                        "end": 70,
                        "start_line": 5,
                        "start_col": 13
                      }
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 70,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 56,
            "end": 71,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 56,
        "end": 72,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 72,
    "start_line": 1,
    "start_col": 0
  }
}
