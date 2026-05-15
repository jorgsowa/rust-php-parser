===source===
<?php
// Ternary with null coalescing chains
$a = ($x ?? $y) ? $z : ($w ?: $u);

// Exponentiation with unary operators
$b = -2 ** 2;
$c = ~2 ** 3;

// Instanceof with complex expressions
$d = ($x instanceof A | B);
$e = $x instanceof (int & string) | bool;

// Error suppress with complex expressions
$f = @($x + $y);
$g = @$x + $y;

// Compound assignment with operations
$h = $x .= $y . $z;
$i = $j **= 2 + 3;

// Logical operators precedence
$k = $a and $b or $c;
$l = $a && $b || $c;
$m = $a && $b or $c;
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
                  "start": 45,
                  "end": 47
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "NullCoalesce": {
                              "left": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 51,
                                  "end": 53
                                }
                              },
                              "right": {
                                "kind": {
                                  "Variable": "y"
                                },
                                "span": {
                                  "start": 57,
                                  "end": 59
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 51,
                            "end": 59
                          }
                        }
                      },
                      "span": {
                        "start": 50,
                        "end": 60
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Variable": "z"
                      },
                      "span": {
                        "start": 63,
                        "end": 65
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Ternary": {
                              "condition": {
                                "kind": {
                                  "Variable": "w"
                                },
                                "span": {
                                  "start": 69,
                                  "end": 71
                                }
                              },
                              "then_expr": null,
                              "else_expr": {
                                "kind": {
                                  "Variable": "u"
                                },
                                "span": {
                                  "start": 75,
                                  "end": 77
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 69,
                            "end": 77
                          }
                        }
                      },
                      "span": {
                        "start": 68,
                        "end": 78
                      }
                    }
                  }
                },
                "span": {
                  "start": 50,
                  "end": 78
                }
              }
            }
          },
          "span": {
            "start": 45,
            "end": 78
          }
        }
      },
      "span": {
        "start": 45,
        "end": 79
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
                  "start": 120,
                  "end": 122
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 126,
                              "end": 127
                            }
                          },
                          "op": "Pow",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 131,
                              "end": 132
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 126,
                        "end": 132
                      }
                    }
                  }
                },
                "span": {
                  "start": 125,
                  "end": 132
                }
              }
            }
          },
          "span": {
            "start": 120,
            "end": 132
          }
        }
      },
      "span": {
        "start": 120,
        "end": 133
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
                  "start": 134,
                  "end": 136
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BitwiseNot",
                    "operand": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 140,
                              "end": 141
                            }
                          },
                          "op": "Pow",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 145,
                              "end": 146
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 140,
                        "end": 146
                      }
                    }
                  }
                },
                "span": {
                  "start": 139,
                  "end": 146
                }
              }
            }
          },
          "span": {
            "start": 134,
            "end": 146
          }
        }
      },
      "span": {
        "start": 134,
        "end": 147
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
                  "start": 188,
                  "end": 190
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Variable": "x"
                                },
                                "span": {
                                  "start": 194,
                                  "end": 196
                                }
                              },
                              "op": "Instanceof",
                              "right": {
                                "kind": {
                                  "Identifier": "A"
                                },
                                "span": {
                                  "start": 208,
                                  "end": 209
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 194,
                            "end": 209
                          }
                        },
                        "op": "BitwiseOr",
                        "right": {
                          "kind": {
                            "Identifier": "B"
                          },
                          "span": {
                            "start": 212,
                            "end": 213
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 194,
                      "end": 213
                    }
                  }
                },
                "span": {
                  "start": 193,
                  "end": 214
                }
              }
            }
          },
          "span": {
            "start": 188,
            "end": 214
          }
        }
      },
      "span": {
        "start": 188,
        "end": 215
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
                  "start": 216,
                  "end": 218
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
                              "Variable": "x"
                            },
                            "span": {
                              "start": 221,
                              "end": 223
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "Identifier": "int"
                                      },
                                      "span": {
                                        "start": 236,
                                        "end": 239
                                      }
                                    },
                                    "op": "BitwiseAnd",
                                    "right": {
                                      "kind": {
                                        "Identifier": "string"
                                      },
                                      "span": {
                                        "start": 242,
                                        "end": 248
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 236,
                                  "end": 248
                                }
                              }
                            },
                            "span": {
                              "start": 235,
                              "end": 249
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 221,
                        "end": 249
                      }
                    },
                    "op": "BitwiseOr",
                    "right": {
                      "kind": {
                        "Identifier": "bool"
                      },
                      "span": {
                        "start": 252,
                        "end": 256
                      }
                    }
                  }
                },
                "span": {
                  "start": 221,
                  "end": 256
                }
              }
            }
          },
          "span": {
            "start": 216,
            "end": 256
          }
        }
      },
      "span": {
        "start": 216,
        "end": 257
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
                  "start": 302,
                  "end": 304
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ErrorSuppress": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 309,
                                "end": 311
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "Variable": "y"
                              },
                              "span": {
                                "start": 314,
                                "end": 316
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 309,
                          "end": 316
                        }
                      }
                    },
                    "span": {
                      "start": 308,
                      "end": 317
                    }
                  }
                },
                "span": {
                  "start": 307,
                  "end": 317
                }
              }
            }
          },
          "span": {
            "start": 302,
            "end": 317
          }
        }
      },
      "span": {
        "start": 302,
        "end": 318
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
                  "start": 319,
                  "end": 321
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "ErrorSuppress": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 325,
                            "end": 327
                          }
                        }
                      },
                      "span": {
                        "start": 324,
                        "end": 327
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 330,
                        "end": 332
                      }
                    }
                  }
                },
                "span": {
                  "start": 324,
                  "end": 332
                }
              }
            }
          },
          "span": {
            "start": 319,
            "end": 332
          }
        }
      },
      "span": {
        "start": 319,
        "end": 333
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
                  "start": 374,
                  "end": 376
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 379,
                        "end": 381
                      }
                    },
                    "op": "Concat",
                    "value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 385,
                              "end": 387
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Variable": "z"
                            },
                            "span": {
                              "start": 390,
                              "end": 392
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 385,
                        "end": 392
                      }
                    }
                  }
                },
                "span": {
                  "start": 379,
                  "end": 392
                }
              }
            }
          },
          "span": {
            "start": 374,
            "end": 392
          }
        }
      },
      "span": {
        "start": 374,
        "end": 393
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
                  "start": 394,
                  "end": 396
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "j"
                      },
                      "span": {
                        "start": 399,
                        "end": 401
                      }
                    },
                    "op": "Pow",
                    "value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 406,
                              "end": 407
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 410,
                              "end": 411
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 406,
                        "end": 411
                      }
                    }
                  }
                },
                "span": {
                  "start": 399,
                  "end": 411
                }
              }
            }
          },
          "span": {
            "start": 394,
            "end": 411
          }
        }
      },
      "span": {
        "start": 394,
        "end": 412
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
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "k"
                            },
                            "span": {
                              "start": 446,
                              "end": 448
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 451,
                              "end": 453
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 446,
                        "end": 453
                      }
                    },
                    "op": "LogicalAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 458,
                        "end": 460
                      }
                    }
                  }
                },
                "span": {
                  "start": 446,
                  "end": 460
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 464,
                  "end": 466
                }
              }
            }
          },
          "span": {
            "start": 446,
            "end": 466
          }
        }
      },
      "span": {
        "start": 446,
        "end": 467
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
                  "start": 468,
                  "end": 470
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
                              "start": 473,
                              "end": 475
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 479,
                              "end": 481
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 473,
                        "end": 481
                      }
                    },
                    "op": "BooleanOr",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 485,
                        "end": 487
                      }
                    }
                  }
                },
                "span": {
                  "start": 473,
                  "end": 487
                }
              }
            }
          },
          "span": {
            "start": 468,
            "end": 487
          }
        }
      },
      "span": {
        "start": 468,
        "end": 488
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "m"
                      },
                      "span": {
                        "start": 489,
                        "end": 491
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
                              "start": 494,
                              "end": 496
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 500,
                              "end": 502
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 494,
                        "end": 502
                      }
                    }
                  }
                },
                "span": {
                  "start": 489,
                  "end": 502
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 506,
                  "end": 508
                }
              }
            }
          },
          "span": {
            "start": 489,
            "end": 508
          }
        }
      },
      "span": {
        "start": 489,
        "end": 509
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 509
  }
}
