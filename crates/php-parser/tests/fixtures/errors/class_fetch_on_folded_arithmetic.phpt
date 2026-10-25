===source===
<?php
echo (5 % 3)::class;
echo (4 / 2)::class;
echo (1 / 2)::class;
echo (2 ** -1)::class;
echo (1 | 2)::class;
echo ("a" | "b")::class;
echo (1 << 2)::class;
echo (1.5 | 2)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
===errors 8.0===
Cannot use "::class" on value of type int
Cannot use "::class" on value of type int
Cannot use "::class" on value of type float
Cannot use "::class" on value of type float
Cannot use "::class" on value of type int
Cannot use "::class" on value of type string
Cannot use "::class" on value of type int
Cannot use "::class" on value of type int
===errors 8.1-8.2===
Cannot use "::class" on value of type int
Cannot use "::class" on value of type int
Cannot use "::class" on value of type float
Cannot use "::class" on value of type float
Cannot use "::class" on value of type int
Cannot use "::class" on value of type string
Cannot use "::class" on value of type int
===errors >=8.3===
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on float
Cannot use "::class" on float
Cannot use "::class" on int
Cannot use "::class" on string
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on int in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 5
                            },
                            "span": {
                              "start": 12,
                              "end": 13
                            }
                          },
                          "op": "Mod",
                          "right": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 16,
                              "end": 17
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 17
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 18
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 20,
                    "end": 25
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 4
                            },
                            "span": {
                              "start": 33,
                              "end": 34
                            }
                          },
                          "op": "Div",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 37,
                              "end": 38
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 38
                      }
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 39
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 41,
                    "end": 46
                  }
                }
              }
            },
            "span": {
              "start": 32,
              "end": 46
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 47
      }
    },
    {
      "kind": {
        "Echo": [
          {
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
                              "start": 54,
                              "end": 55
                            }
                          },
                          "op": "Div",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 58,
                              "end": 59
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 54,
                        "end": 59
                      }
                    }
                  },
                  "span": {
                    "start": 53,
                    "end": 60
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 62,
                    "end": 67
                  }
                }
              }
            },
            "span": {
              "start": 53,
              "end": 67
            }
          }
        ]
      },
      "span": {
        "start": 48,
        "end": 68
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 75,
                              "end": 76
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
                                    "start": 81,
                                    "end": 82
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 80,
                              "end": 82
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 75,
                        "end": 82
                      }
                    }
                  },
                  "span": {
                    "start": 74,
                    "end": 83
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 85,
                    "end": 90
                  }
                }
              }
            },
            "span": {
              "start": 74,
              "end": 90
            }
          }
        ]
      },
      "span": {
        "start": 69,
        "end": 91
      }
    },
    {
      "kind": {
        "Echo": [
          {
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
                              "start": 98,
                              "end": 99
                            }
                          },
                          "op": "BitwiseOr",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 102,
                              "end": 103
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 98,
                        "end": 103
                      }
                    }
                  },
                  "span": {
                    "start": 97,
                    "end": 104
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 106,
                    "end": 111
                  }
                }
              }
            },
            "span": {
              "start": 97,
              "end": 111
            }
          }
        ]
      },
      "span": {
        "start": 92,
        "end": 112
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
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
                              "start": 119,
                              "end": 122
                            }
                          },
                          "op": "BitwiseOr",
                          "right": {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 125,
                              "end": 128
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 119,
                        "end": 128
                      }
                    }
                  },
                  "span": {
                    "start": 118,
                    "end": 129
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 131,
                    "end": 136
                  }
                }
              }
            },
            "span": {
              "start": 118,
              "end": 136
            }
          }
        ]
      },
      "span": {
        "start": 113,
        "end": 137
      }
    },
    {
      "kind": {
        "Echo": [
          {
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
                              "start": 144,
                              "end": 145
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 149,
                              "end": 150
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 144,
                        "end": 150
                      }
                    }
                  },
                  "span": {
                    "start": 143,
                    "end": 151
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 153,
                    "end": 158
                  }
                }
              }
            },
            "span": {
              "start": 143,
              "end": 158
            }
          }
        ]
      },
      "span": {
        "start": 138,
        "end": 159
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Float": 1.5
                            },
                            "span": {
                              "start": 166,
                              "end": 169
                            }
                          },
                          "op": "BitwiseOr",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 172,
                              "end": 173
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 166,
                        "end": 173
                      }
                    }
                  },
                  "span": {
                    "start": 165,
                    "end": 174
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 176,
                    "end": 181
                  }
                }
              }
            },
            "span": {
              "start": 165,
              "end": 181
            }
          }
        ]
      },
      "span": {
        "start": 160,
        "end": 182
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 182
  }
}
