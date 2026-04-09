===source===
<?php
$x = 10;
$x += 5;
$x -= 3;
$x *= 2;
$x /= 4;
$x %= 3;
$x **= 2;
$x .= 'suffix';
$x &= 0xFF;
$x |= 0x10;
$x ^= 0x01;
$x <<= 2;
$x >>= 1;
$x ??= 'default';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 10
                },
                "span": {
                  "start": 11,
                  "end": 13,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 15,
                  "end": 17,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Int": 5
                },
                "span": {
                  "start": 21,
                  "end": 22,
                  "start_line": 3,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 15,
            "end": 22,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 15,
        "end": 24,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 24,
                  "end": 26,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Minus",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 30,
                  "end": 31,
                  "start_line": 4,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 31,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 24,
        "end": 33,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 33,
                  "end": 35,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Mul",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 39,
                  "end": 40,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 33,
            "end": 40,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 33,
        "end": 42,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 42,
                  "end": 44,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Div",
              "value": {
                "kind": {
                  "Int": 4
                },
                "span": {
                  "start": 48,
                  "end": 49,
                  "start_line": 6,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 49,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 42,
        "end": 51,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 51,
                  "end": 53,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Mod",
              "value": {
                "kind": {
                  "Int": 3
                },
                "span": {
                  "start": 57,
                  "end": 58,
                  "start_line": 7,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 58,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 51,
        "end": 60,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 60,
                  "end": 62,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "op": "Pow",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 67,
                  "end": 68,
                  "start_line": 8,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 60,
            "end": 68,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 60,
        "end": 70,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 70,
                  "end": 72,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "String": "suffix"
                },
                "span": {
                  "start": 76,
                  "end": 84,
                  "start_line": 9,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 84,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 70,
        "end": 86,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 86,
                  "end": 88,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "op": "BitwiseAnd",
              "value": {
                "kind": {
                  "Int": 255
                },
                "span": {
                  "start": 92,
                  "end": 96,
                  "start_line": 10,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 86,
            "end": 96,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 86,
        "end": 98,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 98,
                  "end": 100,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "op": "BitwiseOr",
              "value": {
                "kind": {
                  "Int": 16
                },
                "span": {
                  "start": 104,
                  "end": 108,
                  "start_line": 11,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 98,
            "end": 108,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 98,
        "end": 110,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 110,
                  "end": 112,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "op": "BitwiseXor",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 116,
                  "end": 120,
                  "start_line": 12,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 110,
            "end": 120,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 110,
        "end": 122,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 122,
                  "end": 124,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "op": "ShiftLeft",
              "value": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 129,
                  "end": 130,
                  "start_line": 13,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 130,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 122,
        "end": 132,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 132,
                  "end": 134,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "op": "ShiftRight",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 139,
                  "end": 140,
                  "start_line": 14,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 132,
            "end": 140,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 132,
        "end": 142,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 142,
                  "end": 144,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "String": "default"
                },
                "span": {
                  "start": 149,
                  "end": 158,
                  "start_line": 15,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 142,
            "end": 158,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 142,
        "end": 159,
        "start_line": 15,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 159,
    "start_line": 1,
    "start_col": 0
  }
}
