===source===
<?php

new A;
new A($b);

// class name variations
new $a();
new $a['b']();
new A::$b();
// DNCR object access
new $a->b();
new $a->b->c();
new $a->b['c']();

// test regression introduces by new dereferencing syntax
(new A);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 11,
                  "end": 12,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 7,
            "end": 12,
            "start_line": 3,
            "start_col": 0
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
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 4,
                  "start_col": 4
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 20,
                      "end": 22,
                      "start_line": 4,
                      "start_col": 6
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 22,
                    "start_line": 4,
                    "start_col": 6
                  }
                }
              ]
            }
          },
          "span": {
            "start": 14,
            "end": 23,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 14,
        "end": 51,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 55,
                  "end": 57,
                  "start_line": 7,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 51,
            "end": 59,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 51,
        "end": 61,
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 65,
                              "end": 67,
                              "start_line": 8,
                              "start_col": 4
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 61,
                        "end": 67,
                        "start_line": 8,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 68,
                        "end": 71,
                        "start_line": 8,
                        "start_col": 7
                      }
                    }
                  }
                },
                "span": {
                  "start": 61,
                  "end": 72,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 61,
            "end": 74,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 61,
        "end": 76,
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
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 80,
                              "end": 81,
                              "start_line": 9,
                              "start_col": 4
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 76,
                        "end": 81,
                        "start_line": 9,
                        "start_col": 0
                      }
                    },
                    "member": "b"
                  }
                },
                "span": {
                  "start": 76,
                  "end": 85,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 76,
            "end": 87,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 76,
        "end": 111,
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
                  "New": {
                    "class": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 115,
                        "end": 117,
                        "start_line": 11,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 111,
                  "end": 117,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 119,
                  "end": 120,
                  "start_line": 11,
                  "start_col": 8
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 111,
            "end": 122,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 111,
        "end": 124,
        "start_line": 11,
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
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 128,
                              "end": 130,
                              "start_line": 12,
                              "start_col": 4
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 124,
                        "end": 130,
                        "start_line": 12,
                        "start_col": 0
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 132,
                        "end": 133,
                        "start_line": 12,
                        "start_col": 8
                      }
                    }
                  }
                },
                "span": {
                  "start": 124,
                  "end": 133,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "c"
                },
                "span": {
                  "start": 135,
                  "end": 136,
                  "start_line": 12,
                  "start_col": 11
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 124,
            "end": 138,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 124,
        "end": 140,
        "start_line": 12,
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
                              "New": {
                                "class": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 144,
                                    "end": 146,
                                    "start_line": 13,
                                    "start_col": 4
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 140,
                              "end": 146,
                              "start_line": 13,
                              "start_col": 0
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 148,
                              "end": 149,
                              "start_line": 13,
                              "start_col": 8
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 140,
                        "end": 149,
                        "start_line": 13,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "c"
                      },
                      "span": {
                        "start": 150,
                        "end": 153,
                        "start_line": 13,
                        "start_col": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 140,
                  "end": 154,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 140,
            "end": 156,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 140,
        "end": 217,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Parenthesized": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Identifier": "A"
                    },
                    "span": {
                      "start": 222,
                      "end": 223,
                      "start_line": 16,
                      "start_col": 5
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 218,
                "end": 223,
                "start_line": 16,
                "start_col": 1
              }
            }
          },
          "span": {
            "start": 217,
            "end": 224,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 217,
        "end": 225,
        "start_line": 16,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 225,
    "start_line": 1,
    "start_col": 0
  }
}
