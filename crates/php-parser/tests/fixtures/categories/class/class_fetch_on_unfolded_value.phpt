===source===
<?php
echo (1 / 0)::class;
echo (5 % 0)::class;
echo (1 << -1)::class;
echo (1 && $x)::class;
echo (FOO)::class;
trait T { function f() { echo (__CLASS__)::class; } }
===errors <=7.4===
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
Cannot use ::class with dynamic class name
===php_error <=7.4===
PHP Fatal error:  Cannot use ::class with dynamic class name in Standard input code on line 2
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
                          "op": "Div",
                          "right": {
                            "kind": {
                              "Int": 0
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
                              "Int": 5
                            },
                            "span": {
                              "start": 33,
                              "end": 34
                            }
                          },
                          "op": "Mod",
                          "right": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 37,
                              "end": 38
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 38
                      }
                    }
                  },
                  "span": {
                    "start": 32,
                    "end": 39
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 41,
                    "end": 46
                  }
                }
              }
            },
            "span": {
              "start": 32,
              "end": 46
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 47
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
                              "start": 54,
                              "end": 55
                            }
                          },
                          "op": "ShiftLeft",
                          "right": {
                            "kind": {
                              "UnaryPrefix": {
                                "op": "Negate",
                                "operand": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 60,
                                    "end": 61
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 59,
                              "end": 61
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 54,
                        "end": 61
                      }
                    }
                  },
                  "span": {
                    "start": 53,
                    "end": 62
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 64,
                    "end": 69
                  }
                }
              }
            },
            "span": {
              "start": 53,
              "end": 69
            }
          }
        ]
      },
      "span": {
        "start": 48,
        "end": 70
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
                              "start": 77,
                              "end": 78
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 82,
                              "end": 84
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 77,
                        "end": 84
                      }
                    }
                  },
                  "span": {
                    "start": 76,
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
              "start": 76,
              "end": 92
            }
          }
        ]
      },
      "span": {
        "start": 71,
        "end": 93
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
                        "Name": {
                          "parts": [
                            "FOO"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 100,
                            "end": 103
                          }
                        }
                      },
                      "span": {
                        "start": 100,
                        "end": 103
                      }
                    }
                  },
                  "span": {
                    "start": 99,
                    "end": 104
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 106,
                    "end": 111
                  }
                }
              }
            },
            "span": {
              "start": 99,
              "end": 111
            }
          }
        ]
      },
      "span": {
        "start": 94,
        "end": 112
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 119,
              "end": 120
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 132,
                      "end": 133
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
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
                                        "MagicConst": "Class"
                                      },
                                      "span": {
                                        "start": 144,
                                        "end": 153
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 143,
                                    "end": 154
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "class"
                                  },
                                  "span": {
                                    "start": 156,
                                    "end": 161
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 143,
                              "end": 161
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 138,
                        "end": 162
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 123,
                "end": 164
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 113,
        "end": 166
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 166
  }
}
