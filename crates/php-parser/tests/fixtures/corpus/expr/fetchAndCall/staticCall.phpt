===source===
<?php

// method name variations
A::b();
A::{'b'}();
A::$b();
A::$b['c']();
A::$b['c']['d']();

// array dereferencing
A::b()['c'];

// class name variations
static::b();
$a::b();
${'a'}::b();
$a['b']::c();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 33,
                  "end": 34
                }
              },
              "method": "b",
              "args": []
            }
          },
          "span": {
            "start": 33,
            "end": 39
          }
        }
      },
      "span": {
        "start": 33,
        "end": 40
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "ClassConstAccessDynamic": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 41,
                        "end": 42
                      }
                    },
                    "member": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 45,
                        "end": 48
                      }
                    }
                  }
                },
                "span": {
                  "start": 41,
                  "end": 51
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 41,
            "end": 51
          }
        }
      },
      "span": {
        "start": 41,
        "end": 52
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 53,
                        "end": 54
                      }
                    },
                    "member": "b"
                  }
                },
                "span": {
                  "start": 53,
                  "end": 58
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 53,
            "end": 60
          }
        }
      },
      "span": {
        "start": 53,
        "end": 61
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "StaticPropertyAccess": {
                          "class": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 62,
                              "end": 63
                            }
                          },
                          "member": "b"
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 67
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "c"
                      },
                      "span": {
                        "start": 68,
                        "end": 71
                      }
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 72
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 62,
            "end": 74
          }
        }
      },
      "span": {
        "start": 62,
        "end": 75
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "StaticPropertyAccess": {
                                "class": {
                                  "kind": {
                                    "Identifier": "A"
                                  },
                                  "span": {
                                    "start": 76,
                                    "end": 77
                                  }
                                },
                                "member": "b"
                              }
                            },
                            "span": {
                              "start": 76,
                              "end": 81
                            }
                          },
                          "index": {
                            "kind": {
                              "String": "c"
                            },
                            "span": {
                              "start": 82,
                              "end": 85
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 76,
                        "end": 86
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "d"
                      },
                      "span": {
                        "start": 87,
                        "end": 90
                      }
                    }
                  }
                },
                "span": {
                  "start": 76,
                  "end": 91
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 76,
            "end": 93
          }
        }
      },
      "span": {
        "start": 76,
        "end": 94
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 119,
                        "end": 120
                      }
                    },
                    "method": "b",
                    "args": []
                  }
                },
                "span": {
                  "start": 119,
                  "end": 125
                }
              },
              "index": {
                "kind": {
                  "String": "c"
                },
                "span": {
                  "start": 126,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 119,
            "end": 130
          }
        }
      },
      "span": {
        "start": 119,
        "end": 131
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "static"
                },
                "span": {
                  "start": 158,
                  "end": 164
                }
              },
              "method": "b",
              "args": []
            }
          },
          "span": {
            "start": 158,
            "end": 169
          }
        }
      },
      "span": {
        "start": 158,
        "end": 170
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 171,
                  "end": 173
                }
              },
              "method": "b",
              "args": []
            }
          },
          "span": {
            "start": 171,
            "end": 178
          }
        }
      },
      "span": {
        "start": 171,
        "end": 179
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 182,
                      "end": 185
                    }
                  }
                },
                "span": {
                  "start": 180,
                  "end": 185
                }
              },
              "method": "b",
              "args": []
            }
          },
          "span": {
            "start": 180,
            "end": 191
          }
        }
      },
      "span": {
        "start": 180,
        "end": 192
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 193,
                        "end": 195
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 196,
                        "end": 199
                      }
                    }
                  }
                },
                "span": {
                  "start": 193,
                  "end": 200
                }
              },
              "method": "c",
              "args": []
            }
          },
          "span": {
            "start": 193,
            "end": 205
          }
        }
      },
      "span": {
        "start": 193,
        "end": 206
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 206
  }
}
