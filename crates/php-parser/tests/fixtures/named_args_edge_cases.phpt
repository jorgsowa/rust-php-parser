===source===
<?php
foo(a: 1, b: 2, c: 3);
bar(...$args, extra: true);
baz(1, 2, name: 'test');
array_map(callback: fn($x) => $x * 2, array: $arr);
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
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "a",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 13,
                      "end": 14,
                      "start_line": 2,
                      "start_col": 7
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 14,
                    "start_line": 2,
                    "start_col": 4
                  }
                },
                {
                  "name": "b",
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 19,
                      "end": 20,
                      "start_line": 2,
                      "start_col": 13
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 16,
                    "end": 20,
                    "start_line": 2,
                    "start_col": 10
                  }
                },
                {
                  "name": "c",
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 25,
                      "end": 26,
                      "start_line": 2,
                      "start_col": 19
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 22,
                    "end": 26,
                    "start_line": 2,
                    "start_col": 16
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 27,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 29,
                  "end": 32,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "args"
                    },
                    "span": {
                      "start": 36,
                      "end": 41,
                      "start_line": 3,
                      "start_col": 7
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 33,
                    "end": 41,
                    "start_line": 3,
                    "start_col": 4
                  }
                },
                {
                  "name": "extra",
                  "value": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 50,
                      "end": 54,
                      "start_line": 3,
                      "start_col": 21
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 43,
                    "end": 54,
                    "start_line": 3,
                    "start_col": 14
                  }
                }
              ]
            }
          },
          "span": {
            "start": 29,
            "end": 55,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 29,
        "end": 57,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "baz"
                },
                "span": {
                  "start": 57,
                  "end": 60,
                  "start_line": 4,
                  "start_col": 0
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
                      "start": 61,
                      "end": 62,
                      "start_line": 4,
                      "start_col": 4
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 61,
                    "end": 62,
                    "start_line": 4,
                    "start_col": 4
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 64,
                      "end": 65,
                      "start_line": 4,
                      "start_col": 7
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 64,
                    "end": 65,
                    "start_line": 4,
                    "start_col": 7
                  }
                },
                {
                  "name": "name",
                  "value": {
                    "kind": {
                      "String": "test"
                    },
                    "span": {
                      "start": 73,
                      "end": 79,
                      "start_line": 4,
                      "start_col": 16
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 67,
                    "end": 79,
                    "start_line": 4,
                    "start_col": 10
                  }
                }
              ]
            }
          },
          "span": {
            "start": 57,
            "end": 80,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 57,
        "end": 82,
        "start_line": 4,
        "start_col": 0
      }
    },
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
                  "start": 82,
                  "end": 91,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "callback",
                  "value": {
                    "kind": {
                      "ArrowFunction": {
                        "is_static": false,
                        "by_ref": false,
                        "params": [
                          {
                            "name": "x",
                            "type_hint": null,
                            "default": null,
                            "by_ref": false,
                            "variadic": false,
                            "is_readonly": false,
                            "is_final": false,
                            "visibility": null,
                            "set_visibility": null,
                            "attributes": [],
                            "span": {
                              "start": 105,
                              "end": 107,
                              "start_line": 5,
                              "start_col": 23
                            }
                          }
                        ],
                        "return_type": null,
                        "body": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 112,
                                  "end": 114,
                                  "start_line": 5,
                                  "start_col": 30
                                }
                              },
                              "op": "Mul",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 117,
                                  "end": 118,
                                  "start_line": 5,
                                  "start_col": 35
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 112,
                            "end": 118,
                            "start_line": 5,
                            "start_col": 30
                          }
                        },
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 102,
                      "end": 118,
                      "start_line": 5,
                      "start_col": 20
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 92,
                    "end": 118,
                    "start_line": 5,
                    "start_col": 10
                  }
                },
                {
                  "name": "array",
                  "value": {
                    "kind": {
                      "Variable": "arr"
                    },
                    "span": {
                      "start": 127,
                      "end": 131,
                      "start_line": 5,
                      "start_col": 45
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 120,
                    "end": 131,
                    "start_line": 5,
                    "start_col": 38
                  }
                }
              ]
            }
          },
          "span": {
            "start": 82,
            "end": 132,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 82,
        "end": 133,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133,
    "start_line": 1,
    "start_col": 0
  }
}
