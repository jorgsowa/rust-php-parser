===source===
<?php
7 <=> 1.5 or ~null;
1 < 2 || isset(1+1);
"a" == "b" && isset(1+1);
4 >= 5 and 1 ? 2 : 3 ? 4 : 5;
M_PI or isset(1+1);
1 instanceof Foo and isset(1+1);
empty("") or isset(1+1);
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
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 187,
              "end": 188
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
              "start": 197,
              "end": 198
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
                      "start": 214,
                      "end": 215
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
                                            "start": 228,
                                            "end": 232
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 228,
                                        "end": 232
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "class"
                                      },
                                      "span": {
                                        "start": 234,
                                        "end": 239
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 228,
                                  "end": 239
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
                                              "start": 249,
                                              "end": 250
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 251,
                                              "end": 252
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 249,
                                        "end": 252
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 243,
                                  "end": 253
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 228,
                            "end": 253
                          }
                        }
                      },
                      "span": {
                        "start": 228,
                        "end": 254
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
                                            "start": 263,
                                            "end": 269
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 263,
                                        "end": 269
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "class"
                                      },
                                      "span": {
                                        "start": 271,
                                        "end": 276
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 263,
                                  "end": 276
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
                                              "start": 286,
                                              "end": 287
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 288,
                                              "end": 289
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 286,
                                        "end": 289
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 280,
                                  "end": 290
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 263,
                            "end": 290
                          }
                        }
                      },
                      "span": {
                        "start": 263,
                        "end": 291
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 205,
                "end": 297
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 181,
        "end": 299
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 299
  }
}
