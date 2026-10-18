===source===
<?php
++$a[0];
++$$a;
++A::$b;
++$a->b()->c;
++f()[0];
$x = - --$a;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
              "operand": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 8,
                        "end": 10
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 8,
                  "end": 13
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 13
          }
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
              "operand": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 18,
                      "end": 20
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 15,
            "end": 20
          }
        }
      },
      "span": {
        "start": 15,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
              "operand": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 24,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 24,
                        "end": 25
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "b"
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
                  "end": 29
                }
              }
            }
          },
          "span": {
            "start": 22,
            "end": 29
          }
        }
      },
      "span": {
        "start": 22,
        "end": 30
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
              "operand": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 33,
                              "end": 35
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 37,
                              "end": 38
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 33,
                        "end": 40
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 42,
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
            }
          },
          "span": {
            "start": 31,
            "end": 43
          }
        }
      },
      "span": {
        "start": 31,
        "end": 44
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
              "operand": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
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
                                  "start": 47,
                                  "end": 48
                                }
                              }
                            },
                            "span": {
                              "start": 47,
                              "end": 48
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 47,
                        "end": 50
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 51,
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
            }
          },
          "span": {
            "start": 45,
            "end": 53
          }
        }
      },
      "span": {
        "start": 45,
        "end": 54
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 55,
                  "end": 57
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "UnaryPrefix": {
                          "op": "PreDecrement",
                          "operand": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 64,
                              "end": 66
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 66
                      }
                    }
                  }
                },
                "span": {
                  "start": 60,
                  "end": 66
                }
              }
            }
          },
          "span": {
            "start": 55,
            "end": 66
          }
        }
      },
      "span": {
        "start": 55,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
