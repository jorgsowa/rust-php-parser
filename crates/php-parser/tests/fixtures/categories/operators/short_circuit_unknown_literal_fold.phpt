===source===
<?php
7 <=> 1.5 or ~null;
1 < 2 || isset(1+1);
"a" == "b" && isset(1+1);
4 >= 5 and 1 ? 2 : 3 ? 4 : 5;
M_PI or isset(1+1);
1 instanceof Foo and isset(1+1);
empty("") or isset(1+1);
@1 or isset(1+1);
+print $a or isset(1+1);
6 instanceof Foo <> 3 or isset(1+1);
0 != 9 or $a or isset(1+1);
class C extends D {
    function f() {
        self::class or isset(1+1);
        parent::class or isset(1+1);
    }
}
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 7
                      },
                      "span": {
                        "start": 6,
                        "end": 7
                      }
                    },
                    "op": "Spaceship",
                    "right": {
                      "kind": {
                        "Float": 1.5
                      },
                      "span": {
                        "start": 12,
                        "end": 15
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BitwiseNot",
                    "operand": {
                      "kind": "Null",
                      "span": {
                        "start": 20,
                        "end": 24
                      }
                    }
                  }
                },
                "span": {
                  "start": 19,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
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
                        "Int": 1
                      },
                      "span": {
                        "start": 26,
                        "end": 27
                      }
                    },
                    "op": "Less",
                    "right": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 30,
                        "end": 31
                      }
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 31
                }
              },
              "op": "BooleanOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 41,
                              "end": 42
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 43,
                              "end": 44
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 44
                      }
                    }
                  ]
                },
                "span": {
                  "start": 35,
                  "end": 45
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 45
          }
        }
      },
      "span": {
        "start": 26,
        "end": 46
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
                        "String": "a"
                      },
                      "span": {
                        "start": 47,
                        "end": 50
                      }
                    },
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 54,
                        "end": 57
                      }
                    }
                  }
                },
                "span": {
                  "start": 47,
                  "end": 57
                }
              },
              "op": "BooleanAnd",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 67,
                              "end": 68
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 69,
                              "end": 70
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 67,
                        "end": 70
                      }
                    }
                  ]
                },
                "span": {
                  "start": 61,
                  "end": 71
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 71
          }
        }
      },
      "span": {
        "start": 47,
        "end": 72
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
                        "Int": 4
                      },
                      "span": {
                        "start": 73,
                        "end": 74
                      }
                    },
                    "op": "GreaterOrEqual",
                    "right": {
                      "kind": {
                        "Int": 5
                      },
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    }
                  }
                },
                "span": {
                  "start": 73,
                  "end": 79
                }
              },
              "op": "LogicalAnd",
              "right": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Ternary": {
                          "condition": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 84,
                              "end": 85
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 88,
                              "end": 89
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 92,
                              "end": 93
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 84,
                        "end": 93
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 96,
                        "end": 97
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 5
                      },
                      "span": {
                        "start": 100,
                        "end": 101
                      }
                    }
                  }
                },
                "span": {
                  "start": 84,
                  "end": 101
                }
              }
            }
          },
          "span": {
            "start": 73,
            "end": 101
          }
        }
      },
      "span": {
        "start": 73,
        "end": 102
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Name": {
                    "parts": [
                      "M_PI"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 103,
                      "end": 107
                    }
                  }
                },
                "span": {
                  "start": 103,
                  "end": 107
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 117,
                              "end": 118
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 119,
                              "end": 120
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 117,
                        "end": 120
                      }
                    }
                  ]
                },
                "span": {
                  "start": 111,
                  "end": 121
                }
              }
            }
          },
          "span": {
            "start": 103,
            "end": 121
          }
        }
      },
      "span": {
        "start": 103,
        "end": 122
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
                        "Int": 1
                      },
                      "span": {
                        "start": 123,
                        "end": 124
                      }
                    },
                    "op": "Instanceof",
                    "right": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 136,
                            "end": 139
                          }
                        }
                      },
                      "span": {
                        "start": 136,
                        "end": 139
                      }
                    }
                  }
                },
                "span": {
                  "start": 123,
                  "end": 139
                }
              },
              "op": "LogicalAnd",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 150,
                              "end": 151
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 152,
                              "end": 153
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 150,
                        "end": 153
                      }
                    }
                  ]
                },
                "span": {
                  "start": 144,
                  "end": 154
                }
              }
            }
          },
          "span": {
            "start": 123,
            "end": 154
          }
        }
      },
      "span": {
        "start": 123,
        "end": 155
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Empty": {
                    "kind": {
                      "String": ""
                    },
                    "span": {
                      "start": 162,
                      "end": 164
                    }
                  }
                },
                "span": {
                  "start": 156,
                  "end": 165
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 175,
                              "end": 176
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 177,
                              "end": 178
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 175,
                        "end": 178
                      }
                    }
                  ]
                },
                "span": {
                  "start": 169,
                  "end": 179
                }
              }
            }
          },
          "span": {
            "start": 156,
            "end": 179
          }
        }
      },
      "span": {
        "start": 156,
        "end": 180
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "ErrorSuppress": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 182,
                      "end": 183
                    }
                  }
                },
                "span": {
                  "start": 181,
                  "end": 183
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 193,
                              "end": 194
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 195,
                              "end": 196
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 193,
                        "end": 196
                      }
                    }
                  ]
                },
                "span": {
                  "start": 187,
                  "end": 197
                }
              }
            }
          },
          "span": {
            "start": 181,
            "end": 197
          }
        }
      },
      "span": {
        "start": 181,
        "end": 198
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Plus",
                    "operand": {
                      "kind": {
                        "Print": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 206,
                            "end": 208
                          }
                        }
                      },
                      "span": {
                        "start": 200,
                        "end": 208
                      }
                    }
                  }
                },
                "span": {
                  "start": 199,
                  "end": 208
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 218,
                              "end": 219
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 220,
                              "end": 221
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 218,
                        "end": 221
                      }
                    }
                  ]
                },
                "span": {
                  "start": 212,
                  "end": 222
                }
              }
            }
          },
          "span": {
            "start": 199,
            "end": 222
          }
        }
      },
      "span": {
        "start": 199,
        "end": 223
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
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 6
                            },
                            "span": {
                              "start": 224,
                              "end": 225
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 237,
                                  "end": 240
                                }
                              }
                            },
                            "span": {
                              "start": 237,
                              "end": 240
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 224,
                        "end": 240
                      }
                    },
                    "op": "NotEqual",
                    "right": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 244,
                        "end": 245
                      }
                    }
                  }
                },
                "span": {
                  "start": 224,
                  "end": 245
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 255,
                              "end": 256
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 257,
                              "end": 258
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 255,
                        "end": 258
                      }
                    }
                  ]
                },
                "span": {
                  "start": 249,
                  "end": 259
                }
              }
            }
          },
          "span": {
            "start": 224,
            "end": 259
          }
        }
      },
      "span": {
        "start": 224,
        "end": 260
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
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 261,
                              "end": 262
                            }
                          },
                          "op": "NotEqual",
                          "right": {
                            "kind": {
                              "Int": 9
                            },
                            "span": {
                              "start": 266,
                              "end": 267
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 261,
                        "end": 267
                      }
                    },
                    "op": "LogicalOr",
                    "right": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 271,
                        "end": 273
                      }
                    }
                  }
                },
                "span": {
                  "start": 261,
                  "end": 273
                }
              },
              "op": "LogicalOr",
              "right": {
                "kind": {
                  "Isset": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 283,
                              "end": 284
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 285,
                              "end": 286
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 283,
                        "end": 286
                      }
                    }
                  ]
                },
                "span": {
                  "start": 277,
                  "end": 287
                }
              }
            }
          },
          "span": {
            "start": 261,
            "end": 287
          }
        }
      },
      "span": {
        "start": 261,
        "end": 288
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 295,
              "end": 296
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "D"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 305,
              "end": 306
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 322,
                      "end": 323
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "ClassConstAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "self"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 336,
                                            "end": 340
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 336,
                                        "end": 340
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "class"
                                      },
                                      "span": {
                                        "start": 342,
                                        "end": 347
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 336,
                                  "end": 347
                                }
                              },
                              "op": "LogicalOr",
                              "right": {
                                "kind": {
                                  "Isset": [
                                    {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 357,
                                              "end": 358
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 359,
                                              "end": 360
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 357,
                                        "end": 360
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 351,
                                  "end": 361
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 336,
                            "end": 361
                          }
                        }
                      },
                      "span": {
                        "start": 336,
                        "end": 362
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "ClassConstAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 371,
                                            "end": 377
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 371,
                                        "end": 377
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "class"
                                      },
                                      "span": {
                                        "start": 379,
                                        "end": 384
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 371,
                                  "end": 384
                                }
                              },
                              "op": "LogicalOr",
                              "right": {
                                "kind": {
                                  "Isset": [
                                    {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 394,
                                              "end": 395
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 396,
                                              "end": 397
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 394,
                                        "end": 397
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 388,
                                  "end": 398
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 371,
                            "end": 398
                          }
                        }
                      },
                      "span": {
                        "start": 371,
                        "end": 399
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 313,
                "end": 405
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 289,
        "end": 407
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 407
  }
}
