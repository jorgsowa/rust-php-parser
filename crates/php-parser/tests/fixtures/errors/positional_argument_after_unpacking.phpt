===source===
<?php
var_dump(...[1, 2, 3], 4);
f(...$a, ...$b, 4);
new A(...$a, 1);
$o->m(...$a, 1);
A::m(...$a, 1);
===errors===
Cannot use positional argument after argument unpacking
Cannot use positional argument after argument unpacking
Cannot use positional argument after argument unpacking
Cannot use positional argument after argument unpacking
Cannot use positional argument after argument unpacking
===php_error===
PHP Fatal error:  Cannot use positional argument after argument unpacking in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "var_dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 14
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
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
                                  "start": 19,
                                  "end": 20
                                }
                              }
                            },
                            "span": {
                              "start": 19,
                              "end": 20
                            }
                          },
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 22,
                                  "end": 23
                                }
                              }
                            },
                            "span": {
                              "start": 22,
                              "end": 23
                            }
                          },
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 3
                                },
                                "span": {
                                  "start": 25,
                                  "end": 26
                                }
                              }
                            },
                            "span": {
                              "start": 25,
                              "end": 26
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 18,
                        "end": 27
                      }
                    }
                  },
                  "span": {
                    "start": 15,
                    "end": 27
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    }
                  },
                  "span": {
                    "start": 29,
                    "end": 30
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Expression": {
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
                      "start": 33,
                      "end": 34
                    }
                  }
                },
                "span": {
                  "start": 33,
                  "end": 34
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 38,
                        "end": 40
                      }
                    }
                  },
                  "span": {
                    "start": 35,
                    "end": 40
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 45,
                        "end": 47
                      }
                    }
                  },
                  "span": {
                    "start": 42,
                    "end": 47
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 49,
                        "end": 50
                      }
                    }
                  },
                  "span": {
                    "start": 49,
                    "end": 50
                  }
                }
              ]
            }
          },
          "span": {
            "start": 33,
            "end": 51
          }
        }
      },
      "span": {
        "start": 33,
        "end": 52
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 57,
                      "end": 58
                    }
                  }
                },
                "span": {
                  "start": 57,
                  "end": 58
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 62,
                        "end": 64
                      }
                    }
                  },
                  "span": {
                    "start": 59,
                    "end": 64
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 66,
                        "end": 67
                      }
                    }
                  },
                  "span": {
                    "start": 66,
                    "end": 67
                  }
                }
              ]
            }
          },
          "span": {
            "start": 53,
            "end": 68
          }
        }
      },
      "span": {
        "start": 53,
        "end": 69
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 70,
                  "end": 72
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 74,
                  "end": 75
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 79,
                        "end": 81
                      }
                    }
                  },
                  "span": {
                    "start": 76,
                    "end": 81
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 83,
                        "end": 84
                      }
                    }
                  },
                  "span": {
                    "start": 83,
                    "end": 84
                  }
                }
              ]
            }
          },
          "span": {
            "start": 70,
            "end": 85
          }
        }
      },
      "span": {
        "start": 70,
        "end": 86
      }
    },
    {
      "kind": {
        "Expression": {
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
                      "start": 87,
                      "end": 88
                    }
                  }
                },
                "span": {
                  "start": 87,
                  "end": 88
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 90,
                  "end": 91
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 95,
                        "end": 97
                      }
                    }
                  },
                  "span": {
                    "start": 92,
                    "end": 97
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 99,
                        "end": 100
                      }
                    }
                  },
                  "span": {
                    "start": 99,
                    "end": 100
                  }
                }
              ]
            }
          },
          "span": {
            "start": 87,
            "end": 101
          }
        }
      },
      "span": {
        "start": 87,
        "end": 102
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102
  }
}
