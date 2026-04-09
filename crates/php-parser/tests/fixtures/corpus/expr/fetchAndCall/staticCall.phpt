===source===
<?php

// method name variations
A::b();
A::{'b'}();
A::$b();
A::$b['c']();
A::$b['c']['d']();

// array dereferencing
A::b()['c'];

// class name variations
static::b();
$a::b();
${'a'}::b();
$a['b']::c();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 33,
                  "end": 34,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "method": "b",
              "args": []
            }
          },
          "span": {
            "start": 33,
            "end": 39,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 33,
        "end": 41,
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
                  "ClassConstAccessDynamic": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 41,
                        "end": 42,
                        "start_line": 5,
                        "start_col": 0
                      }
                    },
                    "member": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 45,
                        "end": 48,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 51,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 41,
            "end": 51,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 41,
        "end": 53,
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
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 53,
                        "end": 54,
                        "start_line": 6,
                        "start_col": 0
                      }
                    },
                    "member": "b"
                  }
                },
                "span": {
                  "start": 53,
                  "end": 58,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 53,
            "end": 60,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 53,
        "end": 62,
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "StaticPropertyAccess": {
                          "class": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 62,
                              "end": 63,
                              "start_line": 7,
                              "start_col": 0
                            }
                          },
                          "member": "b"
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 67,
                        "start_line": 7,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "c"
                      },
                      "span": {
                        "start": 68,
                        "end": 71,
                        "start_line": 7,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 72,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 62,
            "end": 74,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 62,
        "end": 76,
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
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "StaticPropertyAccess": {
                                "class": {
                                  "kind": {
                                    "Identifier": "A"
                                  },
                                  "span": {
                                    "start": 76,
                                    "end": 77,
                                    "start_line": 8,
                                    "start_col": 0
                                  }
                                },
                                "member": "b"
                              }
                            },
                            "span": {
                              "start": 76,
                              "end": 81,
                              "start_line": 8,
                              "start_col": 0
                            }
                          },
                          "index": {
                            "kind": {
                              "String": "c"
                            },
                            "span": {
                              "start": 82,
                              "end": 85,
                              "start_line": 8,
                              "start_col": 6
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 76,
                        "end": 86,
                        "start_line": 8,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "d"
                      },
                      "span": {
                        "start": 87,
                        "end": 90,
                        "start_line": 8,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 76,
                  "end": 91,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 76,
            "end": 93,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 76,
        "end": 119,
        "start_line": 8,
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
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 119,
                        "end": 120,
                        "start_line": 11,
                        "start_col": 0
                      }
                    },
                    "method": "b",
                    "args": []
                  }
                },
                "span": {
                  "start": 119,
                  "end": 125,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 126,
                  "end": 129,
                  "start_line": 11,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 119,
            "end": 130,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 119,
        "end": 158,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 158,
                  "end": 164,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "method": "b",
              "args": []
            }
          },
          "span": {
            "start": 158,
            "end": 169,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 158,
        "end": 171,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 171,
                  "end": 173,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "method": "b",
              "args": []
            }
          },
          "span": {
            "start": 171,
            "end": 178,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 171,
        "end": 180,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 182,
                      "end": 185,
                      "start_line": 16,
                      "start_col": 2
                    }
                  }
                },
                "span": {
                  "start": 180,
                  "end": 185,
                  "start_line": 16,
                  "start_col": 0
                }
              },
              "method": "b",
              "args": []
            }
          },
          "span": {
            "start": 180,
            "end": 191,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 180,
        "end": 193,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 193,
                        "end": 195,
                        "start_line": 17,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 196,
                        "end": 199,
                        "start_line": 17,
                        "start_col": 3
                      }
                    }
                  }
                },
                "span": {
                  "start": 193,
                  "end": 200,
                  "start_line": 17,
                  "start_col": 0
                }
              },
              "method": "c",
              "args": []
            }
          },
          "span": {
            "start": 193,
            "end": 205,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 193,
        "end": 206,
        "start_line": 17,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 206,
    "start_line": 1,
    "start_col": 0
  }
}
