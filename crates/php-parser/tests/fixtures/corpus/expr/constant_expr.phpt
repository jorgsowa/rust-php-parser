===source===
<?php

const T_1 = 1 << 1;
const T_2 = 1 / 2;
const T_3 = 1.5 + 1.5;
const T_4 = "foo" . "bar";
const T_5 = (1.5 + 1.5) * 2;
const T_6 = "foo" . 2 . 3 . 4.0;
const T_7 = __LINE__;
const T_8 = <<<ENDOFSTRING
This is a test string
ENDOFSTRING;
const T_9 = ~-1;
const T_10 = (-1?:1) + (0?2:3);
const T_11 = 1 && 0;
const T_12 = 1 and 1;
const T_13 = 0 || 0;
const T_14 = 1 or 0;
const T_15 = 1 xor 1;
const T_16 = 1 xor 0;
const T_17 = 1 < 0;
const T_18 = 0 <= 0;
const T_19 = 1 > 0;
const T_20 = 1 >= 0;
const T_21 = 1 === 1;
const T_22 = 1 !== 1;
const T_23 = 0 != "0";
const T_24 = 1 == "1";
const T_25 = 1 + 2 * 3;
const T_26 = "1" + 2 + "3";
const T_27 = 2 ** 3;
const T_28 = [1, 2, 3][1];
const T_29 = 12 - 13;
const T_30 = 12 ^ 13;
const T_31 = 12 & 13;
const T_32 = 12 | 13;
const T_33 = 12 % 3;
const T_34 = 100 >> 4;
const T_35 = !false;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": "T_1",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 19,
                      "end": 20,
                      "start_line": 3,
                      "start_col": 12
                    }
                  },
                  "op": "ShiftLeft",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 24,
                      "end": 25,
                      "start_line": 3,
                      "start_col": 17
                    }
                  }
                }
              },
              "span": {
                "start": 19,
                "end": 25,
                "start_line": 3,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 13,
              "end": 25,
              "start_line": 3,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 27,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_2",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 39,
                      "end": 40,
                      "start_line": 4,
                      "start_col": 12
                    }
                  },
                  "op": "Div",
                  "right": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 43,
                      "end": 44,
                      "start_line": 4,
                      "start_col": 16
                    }
                  }
                }
              },
              "span": {
                "start": 39,
                "end": 44,
                "start_line": 4,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 33,
              "end": 44,
              "start_line": 4,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 46,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_3",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Float": 1.5
                    },
                    "span": {
                      "start": 58,
                      "end": 61,
                      "start_line": 5,
                      "start_col": 12
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "Float": 1.5
                    },
                    "span": {
                      "start": 64,
                      "end": 67,
                      "start_line": 5,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 58,
                "end": 67,
                "start_line": 5,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 52,
              "end": 67,
              "start_line": 5,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 46,
        "end": 69,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_4",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "String": "foo"
                    },
                    "span": {
                      "start": 81,
                      "end": 86,
                      "start_line": 6,
                      "start_col": 12
                    }
                  },
                  "op": "Concat",
                  "right": {
                    "kind": {
                      "String": "bar"
                    },
                    "span": {
                      "start": 89,
                      "end": 94,
                      "start_line": 6,
                      "start_col": 20
                    }
                  }
                }
              },
              "span": {
                "start": 81,
                "end": 94,
                "start_line": 6,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 75,
              "end": 94,
              "start_line": 6,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 69,
        "end": 96,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_5",
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
                                "Float": 1.5
                              },
                              "span": {
                                "start": 109,
                                "end": 112,
                                "start_line": 7,
                                "start_col": 13
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "Float": 1.5
                              },
                              "span": {
                                "start": 115,
                                "end": 118,
                                "start_line": 7,
                                "start_col": 19
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 109,
                          "end": 118,
                          "start_line": 7,
                          "start_col": 13
                        }
                      }
                    },
                    "span": {
                      "start": 108,
                      "end": 120,
                      "start_line": 7,
                      "start_col": 12
                    }
                  },
                  "op": "Mul",
                  "right": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 122,
                      "end": 123,
                      "start_line": 7,
                      "start_col": 26
                    }
                  }
                }
              },
              "span": {
                "start": 108,
                "end": 123,
                "start_line": 7,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 102,
              "end": 123,
              "start_line": 7,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 96,
        "end": 125,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_6",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "String": "foo"
                                },
                                "span": {
                                  "start": 137,
                                  "end": 142,
                                  "start_line": 8,
                                  "start_col": 12
                                }
                              },
                              "op": "Concat",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 145,
                                  "end": 146,
                                  "start_line": 8,
                                  "start_col": 20
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 137,
                            "end": 146,
                            "start_line": 8,
                            "start_col": 12
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 149,
                            "end": 150,
                            "start_line": 8,
                            "start_col": 24
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 137,
                      "end": 150,
                      "start_line": 8,
                      "start_col": 12
                    }
                  },
                  "op": "Concat",
                  "right": {
                    "kind": {
                      "Float": 4.0
                    },
                    "span": {
                      "start": 153,
                      "end": 156,
                      "start_line": 8,
                      "start_col": 28
                    }
                  }
                }
              },
              "span": {
                "start": 137,
                "end": 156,
                "start_line": 8,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 131,
              "end": 156,
              "start_line": 8,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 125,
        "end": 158,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_7",
            "value": {
              "kind": {
                "MagicConst": "Line"
              },
              "span": {
                "start": 170,
                "end": 178,
                "start_line": 9,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 164,
              "end": 178,
              "start_line": 9,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 158,
        "end": 180,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_8",
            "value": {
              "kind": {
                "Heredoc": {
                  "label": "ENDOFSTRING",
                  "parts": [
                    {
                      "Literal": "This is a test string"
                    }
                  ]
                }
              },
              "span": {
                "start": 192,
                "end": 240,
                "start_line": 10,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 186,
              "end": 240,
              "start_line": 10,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 180,
        "end": 242,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_9",
            "value": {
              "kind": {
                "UnaryPrefix": {
                  "op": "BitwiseNot",
                  "operand": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 256,
                            "end": 257,
                            "start_line": 13,
                            "start_col": 14
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 255,
                      "end": 257,
                      "start_line": 13,
                      "start_col": 13
                    }
                  }
                }
              },
              "span": {
                "start": 254,
                "end": 257,
                "start_line": 13,
                "start_col": 12
              }
            },
            "attributes": [],
            "span": {
              "start": 248,
              "end": 257,
              "start_line": 13,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 242,
        "end": 259,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_10",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "UnaryPrefix": {
                                  "op": "Negate",
                                  "operand": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 274,
                                      "end": 275,
                                      "start_line": 14,
                                      "start_col": 15
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 273,
                                "end": 275,
                                "start_line": 14,
                                "start_col": 14
                              }
                            },
                            "then_expr": null,
                            "else_expr": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 277,
                                "end": 278,
                                "start_line": 14,
                                "start_col": 18
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 273,
                          "end": 278,
                          "start_line": 14,
                          "start_col": 14
                        }
                      }
                    },
                    "span": {
                      "start": 272,
                      "end": 280,
                      "start_line": 14,
                      "start_col": 13
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 283,
                                "end": 284,
                                "start_line": 14,
                                "start_col": 24
                              }
                            },
                            "then_expr": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 285,
                                "end": 286,
                                "start_line": 14,
                                "start_col": 26
                              }
                            },
                            "else_expr": {
                              "kind": {
                                "Int": 3
                              },
                              "span": {
                                "start": 287,
                                "end": 288,
                                "start_line": 14,
                                "start_col": 28
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 283,
                          "end": 288,
                          "start_line": 14,
                          "start_col": 24
                        }
                      }
                    },
                    "span": {
                      "start": 282,
                      "end": 289,
                      "start_line": 14,
                      "start_col": 23
                    }
                  }
                }
              },
              "span": {
                "start": 272,
                "end": 289,
                "start_line": 14,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 265,
              "end": 289,
              "start_line": 14,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 259,
        "end": 291,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_11",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 304,
                      "end": 305,
                      "start_line": 15,
                      "start_col": 13
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 309,
                      "end": 310,
                      "start_line": 15,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 304,
                "end": 310,
                "start_line": 15,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 297,
              "end": 310,
              "start_line": 15,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 291,
        "end": 312,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_12",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 325,
                      "end": 326,
                      "start_line": 16,
                      "start_col": 13
                    }
                  },
                  "op": "LogicalAnd",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 331,
                      "end": 332,
                      "start_line": 16,
                      "start_col": 19
                    }
                  }
                }
              },
              "span": {
                "start": 325,
                "end": 332,
                "start_line": 16,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 318,
              "end": 332,
              "start_line": 16,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 312,
        "end": 334,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_13",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 347,
                      "end": 348,
                      "start_line": 17,
                      "start_col": 13
                    }
                  },
                  "op": "BooleanOr",
                  "right": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 352,
                      "end": 353,
                      "start_line": 17,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 347,
                "end": 353,
                "start_line": 17,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 340,
              "end": 353,
              "start_line": 17,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 334,
        "end": 355,
        "start_line": 17,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_14",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 368,
                      "end": 369,
                      "start_line": 18,
                      "start_col": 13
                    }
                  },
                  "op": "LogicalOr",
                  "right": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 373,
                      "end": 374,
                      "start_line": 18,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 368,
                "end": 374,
                "start_line": 18,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 361,
              "end": 374,
              "start_line": 18,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 355,
        "end": 376,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_15",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 389,
                      "end": 390,
                      "start_line": 19,
                      "start_col": 13
                    }
                  },
                  "op": "LogicalXor",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 395,
                      "end": 396,
                      "start_line": 19,
                      "start_col": 19
                    }
                  }
                }
              },
              "span": {
                "start": 389,
                "end": 396,
                "start_line": 19,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 382,
              "end": 396,
              "start_line": 19,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 376,
        "end": 398,
        "start_line": 19,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_16",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 411,
                      "end": 412,
                      "start_line": 20,
                      "start_col": 13
                    }
                  },
                  "op": "LogicalXor",
                  "right": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 417,
                      "end": 418,
                      "start_line": 20,
                      "start_col": 19
                    }
                  }
                }
              },
              "span": {
                "start": 411,
                "end": 418,
                "start_line": 20,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 404,
              "end": 418,
              "start_line": 20,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 398,
        "end": 420,
        "start_line": 20,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_17",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 433,
                      "end": 434,
                      "start_line": 21,
                      "start_col": 13
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 437,
                      "end": 438,
                      "start_line": 21,
                      "start_col": 17
                    }
                  }
                }
              },
              "span": {
                "start": 433,
                "end": 438,
                "start_line": 21,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 426,
              "end": 438,
              "start_line": 21,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 420,
        "end": 440,
        "start_line": 21,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_18",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 453,
                      "end": 454,
                      "start_line": 22,
                      "start_col": 13
                    }
                  },
                  "op": "LessOrEqual",
                  "right": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 458,
                      "end": 459,
                      "start_line": 22,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 453,
                "end": 459,
                "start_line": 22,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 446,
              "end": 459,
              "start_line": 22,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 440,
        "end": 461,
        "start_line": 22,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_19",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 474,
                      "end": 475,
                      "start_line": 23,
                      "start_col": 13
                    }
                  },
                  "op": "Greater",
                  "right": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 478,
                      "end": 479,
                      "start_line": 23,
                      "start_col": 17
                    }
                  }
                }
              },
              "span": {
                "start": 474,
                "end": 479,
                "start_line": 23,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 467,
              "end": 479,
              "start_line": 23,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 461,
        "end": 481,
        "start_line": 23,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_20",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 494,
                      "end": 495,
                      "start_line": 24,
                      "start_col": 13
                    }
                  },
                  "op": "GreaterOrEqual",
                  "right": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 499,
                      "end": 500,
                      "start_line": 24,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 494,
                "end": 500,
                "start_line": 24,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 487,
              "end": 500,
              "start_line": 24,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 481,
        "end": 502,
        "start_line": 24,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_21",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 515,
                      "end": 516,
                      "start_line": 25,
                      "start_col": 13
                    }
                  },
                  "op": "Identical",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 521,
                      "end": 522,
                      "start_line": 25,
                      "start_col": 19
                    }
                  }
                }
              },
              "span": {
                "start": 515,
                "end": 522,
                "start_line": 25,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 508,
              "end": 522,
              "start_line": 25,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 502,
        "end": 524,
        "start_line": 25,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_22",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 537,
                      "end": 538,
                      "start_line": 26,
                      "start_col": 13
                    }
                  },
                  "op": "NotIdentical",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 543,
                      "end": 544,
                      "start_line": 26,
                      "start_col": 19
                    }
                  }
                }
              },
              "span": {
                "start": 537,
                "end": 544,
                "start_line": 26,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 530,
              "end": 544,
              "start_line": 26,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 524,
        "end": 546,
        "start_line": 26,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_23",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 559,
                      "end": 560,
                      "start_line": 27,
                      "start_col": 13
                    }
                  },
                  "op": "NotEqual",
                  "right": {
                    "kind": {
                      "String": "0"
                    },
                    "span": {
                      "start": 564,
                      "end": 567,
                      "start_line": 27,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 559,
                "end": 567,
                "start_line": 27,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 552,
              "end": 567,
              "start_line": 27,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 546,
        "end": 569,
        "start_line": 27,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_24",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 582,
                      "end": 583,
                      "start_line": 28,
                      "start_col": 13
                    }
                  },
                  "op": "Equal",
                  "right": {
                    "kind": {
                      "String": "1"
                    },
                    "span": {
                      "start": 587,
                      "end": 590,
                      "start_line": 28,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 582,
                "end": 590,
                "start_line": 28,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 575,
              "end": 590,
              "start_line": 28,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 569,
        "end": 592,
        "start_line": 28,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_25",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 605,
                      "end": 606,
                      "start_line": 29,
                      "start_col": 13
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
                            "start": 609,
                            "end": 610,
                            "start_line": 29,
                            "start_col": 17
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 613,
                            "end": 614,
                            "start_line": 29,
                            "start_col": 21
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 609,
                      "end": 614,
                      "start_line": 29,
                      "start_col": 17
                    }
                  }
                }
              },
              "span": {
                "start": 605,
                "end": 614,
                "start_line": 29,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 598,
              "end": 614,
              "start_line": 29,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 592,
        "end": 616,
        "start_line": 29,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_26",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "1"
                          },
                          "span": {
                            "start": 629,
                            "end": 632,
                            "start_line": 30,
                            "start_col": 13
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 635,
                            "end": 636,
                            "start_line": 30,
                            "start_col": 19
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 629,
                      "end": 636,
                      "start_line": 30,
                      "start_col": 13
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "String": "3"
                    },
                    "span": {
                      "start": 639,
                      "end": 642,
                      "start_line": 30,
                      "start_col": 23
                    }
                  }
                }
              },
              "span": {
                "start": 629,
                "end": 642,
                "start_line": 30,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 622,
              "end": 642,
              "start_line": 30,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 616,
        "end": 644,
        "start_line": 30,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_27",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 657,
                      "end": 658,
                      "start_line": 31,
                      "start_col": 13
                    }
                  },
                  "op": "Pow",
                  "right": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 662,
                      "end": 663,
                      "start_line": 31,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 657,
                "end": 663,
                "start_line": 31,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 650,
              "end": 663,
              "start_line": 31,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 644,
        "end": 665,
        "start_line": 31,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_28",
            "value": {
              "kind": {
                "ArrayAccess": {
                  "array": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 679,
                              "end": 680,
                              "start_line": 32,
                              "start_col": 14
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 679,
                            "end": 680,
                            "start_line": 32,
                            "start_col": 14
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 682,
                              "end": 683,
                              "start_line": 32,
                              "start_col": 17
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 682,
                            "end": 683,
                            "start_line": 32,
                            "start_col": 17
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 685,
                              "end": 686,
                              "start_line": 32,
                              "start_col": 20
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 685,
                            "end": 686,
                            "start_line": 32,
                            "start_col": 20
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 678,
                      "end": 687,
                      "start_line": 32,
                      "start_col": 13
                    }
                  },
                  "index": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 688,
                      "end": 689,
                      "start_line": 32,
                      "start_col": 23
                    }
                  }
                }
              },
              "span": {
                "start": 678,
                "end": 690,
                "start_line": 32,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 671,
              "end": 690,
              "start_line": 32,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 665,
        "end": 692,
        "start_line": 32,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_29",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 12
                    },
                    "span": {
                      "start": 705,
                      "end": 707,
                      "start_line": 33,
                      "start_col": 13
                    }
                  },
                  "op": "Sub",
                  "right": {
                    "kind": {
                      "Int": 13
                    },
                    "span": {
                      "start": 710,
                      "end": 712,
                      "start_line": 33,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 705,
                "end": 712,
                "start_line": 33,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 698,
              "end": 712,
              "start_line": 33,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 692,
        "end": 714,
        "start_line": 33,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_30",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 12
                    },
                    "span": {
                      "start": 727,
                      "end": 729,
                      "start_line": 34,
                      "start_col": 13
                    }
                  },
                  "op": "BitwiseXor",
                  "right": {
                    "kind": {
                      "Int": 13
                    },
                    "span": {
                      "start": 732,
                      "end": 734,
                      "start_line": 34,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 727,
                "end": 734,
                "start_line": 34,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 720,
              "end": 734,
              "start_line": 34,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 714,
        "end": 736,
        "start_line": 34,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_31",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 12
                    },
                    "span": {
                      "start": 749,
                      "end": 751,
                      "start_line": 35,
                      "start_col": 13
                    }
                  },
                  "op": "BitwiseAnd",
                  "right": {
                    "kind": {
                      "Int": 13
                    },
                    "span": {
                      "start": 754,
                      "end": 756,
                      "start_line": 35,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 749,
                "end": 756,
                "start_line": 35,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 742,
              "end": 756,
              "start_line": 35,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 736,
        "end": 758,
        "start_line": 35,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_32",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 12
                    },
                    "span": {
                      "start": 771,
                      "end": 773,
                      "start_line": 36,
                      "start_col": 13
                    }
                  },
                  "op": "BitwiseOr",
                  "right": {
                    "kind": {
                      "Int": 13
                    },
                    "span": {
                      "start": 776,
                      "end": 778,
                      "start_line": 36,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 771,
                "end": 778,
                "start_line": 36,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 764,
              "end": 778,
              "start_line": 36,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 758,
        "end": 780,
        "start_line": 36,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_33",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 12
                    },
                    "span": {
                      "start": 793,
                      "end": 795,
                      "start_line": 37,
                      "start_col": 13
                    }
                  },
                  "op": "Mod",
                  "right": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 798,
                      "end": 799,
                      "start_line": 37,
                      "start_col": 18
                    }
                  }
                }
              },
              "span": {
                "start": 793,
                "end": 799,
                "start_line": 37,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 786,
              "end": 799,
              "start_line": 37,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 780,
        "end": 801,
        "start_line": 37,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_34",
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 100
                    },
                    "span": {
                      "start": 814,
                      "end": 817,
                      "start_line": 38,
                      "start_col": 13
                    }
                  },
                  "op": "ShiftRight",
                  "right": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 821,
                      "end": 822,
                      "start_line": 38,
                      "start_col": 20
                    }
                  }
                }
              },
              "span": {
                "start": 814,
                "end": 822,
                "start_line": 38,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 807,
              "end": 822,
              "start_line": 38,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 801,
        "end": 824,
        "start_line": 38,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "T_35",
            "value": {
              "kind": {
                "UnaryPrefix": {
                  "op": "BooleanNot",
                  "operand": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 838,
                      "end": 843,
                      "start_line": 39,
                      "start_col": 14
                    }
                  }
                }
              },
              "span": {
                "start": 837,
                "end": 843,
                "start_line": 39,
                "start_col": 13
              }
            },
            "attributes": [],
            "span": {
              "start": 830,
              "end": 843,
              "start_line": 39,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 824,
        "end": 844,
        "start_line": 39,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 844,
    "start_line": 1,
    "start_col": 0
  }
}
