===source===
<?php
const A = null ?? $x;
const B = 1 ? $x : 2;
const C = "" ?: $x;
const D = 1 && $x;
const E = 0 || $x;
const F = 0 ? 1 : $x;
const G = [1, $x][0];
const H = 0 * $x;
const I = (int) "0" ? 1 : $x;
===errors <=8.4===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'casts in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
===php_error===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
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
                "NullCoalesce": {
                  "left": {
                    "kind": "Null",
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 24,
                      "end": 26
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 26
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 26
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 27
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 34,
                "end": 35
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
                      "start": 38,
                      "end": 39
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 42,
                      "end": 44
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 47,
                      "end": 48
                    }
                  }
                }
              },
              "span": {
                "start": 38,
                "end": 48
              }
            },
            "attributes": [],
            "span": {
              "start": 34,
              "end": 48
            }
          }
        ]
      },
      "span": {
        "start": 28,
        "end": 49
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 56,
                "end": 57
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "String": ""
                    },
                    "span": {
                      "start": 60,
                      "end": 62
                    }
                  },
                  "then_expr": null,
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 66,
                      "end": 68
                    }
                  }
                }
              },
              "span": {
                "start": 60,
                "end": 68
              }
            },
            "attributes": [],
            "span": {
              "start": 56,
              "end": 68
            }
          }
        ]
      },
      "span": {
        "start": 50,
        "end": 69
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 76,
                "end": 77
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 80,
                      "end": 81
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 85,
                      "end": 87
                    }
                  }
                }
              },
              "span": {
                "start": 80,
                "end": 87
              }
            },
            "attributes": [],
            "span": {
              "start": 76,
              "end": 87
            }
          }
        ]
      },
      "span": {
        "start": 70,
        "end": 88
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
              "span": {
                "start": 95,
                "end": 96
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 99,
                      "end": 100
                    }
                  },
                  "op": "BooleanOr",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 104,
                      "end": 106
                    }
                  }
                }
              },
              "span": {
                "start": 99,
                "end": 106
              }
            },
            "attributes": [],
            "span": {
              "start": 95,
              "end": 106
            }
          }
        ]
      },
      "span": {
        "start": 89,
        "end": 107
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "F",
              "span": {
                "start": 114,
                "end": 115
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 118,
                      "end": 119
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 122,
                      "end": 123
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 126,
                      "end": 128
                    }
                  }
                }
              },
              "span": {
                "start": 118,
                "end": 128
              }
            },
            "attributes": [],
            "span": {
              "start": 114,
              "end": 128
            }
          }
        ]
      },
      "span": {
        "start": 108,
        "end": 129
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "G",
              "span": {
                "start": 136,
                "end": 137
              }
            },
            "value": {
              "kind": {
                "ArrayAccess": {
                  "array": {
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
                                "start": 141,
                                "end": 142
                              }
                            }
                          },
                          "span": {
                            "start": 141,
                            "end": 142
                          }
                        },
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 144,
                                "end": 146
                              }
                            }
                          },
                          "span": {
                            "start": 144,
                            "end": 146
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 140,
                      "end": 147
                    }
                  },
                  "index": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 148,
                      "end": 149
                    }
                  }
                }
              },
              "span": {
                "start": 140,
                "end": 150
              }
            },
            "attributes": [],
            "span": {
              "start": 136,
              "end": 150
            }
          }
        ]
      },
      "span": {
        "start": 130,
        "end": 151
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "H",
              "span": {
                "start": 158,
                "end": 159
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 162,
                      "end": 163
                    }
                  },
                  "op": "Mul",
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 166,
                      "end": 168
                    }
                  }
                }
              },
              "span": {
                "start": 162,
                "end": 168
              }
            },
            "attributes": [],
            "span": {
              "start": 158,
              "end": 168
            }
          }
        ]
      },
      "span": {
        "start": 152,
        "end": 169
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "I",
              "span": {
                "start": 176,
                "end": 177
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Cast": [
                        "Int",
                        {
                          "kind": {
                            "String": "0"
                          },
                          "span": {
                            "start": 186,
                            "end": 189
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 180,
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
                "start": 180,
                "end": 198
              }
            },
            "attributes": [],
            "span": {
              "start": 176,
              "end": 198
            }
          }
        ]
      },
      "span": {
        "start": 170,
        "end": 199
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 199
  }
}
