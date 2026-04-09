===config===
min_php=8.1
===source===
<?php $fiber = new Fiber(function(): void { Fiber::suspend('hello'); }); $val = $fiber->start();
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
                  "Variable": "fiber"
                },
                "span": {
                  "start": 6,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Fiber"
                      },
                      "span": {
                        "start": 19,
                        "end": 24,
                        "start_line": 1,
                        "start_col": 19
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
                              "params": [],
                              "use_vars": [],
                              "return_type": {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "void"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 37,
                                      "end": 41,
                                      "start_line": 1,
                                      "start_col": 37
                                    }
                                  }
                                },
                                "span": {
                                  "start": 37,
                                  "end": 41,
                                  "start_line": 1,
                                  "start_col": 37
                                }
                              },
                              "body": [
                                {
                                  "kind": {
                                    "Expression": {
                                      "kind": {
                                        "StaticMethodCall": {
                                          "class": {
                                            "kind": {
                                              "Identifier": "Fiber"
                                            },
                                            "span": {
                                              "start": 44,
                                              "end": 49,
                                              "start_line": 1,
                                              "start_col": 44
                                            }
                                          },
                                          "method": "suspend",
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "String": "hello"
                                                },
                                                "span": {
                                                  "start": 59,
                                                  "end": 66,
                                                  "start_line": 1,
                                                  "start_col": 59
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 59,
                                                "end": 66,
                                                "start_line": 1,
                                                "start_col": 59
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 44,
                                        "end": 67,
                                        "start_line": 1,
                                        "start_col": 44
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 44,
                                    "end": 69,
                                    "start_line": 1,
                                    "start_col": 44
                                  }
                                }
                              ],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 25,
                            "end": 70,
                            "start_line": 1,
                            "start_col": 25
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 25,
                          "end": 70,
                          "start_line": 1,
                          "start_col": 25
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 15,
                  "end": 71,
                  "start_line": 1,
                  "start_col": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 71,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 73,
        "start_line": 1,
        "start_col": 6
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "val"
                },
                "span": {
                  "start": 73,
                  "end": 77,
                  "start_line": 1,
                  "start_col": 73
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "fiber"
                      },
                      "span": {
                        "start": 80,
                        "end": 86,
                        "start_line": 1,
                        "start_col": 80
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "start"
                      },
                      "span": {
                        "start": 88,
                        "end": 93,
                        "start_line": 1,
                        "start_col": 88
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 80,
                  "end": 95,
                  "start_line": 1,
                  "start_col": 80
                }
              }
            }
          },
          "span": {
            "start": 73,
            "end": 95,
            "start_line": 1,
            "start_col": 73
          }
        }
      },
      "span": {
        "start": 73,
        "end": 96,
        "start_line": 1,
        "start_col": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96,
    "start_line": 1,
    "start_col": 0
  }
}
