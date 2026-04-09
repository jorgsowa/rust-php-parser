===source===
<?php $a?->b?->c()?->d?->e;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafePropertyAccess": {
              "object": {
                "kind": {
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "NullsafeMethodCall": {
                          "object": {
                            "kind": {
                              "NullsafePropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 6,
                                    "end": 8,
                                    "start_line": 1,
                                    "start_col": 6
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "b"
                                  },
                                  "span": {
                                    "start": 11,
                                    "end": 12,
                                    "start_line": 1,
                                    "start_col": 11
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 6,
                              "end": 12,
                              "start_line": 1,
                              "start_col": 6
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "c"
                            },
                            "span": {
                              "start": 15,
                              "end": 16,
                              "start_line": 1,
                              "start_col": 15
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 18,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "d"
                      },
                      "span": {
                        "start": 21,
                        "end": 22,
                        "start_line": 1,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 22,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "property": {
                "kind": {
                  "Identifier": "e"
                },
                "span": {
                  "start": 25,
                  "end": 26,
                  "start_line": 1,
                  "start_col": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 27,
    "start_line": 1,
    "start_col": 0
  }
}
