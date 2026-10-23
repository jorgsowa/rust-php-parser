===source===
<?php
echo "{$a + 1}";
echo "{$a $b}";
echo "{$a = 1}";
echo "{$g{0}}";
echo "${a + }";
echo <<<EOT
  {$a->}
  EOT;
echo "{$a->b()[0]?->c} {$a::$b} {$a::f()} {$$a} {${"x"}} ${a + 1}";
===errors <=7.4===
only a variable, property, index or call can be interpolated with '{$...}'
expected '}', found variable
only a variable, property, index or call can be interpolated with '{$...}'
expected expression, found end of file
expected member name, found end of file
'nullsafe operator (?->)' requires PHP 8.0 or higher
===errors >=8.0===
only a variable, property, index or call can be interpolated with '{$...}'
expected '}', found variable
only a variable, property, index or call can be interpolated with '{$...}'
Array and string offset access syntax with curly braces is no longer supported
expected expression, found end of file
expected member name, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '+', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "+", expecting "->" or "?->" or "{" or "[" in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "+", expecting "->" or "?->" or "[" in Standard input code on line 2
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
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 18,
                            "end": 19
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 19
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 30,
                      "end": 32
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 28,
              "end": 37
            }
          }
        ]
      },
      "span": {
        "start": 23,
        "end": 38
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 46,
                            "end": 48
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 51,
                            "end": 52
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 46,
                      "end": 52
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 44,
              "end": 54
            }
          }
        ]
      },
      "span": {
        "start": 39,
        "end": 55
      }
    },
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
                            "Variable": "g"
                          },
                          "span": {
                            "start": 63,
                            "end": 65
                          }
                        },
                        "index": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 66,
                            "end": 67
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 68
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 61,
              "end": 70
            }
          }
        ]
      },
      "span": {
        "start": 56,
        "end": 71
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "a"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 80,
                                    "end": 81
                                  }
                                }
                              },
                              "span": {
                                "start": 80,
                                "end": 81
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": "Error",
                              "span": {
                                "start": 83,
                                "end": 83
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 80,
                          "end": 83
                        }
                      }
                    },
                    "span": {
                      "start": 78,
                      "end": 85
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 77,
              "end": 86
            }
          }
        ]
      },
      "span": {
        "start": 72,
        "end": 87
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Heredoc": {
                "label": "EOT",
                "parts": [
                  {
                    "Expr": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 103,
                              "end": 105
                            }
                          },
                          "property": {
                            "kind": "Error",
                            "span": {
                              "start": 107,
                              "end": 107
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 103,
                        "end": 107
                      }
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 93,
              "end": 114
            }
          }
        ]
      },
      "span": {
        "start": 88,
        "end": 115
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "NullsafePropertyAccess": {
                        "object": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 123,
                                        "end": 125
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 127,
                                        "end": 128
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 123,
                                  "end": 130
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 131,
                                  "end": 132
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 123,
                            "end": 133
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "c"
                          },
                          "span": {
                            "start": 136,
                            "end": 137
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 123,
                      "end": 137
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "StaticPropertyAccess": {
                        "class": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 140,
                            "end": 142
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 144,
                            "end": 146
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 140,
                      "end": 146
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "StaticMethodCall": {
                        "class": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 149,
                            "end": 151
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "f"
                          },
                          "span": {
                            "start": 153,
                            "end": 154
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 149,
                      "end": 156
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 160,
                          "end": 162
                        }
                      }
                    },
                    "span": {
                      "start": 159,
                      "end": 162
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "String": "x"
                        },
                        "span": {
                          "start": 167,
                          "end": 170
                        }
                      }
                    },
                    "span": {
                      "start": 165,
                      "end": 171
                    }
                  }
                },
                {
                  "Literal": " "
                },
                {
                  "Expr": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "a"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 175,
                                    "end": 176
                                  }
                                }
                              },
                              "span": {
                                "start": 175,
                                "end": 176
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 179,
                                "end": 180
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 175,
                          "end": 180
                        }
                      }
                    },
                    "span": {
                      "start": 173,
                      "end": 181
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 121,
              "end": 182
            }
          }
        ]
      },
      "span": {
        "start": 116,
        "end": 183
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 183
  }
}
