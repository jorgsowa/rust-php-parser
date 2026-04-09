===source===
<?php

function gen() {
    yield +1;
    yield -1;
    yield * -1;
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
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "UnaryPrefix": {
                            "op": "Plus",
                            "operand": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 35,
                                "end": 36,
                                "start_line": 4,
                                "start_col": 11
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 36,
                          "start_line": 4,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 28,
                    "end": 36,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 28,
                "end": 42,
                "start_line": 4,
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
                          "UnaryPrefix": {
                            "op": "Negate",
                            "operand": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 49,
                                "end": 50,
                                "start_line": 5,
                                "start_col": 11
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 50,
                          "start_line": 5,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 42,
                    "end": 50,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 42,
                "end": 56,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Yield": {
                            "key": null,
                            "value": null,
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 56,
                          "end": 62,
                          "start_line": 6,
                          "start_col": 4
                        }
                      },
                      "op": "Mul",
                      "right": {
                        "kind": {
                          "UnaryPrefix": {
                            "op": "Negate",
                            "operand": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 65,
                                "end": 66,
                                "start_line": 6,
                                "start_col": 13
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 64,
                          "end": 66,
                          "start_line": 6,
                          "start_col": 12
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 56,
                    "end": 66,
                    "start_line": 6,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 56,
                "end": 68,
                "start_line": 6,
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
        "start": 7,
        "end": 69,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69,
    "start_line": 1,
    "start_col": 0
  }
}
