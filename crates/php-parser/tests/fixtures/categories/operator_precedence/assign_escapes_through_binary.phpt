===source===
<?php
$r1 = $a && $b = foo();
for ($i = 0; $i < 10 && $row = fetch(); $i++) {}
$r2 = $a + $b + $c = 5;
$r3 = $a || $b *= 2;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r1"
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 12,
                        "end": 14
                      }
                    },
                    "op": "BooleanAnd",
                    "right": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 18,
                              "end": 20
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Identifier": "foo"
                                  },
                                  "span": {
                                    "start": 23,
                                    "end": 26
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 23,
                              "end": 28
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 28
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 28
          }
        }
      },
      "span": {
        "start": 6,
        "end": 29
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 35,
                      "end": 37
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 40,
                      "end": 41
                    }
                  }
                }
              },
              "span": {
                "start": 35,
                "end": 41
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "i"
                          },
                          "span": {
                            "start": 43,
                            "end": 45
                          }
                        },
                        "op": "Less",
                        "right": {
                          "kind": {
                            "Int": 10
                          },
                          "span": {
                            "start": 48,
                            "end": 50
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 43,
                      "end": 50
                    }
                  },
                  "op": "BooleanAnd",
                  "right": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "Variable": "row"
                          },
                          "span": {
                            "start": 54,
                            "end": 58
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Identifier": "fetch"
                                },
                                "span": {
                                  "start": 61,
                                  "end": 66
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 61,
                            "end": 68
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 68
                    }
                  }
                }
              },
              "span": {
                "start": 43,
                "end": 68
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 70,
                      "end": 72
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 70,
                "end": 74
              }
            }
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 76,
              "end": 78
            }
          }
        }
      },
      "span": {
        "start": 30,
        "end": 78
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r2"
                },
                "span": {
                  "start": 79,
                  "end": 82
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 85,
                              "end": 87
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 90,
                              "end": 92
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 85,
                        "end": 92
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 95,
                              "end": 97
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 5
                            },
                            "span": {
                              "start": 100,
                              "end": 101
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 101
                      }
                    }
                  }
                },
                "span": {
                  "start": 85,
                  "end": 101
                }
              }
            }
          },
          "span": {
            "start": 79,
            "end": 101
          }
        }
      },
      "span": {
        "start": 79,
        "end": 102
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "r3"
                },
                "span": {
                  "start": 103,
                  "end": 106
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 109,
                        "end": 111
                      }
                    },
                    "op": "BooleanOr",
                    "right": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 115,
                              "end": 117
                            }
                          },
                          "op": "Mul",
                          "value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 121,
                              "end": 122
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 115,
                        "end": 122
                      }
                    }
                  }
                },
                "span": {
                  "start": 109,
                  "end": 122
                }
              }
            }
          },
          "span": {
            "start": 103,
            "end": 122
          }
        }
      },
      "span": {
        "start": 103,
        "end": 123
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 123
  }
}
