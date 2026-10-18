===source===
<?php
@$i++;
(string) $i--;
-$j++;
!$k--;
clone $o++;
~$a[0]++;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 7,
                      "end": 9
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 7,
                "end": 11
              }
            }
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "String",
              {
                "kind": {
                  "UnaryPostfix": {
                    "operand": {
                      "kind": {
                        "Variable": "i"
                      },
                      "span": {
                        "start": 22,
                        "end": 24
                      }
                    },
                    "op": "PostDecrement"
                  }
                },
                "span": {
                  "start": 22,
                  "end": 26
                }
              }
            ]
          },
          "span": {
            "start": 13,
            "end": 26
          }
        }
      },
      "span": {
        "start": 13,
        "end": 27
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "Negate",
              "operand": {
                "kind": {
                  "UnaryPostfix": {
                    "operand": {
                      "kind": {
                        "Variable": "j"
                      },
                      "span": {
                        "start": 29,
                        "end": 31
                      }
                    },
                    "op": "PostIncrement"
                  }
                },
                "span": {
                  "start": 29,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 33
          }
        }
      },
      "span": {
        "start": 28,
        "end": 34
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BooleanNot",
              "operand": {
                "kind": {
                  "UnaryPostfix": {
                    "operand": {
                      "kind": {
                        "Variable": "k"
                      },
                      "span": {
                        "start": 36,
                        "end": 38
                      }
                    },
                    "op": "PostDecrement"
                  }
                },
                "span": {
                  "start": 36,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 35,
            "end": 40
          }
        }
      },
      "span": {
        "start": 35,
        "end": 41
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "o"
                    },
                    "span": {
                      "start": 48,
                      "end": 50
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 48,
                "end": 52
              }
            }
          },
          "span": {
            "start": 42,
            "end": 52
          }
        }
      },
      "span": {
        "start": 42,
        "end": 53
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "BitwiseNot",
              "operand": {
                "kind": {
                  "UnaryPostfix": {
                    "operand": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 55,
                              "end": 57
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 58,
                              "end": 59
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 55,
                        "end": 60
                      }
                    },
                    "op": "PostIncrement"
                  }
                },
                "span": {
                  "start": 55,
                  "end": 62
                }
              }
            }
          },
          "span": {
            "start": 54,
            "end": 62
          }
        }
      },
      "span": {
        "start": 54,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
