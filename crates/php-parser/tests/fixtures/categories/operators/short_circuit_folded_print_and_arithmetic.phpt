===source===
<?php
print $a or isset(1+1);
-1 || isset(1+1);
1 - 1 && isset(1+1);
"a" . "b" || isset(1+1);
!print 1 and isset(1+1);
2 * 1.5 or isset(1+1);
(print $a) || $b || isset(1+1);
print $a or 1 ? 2 : 3 ? 4 : 5;
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
                  "Print": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 12,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
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
                              "start": 24,
                              "end": 25
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 26,
                              "end": 27
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 18,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
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
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 31,
                        "end": 32
                      }
                    }
                  }
                },
                "span": {
                  "start": 30,
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
            "start": 30,
            "end": 46
          }
        }
      },
      "span": {
        "start": 30,
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
                        "Int": 1
                      },
                      "span": {
                        "start": 48,
                        "end": 49
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 52,
                        "end": 53
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 53
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
                              "start": 63,
                              "end": 64
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 65,
                              "end": 66
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 63,
                        "end": 66
                      }
                    }
                  ]
                },
                "span": {
                  "start": 57,
                  "end": 67
                }
              }
            }
          },
          "span": {
            "start": 48,
            "end": 67
          }
        }
      },
      "span": {
        "start": 48,
        "end": 68
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
                        "start": 69,
                        "end": 72
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 75,
                        "end": 78
                      }
                    }
                  }
                },
                "span": {
                  "start": 69,
                  "end": 78
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
                              "start": 88,
                              "end": 89
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 90,
                              "end": 91
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 88,
                        "end": 91
                      }
                    }
                  ]
                },
                "span": {
                  "start": 82,
                  "end": 92
                }
              }
            }
          },
          "span": {
            "start": 69,
            "end": 92
          }
        }
      },
      "span": {
        "start": 69,
        "end": 93
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
                        "Print": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 101,
                            "end": 102
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 102
                      }
                    }
                  }
                },
                "span": {
                  "start": 94,
                  "end": 102
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
            "start": 94,
            "end": 117
          }
        }
      },
      "span": {
        "start": 94,
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 119,
                        "end": 120
                      }
                    },
                    "op": "Mul",
                    "right": {
                      "kind": {
                        "Float": 1.5
                      },
                      "span": {
                        "start": 123,
                        "end": 126
                      }
                    }
                  }
                },
                "span": {
                  "start": 119,
                  "end": 126
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
                              "start": 136,
                              "end": 137
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 138,
                              "end": 139
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 136,
                        "end": 139
                      }
                    }
                  ]
                },
                "span": {
                  "start": 130,
                  "end": 140
                }
              }
            }
          },
          "span": {
            "start": 119,
            "end": 140
          }
        }
      },
      "span": {
        "start": 119,
        "end": 141
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
                        "Parenthesized": {
                          "kind": {
                            "Print": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 149,
                                "end": 151
                              }
                            }
                          },
                          "span": {
                            "start": 143,
                            "end": 151
                          }
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 152
                      }
                    },
                    "op": "BooleanOr",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 156,
                        "end": 158
                      }
                    }
                  }
                },
                "span": {
                  "start": 142,
                  "end": 158
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
                              "start": 168,
                              "end": 169
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 170,
                              "end": 171
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 168,
                        "end": 171
                      }
                    }
                  ]
                },
                "span": {
                  "start": 162,
                  "end": 172
                }
              }
            }
          },
          "span": {
            "start": 142,
            "end": 172
          }
        }
      },
      "span": {
        "start": 142,
        "end": 173
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Print": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 180,
                      "end": 182
                    }
                  }
                },
                "span": {
                  "start": 174,
                  "end": 182
                }
              },
              "op": "LogicalOr",
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
                              "start": 186,
                              "end": 187
                            }
                          },
                          "then_expr": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 190,
                              "end": 191
                            }
                          },
                          "else_expr": {
                            "kind": {
                              "Int": 3
                            },
                            "span": {
                              "start": 194,
                              "end": 195
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 186,
                        "end": 195
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 198,
                        "end": 199
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Int": 5
                      },
                      "span": {
                        "start": 202,
                        "end": 203
                      }
                    }
                  }
                },
                "span": {
                  "start": 186,
                  "end": 203
                }
              }
            }
          },
          "span": {
            "start": 174,
            "end": 203
          }
        }
      },
      "span": {
        "start": 174,
        "end": 204
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 204
  }
}
