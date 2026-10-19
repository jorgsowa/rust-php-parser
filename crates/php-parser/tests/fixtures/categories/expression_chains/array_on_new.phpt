===source===
<?php (new Collection([1,2,3]))[0];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Collection"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 11,
                                "end": 21
                              }
                            }
                          },
                          "span": {
                            "start": 11,
                            "end": 21
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Int": 1
                                          },
                                          "span": {
                                            "start": 23,
                                            "end": 24
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 23,
                                        "end": 24
                                      }
                                    },
                                    {
                                      "key": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Int": 2
                                          },
                                          "span": {
                                            "start": 25,
                                            "end": 26
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 25,
                                        "end": 26
                                      }
                                    },
                                    {
                                      "key": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Int": 3
                                          },
                                          "span": {
                                            "start": 27,
                                            "end": 28
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 27,
                                        "end": 28
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 22,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 22,
                              "end": 29
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 30
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 31
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 32,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
