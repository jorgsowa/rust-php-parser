===source===
<?php
$a = 1 + 2 * 3;
$b = (1 + 2) * 3;
$c = 2 ** 3 ** 2;
$d = $a > 0 ? 'positive' : 'non-positive';
$e = $x ?? 'default';
$f = $a === $b;
$g = !$flag;
$h = -$x;
$i = $x++;
$j = ++$x;
$k = 'hello' . ' ' . 'world';
$l = $a + $b - $c * $d / $e;
$m = $a & $b | $c ^ $d;
$n = $a << 2;
$o = $a >> 1;
$p = $a <=> $b;
$q = $a ?: 'fallback';
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
                  "Variable": "a"
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 11,
                        "end": 12,
                        "start_line": 2,
                        "start_col": 5
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 15,
                              "end": 16,
                              "start_line": 2,
                              "start_col": 9
                            }
                          },
                          "op": "Mul",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 19,
                              "end": 20,
                              "start_line": 2,
                              "start_col": 13
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 15,
                        "end": 20,
                        "start_line": 2,
                        "start_col": 9
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 20,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22,
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
                  "Variable": "b"
                },
                "span": {
                  "start": 22,
                  "end": 24,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 28,
                                  "end": 29,
                                  "start_line": 3,
                                  "start_col": 6
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 32,
                                  "end": 33,
                                  "start_line": 3,
                                  "start_col": 10
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 28,
                            "end": 33,
                            "start_line": 3,
                            "start_col": 6
                          }
                        }
                      },
                      "span": {
                        "start": 27,
                        "end": 35,
                        "start_line": 3,
                        "start_col": 5
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 37,
                        "end": 38,
                        "start_line": 3,
                        "start_col": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 27,
                  "end": 38,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 38,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 40,
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
                  "Variable": "c"
                },
                "span": {
                  "start": 40,
                  "end": 42,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 45,
                        "end": 46,
                        "start_line": 4,
                        "start_col": 5
                      }
                    },
                    "op": "Pow",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 50,
                              "end": 51,
                              "start_line": 4,
                              "start_col": 10
                            }
                          },
                          "op": "Pow",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 55,
                              "end": 56,
                              "start_line": 4,
                              "start_col": 15
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 56,
                        "start_line": 4,
                        "start_col": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 45,
                  "end": 56,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 40,
            "end": 56,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 40,
        "end": 58,
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
                  "Variable": "d"
                },
                "span": {
                  "start": 58,
                  "end": 60,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 63,
                              "end": 65,
                              "start_line": 5,
                              "start_col": 5
                            }
                          },
                          "op": "Greater",
                          "right": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 68,
                              "end": 69,
                              "start_line": 5,
                              "start_col": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 63,
                        "end": 69,
                        "start_line": 5,
                        "start_col": 5
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "String": "positive"
                      },
                      "span": {
                        "start": 72,
                        "end": 82,
                        "start_line": 5,
                        "start_col": 14
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "String": "non-positive"
                      },
                      "span": {
                        "start": 85,
                        "end": 99,
                        "start_line": 5,
                        "start_col": 27
                      }
                    }
                  }
                },
                "span": {
                  "start": 63,
                  "end": 99,
                  "start_line": 5,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 99,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 58,
        "end": 101,
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
                  "Variable": "e"
                },
                "span": {
                  "start": 101,
                  "end": 103,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 106,
                        "end": 108,
                        "start_line": 6,
                        "start_col": 5
                      }
                    },
                    "right": {
                      "kind": {
                        "String": "default"
                      },
                      "span": {
                        "start": 112,
                        "end": 121,
                        "start_line": 6,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 106,
                  "end": 121,
                  "start_line": 6,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 101,
            "end": 121,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 101,
        "end": 123,
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
                  "Variable": "f"
                },
                "span": {
                  "start": 123,
                  "end": 125,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 128,
                        "end": 130,
                        "start_line": 7,
                        "start_col": 5
                      }
                    },
                    "op": "Identical",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 135,
                        "end": 137,
                        "start_line": 7,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 128,
                  "end": 137,
                  "start_line": 7,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 123,
            "end": 137,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 123,
        "end": 139,
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
                  "Variable": "g"
                },
                "span": {
                  "start": 139,
                  "end": 141,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "Variable": "flag"
                      },
                      "span": {
                        "start": 145,
                        "end": 150,
                        "start_line": 8,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 144,
                  "end": 150,
                  "start_line": 8,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 139,
            "end": 150,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 139,
        "end": 152,
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
                  "Variable": "h"
                },
                "span": {
                  "start": 152,
                  "end": 154,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 158,
                        "end": 160,
                        "start_line": 9,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 157,
                  "end": 160,
                  "start_line": 9,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 152,
            "end": 160,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 152,
        "end": 162,
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
                  "Variable": "i"
                },
                "span": {
                  "start": 162,
                  "end": 164,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPostfix": {
                    "operand": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 167,
                        "end": 169,
                        "start_line": 10,
                        "start_col": 5
                      }
                    },
                    "op": "PostIncrement"
                  }
                },
                "span": {
                  "start": 167,
                  "end": 171,
                  "start_line": 10,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 162,
            "end": 171,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 162,
        "end": 173,
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
                  "Variable": "j"
                },
                "span": {
                  "start": 173,
                  "end": 175,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "PreIncrement",
                    "operand": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 180,
                        "end": 182,
                        "start_line": 11,
                        "start_col": 7
                      }
                    }
                  }
                },
                "span": {
                  "start": 178,
                  "end": 182,
                  "start_line": 11,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 173,
            "end": 182,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 173,
        "end": 184,
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
                  "Variable": "k"
                },
                "span": {
                  "start": 184,
                  "end": 186,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "String": "hello"
                            },
                            "span": {
                              "start": 189,
                              "end": 196,
                              "start_line": 12,
                              "start_col": 5
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "String": " "
                            },
                            "span": {
                              "start": 199,
                              "end": 202,
                              "start_line": 12,
                              "start_col": 15
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 189,
                        "end": 202,
                        "start_line": 12,
                        "start_col": 5
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "world"
                      },
                      "span": {
                        "start": 205,
                        "end": 212,
                        "start_line": 12,
                        "start_col": 21
                      }
                    }
                  }
                },
                "span": {
                  "start": 189,
                  "end": 212,
                  "start_line": 12,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 184,
            "end": 212,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 184,
        "end": 214,
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
                  "Variable": "l"
                },
                "span": {
                  "start": 214,
                  "end": 216,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
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
                              "start": 219,
                              "end": 221,
                              "start_line": 13,
                              "start_col": 5
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 224,
                              "end": 226,
                              "start_line": 13,
                              "start_col": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 219,
                        "end": 226,
                        "start_line": 13,
                        "start_col": 5
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Variable": "c"
                                  },
                                  "span": {
                                    "start": 229,
                                    "end": 231,
                                    "start_line": 13,
                                    "start_col": 15
                                  }
                                },
                                "op": "Mul",
                                "right": {
                                  "kind": {
                                    "Variable": "d"
                                  },
                                  "span": {
                                    "start": 234,
                                    "end": 236,
                                    "start_line": 13,
                                    "start_col": 20
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 229,
                              "end": 236,
                              "start_line": 13,
                              "start_col": 15
                            }
                          },
                          "op": "Div",
                          "right": {
                            "kind": {
                              "Variable": "e"
                            },
                            "span": {
                              "start": 239,
                              "end": 241,
                              "start_line": 13,
                              "start_col": 25
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 229,
                        "end": 241,
                        "start_line": 13,
                        "start_col": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 219,
                  "end": 241,
                  "start_line": 13,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 214,
            "end": 241,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 214,
        "end": 243,
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
                  "Variable": "m"
                },
                "span": {
                  "start": 243,
                  "end": 245,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
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
                              "start": 248,
                              "end": 250,
                              "start_line": 14,
                              "start_col": 5
                            }
                          },
                          "op": "BitwiseAnd",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 253,
                              "end": 255,
                              "start_line": 14,
                              "start_col": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 248,
                        "end": 255,
                        "start_line": 14,
                        "start_col": 5
                      }
                    },
                    "op": "BitwiseOr",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 258,
                              "end": 260,
                              "start_line": 14,
                              "start_col": 15
                            }
                          },
                          "op": "BitwiseXor",
                          "right": {
                            "kind": {
                              "Variable": "d"
                            },
                            "span": {
                              "start": 263,
                              "end": 265,
                              "start_line": 14,
                              "start_col": 20
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 258,
                        "end": 265,
                        "start_line": 14,
                        "start_col": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 248,
                  "end": 265,
                  "start_line": 14,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 243,
            "end": 265,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 243,
        "end": 267,
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
                  "Variable": "n"
                },
                "span": {
                  "start": 267,
                  "end": 269,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 272,
                        "end": 274,
                        "start_line": 15,
                        "start_col": 5
                      }
                    },
                    "op": "ShiftLeft",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 278,
                        "end": 279,
                        "start_line": 15,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 272,
                  "end": 279,
                  "start_line": 15,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 267,
            "end": 279,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 267,
        "end": 281,
        "start_line": 15,
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
                  "Variable": "o"
                },
                "span": {
                  "start": 281,
                  "end": 283,
                  "start_line": 16,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 286,
                        "end": 288,
                        "start_line": 16,
                        "start_col": 5
                      }
                    },
                    "op": "ShiftRight",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 292,
                        "end": 293,
                        "start_line": 16,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 286,
                  "end": 293,
                  "start_line": 16,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 281,
            "end": 293,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 281,
        "end": 295,
        "start_line": 16,
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
                  "Variable": "p"
                },
                "span": {
                  "start": 295,
                  "end": 297,
                  "start_line": 17,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 300,
                        "end": 302,
                        "start_line": 17,
                        "start_col": 5
                      }
                    },
                    "op": "Spaceship",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 307,
                        "end": 309,
                        "start_line": 17,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 300,
                  "end": 309,
                  "start_line": 17,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 295,
            "end": 309,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 295,
        "end": 311,
        "start_line": 17,
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
                  "Variable": "q"
                },
                "span": {
                  "start": 311,
                  "end": 313,
                  "start_line": 18,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 316,
                        "end": 318,
                        "start_line": 18,
                        "start_col": 5
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "String": "fallback"
                      },
                      "span": {
                        "start": 322,
                        "end": 332,
                        "start_line": 18,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 316,
                  "end": 332,
                  "start_line": 18,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 311,
            "end": 332,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 311,
        "end": 333,
        "start_line": 18,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 333,
    "start_line": 1,
    "start_col": 0
  }
}
