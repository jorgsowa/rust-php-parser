===source===
<?php
// simple assign
$a = $b;

// combined assign
$a &= $b;
$a |= $b;
$a ^= $b;
$a .= $b;
$a /= $b;
$a -= $b;
$a %= $b;
$a *= $b;
$a += $b;
$a <<= $b;
$a >>= $b;
$a **= $b;
$a ??= $b;

// chained assign
$a = $b *= $c **= $d;

// by ref assign
$a =& $b;

// list() assign
list($a) = $b;
list($a, , $b) = $c;
list($a, list(, $c), $d) = $e;

// inc/dec
++$a;
$a++;
--$a;
$a--;
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
                  "start": 23,
                  "end": 25,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 28,
                  "end": 30,
                  "start_line": 3,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 30,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 23,
        "end": 52,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 52,
                  "end": 54,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "BitwiseAnd",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 58,
                  "end": 60,
                  "start_line": 6,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 60,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 52,
        "end": 62,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 62,
                  "end": 64,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "BitwiseOr",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 68,
                  "end": 70,
                  "start_line": 7,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 62,
            "end": 70,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 62,
        "end": 72,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 72,
                  "end": 74,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "op": "BitwiseXor",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 78,
                  "end": 80,
                  "start_line": 8,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 72,
            "end": 80,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 72,
        "end": 82,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 82,
                  "end": 84,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 88,
                  "end": 90,
                  "start_line": 9,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 82,
            "end": 90,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 82,
        "end": 92,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 92,
                  "end": 94,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "op": "Div",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 98,
                  "end": 100,
                  "start_line": 10,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 92,
            "end": 100,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 92,
        "end": 102,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 102,
                  "end": 104,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "op": "Minus",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 108,
                  "end": 110,
                  "start_line": 11,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 102,
            "end": 110,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 102,
        "end": 112,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 112,
                  "end": 114,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "op": "Mod",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 118,
                  "end": 120,
                  "start_line": 12,
                  "start_col": 6
                }
              }
            }
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
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 122,
                  "end": 124,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "op": "Mul",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 128,
                  "end": 130,
                  "start_line": 13,
                  "start_col": 6
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
                  "Variable": "a"
                },
                "span": {
                  "start": 132,
                  "end": 134,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 138,
                  "end": 140,
                  "start_line": 14,
                  "start_col": 6
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
                  "Variable": "a"
                },
                "span": {
                  "start": 142,
                  "end": 144,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "op": "ShiftLeft",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 149,
                  "end": 151,
                  "start_line": 15,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 142,
            "end": 151,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 142,
        "end": 153,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 153,
                  "end": 155,
                  "start_line": 16,
                  "start_col": 0
                }
              },
              "op": "ShiftRight",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 160,
                  "end": 162,
                  "start_line": 16,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 153,
            "end": 162,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 153,
        "end": 164,
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
                  "start": 164,
                  "end": 166,
                  "start_line": 17,
                  "start_col": 0
                }
              },
              "op": "Pow",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 171,
                  "end": 173,
                  "start_line": 17,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 164,
            "end": 173,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 164,
        "end": 175,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 175,
                  "end": 177,
                  "start_line": 18,
                  "start_col": 0
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 182,
                  "end": 184,
                  "start_line": 18,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 175,
            "end": 184,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 175,
        "end": 205,
        "start_line": 18,
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
                  "start": 205,
                  "end": 207,
                  "start_line": 21,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 210,
                        "end": 212,
                        "start_line": 21,
                        "start_col": 5
                      }
                    },
                    "op": "Mul",
                    "value": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 216,
                              "end": 218,
                              "start_line": 21,
                              "start_col": 11
                            }
                          },
                          "op": "Pow",
                          "value": {
                            "kind": {
                              "Variable": "d"
                            },
                            "span": {
                              "start": 223,
                              "end": 225,
                              "start_line": 21,
                              "start_col": 18
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 216,
                        "end": 225,
                        "start_line": 21,
                        "start_col": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 210,
                  "end": 225,
                  "start_line": 21,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 205,
            "end": 225,
            "start_line": 21,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 205,
        "end": 245,
        "start_line": 21,
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
                  "start": 245,
                  "end": 247,
                  "start_line": 24,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 251,
                  "end": 253,
                  "start_line": 24,
                  "start_col": 6
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 245,
            "end": 253,
            "start_line": 24,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 245,
        "end": 273,
        "start_line": 24,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 278,
                          "end": 280,
                          "start_line": 27,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 278,
                        "end": 280,
                        "start_line": 27,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 273,
                  "end": 281,
                  "start_line": 27,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 284,
                  "end": 286,
                  "start_line": 27,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 273,
            "end": 286,
            "start_line": 27,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 273,
        "end": 288,
        "start_line": 27,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 293,
                          "end": 295,
                          "start_line": 28,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 293,
                        "end": 295,
                        "start_line": 28,
                        "start_col": 5
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 297,
                          "end": 298,
                          "start_line": 28,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 297,
                        "end": 298,
                        "start_line": 28,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 299,
                          "end": 301,
                          "start_line": 28,
                          "start_col": 11
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 299,
                        "end": 301,
                        "start_line": 28,
                        "start_col": 11
                      }
                    }
                  ]
                },
                "span": {
                  "start": 288,
                  "end": 302,
                  "start_line": 28,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 305,
                  "end": 307,
                  "start_line": 28,
                  "start_col": 17
                }
              }
            }
          },
          "span": {
            "start": 288,
            "end": 307,
            "start_line": 28,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 288,
        "end": 309,
        "start_line": 28,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 314,
                          "end": 316,
                          "start_line": 29,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 314,
                        "end": 316,
                        "start_line": 29,
                        "start_col": 5
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": "Omit",
                                "span": {
                                  "start": 323,
                                  "end": 324,
                                  "start_line": 29,
                                  "start_col": 14
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 323,
                                "end": 324,
                                "start_line": 29,
                                "start_col": 14
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 325,
                                  "end": 327,
                                  "start_line": 29,
                                  "start_col": 16
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 325,
                                "end": 327,
                                "start_line": 29,
                                "start_col": 16
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 318,
                          "end": 328,
                          "start_line": 29,
                          "start_col": 9
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 318,
                        "end": 328,
                        "start_line": 29,
                        "start_col": 9
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "d"
                        },
                        "span": {
                          "start": 330,
                          "end": 332,
                          "start_line": 29,
                          "start_col": 21
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 330,
                        "end": 332,
                        "start_line": 29,
                        "start_col": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 309,
                  "end": 333,
                  "start_line": 29,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 336,
                  "end": 338,
                  "start_line": 29,
                  "start_col": 27
                }
              }
            }
          },
          "span": {
            "start": 309,
            "end": 338,
            "start_line": 29,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 309,
        "end": 352,
        "start_line": 29,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 354,
                  "end": 356,
                  "start_line": 32,
                  "start_col": 2
                }
              }
            }
          },
          "span": {
            "start": 352,
            "end": 356,
            "start_line": 32,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 352,
        "end": 358,
        "start_line": 32,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 358,
                  "end": 360,
                  "start_line": 33,
                  "start_col": 0
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 358,
            "end": 362,
            "start_line": 33,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 358,
        "end": 364,
        "start_line": 33,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreDecrement",
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 366,
                  "end": 368,
                  "start_line": 34,
                  "start_col": 2
                }
              }
            }
          },
          "span": {
            "start": 364,
            "end": 368,
            "start_line": 34,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 364,
        "end": 370,
        "start_line": 34,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 370,
                  "end": 372,
                  "start_line": 35,
                  "start_col": 0
                }
              },
              "op": "PostDecrement"
            }
          },
          "span": {
            "start": 370,
            "end": 374,
            "start_line": 35,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 370,
        "end": 375,
        "start_line": 35,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 375,
    "start_line": 1,
    "start_col": 0
  }
}
