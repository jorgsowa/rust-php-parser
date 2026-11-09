===source===
<?php
$a instanceof 1;
$a instanceof "A";
$a instanceof f();
$a instanceof [1];
$a instanceof A::B;
$a instanceof $b();
$a instanceof $b->c();
$a instanceof A::m();
$a instanceof -1;
$a instanceof !$b;
===errors===
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
right side of instanceof must be a class name, a variable or a parenthesized expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '1' (T_LNUMBER) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected integer "1" in Standard input code on line 2
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
                  "end": 8
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 20,
                  "end": 21
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
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
                  "start": 23,
                  "end": 25
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "String": "A"
                },
                "span": {
                  "start": 37,
                  "end": 40
                }
              }
            }
          },
          "span": {
            "start": 23,
            "end": 40
          }
        }
      },
      "span": {
        "start": 23,
        "end": 41
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
                  "start": 42,
                  "end": 44
                }
              },
              "op": "Instanceof",
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
                            "start": 56,
                            "end": 57
                          }
                        }
                      },
                      "span": {
                        "start": 56,
                        "end": 57
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 56,
                  "end": 59
                }
              }
            }
          },
          "span": {
            "start": 42,
            "end": 59
          }
        }
      },
      "span": {
        "start": 42,
        "end": 60
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
                  "start": 61,
                  "end": 63
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 76,
                            "end": 77
                          }
                        }
                      },
                      "span": {
                        "start": 76,
                        "end": 77
                      }
                    }
                  ]
                },
                "span": {
                  "start": 75,
                  "end": 78
                }
              }
            }
          },
          "span": {
            "start": 61,
            "end": 78
          }
        }
      },
      "span": {
        "start": 61,
        "end": 79
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
                  "start": 80,
                  "end": 82
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 94,
                            "end": 95
                          }
                        }
                      },
                      "span": {
                        "start": 94,
                        "end": 95
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "B"
                      },
                      "span": {
                        "start": 97,
                        "end": 98
                      }
                    }
                  }
                },
                "span": {
                  "start": 94,
                  "end": 98
                }
              }
            }
          },
          "span": {
            "start": 80,
            "end": 98
          }
        }
      },
      "span": {
        "start": 80,
        "end": 99
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
                  "start": 100,
                  "end": 102
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 114,
                        "end": 116
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 114,
                  "end": 118
                }
              }
            }
          },
          "span": {
            "start": 100,
            "end": 118
          }
        }
      },
      "span": {
        "start": 100,
        "end": 119
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
                  "start": 120,
                  "end": 122
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 134,
                        "end": 136
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 138,
                        "end": 139
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 134,
                  "end": 141
                }
              }
            }
          },
          "span": {
            "start": 120,
            "end": 141
          }
        }
      },
      "span": {
        "start": 120,
        "end": 142
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
                  "start": 143,
                  "end": 145
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 157,
                            "end": 158
                          }
                        }
                      },
                      "span": {
                        "start": 157,
                        "end": 158
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "m"
                      },
                      "span": {
                        "start": 160,
                        "end": 161
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 157,
                  "end": 163
                }
              }
            }
          },
          "span": {
            "start": 143,
            "end": 163
          }
        }
      },
      "span": {
        "start": 143,
        "end": 164
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
                  "start": 165,
                  "end": 167
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 180,
                        "end": 181
                      }
                    }
                  }
                },
                "span": {
                  "start": 179,
                  "end": 181
                }
              }
            }
          },
          "span": {
            "start": 165,
            "end": 181
          }
        }
      },
      "span": {
        "start": 165,
        "end": 182
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
                  "start": 183,
                  "end": 185
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "BooleanNot",
                    "operand": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 198,
                        "end": 200
                      }
                    }
                  }
                },
                "span": {
                  "start": 197,
                  "end": 200
                }
              }
            }
          },
          "span": {
            "start": 183,
            "end": 200
          }
        }
      },
      "span": {
        "start": 183,
        "end": 201
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 201
  }
}
