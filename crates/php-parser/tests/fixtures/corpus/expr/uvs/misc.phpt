===source===
<?php

"string"->length();
"foo$bar"[0];
"foo$bar"->length();
(clone $obj)->b[0](1);
[0, 1][0] = 1;
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
                  "String": "string"
                },
                "span": {
                  "start": 7,
                  "end": 15,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 17,
                  "end": 23,
                  "start_line": 3,
                  "start_col": 10
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 25,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 27,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "foo"
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "bar"
                        },
                        "span": {
                          "start": 31,
                          "end": 35,
                          "start_line": 4,
                          "start_col": 4
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 27,
                  "end": 36,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 37,
                  "end": 38,
                  "start_line": 4,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 39,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 27,
        "end": 41,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "foo"
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "bar"
                        },
                        "span": {
                          "start": 45,
                          "end": 49,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 41,
                  "end": 50,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 52,
                  "end": 58,
                  "start_line": 5,
                  "start_col": 11
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 41,
            "end": 60,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 41,
        "end": 62,
        "start_line": 5,
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Clone": {
                                    "kind": {
                                      "Variable": "obj"
                                    },
                                    "span": {
                                      "start": 69,
                                      "end": 73,
                                      "start_line": 6,
                                      "start_col": 7
                                    }
                                  }
                                },
                                "span": {
                                  "start": 63,
                                  "end": 73,
                                  "start_line": 6,
                                  "start_col": 1
                                }
                              }
                            },
                            "span": {
                              "start": 62,
                              "end": 74,
                              "start_line": 6,
                              "start_col": 0
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 76,
                              "end": 77,
                              "start_line": 6,
                              "start_col": 14
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 77,
                        "start_line": 6,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 78,
                        "end": 79,
                        "start_line": 6,
                        "start_col": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 80,
                  "start_line": 6,
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
                      "start": 81,
                      "end": 82,
                      "start_line": 6,
                      "start_col": 19
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 81,
                    "end": 82,
                    "start_line": 6,
                    "start_col": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 62,
            "end": 83,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 62,
        "end": 85,
        "start_line": 6,
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "value": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 86,
                                "end": 87,
                                "start_line": 7,
                                "start_col": 1
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 86,
                              "end": 87,
                              "start_line": 7,
                              "start_col": 1
                            }
                          },
                          {
                            "key": null,
                            "value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 89,
                                "end": 90,
                                "start_line": 7,
                                "start_col": 4
                              }
                            },
                            "unpack": false,
                            "span": {
                              "start": 89,
                              "end": 90,
                              "start_line": 7,
                              "start_col": 4
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 85,
                        "end": 91,
                        "start_line": 7,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 92,
                        "end": 93,
                        "start_line": 7,
                        "start_col": 7
                      }
                    }
                  }
                },
                "span": {
                  "start": 85,
                  "end": 95,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 97,
                  "end": 98,
                  "start_line": 7,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 85,
            "end": 98,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 85,
        "end": 99,
        "start_line": 7,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 99,
    "start_line": 1,
    "start_col": 0
  }
}
