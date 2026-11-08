===source===
<?php
$r1 = $x == $a =& $b > f();
$r2 = $c ? 1 : $a =& $b > f();
$r3 = $n ?? $a =& $b > f();
$r4 = !$a =& $o instanceof C;
$r5 = $a =& $b > f();
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
                  "Variable": "r1"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "op": "Equal",
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 18,
                                    "end": 20
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 24,
                                    "end": 26
                                  }
                                },
                                "by_ref": true
                              }
                            },
                            "span": {
                              "start": 18,
                              "end": 26
                            }
                          },
                          "op": "Greater",
                          "right": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "f"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 29,
                                        "end": 30
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 29,
                                    "end": 30
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 29,
                              "end": 32
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 32
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r2"
                },
                "span": {
                  "start": 34,
                  "end": 37
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 40,
                        "end": 42
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 45,
                        "end": 46
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 49,
                                    "end": 51
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 55,
                                    "end": 57
                                  }
                                },
                                "by_ref": true
                              }
                            },
                            "span": {
                              "start": 49,
                              "end": 57
                            }
                          },
                          "op": "Greater",
                          "right": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "f"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 60,
                                        "end": 61
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 60,
                                    "end": 61
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 60,
                              "end": 63
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 63
                      }
                    }
                  }
                },
                "span": {
                  "start": 40,
                  "end": 63
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 63
          }
        }
      },
      "span": {
        "start": 34,
        "end": 64
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r3"
                },
                "span": {
                  "start": 65,
                  "end": 68
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "n"
                      },
                      "span": {
                        "start": 71,
                        "end": 73
                      }
                    },
                    "right": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 77,
                                    "end": 79
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 83,
                                    "end": 85
                                  }
                                },
                                "by_ref": true
                              }
                            },
                            "span": {
                              "start": 77,
                              "end": 85
                            }
                          },
                          "op": "Greater",
                          "right": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "f"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 88,
                                        "end": 89
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 88,
                                    "end": 89
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 88,
                              "end": 91
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 77,
                        "end": 91
                      }
                    }
                  }
                },
                "span": {
                  "start": 71,
                  "end": 91
                }
              }
            }
          },
          "span": {
            "start": 65,
            "end": 91
          }
        }
      },
      "span": {
        "start": 65,
        "end": 92
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r4"
                },
                "span": {
                  "start": 93,
                  "end": 96
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 100,
                                    "end": 102
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Variable": "o"
                                  },
                                  "span": {
                                    "start": 106,
                                    "end": 108
                                  }
                                },
                                "by_ref": true
                              }
                            },
                            "span": {
                              "start": 100,
                              "end": 108
                            }
                          },
                          "op": "Instanceof",
                          "right": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "C"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 120,
                                  "end": 121
                                }
                              }
                            },
                            "span": {
                              "start": 120,
                              "end": 121
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 100,
                        "end": 121
                      }
                    }
                  }
                },
                "span": {
                  "start": 99,
                  "end": 121
                }
              }
            }
          },
          "span": {
            "start": 93,
            "end": 121
          }
        }
      },
      "span": {
        "start": 93,
        "end": 122
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r5"
                },
                "span": {
                  "start": 123,
                  "end": 126
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 129,
                              "end": 131
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 135,
                              "end": 137
                            }
                          },
                          "by_ref": true
                        }
                      },
                      "span": {
                        "start": 129,
                        "end": 137
                      }
                    },
                    "op": "Greater",
                    "right": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "f"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 140,
                                  "end": 141
                                }
                              }
                            },
                            "span": {
                              "start": 140,
                              "end": 141
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 140,
                        "end": 143
                      }
                    }
                  }
                },
                "span": {
                  "start": 129,
                  "end": 143
                }
              }
            }
          },
          "span": {
            "start": 123,
            "end": 143
          }
        }
      },
      "span": {
        "start": 123,
        "end": 144
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 144
  }
}
