===source===
<?php
$x = !0 ? 1 : isset(1+1);
$x = [] ?: isset(1+1);
true && $a && isset(1+1);
self::class || isset(1+1);
static::class || isset(1+1);
===errors===
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
===php_error===
PHP Fatal error:  Cannot use isset() on the result of an expression (you can use "null !== expression" instead) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "BooleanNot",
                          "operand": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 12,
                              "end": 13
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 16,
                        "end": 17
                      }
                    },
                    "else_expr": {
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
                                    "start": 26,
                                    "end": 27
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 28,
                                    "end": 29
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 26,
                              "end": 29
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 20,
                        "end": 30
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
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
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 32,
                  "end": 34
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 37,
                        "end": 39
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
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
                                    "start": 49,
                                    "end": 50
                                  }
                                },
                                "op": "Add",
                                "right": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 51,
                                    "end": 52
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 49,
                              "end": 52
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 43,
                        "end": 53
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 53
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 53
          }
        }
      },
      "span": {
        "start": 32,
        "end": 54
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
                        "Bool": true
                      },
                      "span": {
                        "start": 55,
                        "end": 59
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 63,
                        "end": 65
                      }
                    }
                  }
                },
                "span": {
                  "start": 55,
                  "end": 65
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
                              "start": 75,
                              "end": 76
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 77,
                              "end": 78
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 75,
                        "end": 78
                      }
                    }
                  ]
                },
                "span": {
                  "start": 69,
                  "end": 79
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 79
          }
        }
      },
      "span": {
        "start": 55,
        "end": 80
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
                            "self"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 81,
                            "end": 85
                          }
                        }
                      },
                      "span": {
                        "start": 81,
                        "end": 85
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 87,
                        "end": 92
                      }
                    }
                  }
                },
                "span": {
                  "start": 81,
                  "end": 92
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
                              "start": 102,
                              "end": 103
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 104,
                              "end": 105
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 102,
                        "end": 105
                      }
                    }
                  ]
                },
                "span": {
                  "start": 96,
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
            "Binary": {
              "left": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "static"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 108,
                            "end": 114
                          }
                        }
                      },
                      "span": {
                        "start": 108,
                        "end": 114
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 116,
                        "end": 121
                      }
                    }
                  }
                },
                "span": {
                  "start": 108,
                  "end": 121
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
                              "start": 131,
                              "end": 132
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 133,
                              "end": 134
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 131,
                        "end": 134
                      }
                    }
                  ]
                },
                "span": {
                  "start": 125,
                  "end": 135
                }
              }
            }
          },
          "span": {
            "start": 108,
            "end": 135
          }
        }
      },
      "span": {
        "start": 108,
        "end": 136
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 136
  }
}
