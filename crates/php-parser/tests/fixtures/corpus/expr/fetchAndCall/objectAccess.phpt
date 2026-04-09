===source===
<?php

// property fetch variations
$a->b;
$a->b['c'];

// method call variations
$a->b();
$a->{'b'}();
$a->$b();
$a->$b['c']();

// array dereferencing
$a->b()['c'];
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
                  "Variable": "a"
                },
                "span": {
                  "start": 36,
                  "end": 38,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 40,
                  "end": 41,
                  "start_line": 4,
                  "start_col": 4
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 41,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 36,
        "end": 43,
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 43,
                        "end": 45,
                        "start_line": 5,
                        "start_col": 0
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 47,
                        "end": 48,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  }
                },
                "span": {
                  "start": 43,
                  "end": 48,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 49,
                  "end": 52,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 53,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 43,
        "end": 82,
        "start_line": 5,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 82,
                  "end": 84,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 86,
                  "end": 87,
                  "start_line": 8,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 82,
            "end": 89,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 82,
        "end": 91,
        "start_line": 8,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 91,
                  "end": 93,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 96,
                  "end": 99,
                  "start_line": 9,
                  "start_col": 5
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 91,
            "end": 102,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 91,
        "end": 104,
        "start_line": 9,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 104,
                  "end": 106,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 108,
                  "end": 110,
                  "start_line": 10,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 104,
            "end": 112,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 104,
        "end": 114,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 114,
                              "end": 116,
                              "start_line": 11,
                              "start_col": 0
                            }
                          },
                          "property": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 118,
                              "end": 120,
                              "start_line": 11,
                              "start_col": 4
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 120,
                        "start_line": 11,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "c"
                      },
                      "span": {
                        "start": 121,
                        "end": 124,
                        "start_line": 11,
                        "start_col": 7
                      }
                    }
                  }
                },
                "span": {
                  "start": 114,
                  "end": 125,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 114,
            "end": 127,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 114,
        "end": 153,
        "start_line": 11,
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
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 153,
                        "end": 155,
                        "start_line": 14,
                        "start_col": 0
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 157,
                        "end": 158,
                        "start_line": 14,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 153,
                  "end": 160,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 161,
                  "end": 164,
                  "start_line": 14,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 153,
            "end": 165,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 153,
        "end": 166,
        "start_line": 14,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 166,
    "start_line": 1,
    "start_col": 0
  }
}
