===source===
<?php

// function name variations
a();
$a();
${'a'}();
$$a();
$$$a();
$a['b']();
$a->b['c']();

// array dereferencing
a()['b'];
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "a"
                },
                "span": {
                  "start": 35,
                  "end": 36,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 35,
            "end": 38,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 35,
        "end": 40,
        "start_line": 4,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 40,
                  "end": 42,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 40,
            "end": 44,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 40,
        "end": 46,
        "start_line": 5,
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
                  "VariableVariable": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 48,
                      "end": 51,
                      "start_line": 6,
                      "start_col": 2
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 51,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 46,
            "end": 54,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 46,
        "end": 56,
        "start_line": 6,
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
                  "VariableVariable": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 57,
                      "end": 59,
                      "start_line": 7,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 56,
                  "end": 59,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 56,
            "end": 61,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 56,
        "end": 63,
        "start_line": 7,
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
                  "VariableVariable": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 65,
                          "end": 67,
                          "start_line": 8,
                          "start_col": 2
                        }
                      }
                    },
                    "span": {
                      "start": 64,
                      "end": 67,
                      "start_line": 8,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 63,
                  "end": 67,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 63,
            "end": 69,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 63,
        "end": 71,
        "start_line": 8,
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
                        "Variable": "a"
                      },
                      "span": {
                        "start": 71,
                        "end": 73,
                        "start_line": 9,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 74,
                        "end": 77,
                        "start_line": 9,
                        "start_col": 3
                      }
                    }
                  }
                },
                "span": {
                  "start": 71,
                  "end": 78,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 71,
            "end": 80,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 71,
        "end": 82,
        "start_line": 9,
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
                              "start": 82,
                              "end": 84,
                              "start_line": 10,
                              "start_col": 0
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 86,
                              "end": 87,
                              "start_line": 10,
                              "start_col": 4
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 82,
                        "end": 87,
                        "start_line": 10,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "c"
                      },
                      "span": {
                        "start": 88,
                        "end": 91,
                        "start_line": 10,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 92,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 82,
            "end": 94,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 82,
        "end": 120,
        "start_line": 10,
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
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 120,
                        "end": 121,
                        "start_line": 13,
                        "start_col": 0
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 120,
                  "end": 123,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 124,
                  "end": 127,
                  "start_line": 13,
                  "start_col": 4
                }
              }
            }
          },
          "span": {
            "start": 120,
            "end": 128,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 120,
        "end": 129,
        "start_line": 13,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 129,
    "start_line": 1,
    "start_col": 0
  }
}
