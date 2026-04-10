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
                  "end": 20
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 23,
                  "end": 25
                }
              },
              "else_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 28,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 18,
            "end": 30
          }
        }
      },
      "span": {
        "start": 18,
        "end": 31
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
                  "end": 34
                }
              },
              "then_expr": null,
              "else_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 38,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 32,
            "end": 40
          }
        }
      },
      "span": {
        "start": 32,
        "end": 41
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
                            "end": 60
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 63,
                            "end": 65
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 68,
                            "end": 70
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 58,
                      "end": 70
                    }
                  }
                },
                "span": {
                  "start": 57,
                  "end": 71
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 74,
                  "end": 76
                }
              },
              "else_expr": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 79,
                  "end": 81
                }
              }
            }
          },
          "span": {
            "start": 57,
            "end": 81
          }
        }
      },
      "span": {
        "start": 57,
        "end": 82
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
                  "end": 85
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 88,
                  "end": 90
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
                            "end": 96
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Variable": "d"
                          },
                          "span": {
                            "start": 99,
                            "end": 101
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "e"
                          },
                          "span": {
                            "start": 104,
                            "end": 106
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 94,
                      "end": 106
                    }
                  }
                },
                "span": {
                  "start": 93,
                  "end": 107
                }
              }
            }
          },
          "span": {
            "start": 83,
            "end": 107
          }
        }
      },
      "span": {
        "start": 83,
        "end": 108
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
                  "end": 129
                }
              },
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 133,
                  "end": 135
                }
              }
            }
          },
          "span": {
            "start": 127,
            "end": 135
          }
        }
      },
      "span": {
        "start": 127,
        "end": 136
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
                  "end": 139
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
                        "end": 145
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "c"
                      },
                      "span": {
                        "start": 149,
                        "end": 151
                      }
                    }
                  }
                },
                "span": {
                  "start": 143,
                  "end": 151
                }
              }
            }
          },
          "span": {
            "start": 137,
            "end": 151
          }
        }
      },
      "span": {
        "start": 137,
        "end": 152
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
                        "end": 155
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 159,
                        "end": 161
                      }
                    }
                  }
                },
                "span": {
                  "start": 153,
                  "end": 161
                }
              },
              "then_expr": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 164,
                  "end": 166
                }
              },
              "else_expr": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 169,
                  "end": 171
                }
              }
            }
          },
          "span": {
            "start": 153,
            "end": 171
          }
        }
      },
      "span": {
        "start": 153,
        "end": 172
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
                        "end": 175
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 179,
                        "end": 181
                      }
                    }
                  }
                },
                "span": {
                  "start": 173,
                  "end": 181
                }
              },
              "right": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 185,
                  "end": 187
                }
              }
            }
          },
          "span": {
            "start": 173,
            "end": 187
          }
        }
      },
      "span": {
        "start": 173,
        "end": 188
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 188
  }
}
