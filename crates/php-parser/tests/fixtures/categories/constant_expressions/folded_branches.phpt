===source===
<?php
const A = true ? 1 : $x;
const B = false && $x;
const C = true || f();
const D = 1 ?: $x;
const E = 1 ?? $x;
const F = false and $x;
const G = (true ? 1 : 2) ?: $x;
const H = __LINE__ ? 1 : $x;
const I = PHP_EOL ? 1 : $x;
const J = "0" ? $x : 1;
const K = 0.0 ? $x : 1;
const L = !true && $x;
class C {
    const X = 1;
    const Y = self::X ? 1 : $x;
    const Z = true ? 1 : new Foo;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 23,
                      "end": 24
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 29
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 29
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 30
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 37,
                "end": 38
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 41,
                      "end": 46
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 50,
                      "end": 52
                    }
                  }
                }
              },
              "span": {
                "start": 41,
                "end": 52
              }
            },
            "attributes": [],
            "span": {
              "start": 37,
              "end": 52
            }
          }
        ]
      },
      "span": {
        "start": 31,
        "end": 53
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 60,
                "end": 61
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 64,
                      "end": 68
                    }
                  },
                  "op": "BooleanOr",
                  "right": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 72,
                                "end": 73
                              }
                            }
                          },
                          "span": {
                            "start": 72,
                            "end": 73
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 72,
                      "end": 75
                    }
                  }
                }
              },
              "span": {
                "start": 64,
                "end": 75
              }
            },
            "attributes": [],
            "span": {
              "start": 60,
              "end": 75
            }
          }
        ]
      },
      "span": {
        "start": 54,
        "end": 76
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 83,
                "end": 84
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 87,
                      "end": 88
                    }
                  },
                  "then_expr": null,
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 92,
                      "end": 94
                    }
                  }
                }
              },
              "span": {
                "start": 87,
                "end": 94
              }
            },
            "attributes": [],
            "span": {
              "start": 83,
              "end": 94
            }
          }
        ]
      },
      "span": {
        "start": 77,
        "end": 95
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
              "span": {
                "start": 102,
                "end": 103
              }
            },
            "value": {
              "kind": {
                "NullCoalesce": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 106,
                      "end": 107
                    }
                  },
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 111,
                      "end": 113
                    }
                  }
                }
              },
              "span": {
                "start": 106,
                "end": 113
              }
            },
            "attributes": [],
            "span": {
              "start": 102,
              "end": 113
            }
          }
        ]
      },
      "span": {
        "start": 96,
        "end": 114
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "F",
              "span": {
                "start": 121,
                "end": 122
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 125,
                      "end": 130
                    }
                  },
                  "op": "LogicalAnd",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 135,
                      "end": 137
                    }
                  }
                }
              },
              "span": {
                "start": 125,
                "end": 137
              }
            },
            "attributes": [],
            "span": {
              "start": 121,
              "end": 137
            }
          }
        ]
      },
      "span": {
        "start": 115,
        "end": 138
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "G",
              "span": {
                "start": 145,
                "end": 146
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "Bool": true
                              },
                              "span": {
                                "start": 150,
                                "end": 154
                              }
                            },
                            "then_expr": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 157,
                                "end": 158
                              }
                            },
                            "else_expr": {
                              "kind": {
                                "Int": 2
                              },
                              "span": {
                                "start": 161,
                                "end": 162
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 150,
                          "end": 162
                        }
                      }
                    },
                    "span": {
                      "start": 149,
                      "end": 163
                    }
                  },
                  "then_expr": null,
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 167,
                      "end": 169
                    }
                  }
                }
              },
              "span": {
                "start": 149,
                "end": 169
              }
            },
            "attributes": [],
            "span": {
              "start": 145,
              "end": 169
            }
          }
        ]
      },
      "span": {
        "start": 139,
        "end": 170
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "H",
              "span": {
                "start": 177,
                "end": 178
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "MagicConst": "Line"
                    },
                    "span": {
                      "start": 181,
                      "end": 189
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 192,
                      "end": 193
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 196,
                      "end": 198
                    }
                  }
                }
              },
              "span": {
                "start": 181,
                "end": 198
              }
            },
            "attributes": [],
            "span": {
              "start": 177,
              "end": 198
            }
          }
        ]
      },
      "span": {
        "start": 171,
        "end": 199
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "I",
              "span": {
                "start": 206,
                "end": 207
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "PHP_EOL"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 210,
                          "end": 217
                        }
                      }
                    },
                    "span": {
                      "start": 210,
                      "end": 217
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 220,
                      "end": 221
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 224,
                      "end": 226
                    }
                  }
                }
              },
              "span": {
                "start": 210,
                "end": 226
              }
            },
            "attributes": [],
            "span": {
              "start": 206,
              "end": 226
            }
          }
        ]
      },
      "span": {
        "start": 200,
        "end": 227
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "J",
              "span": {
                "start": 234,
                "end": 235
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "String": "0"
                    },
                    "span": {
                      "start": 238,
                      "end": 241
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 244,
                      "end": 246
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 249,
                      "end": 250
                    }
                  }
                }
              },
              "span": {
                "start": 238,
                "end": 250
              }
            },
            "attributes": [],
            "span": {
              "start": 234,
              "end": 250
            }
          }
        ]
      },
      "span": {
        "start": 228,
        "end": 251
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "K",
              "span": {
                "start": 258,
                "end": 259
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Float": 0.0
                    },
                    "span": {
                      "start": 262,
                      "end": 265
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 268,
                      "end": 270
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 273,
                      "end": 274
                    }
                  }
                }
              },
              "span": {
                "start": 262,
                "end": 274
              }
            },
            "attributes": [],
            "span": {
              "start": 258,
              "end": 274
            }
          }
        ]
      },
      "span": {
        "start": 252,
        "end": 275
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "L",
              "span": {
                "start": 282,
                "end": 283
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
                            "Bool": true
                          },
                          "span": {
                            "start": 287,
                            "end": 291
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 286,
                      "end": 291
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 295,
                      "end": 297
                    }
                  }
                }
              },
              "span": {
                "start": 286,
                "end": 297
              }
            },
            "attributes": [],
            "span": {
              "start": 282,
              "end": 297
            }
          }
        ]
      },
      "span": {
        "start": 276,
        "end": 298
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 305,
              "end": 306
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 319,
                      "end": 320
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 323,
                      "end": 324
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 313,
                "end": 325
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 336,
                      "end": 337
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Ternary": {
                        "condition": {
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
                                      "start": 340,
                                      "end": 344
                                    }
                                  }
                                },
                                "span": {
                                  "start": 340,
                                  "end": 344
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "X"
                                },
                                "span": {
                                  "start": 346,
                                  "end": 347
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 340,
                            "end": 347
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 350,
                            "end": 351
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 354,
                            "end": 356
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 340,
                      "end": 356
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 330,
                "end": 357
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Z",
                    "span": {
                      "start": 368,
                      "end": 369
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "Bool": true
                          },
                          "span": {
                            "start": 372,
                            "end": 376
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 379,
                            "end": 380
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "Foo"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 387,
                                      "end": 390
                                    }
                                  }
                                },
                                "span": {
                                  "start": 387,
                                  "end": 390
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 383,
                            "end": 390
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 372,
                      "end": 390
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 362,
                "end": 391
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 299,
        "end": 393
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 393
  }
}
