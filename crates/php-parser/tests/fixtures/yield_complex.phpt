===source===
<?php
function gen() {
    $a = yield;
    $b = yield 'value';
    $c = yield 'key' => 'value';
    yield from otherGen();
    $d = (yield 'x') + 1;
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
                          "Variable": "a"
                        },
                        "span": {
                          "start": 27,
                          "end": 29,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Yield": {
                            "key": null,
                            "value": null,
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 32,
                          "end": 37,
                          "start_line": 3,
                          "start_col": 9
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 27,
                    "end": 37,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 27,
                "end": 43,
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
                          "Variable": "b"
                        },
                        "span": {
                          "start": 43,
                          "end": 45,
                          "start_line": 4,
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
                                "start": 54,
                                "end": 61,
                                "start_line": 4,
                                "start_col": 15
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 61,
                          "start_line": 4,
                          "start_col": 9
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 43,
                    "end": 61,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 43,
                "end": 67,
                "start_line": 4,
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
                          "Variable": "c"
                        },
                        "span": {
                          "start": 67,
                          "end": 69,
                          "start_line": 5,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Yield": {
                            "key": {
                              "kind": {
                                "String": "key"
                              },
                              "span": {
                                "start": 78,
                                "end": 83,
                                "start_line": 5,
                                "start_col": 15
                              }
                            },
                            "value": {
                              "kind": {
                                "String": "value"
                              },
                              "span": {
                                "start": 87,
                                "end": 94,
                                "start_line": 5,
                                "start_col": 24
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 72,
                          "end": 94,
                          "start_line": 5,
                          "start_col": 9
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 67,
                    "end": 94,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 67,
                "end": 100,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "FunctionCall": {
                            "name": {
                              "kind": {
                                "Identifier": "otherGen"
                              },
                              "span": {
                                "start": 111,
                                "end": 119,
                                "start_line": 6,
                                "start_col": 15
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 111,
                          "end": 121,
                          "start_line": 6,
                          "start_col": 15
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 100,
                    "end": 121,
                    "start_line": 6,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 100,
                "end": 127,
                "start_line": 6,
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
                          "Variable": "d"
                        },
                        "span": {
                          "start": 127,
                          "end": 129,
                          "start_line": 7,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Parenthesized": {
                                  "kind": {
                                    "Yield": {
                                      "key": null,
                                      "value": {
                                        "kind": {
                                          "String": "x"
                                        },
                                        "span": {
                                          "start": 139,
                                          "end": 142,
                                          "start_line": 7,
                                          "start_col": 16
                                        }
                                      },
                                      "is_from": false
                                    }
                                  },
                                  "span": {
                                    "start": 133,
                                    "end": 142,
                                    "start_line": 7,
                                    "start_col": 10
                                  }
                                }
                              },
                              "span": {
                                "start": 132,
                                "end": 144,
                                "start_line": 7,
                                "start_col": 9
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 146,
                                "end": 147,
                                "start_line": 7,
                                "start_col": 23
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 132,
                          "end": 147,
                          "start_line": 7,
                          "start_col": 9
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 127,
                    "end": 147,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 127,
                "end": 149,
                "start_line": 7,
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
        "end": 150,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 150,
    "start_line": 1,
    "start_col": 0
  }
}
