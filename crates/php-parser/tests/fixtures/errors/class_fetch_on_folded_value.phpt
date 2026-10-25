===source===
<?php
echo (-1)::class;
echo (!1)::class;
echo (Foo::class)::class;
echo (1 . 2)::class;
echo (~1)::class;
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
===errors 8.0-8.1===
Cannot use "::class" on value of type int
Cannot use "::class" on value of type bool
Cannot use "::class" on value of type string
Cannot use "::class" on value of type string
Cannot use "::class" on value of type int
===errors 8.2===
Cannot use "::class" on value of type int
Cannot use "::class" on value of type bool
Cannot use "::class" on value of type string
Cannot use "::class" on value of type int
===errors >=8.3===
Cannot use "::class" on int
Cannot use "::class" on false
Cannot use "::class" on string
Cannot use "::class" on int
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
===php_error 8.0-8.2===
PHP Fatal error:  Cannot use "::class" on value of type int in Standard input code on line 2
===php_error >=8.3===
PHP Fatal error:  Cannot use "::class" on int in Standard input code on line 2
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
                        "UnaryPrefix": {
                          "op": "Negate",
                          "operand": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 13,
                              "end": 14
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    }
                  },
                  "span": {
                    "start": 11,
                    "end": 15
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 17,
                    "end": 22
                  }
                }
              }
            },
            "span": {
              "start": 11,
              "end": 22
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 23
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
                        "UnaryPrefix": {
                          "op": "BooleanNot",
                          "operand": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 31,
                              "end": 32
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 32
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 33
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 35,
                    "end": 40
                  }
                }
              }
            },
            "span": {
              "start": 29,
              "end": 40
            }
          }
        ]
      },
      "span": {
        "start": 24,
        "end": 41
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
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 48,
                                  "end": 51
                                }
                              }
                            },
                            "span": {
                              "start": 48,
                              "end": 51
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 53,
                              "end": 58
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 48,
                        "end": 58
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 59
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 61,
                    "end": 66
                  }
                }
              }
            },
            "span": {
              "start": 47,
              "end": 66
            }
          }
        ]
      },
      "span": {
        "start": 42,
        "end": 67
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
                              "start": 74,
                              "end": 75
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 78,
                              "end": 79
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 74,
                        "end": 79
                      }
                    }
                  },
                  "span": {
                    "start": 73,
                    "end": 80
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 82,
                    "end": 87
                  }
                }
              }
            },
            "span": {
              "start": 73,
              "end": 87
            }
          }
        ]
      },
      "span": {
        "start": 68,
        "end": 88
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
                        "UnaryPrefix": {
                          "op": "BitwiseNot",
                          "operand": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 96,
                              "end": 97
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 97
                      }
                    }
                  },
                  "span": {
                    "start": 94,
                    "end": 98
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 100,
                    "end": 105
                  }
                }
              }
            },
            "span": {
              "start": 94,
              "end": 105
            }
          }
        ]
      },
      "span": {
        "start": 89,
        "end": 106
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 106
  }
}
