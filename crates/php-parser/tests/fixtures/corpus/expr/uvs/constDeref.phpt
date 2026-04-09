===source===
<?php

A->length;
A->length();
A[0];
A[0][1][2];

A::B[0];
A::B[0][1][2];
A::B->length;
A::B->length();
A::B::C;
A::B::$c;
A::B::c();

__FUNCTION__[0];
__FUNCTION__->length;
__FUNCIONT__->length();
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
                  "Identifier": "A"
                },
                "span": {
                  "start": 7,
                  "end": 8,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 10,
                  "end": 16,
                  "start_line": 3,
                  "start_col": 3
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 16,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 18,
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
                  "Identifier": "A"
                },
                "span": {
                  "start": 18,
                  "end": 19,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 21,
                  "end": 27,
                  "start_line": 4,
                  "start_col": 3
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 18,
            "end": 29,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 18,
        "end": 31,
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
                  "Identifier": "A"
                },
                "span": {
                  "start": 31,
                  "end": 32,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 33,
                  "end": 34,
                  "start_line": 5,
                  "start_col": 2
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 35,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 31,
        "end": 37,
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
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 37,
                              "end": 38,
                              "start_line": 6,
                              "start_col": 0
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 39,
                              "end": 40,
                              "start_line": 6,
                              "start_col": 2
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 41,
                        "start_line": 6,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 42,
                        "end": 43,
                        "start_line": 6,
                        "start_col": 5
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 44,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 45,
                  "end": 46,
                  "start_line": 6,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 37,
            "end": 47,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 37,
        "end": 50,
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
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 50,
                        "end": 51,
                        "start_line": 8,
                        "start_col": 0
                      }
                    },
                    "member": "B"
                  }
                },
                "span": {
                  "start": 50,
                  "end": 54,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 55,
                  "end": 56,
                  "start_line": 8,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 57,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 50,
        "end": 59,
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
                  "ArrayAccess": {
                    "array": {
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
                                    "start": 59,
                                    "end": 60,
                                    "start_line": 9,
                                    "start_col": 0
                                  }
                                },
                                "member": "B"
                              }
                            },
                            "span": {
                              "start": 59,
                              "end": 63,
                              "start_line": 9,
                              "start_col": 0
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 64,
                              "end": 65,
                              "start_line": 9,
                              "start_col": 5
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 66,
                        "start_line": 9,
                        "start_col": 0
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 67,
                        "end": 68,
                        "start_line": 9,
                        "start_col": 8
                      }
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 69,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 70,
                  "end": 71,
                  "start_line": 9,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 72,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 59,
        "end": 74,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 74,
                        "end": 75,
                        "start_line": 10,
                        "start_col": 0
                      }
                    },
                    "member": "B"
                  }
                },
                "span": {
                  "start": 74,
                  "end": 78,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 80,
                  "end": 86,
                  "start_line": 10,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 74,
            "end": 86,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 74,
        "end": 88,
        "start_line": 10,
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
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 88,
                        "end": 89,
                        "start_line": 11,
                        "start_col": 0
                      }
                    },
                    "member": "B"
                  }
                },
                "span": {
                  "start": 88,
                  "end": 92,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 94,
                  "end": 100,
                  "start_line": 11,
                  "start_col": 6
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 88,
            "end": 102,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 88,
        "end": 104,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 104,
                        "end": 105,
                        "start_line": 12,
                        "start_col": 0
                      }
                    },
                    "member": "B"
                  }
                },
                "span": {
                  "start": 104,
                  "end": 108,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "member": "C"
            }
          },
          "span": {
            "start": 104,
            "end": 111,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 104,
        "end": 113,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 113,
                        "end": 114,
                        "start_line": 13,
                        "start_col": 0
                      }
                    },
                    "member": "B"
                  }
                },
                "span": {
                  "start": 113,
                  "end": 117,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "member": "c"
            }
          },
          "span": {
            "start": 113,
            "end": 121,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 113,
        "end": 123,
        "start_line": 13,
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
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 123,
                        "end": 124,
                        "start_line": 14,
                        "start_col": 0
                      }
                    },
                    "member": "B"
                  }
                },
                "span": {
                  "start": 123,
                  "end": 127,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "method": "c",
              "args": []
            }
          },
          "span": {
            "start": 123,
            "end": 132,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 123,
        "end": 135,
        "start_line": 14,
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
                  "MagicConst": "Function"
                },
                "span": {
                  "start": 135,
                  "end": 147,
                  "start_line": 16,
                  "start_col": 0
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 148,
                  "end": 149,
                  "start_line": 16,
                  "start_col": 13
                }
              }
            }
          },
          "span": {
            "start": 135,
            "end": 150,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 135,
        "end": 152,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "MagicConst": "Function"
                },
                "span": {
                  "start": 152,
                  "end": 164,
                  "start_line": 17,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 166,
                  "end": 172,
                  "start_line": 17,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 152,
            "end": 172,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 152,
        "end": 174,
        "start_line": 17,
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
                  "Identifier": "__FUNCIONT__"
                },
                "span": {
                  "start": 174,
                  "end": 186,
                  "start_line": 18,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 188,
                  "end": 194,
                  "start_line": 18,
                  "start_col": 14
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 174,
            "end": 196,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 174,
        "end": 197,
        "start_line": 18,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 197,
    "start_line": 1,
    "start_col": 0
  }
}
