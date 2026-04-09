===source===
<?php
$a < $b;
$a <= $b;
$a > $b;
$a >= $b;
$a == $b;
$a === $b;
$a != $b;
$a !== $b;
$a <=> $b;
$a instanceof B;
$a instanceof $b;
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Less",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 11,
                  "end": 13,
                  "start_line": 2,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15,
        "start_line": 2,
        "start_col": 0
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
                  "start": 15,
                  "end": 17,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "LessOrEqual",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 21,
                  "end": 23,
                  "start_line": 3,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 15,
            "end": 23,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 15,
        "end": 25,
        "start_line": 3,
        "start_col": 0
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
                  "start": 25,
                  "end": 27,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "op": "Greater",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 30,
                  "end": 32,
                  "start_line": 4,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 32,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 34,
        "start_line": 4,
        "start_col": 0
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
                  "start": 34,
                  "end": 36,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "op": "GreaterOrEqual",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 40,
                  "end": 42,
                  "start_line": 5,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 42,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 34,
        "end": 44,
        "start_line": 5,
        "start_col": 0
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
                  "start": 44,
                  "end": 46,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Equal",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 50,
                  "end": 52,
                  "start_line": 6,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 44,
            "end": 52,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 44,
        "end": 54,
        "start_line": 6,
        "start_col": 0
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
                  "start": 54,
                  "end": 56,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "op": "Identical",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 61,
                  "end": 63,
                  "start_line": 7,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 54,
            "end": 63,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 54,
        "end": 65,
        "start_line": 7,
        "start_col": 0
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
                  "start": 65,
                  "end": 67,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "op": "NotEqual",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 71,
                  "end": 73,
                  "start_line": 8,
                  "start_col": 6
                }
              }
            }
          },
          "span": {
            "start": 65,
            "end": 73,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 65,
        "end": 75,
        "start_line": 8,
        "start_col": 0
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
                  "start": 75,
                  "end": 77,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "op": "NotIdentical",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 82,
                  "end": 84,
                  "start_line": 9,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 75,
            "end": 84,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 75,
        "end": 86,
        "start_line": 9,
        "start_col": 0
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
                  "start": 86,
                  "end": 88,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "op": "Spaceship",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 93,
                  "end": 95,
                  "start_line": 10,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 86,
            "end": 95,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 86,
        "end": 97,
        "start_line": 10,
        "start_col": 0
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
                  "start": 97,
                  "end": 99,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Identifier": "B"
                },
                "span": {
                  "start": 111,
                  "end": 112,
                  "start_line": 11,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 97,
            "end": 112,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 97,
        "end": 114,
        "start_line": 11,
        "start_col": 0
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
                  "start": 114,
                  "end": 116,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 128,
                  "end": 130,
                  "start_line": 12,
                  "start_col": 14
                }
              }
            }
          },
          "span": {
            "start": 114,
            "end": 130,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 114,
        "end": 131,
        "start_line": 12,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 131,
    "start_line": 1,
    "start_col": 0
  }
}
