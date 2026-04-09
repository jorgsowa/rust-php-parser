===source===
<?php

// unary ops
~$a;
+$a;
-$a;

// binary ops
$a & $b;
$a | $b;
$a ^ $b;
$a . $b;
$a / $b;
$a - $b;
$a % $b;
$a * $b;
$a + $b;
$a << $b;
$a >> $b;
$a ** $b;

// associativity
$a * $b * $c;
$a * ($b * $c);

// precedence
$a + $b * $c;
($a + $b) * $c;

// pow is special
$a ** $b ** $c;
($a ** $b) ** $c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BitwiseNot",
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 21,
                  "end": 23,
                  "start_line": 4,
                  "start_col": 1
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 23,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 20,
        "end": 25,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Plus",
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 26,
                  "end": 28,
                  "start_line": 5,
                  "start_col": 1
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 28,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 30,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Negate",
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 31,
                  "end": 33,
                  "start_line": 6,
                  "start_col": 1
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 33,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 50,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 50,
                  "end": 52,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "op": "BitwiseAnd",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 55,
                  "end": 57,
                  "start_line": 9,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 57,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 50,
        "end": 59,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 59,
                  "end": 61,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "op": "BitwiseOr",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 64,
                  "end": 66,
                  "start_line": 10,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 66,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 59,
        "end": 68,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 68,
                  "end": 70,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "op": "BitwiseXor",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 73,
                  "end": 75,
                  "start_line": 11,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 75,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 68,
        "end": 77,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 77,
                  "end": 79,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 82,
                  "end": 84,
                  "start_line": 12,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 77,
            "end": 84,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 77,
        "end": 86,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 86,
                  "end": 88,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "op": "Div",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 91,
                  "end": 93,
                  "start_line": 13,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 86,
            "end": 93,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 86,
        "end": 95,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 95,
                  "end": 97,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "op": "Sub",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 100,
                  "end": 102,
                  "start_line": 14,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 95,
            "end": 102,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 95,
        "end": 104,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 104,
                  "end": 106,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "op": "Mod",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 109,
                  "end": 111,
                  "start_line": 15,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 104,
            "end": 111,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 104,
        "end": 113,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 113,
                  "end": 115,
                  "start_line": 16,
                  "start_col": 0
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 118,
                  "end": 120,
                  "start_line": 16,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 113,
            "end": 120,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 113,
        "end": 122,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 122,
                  "end": 124,
                  "start_line": 17,
                  "start_col": 0
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 127,
                  "end": 129,
                  "start_line": 17,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 129,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 122,
        "end": 131,
        "start_line": 17,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 131,
                  "end": 133,
                  "start_line": 18,
                  "start_col": 0
                }
              },
              "op": "ShiftLeft",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 137,
                  "end": 139,
                  "start_line": 18,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 131,
            "end": 139,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 131,
        "end": 141,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 141,
                  "end": 143,
                  "start_line": 19,
                  "start_col": 0
                }
              },
              "op": "ShiftRight",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 147,
                  "end": 149,
                  "start_line": 19,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 141,
            "end": 149,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 141,
        "end": 151,
        "start_line": 19,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 151,
                  "end": 153,
                  "start_line": 20,
                  "start_col": 0
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 157,
                  "end": 159,
                  "start_line": 20,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 151,
            "end": 159,
            "start_line": 20,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 151,
        "end": 179,
        "start_line": 20,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 179,
                        "end": 181,
                        "start_line": 23,
                        "start_col": 0
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 184,
                        "end": 186,
                        "start_line": 23,
                        "start_col": 5
                      }
                    }
                  }
                },
                "span": {
                  "start": 179,
                  "end": 186,
                  "start_line": 23,
                  "start_col": 0
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 189,
                  "end": 191,
                  "start_line": 23,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 179,
            "end": 191,
            "start_line": 23,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 179,
        "end": 193,
        "start_line": 23,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 193,
                  "end": 195,
                  "start_line": 24,
                  "start_col": 0
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 199,
                            "end": 201,
                            "start_line": 24,
                            "start_col": 6
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 204,
                            "end": 206,
                            "start_line": 24,
                            "start_col": 11
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 199,
                      "end": 206,
                      "start_line": 24,
                      "start_col": 6
                    }
                  }
                },
                "span": {
                  "start": 198,
                  "end": 207,
                  "start_line": 24,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 193,
            "end": 207,
            "start_line": 24,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 193,
        "end": 224,
        "start_line": 24,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 224,
                  "end": 226,
                  "start_line": 27,
                  "start_col": 0
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 229,
                        "end": 231,
                        "start_line": 27,
                        "start_col": 5
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 234,
                        "end": 236,
                        "start_line": 27,
                        "start_col": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 229,
                  "end": 236,
                  "start_line": 27,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 224,
            "end": 236,
            "start_line": 27,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 224,
        "end": 238,
        "start_line": 27,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 239,
                            "end": 241,
                            "start_line": 28,
                            "start_col": 1
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 244,
                            "end": 246,
                            "start_line": 28,
                            "start_col": 6
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 239,
                      "end": 246,
                      "start_line": 28,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 238,
                  "end": 248,
                  "start_line": 28,
                  "start_col": 0
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 250,
                  "end": 252,
                  "start_line": 28,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 238,
            "end": 252,
            "start_line": 28,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 238,
        "end": 273,
        "start_line": 28,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 273,
                  "end": 275,
                  "start_line": 31,
                  "start_col": 0
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 279,
                        "end": 281,
                        "start_line": 31,
                        "start_col": 6
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 285,
                        "end": 287,
                        "start_line": 31,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 279,
                  "end": 287,
                  "start_line": 31,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 273,
            "end": 287,
            "start_line": 31,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 273,
        "end": 289,
        "start_line": 31,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 290,
                            "end": 292,
                            "start_line": 32,
                            "start_col": 1
                          }
                        },
                        "op": "Pow",
                        "right": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 296,
                            "end": 298,
                            "start_line": 32,
                            "start_col": 7
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 290,
                      "end": 298,
                      "start_line": 32,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 289,
                  "end": 300,
                  "start_line": 32,
                  "start_col": 0
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 303,
                  "end": 305,
                  "start_line": 32,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 289,
            "end": 305,
            "start_line": 32,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 289,
        "end": 306,
        "start_line": 32,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 306,
    "start_line": 1,
    "start_col": 0
  }
}
