===source===
<?php
echo (1 < 2)::class;
echo ("a" == "b")::class;
echo (1 <=> 2)::class;
echo (0 && $x)::class;
echo (1 xor 0)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
===errors >=8.0===
Cannot use "::class" on true
Cannot use "::class" on false
Cannot use "::class" on int
Cannot use "::class" on false
Cannot use "::class" on true
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type bool in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on true in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
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
                              "start": 12,
                              "end": 13
                            }
                          },
                          "op": "Less",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 16,
                              "end": 17
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
                  "span": {
                    "start": 11,
                    "end": 18
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 20,
                    "end": 25
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "String": "a"
                            },
                            "span": {
                              "start": 33,
                              "end": 36
                            }
                          },
                          "op": "Equal",
                          "right": {
                            "kind": {
                              "String": "b"
                            },
                            "span": {
                              "start": 40,
                              "end": 43
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 43
                      }
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 44
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 46,
                    "end": 51
                  }
                }
              }
            },
            "span": {
              "start": 32,
              "end": 51
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 52
      }
    },
    {
      "kind": {
        "Echo": [
          {
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
                              "start": 59,
                              "end": 60
                            }
                          },
                          "op": "Spaceship",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 65,
                              "end": 66
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 66
                      }
                    }
                  },
                  "span": {
                    "start": 58,
                    "end": 67
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 69,
                    "end": 74
                  }
                }
              }
            },
            "span": {
              "start": 58,
              "end": 74
            }
          }
        ]
      },
      "span": {
        "start": 53,
        "end": 75
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Parenthesized": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 82,
                              "end": 83
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 87,
                              "end": 89
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 82,
                        "end": 89
                      }
                    }
                  },
                  "span": {
                    "start": 81,
                    "end": 90
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 92,
                    "end": 97
                  }
                }
              }
            },
            "span": {
              "start": 81,
              "end": 97
            }
          }
        ]
      },
      "span": {
        "start": 76,
        "end": 98
      }
    },
    {
      "kind": {
        "Echo": [
          {
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
                              "start": 105,
                              "end": 106
                            }
                          },
                          "op": "LogicalXor",
                          "right": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 111,
                              "end": 112
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 105,
                        "end": 112
                      }
                    }
                  },
                  "span": {
                    "start": 104,
                    "end": 113
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 115,
                    "end": 120
                  }
                }
              }
            },
            "span": {
              "start": 104,
              "end": 120
            }
          }
        ]
      },
      "span": {
        "start": 99,
        "end": 121
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 121
  }
}
