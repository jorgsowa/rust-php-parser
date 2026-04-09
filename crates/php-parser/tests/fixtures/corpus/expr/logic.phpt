===source===
<?php

// boolean ops
$a && $b;
$a || $b;
!$a;
!!$a;

// logical ops
$a and $b;
$a or $b;
$a xor $b;

// precedence
$a && $b || $c && $d;
$a && ($b || $c) && $d;

$a = $b || $c;
$a = $b or $c;
===ast===
{
  "stmts": [
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
                  "start": 22,
                  "end": 24,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 28,
                  "end": 30,
                  "start_line": 4,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 30,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 22,
        "end": 32,
        "start_line": 4,
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
                  "start": 32,
                  "end": 34,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "BooleanOr",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 38,
                  "end": 40,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 40,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 32,
        "end": 42,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BooleanNot",
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 43,
                  "end": 45,
                  "start_line": 6,
                  "start_col": 1
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 45,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 42,
        "end": 47,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BooleanNot",
              "operand": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 49,
                        "end": 51,
                        "start_line": 7,
                        "start_col": 2
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 51,
                  "start_line": 7,
                  "start_col": 1
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 51,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 47,
        "end": 69,
        "start_line": 7,
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
                  "start": 69,
                  "end": 71,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "op": "LogicalAnd",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 76,
                  "end": 78,
                  "start_line": 10,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 69,
            "end": 78,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 69,
        "end": 80,
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
                  "start": 80,
                  "end": 82,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 86,
                  "end": 88,
                  "start_line": 11,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 80,
            "end": 88,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 80,
        "end": 90,
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
                  "start": 90,
                  "end": 92,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "op": "LogicalXor",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 97,
                  "end": 99,
                  "start_line": 12,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 90,
            "end": 99,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 90,
        "end": 116,
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 116,
                        "end": 118,
                        "start_line": 15,
                        "start_col": 0
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 122,
                        "end": 124,
                        "start_line": 15,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 116,
                  "end": 124,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "op": "BooleanOr",
              "right": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 128,
                        "end": 130,
                        "start_line": 15,
                        "start_col": 12
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "d"
                      },
                      "span": {
                        "start": 134,
                        "end": 136,
                        "start_line": 15,
                        "start_col": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 128,
                  "end": 136,
                  "start_line": 15,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 116,
            "end": 136,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 116,
        "end": 138,
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 138,
                        "end": 140,
                        "start_line": 16,
                        "start_col": 0
                      }
                    },
                    "op": "BooleanAnd",
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
                                  "start": 145,
                                  "end": 147,
                                  "start_line": 16,
                                  "start_col": 7
                                }
                              },
                              "op": "BooleanOr",
                              "right": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 151,
                                  "end": 153,
                                  "start_line": 16,
                                  "start_col": 13
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 145,
                            "end": 153,
                            "start_line": 16,
                            "start_col": 7
                          }
                        }
                      },
                      "span": {
                        "start": 144,
                        "end": 155,
                        "start_line": 16,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 138,
                  "end": 155,
                  "start_line": 16,
                  "start_col": 0
                }
              },
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 158,
                  "end": 160,
                  "start_line": 16,
                  "start_col": 20
                }
              }
            }
          },
          "span": {
            "start": 138,
            "end": 160,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 138,
        "end": 163,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 163,
                  "end": 165,
                  "start_line": 18,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 168,
                        "end": 170,
                        "start_line": 18,
                        "start_col": 5
                      }
                    },
                    "op": "BooleanOr",
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 174,
                        "end": 176,
                        "start_line": 18,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 168,
                  "end": 176,
                  "start_line": 18,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 163,
            "end": 176,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 163,
        "end": 178,
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
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 178,
                        "end": 180,
                        "start_line": 19,
                        "start_col": 0
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 183,
                        "end": 185,
                        "start_line": 19,
                        "start_col": 5
                      }
                    }
                  }
                },
                "span": {
                  "start": 178,
                  "end": 185,
                  "start_line": 19,
                  "start_col": 0
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 189,
                  "end": 191,
                  "start_line": 19,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 178,
            "end": 191,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 178,
        "end": 192,
        "start_line": 19,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 192,
    "start_line": 1,
    "start_col": 0
  }
}
