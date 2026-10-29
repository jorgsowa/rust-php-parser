===source===
<?php
(1 + '1')::class;
(-'1')::class;
('1.5' * 2)::class;
(' 1' + 1)::class;
('1 ' + 1)::class;
('4' / '2')::class;
(1 + '1a')::class;
(1 + 'a')::class;
$o->{'1' + 1}();
$o->{'1 ' + 1}();
$o->{'1a' + 1}();
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Method name must be a string
===errors >=8.0===
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on float
Cannot use "::class" on int
Cannot use "::class" on int
Cannot use "::class" on int
Method name must be a string
Method name must be a string
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
                            "start": 7,
                            "end": 8
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "String": "1"
                          },
                          "span": {
                            "start": 11,
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
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 17,
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
            "ClassConstAccess": {
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
                            "start": 26,
                            "end": 29
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 25,
                      "end": 29
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 30
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 32,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 24,
            "end": 37
          }
        }
      },
      "span": {
        "start": 24,
        "end": 38
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
                            "String": "1.5"
                          },
                          "span": {
                            "start": 40,
                            "end": 45
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 48,
                            "end": 49
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 49
                    }
                  }
                },
                "span": {
                  "start": 39,
                  "end": 50
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 52,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 57
          }
        }
      },
      "span": {
        "start": 39,
        "end": 58
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
                            "String": " 1"
                          },
                          "span": {
                            "start": 60,
                            "end": 64
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 67,
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
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 71,
                  "end": 76
                }
              }
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
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "1 "
                          },
                          "span": {
                            "start": 79,
                            "end": 83
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 86,
                            "end": 87
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 79,
                      "end": 87
                    }
                  }
                },
                "span": {
                  "start": 78,
                  "end": 88
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 90,
                  "end": 95
                }
              }
            }
          },
          "span": {
            "start": 78,
            "end": 95
          }
        }
      },
      "span": {
        "start": 78,
        "end": 96
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
                            "String": "4"
                          },
                          "span": {
                            "start": 98,
                            "end": 101
                          }
                        },
                        "op": "Div",
                        "right": {
                          "kind": {
                            "String": "2"
                          },
                          "span": {
                            "start": 104,
                            "end": 107
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 98,
                      "end": 107
                    }
                  }
                },
                "span": {
                  "start": 97,
                  "end": 108
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 110,
                  "end": 115
                }
              }
            }
          },
          "span": {
            "start": 97,
            "end": 115
          }
        }
      },
      "span": {
        "start": 97,
        "end": 116
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
                            "start": 118,
                            "end": 119
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "String": "1a"
                          },
                          "span": {
                            "start": 122,
                            "end": 126
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 118,
                      "end": 126
                    }
                  }
                },
                "span": {
                  "start": 117,
                  "end": 127
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 129,
                  "end": 134
                }
              }
            }
          },
          "span": {
            "start": 117,
            "end": 134
          }
        }
      },
      "span": {
        "start": 117,
        "end": 135
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
                            "start": 137,
                            "end": 138
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 141,
                            "end": 144
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 137,
                      "end": 144
                    }
                  }
                },
                "span": {
                  "start": 136,
                  "end": 145
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 147,
                  "end": 152
                }
              }
            }
          },
          "span": {
            "start": 136,
            "end": 152
          }
        }
      },
      "span": {
        "start": 136,
        "end": 153
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 154,
                  "end": 156
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "1"
                      },
                      "span": {
                        "start": 159,
                        "end": 162
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 165,
                        "end": 166
                      }
                    }
                  }
                },
                "span": {
                  "start": 159,
                  "end": 166
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 154,
            "end": 169
          }
        }
      },
      "span": {
        "start": 154,
        "end": 170
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 171,
                  "end": 173
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "1 "
                      },
                      "span": {
                        "start": 176,
                        "end": 180
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 183,
                        "end": 184
                      }
                    }
                  }
                },
                "span": {
                  "start": 176,
                  "end": 184
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 171,
            "end": 187
          }
        }
      },
      "span": {
        "start": 171,
        "end": 188
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 189,
                  "end": 191
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "String": "1a"
                      },
                      "span": {
                        "start": 194,
                        "end": 198
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 201,
                        "end": 202
                      }
                    }
                  }
                },
                "span": {
                  "start": 194,
                  "end": 202
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 189,
            "end": 205
          }
        }
      },
      "span": {
        "start": 189,
        "end": 206
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 206
  }
}
