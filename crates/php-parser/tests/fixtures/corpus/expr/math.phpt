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
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 23
          }
        }
      },
      "span": {
        "start": 20,
        "end": 24
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
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 28
          }
        }
      },
      "span": {
        "start": 25,
        "end": 29
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
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 33
          }
        }
      },
      "span": {
        "start": 30,
        "end": 34
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
                  "end": 52
                }
              },
              "op": "BitwiseAnd",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 57
          }
        }
      },
      "span": {
        "start": 50,
        "end": 58
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
                  "end": 61
                }
              },
              "op": "BitwiseOr",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 64,
                  "end": 66
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 66
          }
        }
      },
      "span": {
        "start": 59,
        "end": 67
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
                  "end": 70
                }
              },
              "op": "BitwiseXor",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 73,
                  "end": 75
                }
              }
            }
          },
          "span": {
            "start": 68,
            "end": 75
          }
        }
      },
      "span": {
        "start": 68,
        "end": 76
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
                  "end": 79
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 82,
                  "end": 84
                }
              }
            }
          },
          "span": {
            "start": 77,
            "end": 84
          }
        }
      },
      "span": {
        "start": 77,
        "end": 85
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
                  "end": 88
                }
              },
              "op": "Div",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 91,
                  "end": 93
                }
              }
            }
          },
          "span": {
            "start": 86,
            "end": 93
          }
        }
      },
      "span": {
        "start": 86,
        "end": 94
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
                  "end": 97
                }
              },
              "op": "Sub",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 100,
                  "end": 102
                }
              }
            }
          },
          "span": {
            "start": 95,
            "end": 102
          }
        }
      },
      "span": {
        "start": 95,
        "end": 103
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
                  "end": 106
                }
              },
              "op": "Mod",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 109,
                  "end": 111
                }
              }
            }
          },
          "span": {
            "start": 104,
            "end": 111
          }
        }
      },
      "span": {
        "start": 104,
        "end": 112
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
                  "end": 115
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 118,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 113,
            "end": 120
          }
        }
      },
      "span": {
        "start": 113,
        "end": 121
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
                  "end": 124
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 127,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 129
          }
        }
      },
      "span": {
        "start": 122,
        "end": 130
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
                  "end": 133
                }
              },
              "op": "ShiftLeft",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 137,
                  "end": 139
                }
              }
            }
          },
          "span": {
            "start": 131,
            "end": 139
          }
        }
      },
      "span": {
        "start": 131,
        "end": 140
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
                  "end": 143
                }
              },
              "op": "ShiftRight",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 147,
                  "end": 149
                }
              }
            }
          },
          "span": {
            "start": 141,
            "end": 149
          }
        }
      },
      "span": {
        "start": 141,
        "end": 150
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
                  "end": 153
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 157,
                  "end": 159
                }
              }
            }
          },
          "span": {
            "start": 151,
            "end": 159
          }
        }
      },
      "span": {
        "start": 151,
        "end": 160
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
                        "end": 181
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 184,
                        "end": 186
                      }
                    }
                  }
                },
                "span": {
                  "start": 179,
                  "end": 186
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 189,
                  "end": 191
                }
              }
            }
          },
          "span": {
            "start": 179,
            "end": 191
          }
        }
      },
      "span": {
        "start": 179,
        "end": 192
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
                  "end": 195
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
                            "end": 201
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 204,
                            "end": 206
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 199,
                      "end": 206
                    }
                  }
                },
                "span": {
                  "start": 198,
                  "end": 207
                }
              }
            }
          },
          "span": {
            "start": 193,
            "end": 207
          }
        }
      },
      "span": {
        "start": 193,
        "end": 208
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
                  "end": 226
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
                        "end": 231
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 234,
                        "end": 236
                      }
                    }
                  }
                },
                "span": {
                  "start": 229,
                  "end": 236
                }
              }
            }
          },
          "span": {
            "start": 224,
            "end": 236
          }
        }
      },
      "span": {
        "start": 224,
        "end": 237
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
                            "end": 241
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 244,
                            "end": 246
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 239,
                      "end": 246
                    }
                  }
                },
                "span": {
                  "start": 238,
                  "end": 247
                }
              },
              "op": "Mul",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 250,
                  "end": 252
                }
              }
            }
          },
          "span": {
            "start": 238,
            "end": 252
          }
        }
      },
      "span": {
        "start": 238,
        "end": 253
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
                  "end": 275
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
                        "end": 281
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 285,
                        "end": 287
                      }
                    }
                  }
                },
                "span": {
                  "start": 279,
                  "end": 287
                }
              }
            }
          },
          "span": {
            "start": 273,
            "end": 287
          }
        }
      },
      "span": {
        "start": 273,
        "end": 288
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
                            "end": 292
                          }
                        },
                        "op": "Pow",
                        "right": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 296,
                            "end": 298
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 290,
                      "end": 298
                    }
                  }
                },
                "span": {
                  "start": 289,
                  "end": 299
                }
              },
              "op": "Pow",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 303,
                  "end": 305
                }
              }
            }
          },
          "span": {
            "start": 289,
            "end": 305
          }
        }
      },
      "span": {
        "start": 289,
        "end": 306
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 306
  }
}
