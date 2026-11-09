===source===
<?php
('1' * 1)::foo();
(1 << 2)::foo();
([] + [])::foo();
(1 == 'a')::foo();
(-'1')::foo();
(' 1 ' + 1)::foo();
(true + 1)::foo();
(!'a')::foo();
('1e3' * 1)::foo();
('.5' * 1)::foo();
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
===php_error===
PHP Fatal error:  Illegal class name in Standard input code on line 2
===ast===
{
  "stmts": [
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
                            "String": "1"
                          },
                          "span": {
                            "start": 7,
                            "end": 10
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 13,
                            "end": 14
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 15
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 17,
                  "end": 20
                }
              },
              "args": []
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
                            "start": 25,
                            "end": 26
                          }
                        },
                        "op": "ShiftLeft",
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
                      "start": 25,
                      "end": 31
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 32
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 34,
                  "end": 37
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 24,
            "end": 39
          }
        }
      },
      "span": {
        "start": 24,
        "end": 40
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
                            "start": 42,
                            "end": 44
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 47,
                            "end": 49
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 42,
                      "end": 49
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 50
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 52,
                  "end": 55
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 41,
            "end": 57
          }
        }
      },
      "span": {
        "start": 41,
        "end": 58
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
                            "start": 60,
                            "end": 61
                          }
                        },
                        "op": "Equal",
                        "right": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 65,
                            "end": 68
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 60,
                      "end": 68
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 69
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 71,
                  "end": 74
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 59,
            "end": 76
          }
        }
      },
      "span": {
        "start": 59,
        "end": 77
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
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "String": "1"
                          },
                          "span": {
                            "start": 80,
                            "end": 83
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 79,
                      "end": 83
                    }
                  }
                },
                "span": {
                  "start": 78,
                  "end": 84
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 86,
                  "end": 89
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 78,
            "end": 91
          }
        }
      },
      "span": {
        "start": 78,
        "end": 92
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
                            "String": " 1 "
                          },
                          "span": {
                            "start": 94,
                            "end": 99
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 102,
                            "end": 103
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 94,
                      "end": 103
                    }
                  }
                },
                "span": {
                  "start": 93,
                  "end": 104
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 106,
                  "end": 109
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 93,
            "end": 111
          }
        }
      },
      "span": {
        "start": 93,
        "end": 112
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
                            "Bool": true
                          },
                          "span": {
                            "start": 114,
                            "end": 118
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 121,
                            "end": 122
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 114,
                      "end": 122
                    }
                  }
                },
                "span": {
                  "start": 113,
                  "end": 123
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 125,
                  "end": 128
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 113,
            "end": 130
          }
        }
      },
      "span": {
        "start": 113,
        "end": 131
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
                        "op": "BooleanNot",
                        "operand": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 134,
                            "end": 137
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 133,
                      "end": 137
                    }
                  }
                },
                "span": {
                  "start": 132,
                  "end": 138
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 140,
                  "end": 143
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 132,
            "end": 145
          }
        }
      },
      "span": {
        "start": 132,
        "end": 146
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
                            "String": "1e3"
                          },
                          "span": {
                            "start": 148,
                            "end": 153
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 156,
                            "end": 157
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 148,
                      "end": 157
                    }
                  }
                },
                "span": {
                  "start": 147,
                  "end": 158
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 160,
                  "end": 163
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 147,
            "end": 165
          }
        }
      },
      "span": {
        "start": 147,
        "end": 166
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
                            "String": ".5"
                          },
                          "span": {
                            "start": 168,
                            "end": 172
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 175,
                            "end": 176
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 168,
                      "end": 176
                    }
                  }
                },
                "span": {
                  "start": 167,
                  "end": 177
                }
              },
              "method": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 179,
                  "end": 182
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 167,
            "end": 184
          }
        }
      },
      "span": {
        "start": 167,
        "end": 185
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 185
  }
}
