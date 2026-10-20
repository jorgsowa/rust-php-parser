===source===
<?php
function combined() {
    yield from [1, 2, 3];
    yield from otherGenerator();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "combined",
            "span": {
              "start": 15,
              "end": 23
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
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
                                    "start": 44,
                                    "end": 45
                                  }
                                }
                              },
                              "span": {
                                "start": 44,
                                "end": 45
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
                                    "start": 47,
                                    "end": 48
                                  }
                                }
                              },
                              "span": {
                                "start": 47,
                                "end": 48
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
                                    "start": 50,
                                    "end": 51
                                  }
                                }
                              },
                              "span": {
                                "start": 50,
                                "end": 51
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 43,
                          "end": 52
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 52
                  }
                }
              },
              "span": {
                "start": 32,
                "end": 53
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
                                "Name": {
                                  "parts": [
                                    "otherGenerator"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 69,
                                    "end": 83
                                  }
                                }
                              },
                              "span": {
                                "start": 69,
                                "end": 83
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 85
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 85
                  }
                }
              },
              "span": {
                "start": 58,
                "end": 86
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
        "end": 88
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 88
  }
}
