===source===
<?php

// ternary
$a ? $b : $c;
$a ?: $c;

// precedence
($a ? $b : $c) ? $d : $e;
$a ? $b : ($c ? $d : $e);

// null coalesce
$a ?? $b;
$a ?? $b ?? $c;
$a ?? $b ? $c : $d;
$a && $b ?? $c;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 18,
                  "end": 20,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 23,
                  "end": 25,
                  "start_line": 4,
                  "start_col": 5
                }
              },
              "else_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 28,
                  "end": 30,
                  "start_line": 4,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 18,
            "end": 30,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 18,
        "end": 32,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 32,
                  "end": 34,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "then_expr": null,
              "else_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 38,
                  "end": 40,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 40,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 32,
        "end": 57,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 58,
                            "end": 60,
                            "start_line": 8,
                            "start_col": 1
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 63,
                            "end": 65,
                            "start_line": 8,
                            "start_col": 6
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 68,
                            "end": 70,
                            "start_line": 8,
                            "start_col": 11
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 70,
                      "start_line": 8,
                      "start_col": 1
                    }
                  }
                },
                "span": {
                  "start": 57,
                  "end": 72,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 74,
                  "end": 76,
                  "start_line": 8,
                  "start_col": 17
                }
              },
              "else_expr": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 79,
                  "end": 81,
                  "start_line": 8,
                  "start_col": 22
                }
              }
            }
          },
          "span": {
            "start": 57,
            "end": 81,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 57,
        "end": 83,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 83,
                  "end": 85,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 88,
                  "end": 90,
                  "start_line": 9,
                  "start_col": 5
                }
              },
              "else_expr": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 94,
                            "end": 96,
                            "start_line": 9,
                            "start_col": 11
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Variable": "d"
                          },
                          "span": {
                            "start": 99,
                            "end": 101,
                            "start_line": 9,
                            "start_col": 16
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "e"
                          },
                          "span": {
                            "start": 104,
                            "end": 106,
                            "start_line": 9,
                            "start_col": 21
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 94,
                      "end": 106,
                      "start_line": 9,
                      "start_col": 11
                    }
                  }
                },
                "span": {
                  "start": 93,
                  "end": 107,
                  "start_line": 9,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 107,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 83,
        "end": 127,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 127,
                  "end": 129,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 133,
                  "end": 135,
                  "start_line": 12,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 127,
            "end": 135,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 127,
        "end": 137,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 137,
                  "end": 139,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "right": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 143,
                        "end": 145,
                        "start_line": 13,
                        "start_col": 6
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 149,
                        "end": 151,
                        "start_line": 13,
                        "start_col": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 143,
                  "end": 151,
                  "start_line": 13,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 137,
            "end": 151,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 137,
        "end": 153,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Ternary": {
              "condition": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 153,
                        "end": 155,
                        "start_line": 14,
                        "start_col": 0
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 159,
                        "end": 161,
                        "start_line": 14,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 153,
                  "end": 161,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 164,
                  "end": 166,
                  "start_line": 14,
                  "start_col": 11
                }
              },
              "else_expr": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 169,
                  "end": 171,
                  "start_line": 14,
                  "start_col": 16
                }
              }
            }
          },
          "span": {
            "start": 153,
            "end": 171,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 153,
        "end": 173,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullCoalesce": {
              "left": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 173,
                        "end": 175,
                        "start_line": 15,
                        "start_col": 0
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 179,
                        "end": 181,
                        "start_line": 15,
                        "start_col": 6
                      }
                    }
                  }
                },
                "span": {
                  "start": 173,
                  "end": 181,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 185,
                  "end": 187,
                  "start_line": 15,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 173,
            "end": 187,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 173,
        "end": 188,
        "start_line": 15,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 188,
    "start_line": 1,
    "start_col": 0
  }
}
