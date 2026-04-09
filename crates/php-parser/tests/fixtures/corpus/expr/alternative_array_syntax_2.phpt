===source===
<?php

$a{'b'};
$a{'b'}();
$a->b{'c'};
$a->b(){'c'};
A::$b{'c'};
A{0};
A::B{0};
new $array{'className'};
new $a->b{'c'}();
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
                  "Variable": "a"
                },
                "span": {
                  "start": 7,
                  "end": 9,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 10,
                  "end": 13,
                  "start_line": 3,
                  "start_col": 3
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 14,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 16,
        "start_line": 3,
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
                        "start": 16,
                        "end": 18,
                        "start_line": 4,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 19,
                        "end": 22,
                        "start_line": 4,
                        "start_col": 3
                      }
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 23,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 16,
            "end": 25,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 16,
        "end": 27,
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
                        "start": 27,
                        "end": 29,
                        "start_line": 5,
                        "start_col": 0
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 31,
                        "end": 32,
                        "start_line": 5,
                        "start_col": 4
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 32,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 33,
                  "end": 36,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 37,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 27,
        "end": 39,
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
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 39,
                        "end": 41,
                        "start_line": 6,
                        "start_col": 0
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 43,
                        "end": 44,
                        "start_line": 6,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 39,
                  "end": 46,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 47,
                  "end": 50,
                  "start_line": 6,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 51,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 39,
        "end": 53,
        "start_line": 6,
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
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 53,
                        "end": 54,
                        "start_line": 7,
                        "start_col": 0
                      }
                    },
                    "member": "b"
                  }
                },
                "span": {
                  "start": 53,
                  "end": 58,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 59,
                  "end": 62,
                  "start_line": 7,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 53,
            "end": 63,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 53,
        "end": 65,
        "start_line": 7,
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
                  "Identifier": "A"
                },
                "span": {
                  "start": 65,
                  "end": 66,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 67,
                  "end": 68,
                  "start_line": 8,
                  "start_col": 2
                }
              }
            }
          },
          "span": {
            "start": 65,
            "end": 69,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 65,
        "end": 71,
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
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 71,
                        "end": 72,
                        "start_line": 9,
                        "start_col": 0
                      }
                    },
                    "member": "B"
                  }
                },
                "span": {
                  "start": 71,
                  "end": 75,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 76,
                  "end": 77,
                  "start_line": 9,
                  "start_col": 5
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
        }
      },
      "span": {
        "start": 71,
        "end": 80,
        "start_line": 9,
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
                  "New": {
                    "class": {
                      "kind": {
                        "Variable": "array"
                      },
                      "span": {
                        "start": 84,
                        "end": 90,
                        "start_line": 10,
                        "start_col": 4
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 80,
                  "end": 90,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "String": "className"
                },
                "span": {
                  "start": 91,
                  "end": 102,
                  "start_line": 10,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 80,
            "end": 103,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 80,
        "end": 105,
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
                              "New": {
                                "class": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 109,
                                    "end": 111,
                                    "start_line": 11,
                                    "start_col": 4
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 105,
                              "end": 111,
                              "start_line": 11,
                              "start_col": 0
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 113,
                              "end": 114,
                              "start_line": 11,
                              "start_col": 8
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 105,
                        "end": 114,
                        "start_line": 11,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "c"
                      },
                      "span": {
                        "start": 115,
                        "end": 118,
                        "start_line": 11,
                        "start_col": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 105,
                  "end": 119,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 105,
            "end": 121,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 105,
        "end": 122,
        "start_line": 11,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 122,
    "start_line": 1,
    "start_col": 0
  }
}
