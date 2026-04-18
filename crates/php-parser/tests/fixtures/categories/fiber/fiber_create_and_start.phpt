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
                  "end": 12
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
                        "end": 24
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
                                      "end": 41
                                    }
                                  }
                                },
                                "span": {
                                  "start": 37,
                                  "end": 41
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
                                              "end": 49
                                            }
                                          },
                                          "method": {
                                            "parts": [
                                              "suspend"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 51,
                                              "end": 58
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "String": "hello"
                                                },
                                                "span": {
                                                  "start": 59,
                                                  "end": 66
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 59,
                                                "end": 66
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 44,
                                        "end": 67
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 44,
                                    "end": 68
                                  }
                                }
                              ],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 25,
                            "end": 70
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 25,
                          "end": 70
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 15,
                  "end": 71
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 71
          }
        }
      },
      "span": {
        "start": 6,
        "end": 72
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
                  "end": 77
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
                        "end": 86
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "start"
                      },
                      "span": {
                        "start": 88,
                        "end": 93
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 80,
                  "end": 95
                }
              }
            }
          },
          "span": {
            "start": 73,
            "end": 95
          }
        }
      },
      "span": {
        "start": 73,
        "end": 96
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 96
  }
}
