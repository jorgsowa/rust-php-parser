===source===
<?php

"$A";
"$A->B";
"$A[B]";
"$A[0]";
"$A[1234]";
"$A[9223372036854775808]";
"$A[000]";
"$A[0x0]";
"$A[0b0]";
"$A[$B]";
"{$A}";
"{$A['B']}";
"${A}";
"${A['B']}";
"${$A}";
"\{$A}";
"\{ $A }";
"\\{$A}";
"\\{ $A }";
"{$$A}[B]";
"$$A[B]";
"A $B C";
b"$A";
B"$A";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 8,
                    "end": 10,
                    "start_line": 3,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 7,
            "end": 11,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 13,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "PropertyAccess": {
                      "object": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 14,
                          "end": 16,
                          "start_line": 4,
                          "start_col": 1
                        }
                      },
                      "property": {
                        "kind": {
                          "Identifier": "B"
                        },
                        "span": {
                          "start": 18,
                          "end": 19,
                          "start_line": 4,
                          "start_col": 5
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 19,
                    "start_line": 4,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 13,
            "end": 20,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 13,
        "end": 22,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 23,
                          "end": 25,
                          "start_line": 5,
                          "start_col": 1
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "B"
                        },
                        "span": {
                          "start": 26,
                          "end": 27,
                          "start_line": 5,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 28,
                    "start_line": 5,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 22,
            "end": 29,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 31,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 32,
                          "end": 34,
                          "start_line": 6,
                          "start_col": 1
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 35,
                          "end": 36,
                          "start_line": 6,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 37,
                    "start_line": 6,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 31,
            "end": 38,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 31,
        "end": 40,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 41,
                          "end": 43,
                          "start_line": 7,
                          "start_col": 1
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 1234
                        },
                        "span": {
                          "start": 44,
                          "end": 48,
                          "start_line": 7,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 41,
                    "end": 49,
                    "start_line": 7,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 40,
            "end": 50,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 40,
        "end": 52,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 53,
                          "end": 55,
                          "start_line": 8,
                          "start_col": 1
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "9223372036854775808"
                        },
                        "span": {
                          "start": 56,
                          "end": 75,
                          "start_line": 8,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 53,
                    "end": 76,
                    "start_line": 8,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 52,
            "end": 77,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 52,
        "end": 79,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 80,
                          "end": 82,
                          "start_line": 9,
                          "start_col": 1
                        }
                      },
                      "index": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 83,
                          "end": 86,
                          "start_line": 9,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 80,
                    "end": 87,
                    "start_line": 9,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 79,
            "end": 88,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 79,
        "end": 90,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 91,
                          "end": 93,
                          "start_line": 10,
                          "start_col": 1
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "0x0"
                        },
                        "span": {
                          "start": 94,
                          "end": 97,
                          "start_line": 10,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 91,
                    "end": 98,
                    "start_line": 10,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 90,
            "end": 99,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 90,
        "end": 101,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 102,
                          "end": 104,
                          "start_line": 11,
                          "start_col": 1
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "0b0"
                        },
                        "span": {
                          "start": 105,
                          "end": 108,
                          "start_line": 11,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 102,
                    "end": 109,
                    "start_line": 11,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 101,
            "end": 110,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 101,
        "end": 112,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 113,
                          "end": 115,
                          "start_line": 12,
                          "start_col": 1
                        }
                      },
                      "index": {
                        "kind": {
                          "Variable": "B"
                        },
                        "span": {
                          "start": 116,
                          "end": 118,
                          "start_line": 12,
                          "start_col": 4
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 113,
                    "end": 119,
                    "start_line": 12,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 112,
            "end": 120,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 112,
        "end": 122,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 124,
                    "end": 126,
                    "start_line": 13,
                    "start_col": 2
                  }
                }
              }
            ]
          },
          "span": {
            "start": 122,
            "end": 128,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 122,
        "end": 130,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 132,
                          "end": 134,
                          "start_line": 14,
                          "start_col": 2
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "B"
                        },
                        "span": {
                          "start": 135,
                          "end": 138,
                          "start_line": 14,
                          "start_col": 5
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 132,
                    "end": 139,
                    "start_line": 14,
                    "start_col": 2
                  }
                }
              }
            ]
          },
          "span": {
            "start": 130,
            "end": 141,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 130,
        "end": 143,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 146,
                    "end": 147,
                    "start_line": 15,
                    "start_col": 3
                  }
                }
              }
            ]
          },
          "span": {
            "start": 143,
            "end": 149,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 143,
        "end": 151,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 154,
                          "end": 155,
                          "start_line": 16,
                          "start_col": 3
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "'B'"
                        },
                        "span": {
                          "start": 156,
                          "end": 159,
                          "start_line": 16,
                          "start_col": 5
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 152,
                    "end": 160,
                    "start_line": 16,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 151,
            "end": 162,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 151,
        "end": 164,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "VariableVariable": {
                      "kind": {
                        "Variable": "A"
                      },
                      "span": {
                        "start": 167,
                        "end": 169,
                        "start_line": 17,
                        "start_col": 3
                      }
                    }
                  },
                  "span": {
                    "start": 165,
                    "end": 170,
                    "start_line": 17,
                    "start_col": 1
                  }
                }
              }
            ]
          },
          "span": {
            "start": 164,
            "end": 171,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 164,
        "end": 173,
        "start_line": 17,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Literal": "\\{"
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 176,
                    "end": 178,
                    "start_line": 18,
                    "start_col": 3
                  }
                }
              },
              {
                "Literal": "}"
              }
            ]
          },
          "span": {
            "start": 173,
            "end": 180,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 173,
        "end": 182,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Literal": "\\{ "
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 186,
                    "end": 188,
                    "start_line": 19,
                    "start_col": 4
                  }
                }
              },
              {
                "Literal": " }"
              }
            ]
          },
          "span": {
            "start": 182,
            "end": 191,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 182,
        "end": 193,
        "start_line": 19,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Literal": "\\"
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 197,
                    "end": 199,
                    "start_line": 20,
                    "start_col": 4
                  }
                }
              }
            ]
          },
          "span": {
            "start": 193,
            "end": 201,
            "start_line": 20,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 193,
        "end": 203,
        "start_line": 20,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Literal": "\\{ "
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 208,
                    "end": 210,
                    "start_line": 21,
                    "start_col": 5
                  }
                }
              },
              {
                "Literal": " }"
              }
            ]
          },
          "span": {
            "start": 203,
            "end": 213,
            "start_line": 21,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 203,
        "end": 215,
        "start_line": 21,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "VariableVariable": {
                      "kind": {
                        "Variable": "A"
                      },
                      "span": {
                        "start": 218,
                        "end": 220,
                        "start_line": 22,
                        "start_col": 3
                      }
                    }
                  },
                  "span": {
                    "start": 217,
                    "end": 220,
                    "start_line": 22,
                    "start_col": 2
                  }
                }
              },
              {
                "Literal": "[B]"
              }
            ]
          },
          "span": {
            "start": 215,
            "end": 225,
            "start_line": 22,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 215,
        "end": 227,
        "start_line": 22,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Literal": "$"
              },
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "A"
                        },
                        "span": {
                          "start": 229,
                          "end": 231,
                          "start_line": 23,
                          "start_col": 2
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "B"
                        },
                        "span": {
                          "start": 232,
                          "end": 233,
                          "start_line": 23,
                          "start_col": 5
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 229,
                    "end": 234,
                    "start_line": 23,
                    "start_col": 2
                  }
                }
              }
            ]
          },
          "span": {
            "start": 227,
            "end": 235,
            "start_line": 23,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 227,
        "end": 237,
        "start_line": 23,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Literal": "A "
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "B"
                  },
                  "span": {
                    "start": 240,
                    "end": 242,
                    "start_line": 24,
                    "start_col": 3
                  }
                }
              },
              {
                "Literal": " C"
              }
            ]
          },
          "span": {
            "start": 237,
            "end": 245,
            "start_line": 24,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 237,
        "end": 247,
        "start_line": 24,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 249,
                    "end": 251,
                    "start_line": 25,
                    "start_col": 2
                  }
                }
              }
            ]
          },
          "span": {
            "start": 247,
            "end": 252,
            "start_line": 25,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 247,
        "end": 254,
        "start_line": 25,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "Variable": "A"
                  },
                  "span": {
                    "start": 256,
                    "end": 258,
                    "start_line": 26,
                    "start_col": 2
                  }
                }
              }
            ]
          },
          "span": {
            "start": 254,
            "end": 259,
            "start_line": 26,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 254,
        "end": 260,
        "start_line": 26,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 260,
    "start_line": 1,
    "start_col": 0
  }
}
