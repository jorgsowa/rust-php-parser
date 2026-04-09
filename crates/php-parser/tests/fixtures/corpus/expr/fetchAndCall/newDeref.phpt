===source===
<?php

(new A)->b;
(new A)->b();
(new A)['b'];
(new A)['b']['c'];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 12,
                            "end": 13,
                            "start_line": 3,
                            "start_col": 5
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 8,
                      "end": 13,
                      "start_line": 3,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 14,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 16,
                  "end": 17,
                  "start_line": 3,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 17,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 19,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 24,
                            "end": 25,
                            "start_line": 4,
                            "start_col": 5
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 20,
                      "end": 25,
                      "start_line": 4,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 26,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 28,
                  "end": 29,
                  "start_line": 4,
                  "start_col": 9
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 19,
            "end": 31,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 19,
        "end": 33,
        "start_line": 4,
        "start_col": 0
      }
    },
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
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 38,
                            "end": 39,
                            "start_line": 5,
                            "start_col": 5
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 39,
                      "start_line": 5,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 33,
                  "end": 40,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 41,
                  "end": 44,
                  "start_line": 5,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 45,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 33,
        "end": 47,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "A"
                                },
                                "span": {
                                  "start": 52,
                                  "end": 53,
                                  "start_line": 6,
                                  "start_col": 5
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 48,
                            "end": 53,
                            "start_line": 6,
                            "start_col": 1
                          }
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 54,
                        "start_line": 6,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 55,
                        "end": 58,
                        "start_line": 6,
                        "start_col": 8
                      }
                    }
                  }
                },
                "span": {
                  "start": 47,
                  "end": 59,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 60,
                  "end": 63,
                  "start_line": 6,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 64,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 47,
        "end": 65,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65,
    "start_line": 1,
    "start_col": 0
  }
}
