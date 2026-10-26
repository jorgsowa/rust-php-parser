===source===
<?php
(PHP_INT_MAX + 1)::class;
(PHP_INT_MIN - 1)::class;
(-PHP_INT_MIN)::class;
(\PHP_INT_MAX * 2)::class;
(PHP_INT_MAX - 1)::class;
(PHP_INT_SIZE == 8)::class;
$o->{PHP_INT_MAX + 1}();
PHP_INT_SIZE - 8 || isset(1 + 1);
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Method name must be a string
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===errors 8.0-8.2===
Cannot use "::class" on value of type float
Cannot use "::class" on value of type float
Cannot use "::class" on value of type float
Cannot use "::class" on value of type float
Cannot use "::class" on value of type int
Cannot use "::class" on value of type bool
Method name must be a string
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===errors >=8.3===
Cannot use "::class" on float
Cannot use "::class" on float
Cannot use "::class" on float
Cannot use "::class" on float
Cannot use "::class" on int
Cannot use "::class" on true
Method name must be a string
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type float in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on float in Standard input code on line 2
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
                            "Name": {
                              "parts": [
                                "PHP_INT_MAX"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 7,
                                "end": 18
                              }
                            }
                          },
                          "span": {
                            "start": 7,
                            "end": 18
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 7,
                      "end": 22
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 23
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 25,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
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
                            "Name": {
                              "parts": [
                                "PHP_INT_MIN"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 33,
                                "end": 44
                              }
                            }
                          },
                          "span": {
                            "start": 33,
                            "end": 44
                          }
                        },
                        "op": "Sub",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 47,
                            "end": 48
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 48
                    }
                  }
                },
                "span": {
                  "start": 32,
                  "end": 49
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 51,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 56
          }
        }
      },
      "span": {
        "start": 32,
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
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "PHP_INT_MIN"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 60,
                                "end": 71
                              }
                            }
                          },
                          "span": {
                            "start": 60,
                            "end": 71
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 59,
                      "end": 71
                    }
                  }
                },
                "span": {
                  "start": 58,
                  "end": 72
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 74,
                  "end": 79
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 79
          }
        }
      },
      "span": {
        "start": 58,
        "end": 80
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
                            "Name": {
                              "parts": [
                                "PHP_INT_MAX"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 82,
                                "end": 94
                              }
                            }
                          },
                          "span": {
                            "start": 82,
                            "end": 94
                          }
                        },
                        "op": "Mul",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 97,
                            "end": 98
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 82,
                      "end": 98
                    }
                  }
                },
                "span": {
                  "start": 81,
                  "end": 99
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 101,
                  "end": 106
                }
              }
            }
          },
          "span": {
            "start": 81,
            "end": 106
          }
        }
      },
      "span": {
        "start": 81,
        "end": 107
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
                            "Name": {
                              "parts": [
                                "PHP_INT_MAX"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 109,
                                "end": 120
                              }
                            }
                          },
                          "span": {
                            "start": 109,
                            "end": 120
                          }
                        },
                        "op": "Sub",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 123,
                            "end": 124
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 109,
                      "end": 124
                    }
                  }
                },
                "span": {
                  "start": 108,
                  "end": 125
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 127,
                  "end": 132
                }
              }
            }
          },
          "span": {
            "start": 108,
            "end": 132
          }
        }
      },
      "span": {
        "start": 108,
        "end": 133
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
                            "Name": {
                              "parts": [
                                "PHP_INT_SIZE"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 135,
                                "end": 147
                              }
                            }
                          },
                          "span": {
                            "start": 135,
                            "end": 147
                          }
                        },
                        "op": "Equal",
                        "right": {
                          "kind": {
                            "Int": 8
                          },
                          "span": {
                            "start": 151,
                            "end": 152
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 135,
                      "end": 152
                    }
                  }
                },
                "span": {
                  "start": 134,
                  "end": 153
                }
              },
              "member": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 155,
                  "end": 160
                }
              }
            }
          },
          "span": {
            "start": 134,
            "end": 160
          }
        }
      },
      "span": {
        "start": 134,
        "end": 161
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
                  "start": 162,
                  "end": 164
                }
              },
              "method": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "PHP_INT_MAX"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 167,
                            "end": 178
                          }
                        }
                      },
                      "span": {
                        "start": 167,
                        "end": 178
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 181,
                        "end": 182
                      }
                    }
                  }
                },
                "span": {
                  "start": 167,
                  "end": 182
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 162,
            "end": 185
          }
        }
      },
      "span": {
        "start": 162,
        "end": 186
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
                        "Name": {
                          "parts": [
                            "PHP_INT_SIZE"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 187,
                            "end": 199
                          }
                        }
                      },
                      "span": {
                        "start": 187,
                        "end": 199
                      }
                    },
                    "op": "Sub",
                    "right": {
                      "kind": {
                        "Int": 8
                      },
                      "span": {
                        "start": 202,
                        "end": 203
                      }
                    }
                  }
                },
                "span": {
                  "start": 187,
                  "end": 203
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
                              "start": 213,
                              "end": 214
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 217,
                              "end": 218
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 213,
                        "end": 218
                      }
                    }
                  ]
                },
                "span": {
                  "start": 207,
                  "end": 219
                }
              }
            }
          },
          "span": {
            "start": 187,
            "end": 219
          }
        }
      },
      "span": {
        "start": 187,
        "end": 220
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 220
  }
}
