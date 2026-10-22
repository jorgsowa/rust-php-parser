===source===
<?php
new (-'A');
('a' * 1)::foo();
$x instanceof (~[]);
(1 << -1)::foo();
([] + 1)::foo();
(~null)::foo();
(~1.5)::foo();
('1a' + 1)::foo();
(~'a')::foo();
('a' | 1)::foo();
('a' | 'b')::foo();
(0 ** -1)::foo();
('0x1A' * 1)::foo();
('inf' * 1)::foo();
===php_error <=8.0===
PHP Fatal error:  Illegal class name in Standard input code on line 8
===php_error 8.1-8.3===
PHP Fatal error:  Illegal class name in Standard input code on line 13
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "String": "A"
                          },
                          "span": {
                            "start": 12,
                            "end": 15
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 11,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 10,
                  "end": 16
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 19,
                            "end": 22
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 25,
                            "end": 26
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 19,
                      "end": 26
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 27
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 29,
                  "end": 32
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 18,
            "end": 34
          }
        }
      },
      "span": {
        "start": 18,
        "end": 35
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 36,
                  "end": 38
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "BitwiseNot",
                        "operand": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 52,
                            "end": 54
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 51,
                      "end": 54
                    }
                  }
                },
                "span": {
                  "start": 50,
                  "end": 55
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 55
          }
        }
      },
      "span": {
        "start": 36,
        "end": 56
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 58,
                            "end": 59
                          }
                        },
                        "op": "ShiftLeft",
                        "right": {
                          "kind": {
                            "UnaryPrefix": {
                              "op": "Negate",
                              "operand": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 64,
                                  "end": 65
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 63,
                            "end": 65
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 65
                    }
                  }
                },
                "span": {
                  "start": 57,
                  "end": 66
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 68,
                  "end": 71
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 57,
            "end": 73
          }
        }
      },
      "span": {
        "start": 57,
        "end": 74
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 76,
                            "end": 78
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 81,
                            "end": 82
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 76,
                      "end": 82
                    }
                  }
                },
                "span": {
                  "start": 75,
                  "end": 83
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 85,
                  "end": 88
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 75,
            "end": 90
          }
        }
      },
      "span": {
        "start": 75,
        "end": 91
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "BitwiseNot",
                        "operand": {
                          "kind": "Null",
                          "span": {
                            "start": 94,
                            "end": 98
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 93,
                      "end": 98
                    }
                  }
                },
                "span": {
                  "start": 92,
                  "end": 99
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 101,
                  "end": 104
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 92,
            "end": 106
          }
        }
      },
      "span": {
        "start": 92,
        "end": 107
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "BitwiseNot",
                        "operand": {
                          "kind": {
                            "Float": 1.5
                          },
                          "span": {
                            "start": 110,
                            "end": 113
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 109,
                      "end": 113
                    }
                  }
                },
                "span": {
                  "start": 108,
                  "end": 114
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 116,
                  "end": 119
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 108,
            "end": 121
          }
        }
      },
      "span": {
        "start": 108,
        "end": 122
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "1a"
                          },
                          "span": {
                            "start": 124,
                            "end": 128
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 131,
                            "end": 132
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 124,
                      "end": 132
                    }
                  }
                },
                "span": {
                  "start": 123,
                  "end": 133
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 135,
                  "end": 138
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 123,
            "end": 140
          }
        }
      },
      "span": {
        "start": 123,
        "end": 141
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "BitwiseNot",
                        "operand": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 144,
                            "end": 147
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 143,
                      "end": 147
                    }
                  }
                },
                "span": {
                  "start": 142,
                  "end": 148
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 150,
                  "end": 153
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 142,
            "end": 155
          }
        }
      },
      "span": {
        "start": 142,
        "end": 156
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 158,
                            "end": 161
                          }
                        },
                        "op": "BitwiseOr",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 164,
                            "end": 165
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 158,
                      "end": 165
                    }
                  }
                },
                "span": {
                  "start": 157,
                  "end": 166
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 168,
                  "end": 171
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 157,
            "end": 173
          }
        }
      },
      "span": {
        "start": 157,
        "end": 174
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 176,
                            "end": 179
                          }
                        },
                        "op": "BitwiseOr",
                        "right": {
                          "kind": {
                            "String": "b"
                          },
                          "span": {
                            "start": 182,
                            "end": 185
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 176,
                      "end": 185
                    }
                  }
                },
                "span": {
                  "start": 175,
                  "end": 186
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 188,
                  "end": 191
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 175,
            "end": 193
          }
        }
      },
      "span": {
        "start": 175,
        "end": 194
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 196,
                            "end": 197
                          }
                        },
                        "op": "Pow",
                        "right": {
                          "kind": {
                            "UnaryPrefix": {
                              "op": "Negate",
                              "operand": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 202,
                                  "end": 203
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 201,
                            "end": 203
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 196,
                      "end": 203
                    }
                  }
                },
                "span": {
                  "start": 195,
                  "end": 204
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 206,
                  "end": 209
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 195,
            "end": 211
          }
        }
      },
      "span": {
        "start": 195,
        "end": 212
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "0x1A"
                          },
                          "span": {
                            "start": 214,
                            "end": 220
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 223,
                            "end": 224
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 214,
                      "end": 224
                    }
                  }
                },
                "span": {
                  "start": 213,
                  "end": 225
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 227,
                  "end": 230
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 213,
            "end": 232
          }
        }
      },
      "span": {
        "start": 213,
        "end": 233
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "inf"
                          },
                          "span": {
                            "start": 235,
                            "end": 240
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 243,
                            "end": 244
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 235,
                      "end": 244
                    }
                  }
                },
                "span": {
                  "start": 234,
                  "end": 245
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 247,
                  "end": 250
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 234,
            "end": 252
          }
        }
      },
      "span": {
        "start": 234,
        "end": 253
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 253
  }
}
