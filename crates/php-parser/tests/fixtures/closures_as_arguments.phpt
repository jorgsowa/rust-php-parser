===source===
<?php
$filtered = array_filter($items, fn($x) => $x > 0);
$mapped = array_map(function($x) { return $x * 2; }, $items);
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
                  "Variable": "filtered"
                },
                "span": {
                  "start": 6,
                  "end": 15,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "array_filter"
                      },
                      "span": {
                        "start": 18,
                        "end": 30,
                        "start_line": 2,
                        "start_col": 12
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Variable": "items"
                          },
                          "span": {
                            "start": 31,
                            "end": 37,
                            "start_line": 2,
                            "start_col": 25
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 31,
                          "end": 37,
                          "start_line": 2,
                          "start_col": 25
                        }
                      },
                      {
                        "name": null,
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
                                    "start": 42,
                                    "end": 44,
                                    "start_line": 2,
                                    "start_col": 36
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
                                        "start": 49,
                                        "end": 51,
                                        "start_line": 2,
                                        "start_col": 43
                                      }
                                    },
                                    "op": "Greater",
                                    "right": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 54,
                                        "end": 55,
                                        "start_line": 2,
                                        "start_col": 48
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 49,
                                  "end": 55,
                                  "start_line": 2,
                                  "start_col": 43
                                }
                              },
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 39,
                            "end": 55,
                            "start_line": 2,
                            "start_col": 33
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 39,
                          "end": 55,
                          "start_line": 2,
                          "start_col": 33
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 18,
                  "end": 56,
                  "start_line": 2,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 56,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 58,
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
                  "Variable": "mapped"
                },
                "span": {
                  "start": 58,
                  "end": 65,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "array_map"
                      },
                      "span": {
                        "start": 68,
                        "end": 77,
                        "start_line": 3,
                        "start_col": 10
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Closure": {
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
                                    "start": 87,
                                    "end": 89,
                                    "start_line": 3,
                                    "start_col": 29
                                  }
                                }
                              ],
                              "use_vars": [],
                              "return_type": null,
                              "body": [
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "Variable": "x"
                                            },
                                            "span": {
                                              "start": 100,
                                              "end": 102,
                                              "start_line": 3,
                                              "start_col": 42
                                            }
                                          },
                                          "op": "Mul",
                                          "right": {
                                            "kind": {
                                              "Int": 2
                                            },
                                            "span": {
                                              "start": 105,
                                              "end": 106,
                                              "start_line": 3,
                                              "start_col": 47
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 100,
                                        "end": 106,
                                        "start_line": 3,
                                        "start_col": 42
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 93,
                                    "end": 108,
                                    "start_line": 3,
                                    "start_col": 35
                                  }
                                }
                              ],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 78,
                            "end": 109,
                            "start_line": 3,
                            "start_col": 20
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 78,
                          "end": 109,
                          "start_line": 3,
                          "start_col": 20
                        }
                      },
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Variable": "items"
                          },
                          "span": {
                            "start": 111,
                            "end": 117,
                            "start_line": 3,
                            "start_col": 53
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 111,
                          "end": 117,
                          "start_line": 3,
                          "start_col": 53
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 68,
                  "end": 118,
                  "start_line": 3,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 118,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 58,
        "end": 119,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 119,
    "start_line": 1,
    "start_col": 0
  }
}
