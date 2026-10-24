===source===
<?php
"$a[1_2] $a[0x1_f] $a[0b1_0] $a[-1_0] $a[-0x1] $a[0_7] $a[_1]";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 7,
                          "end": 9
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "1_2"
                        },
                        "span": {
                          "start": 10,
                          "end": 13
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
              {
                "Literal": " "
              },
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 15,
                          "end": 17
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "0x1_f"
                        },
                        "span": {
                          "start": 18,
                          "end": 23
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 15,
                    "end": 24
                  }
                }
              },
              {
                "Literal": " "
              },
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 25,
                          "end": 27
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "0b1_0"
                        },
                        "span": {
                          "start": 28,
                          "end": 33
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 25,
                    "end": 34
                  }
                }
              },
              {
                "Literal": " "
              },
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 35,
                          "end": 37
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "-1_0"
                        },
                        "span": {
                          "start": 38,
                          "end": 42
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 35,
                    "end": 43
                  }
                }
              },
              {
                "Literal": " "
              },
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 44,
                          "end": 46
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "-0x1"
                        },
                        "span": {
                          "start": 47,
                          "end": 51
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 44,
                    "end": 52
                  }
                }
              },
              {
                "Literal": " "
              },
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 53,
                          "end": 55
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "0_7"
                        },
                        "span": {
                          "start": 56,
                          "end": 59
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 53,
                    "end": 60
                  }
                }
              },
              {
                "Literal": " "
              },
              {
                "Expr": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 61,
                          "end": 63
                        }
                      },
                      "index": {
                        "kind": {
                          "String": "_1"
                        },
                        "span": {
                          "start": 64,
                          "end": 66
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 61,
                    "end": 67
                  }
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 68
          }
        }
      },
      "span": {
        "start": 6,
        "end": 69
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 69
  }
}
