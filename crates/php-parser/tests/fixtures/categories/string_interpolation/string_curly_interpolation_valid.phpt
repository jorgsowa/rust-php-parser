===source===
<?php
echo "{$a->b()[0]?->c} {$a::$b} {$a::f()} {$$a} {${"x"}} ${a + 1}";
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 2
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
                                        "start": 13,
                                        "end": 15
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 17,
                                        "end": 18
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 13,
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
                            "start": 13,
                            "end": 23
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "c"
                          },
                          "span": {
                            "start": 26,
                            "end": 27
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 27
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
                            "start": 30,
                            "end": 32
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 34,
                            "end": 36
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36
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
                            "start": 39,
                            "end": 41
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "f"
                          },
                          "span": {
                            "start": 43,
                            "end": 44
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 39,
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
                      "VariableVariable": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 50,
                          "end": 52
                        }
                      }
                    },
                    "span": {
                      "start": 49,
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
                      "VariableVariable": {
                        "kind": {
                          "String": "x"
                        },
                        "span": {
                          "start": 57,
                          "end": 60
                        }
                      }
                    },
                    "span": {
                      "start": 55,
                      "end": 61
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
                                    "start": 65,
                                    "end": 66
                                  }
                                }
                              },
                              "span": {
                                "start": 65,
                                "end": 66
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 69,
                                "end": 70
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 65,
                          "end": 70
                        }
                      }
                    },
                    "span": {
                      "start": 63,
                      "end": 71
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 72
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
