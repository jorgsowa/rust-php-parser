===source===
<?php
echo "$a[k] $a[0] $a[-1] $a[0x1F] $a[01] $a[$i] $a[_x] $a[é]";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
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
                            "start": 12,
                            "end": 14
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "k"
                          },
                          "span": {
                            "start": 15,
                            "end": 16
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
                            "start": 18,
                            "end": 20
                          }
                        },
                        "index": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 21,
                            "end": 22
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 18,
                      "end": 23
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
                            "start": 24,
                            "end": 26
                          }
                        },
                        "index": {
                          "kind": {
                            "Int": -1
                          },
                          "span": {
                            "start": 27,
                            "end": 29
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 30
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
                            "start": 31,
                            "end": 33
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "0x1F"
                          },
                          "span": {
                            "start": 34,
                            "end": 38
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 39
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
                            "start": 40,
                            "end": 42
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "01"
                          },
                          "span": {
                            "start": 43,
                            "end": 45
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 46
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
                            "start": 47,
                            "end": 49
                          }
                        },
                        "index": {
                          "kind": {
                            "Variable": "i"
                          },
                          "span": {
                            "start": 50,
                            "end": 52
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 53
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
                            "start": 54,
                            "end": 56
                          }
                        },
                        "index": {
                          "kind": {
                            "String": "_x"
                          },
                          "span": {
                            "start": 57,
                            "end": 59
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 54,
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
                            "String": "é"
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
              "start": 11,
              "end": 68
            }
          }
        ]
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
