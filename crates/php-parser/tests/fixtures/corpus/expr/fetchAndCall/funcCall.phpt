===source===
<?php

// function name variations
a();
$a();
${'a'}();
$$a();
$$$a();
$a['b']();
$a->b['c']();

// array dereferencing
a()['b'];
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
                  "Identifier": "a"
                },
                "span": {
                  "start": 35,
                  "end": 36
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 35,
            "end": 38
          }
        }
      },
      "span": {
        "start": 35,
        "end": 39
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 40,
                  "end": 42
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 40,
            "end": 44
          }
        }
      },
      "span": {
        "start": 40,
        "end": 45
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 48,
                      "end": 51
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 52
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 46,
            "end": 54
          }
        }
      },
      "span": {
        "start": 46,
        "end": 55
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 57,
                      "end": 59
                    }
                  }
                },
                "span": {
                  "start": 56,
                  "end": 59
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 56,
            "end": 61
          }
        }
      },
      "span": {
        "start": 56,
        "end": 62
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "VariableVariable": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 65,
                          "end": 67
                        }
                      }
                    },
                    "span": {
                      "start": 64,
                      "end": 67
                    }
                  }
                },
                "span": {
                  "start": 63,
                  "end": 67
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 63,
            "end": 69
          }
        }
      },
      "span": {
        "start": 63,
        "end": 70
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
                        "Variable": "a"
                      },
                      "span": {
                        "start": 71,
                        "end": 73
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 74,
                        "end": 77
                      }
                    }
                  }
                },
                "span": {
                  "start": 71,
                  "end": 78
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 71,
            "end": 80
          }
        }
      },
      "span": {
        "start": 71,
        "end": 81
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
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 82,
                              "end": 84
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 86,
                              "end": 87
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 82,
                        "end": 87
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "c"
                      },
                      "span": {
                        "start": 88,
                        "end": 91
                      }
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 92
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 82,
            "end": 94
          }
        }
      },
      "span": {
        "start": 82,
        "end": 95
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 120,
                        "end": 121
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 120,
                  "end": 123
                }
              },
              "index": {
                "kind": {
                  "String": "b"
                },
                "span": {
                  "start": 124,
                  "end": 127
                }
              }
            }
          },
          "span": {
            "start": 120,
            "end": 128
          }
        }
      },
      "span": {
        "start": 120,
        "end": 129
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 129
  }
}
