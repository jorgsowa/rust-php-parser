===source===
<?php (new Foo(1, 2))->init()->run();
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
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "Foo"
                                },
                                "span": {
                                  "start": 11,
                                  "end": 14
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
                                      "start": 15,
                                      "end": 16
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 15,
                                    "end": 16
                                  }
                                },
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 18,
                                      "end": 19
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 18,
                                    "end": 19
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 21
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "init"
                      },
                      "span": {
                        "start": 23,
                        "end": 27
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 29
                }
              },
              "method": {
                "kind": {
                  "Identifier": "run"
                },
                "span": {
                  "start": 31,
                  "end": 34
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 36
          }
        }
      },
      "span": {
        "start": 6,
        "end": 37
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 37
  }
}
