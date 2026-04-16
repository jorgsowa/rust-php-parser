===source===
<?php
A::$b;
$A::$b;
'A'::$b;
('A' . '')::$b;
'A'[0]::$b;
A::$$b;
A::$$c[1];
A::$A::$b;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "member": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 9,
                  "end": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Variable": "A"
                },
                "span": {
                  "start": 13,
                  "end": 15
                }
              },
              "member": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 17,
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
      },
      "span": {
        "start": 13,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "String": "A"
                },
                "span": {
                  "start": 21,
                  "end": 24
                }
              },
              "member": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 26,
                  "end": 28
                }
              }
            }
          },
          "span": {
            "start": 21,
            "end": 28
          }
        }
      },
      "span": {
        "start": 21,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "A"
                          },
                          "span": {
                            "start": 31,
                            "end": 34
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "String": ""
                          },
                          "span": {
                            "start": 37,
                            "end": 39
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 39
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 40
                }
              },
              "member": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 42,
                  "end": 44
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 44
          }
        }
      },
      "span": {
        "start": 30,
        "end": 45
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "String": "A"
                      },
                      "span": {
                        "start": 46,
                        "end": 49
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 50,
                        "end": 51
                      }
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 52
                }
              },
              "member": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 54,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 46,
            "end": 56
          }
        }
      },
      "span": {
        "start": 46,
        "end": 57
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccessDynamic": {
              "class": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 58,
                  "end": 59
                }
              },
              "member": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 62,
                      "end": 64
                    }
                  }
                },
                "span": {
                  "start": 61,
                  "end": 64
                }
              }
            }
          },
          "span": {
            "start": 58,
            "end": 64
          }
        }
      },
      "span": {
        "start": 58,
        "end": 65
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "StaticPropertyAccessDynamic": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 66,
                        "end": 67
                      }
                    },
                    "member": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 70,
                            "end": 72
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 72
                      }
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 72
                }
              },
              "index": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 73,
                  "end": 74
                }
              }
            }
          },
          "span": {
            "start": 66,
            "end": 75
          }
        }
      },
      "span": {
        "start": 66,
        "end": 76
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 77,
                        "end": 78
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 80,
                        "end": 82
                      }
                    }
                  }
                },
                "span": {
                  "start": 77,
                  "end": 82
                }
              },
              "member": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 84,
                  "end": 86
                }
              }
            }
          },
          "span": {
            "start": 77,
            "end": 86
          }
        }
      },
      "span": {
        "start": 77,
        "end": 87
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87
  }
}
