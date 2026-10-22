===source===
<?php
!1 && isset(1+1);
A::class || isset(1+1);
false && $a && isset(1+1);
true || $a || isset(1+1);
[] && isset(1+1);
[1] || isset(1+1);
!A::class && isset(1+1);
(false and $a) and isset(1+1);
[...[]] && isset(1+1);
!!0 && isset(1+1);
\A::class || isset(1+1);
namespace\A::class || isset(1+1);
const A = !1 && $a;
const B = A::class || $a;
const C = !0 ? 1 : $a;
const D = (false && $a) && $b;
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
                  "UnaryPrefix": {
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 7,
                        "end": 8
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 8
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
                              "start": 18,
                              "end": 19
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 20,
                              "end": 21
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 21
                      }
                    }
                  ]
                },
                "span": {
                  "start": 12,
                  "end": 22
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 22
          }
        }
      },
      "span": {
        "start": 6,
        "end": 23
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
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 24,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 27,
                        "end": 32
                      }
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 32
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
                              "start": 42,
                              "end": 43
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 44,
                              "end": 45
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 42,
                        "end": 45
                      }
                    }
                  ]
                },
                "span": {
                  "start": 36,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 46
          }
        }
      },
      "span": {
        "start": 24,
        "end": 47
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
                        "Bool": false
                      },
                      "span": {
                        "start": 48,
                        "end": 53
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 57,
                        "end": 59
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 59
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
                              "start": 69,
                              "end": 70
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 71,
                              "end": 72
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 72
                      }
                    }
                  ]
                },
                "span": {
                  "start": 63,
                  "end": 73
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 73
          }
        }
      },
      "span": {
        "start": 48,
        "end": 74
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
                        "Bool": true
                      },
                      "span": {
                        "start": 75,
                        "end": 79
                      }
                    },
                    "op": "BooleanOr",
                    "right": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 83,
                        "end": 85
                      }
                    }
                  }
                },
                "span": {
                  "start": 75,
                  "end": 85
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
                              "start": 95,
                              "end": 96
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 97,
                              "end": 98
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 98
                      }
                    }
                  ]
                },
                "span": {
                  "start": 89,
                  "end": 99
                }
              }
            }
          },
          "span": {
            "start": 75,
            "end": 99
          }
        }
      },
      "span": {
        "start": 75,
        "end": 100
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 101,
                  "end": 103
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
                              "start": 113,
                              "end": 114
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 115,
                              "end": 116
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 113,
                        "end": 116
                      }
                    }
                  ]
                },
                "span": {
                  "start": 107,
                  "end": 117
                }
              }
            }
          },
          "span": {
            "start": 101,
            "end": 117
          }
        }
      },
      "span": {
        "start": 101,
        "end": 118
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 120,
                            "end": 121
                          }
                        }
                      },
                      "span": {
                        "start": 120,
                        "end": 121
                      }
                    }
                  ]
                },
                "span": {
                  "start": 119,
                  "end": 122
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
                              "start": 132,
                              "end": 133
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 134,
                              "end": 135
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 132,
                        "end": 135
                      }
                    }
                  ]
                },
                "span": {
                  "start": 126,
                  "end": 136
                }
              }
            }
          },
          "span": {
            "start": 119,
            "end": 136
          }
        }
      },
      "span": {
        "start": 119,
        "end": 137
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
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 139,
                                  "end": 140
                                }
                              }
                            },
                            "span": {
                              "start": 139,
                              "end": 140
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 142,
                              "end": 147
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 139,
                        "end": 147
                      }
                    }
                  }
                },
                "span": {
                  "start": 138,
                  "end": 147
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
                              "start": 157,
                              "end": 158
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 159,
                              "end": 160
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 157,
                        "end": 160
                      }
                    }
                  ]
                },
                "span": {
                  "start": 151,
                  "end": 161
                }
              }
            }
          },
          "span": {
            "start": 138,
            "end": 161
          }
        }
      },
      "span": {
        "start": 138,
        "end": 162
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
                            "Bool": false
                          },
                          "span": {
                            "start": 164,
                            "end": 169
                          }
                        },
                        "op": "LogicalAnd",
                        "right": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 174,
                            "end": 176
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 164,
                      "end": 176
                    }
                  }
                },
                "span": {
                  "start": 163,
                  "end": 177
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
                              "start": 188,
                              "end": 189
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 190,
                              "end": 191
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 188,
                        "end": 191
                      }
                    }
                  ]
                },
                "span": {
                  "start": 182,
                  "end": 192
                }
              }
            }
          },
          "span": {
            "start": 163,
            "end": 192
          }
        }
      },
      "span": {
        "start": 163,
        "end": 193
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 198,
                            "end": 200
                          }
                        }
                      },
                      "span": {
                        "start": 195,
                        "end": 200
                      }
                    }
                  ]
                },
                "span": {
                  "start": 194,
                  "end": 201
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
                              "start": 211,
                              "end": 212
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 213,
                              "end": 214
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 211,
                        "end": 214
                      }
                    }
                  ]
                },
                "span": {
                  "start": 205,
                  "end": 215
                }
              }
            }
          },
          "span": {
            "start": 194,
            "end": 215
          }
        }
      },
      "span": {
        "start": 194,
        "end": 216
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
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "BooleanNot",
                          "operand": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 219,
                              "end": 220
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 218,
                        "end": 220
                      }
                    }
                  }
                },
                "span": {
                  "start": 217,
                  "end": 220
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
                              "start": 230,
                              "end": 231
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 232,
                              "end": 233
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 230,
                        "end": 233
                      }
                    }
                  ]
                },
                "span": {
                  "start": 224,
                  "end": 234
                }
              }
            }
          },
          "span": {
            "start": 217,
            "end": 234
          }
        }
      },
      "span": {
        "start": 217,
        "end": 235
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
                            "A"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 236,
                            "end": 238
                          }
                        }
                      },
                      "span": {
                        "start": 236,
                        "end": 238
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 240,
                        "end": 245
                      }
                    }
                  }
                },
                "span": {
                  "start": 236,
                  "end": 245
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
            "start": 236,
            "end": 259
          }
        }
      },
      "span": {
        "start": 236,
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
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Relative",
                          "span": {
                            "start": 261,
                            "end": 272
                          }
                        }
                      },
                      "span": {
                        "start": 261,
                        "end": 272
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 274,
                        "end": 279
                      }
                    }
                  }
                },
                "span": {
                  "start": 261,
                  "end": 279
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
                              "start": 289,
                              "end": 290
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 291,
                              "end": 292
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 289,
                        "end": 292
                      }
                    }
                  ]
                },
                "span": {
                  "start": 283,
                  "end": 293
                }
              }
            }
          },
          "span": {
            "start": 261,
            "end": 293
          }
        }
      },
      "span": {
        "start": 261,
        "end": 294
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 301,
                "end": 302
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "BooleanNot",
                        "operand": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 306,
                            "end": 307
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 305,
                      "end": 307
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 311,
                      "end": 313
                    }
                  }
                }
              },
              "span": {
                "start": 305,
                "end": 313
              }
            },
            "attributes": [],
            "span": {
              "start": 301,
              "end": 313
            }
          }
        ]
      },
      "span": {
        "start": 295,
        "end": 314
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 321,
                "end": 322
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 325,
                                "end": 326
                              }
                            }
                          },
                          "span": {
                            "start": 325,
                            "end": 326
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 328,
                            "end": 333
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 325,
                      "end": 333
                    }
                  },
                  "op": "BooleanOr",
                  "right": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 337,
                      "end": 339
                    }
                  }
                }
              },
              "span": {
                "start": 325,
                "end": 339
              }
            },
            "attributes": [],
            "span": {
              "start": 321,
              "end": 339
            }
          }
        ]
      },
      "span": {
        "start": 315,
        "end": 340
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 347,
                "end": 348
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "BooleanNot",
                        "operand": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 352,
                            "end": 353
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 351,
                      "end": 353
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 356,
                      "end": 357
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 360,
                      "end": 362
                    }
                  }
                }
              },
              "span": {
                "start": 351,
                "end": 362
              }
            },
            "attributes": [],
            "span": {
              "start": 347,
              "end": 362
            }
          }
        ]
      },
      "span": {
        "start": 341,
        "end": 363
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 370,
                "end": 371
              }
            },
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
                                "Bool": false
                              },
                              "span": {
                                "start": 375,
                                "end": 380
                              }
                            },
                            "op": "BooleanAnd",
                            "right": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 384,
                                "end": 386
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 375,
                          "end": 386
                        }
                      }
                    },
                    "span": {
                      "start": 374,
                      "end": 387
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 391,
                      "end": 393
                    }
                  }
                }
              },
              "span": {
                "start": 374,
                "end": 393
              }
            },
            "attributes": [],
            "span": {
              "start": 370,
              "end": 393
            }
          }
        ]
      },
      "span": {
        "start": 364,
        "end": 394
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 394
  }
}
