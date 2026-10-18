===source===
<?php

try {
    doTry();
} catch (A $b) {
    doCatchA();
} catch (B $c) {
    doCatchB();
} finally {
    doFinally();
}

// no finally
try { }
catch (A $b) { }

// no catch
try { }
finally { }
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "doTry"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 17,
                              "end": 22
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 22
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 24
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 25
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 35,
                    "end": 36
                  }
                }
              ],
              "var": {
                "name": "b",
                "span": {
                  "start": 37,
                  "end": 39
                }
              },
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "doCatchA"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 47,
                                  "end": 55
                                }
                              }
                            },
                            "span": {
                              "start": 47,
                              "end": 55
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 57
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 58
                  }
                }
              ],
              "span": {
                "start": 34,
                "end": 60
              }
            },
            {
              "types": [
                {
                  "parts": [
                    "B"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 68,
                    "end": 69
                  }
                }
              ],
              "var": {
                "name": "c",
                "span": {
                  "start": 70,
                  "end": 72
                }
              },
              "body": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "doCatchB"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 80,
                                  "end": 88
                                }
                              }
                            },
                            "span": {
                              "start": 80,
                              "end": 88
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 80,
                        "end": 90
                      }
                    }
                  },
                  "span": {
                    "start": 80,
                    "end": 91
                  }
                }
              ],
              "span": {
                "start": 67,
                "end": 93
              }
            }
          ],
          "finally": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "doFinally"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 108,
                              "end": 117
                            }
                          }
                        },
                        "span": {
                          "start": 108,
                          "end": 117
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 108,
                    "end": 119
                  }
                }
              },
              "span": {
                "start": 108,
                "end": 120
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 122
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "A"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 153,
                    "end": 154
                  }
                }
              ],
              "var": {
                "name": "b",
                "span": {
                  "start": 155,
                  "end": 157
                }
              },
              "body": [],
              "span": {
                "start": 152,
                "end": 162
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 138,
        "end": 162
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [],
          "finally": []
        }
      },
      "span": {
        "start": 176,
        "end": 195
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 195
  }
}
