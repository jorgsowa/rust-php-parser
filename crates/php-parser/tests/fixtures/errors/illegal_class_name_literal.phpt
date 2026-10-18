===source===
<?php
(1)::A;
(1.5)::f();
(true)::$a;
(null)::A;
([])::A;
(1 + 1)::A;
(-1)::A;
new (1);
new ([]);
$a instanceof (1);
$a instanceof (1 . 2 + 3);
(1)::class;
(null)::class;
(true)::class;
(false)::class;
([])::class;
const A = (1)::BAR;
===errors===
Illegal class name
Illegal class name
Illegal class name
Illegal class name
Illegal class name
Illegal class name
Illegal class name
Illegal class name
Illegal class name
Illegal class name
Illegal class name
Cannot use "::class" on null
Cannot use "::class" on true
Cannot use "::class" on false
Cannot use "::class" on array
Illegal class name
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 7,
                      "end": 8
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 11,
                  "end": 12
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 12
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13
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
                      "Float": 1.5
                    },
                    "span": {
                      "start": 15,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 14,
                  "end": 19
                }
              },
              "method": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 21,
                  "end": 22
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 14,
            "end": 24
          }
        }
      },
      "span": {
        "start": 14,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 27,
                      "end": 31
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 32
                }
              },
              "member": {
                "kind": {
                  "Identifier": "a"
                },
                "span": {
                  "start": 34,
                  "end": 36
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 36
          }
        }
      },
      "span": {
        "start": 26,
        "end": 37
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": "Null",
                    "span": {
                      "start": 39,
                      "end": 43
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 44
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 46,
                  "end": 47
                }
              }
            }
          },
          "span": {
            "start": 38,
            "end": 47
          }
        }
      },
      "span": {
        "start": 38,
        "end": 48
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 50,
                      "end": 52
                    }
                  }
                },
                "span": {
                  "start": 49,
                  "end": 53
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 55,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 49,
            "end": 56
          }
        }
      },
      "span": {
        "start": 49,
        "end": 57
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
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
                            "start": 59,
                            "end": 60
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 63,
                            "end": 64
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 64
                    }
                  }
                },
                "span": {
                  "start": 58,
                  "end": 65
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 67,
                  "end": 68
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 68
          }
        }
      },
      "span": {
        "start": 58,
        "end": 69
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 72,
                            "end": 73
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 71,
                      "end": 73
                    }
                  }
                },
                "span": {
                  "start": 70,
                  "end": 74
                }
              },
              "member": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 76,
                  "end": 77
                }
              }
            }
          },
          "span": {
            "start": 70,
            "end": 77
          }
        }
      },
      "span": {
        "start": 70,
        "end": 78
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 84,
                      "end": 85
                    }
                  }
                },
                "span": {
                  "start": 83,
                  "end": 86
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 79,
            "end": 86
          }
        }
      },
      "span": {
        "start": 79,
        "end": 87
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 93,
                      "end": 95
                    }
                  }
                },
                "span": {
                  "start": 92,
                  "end": 96
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 88,
            "end": 96
          }
        }
      },
      "span": {
        "start": 88,
        "end": 97
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
                  "start": 98,
                  "end": 100
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 113,
                      "end": 114
                    }
                  }
                },
                "span": {
                  "start": 112,
                  "end": 115
                }
              }
            }
          },
          "span": {
            "start": 98,
            "end": 115
          }
        }
      },
      "span": {
        "start": 98,
        "end": 116
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
                  "start": 117,
                  "end": 119
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
                            "Int": 1
                          },
                          "span": {
                            "start": 132,
                            "end": 133
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 136,
                                  "end": 137
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Int": 3
                                },
                                "span": {
                                  "start": 140,
                                  "end": 141
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 136,
                            "end": 141
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 132,
                      "end": 141
                    }
                  }
                },
                "span": {
                  "start": 131,
                  "end": 142
                }
              }
            }
          },
          "span": {
            "start": 117,
            "end": 142
          }
        }
      },
      "span": {
        "start": 117,
        "end": 143
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 145,
                      "end": 146
                    }
                  }
                },
                "span": {
                  "start": 144,
                  "end": 147
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 149,
                  "end": 154
                }
              }
            }
          },
          "span": {
            "start": 144,
            "end": 154
          }
        }
      },
      "span": {
        "start": 144,
        "end": 155
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": "Null",
                    "span": {
                      "start": 157,
                      "end": 161
                    }
                  }
                },
                "span": {
                  "start": 156,
                  "end": 162
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 164,
                  "end": 169
                }
              }
            }
          },
          "span": {
            "start": 156,
            "end": 169
          }
        }
      },
      "span": {
        "start": 156,
        "end": 170
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 172,
                      "end": 176
                    }
                  }
                },
                "span": {
                  "start": 171,
                  "end": 177
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 179,
                  "end": 184
                }
              }
            }
          },
          "span": {
            "start": 171,
            "end": 184
          }
        }
      },
      "span": {
        "start": 171,
        "end": 185
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 187,
                      "end": 192
                    }
                  }
                },
                "span": {
                  "start": 186,
                  "end": 193
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 195,
                  "end": 200
                }
              }
            }
          },
          "span": {
            "start": 186,
            "end": 200
          }
        }
      },
      "span": {
        "start": 186,
        "end": 201
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 203,
                      "end": 205
                    }
                  }
                },
                "span": {
                  "start": 202,
                  "end": 206
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 208,
                  "end": 213
                }
              }
            }
          },
          "span": {
            "start": 202,
            "end": 213
          }
        }
      },
      "span": {
        "start": 202,
        "end": 214
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 221,
                "end": 222
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 226,
                          "end": 227
                        }
                      }
                    },
                    "span": {
                      "start": 225,
                      "end": 228
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "BAR"
                    },
                    "span": {
                      "start": 230,
                      "end": 233
                    }
                  }
                }
              },
              "span": {
                "start": 225,
                "end": 233
              }
            },
            "attributes": [],
            "span": {
              "start": 221,
              "end": 233
            }
          }
        ]
      },
      "span": {
        "start": 215,
        "end": 234
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 234
  }
}
