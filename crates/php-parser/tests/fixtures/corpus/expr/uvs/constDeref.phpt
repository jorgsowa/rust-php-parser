===source===
<?php

A->length;
A->length();
A[0];
A[0][1][2];

A::B[0];
A::B[0][1][2];
A::B->length;
A::B->length();
A::B::C;
A::B::$c;
A::B::c();

__FUNCTION__[0];
__FUNCTION__->length;
__FUNCIONT__->length();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 7,
                  "end": 8
                }
              },
              "property": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 10,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 16
          }
        }
      },
      "span": {
        "start": 7,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 18,
                  "end": 19
                }
              },
              "method": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 21,
                  "end": 27
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 18,
            "end": 29
          }
        }
      },
      "span": {
        "start": 18,
        "end": 30
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Identifier": "A"
                },
                "span": {
                  "start": 31,
                  "end": 32
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 33,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 31,
            "end": 35
          }
        }
      },
      "span": {
        "start": 31,
        "end": 36
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Identifier": "A"
                            },
                            "span": {
                              "start": 37,
                              "end": 38
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 39,
                              "end": 40
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 37,
                        "end": 41
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 42,
                        "end": 43
                      }
                    }
                  }
                },
                "span": {
                  "start": 37,
                  "end": 44
                }
              },
              "index": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 45,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 37,
            "end": 47
          }
        }
      },
      "span": {
        "start": 37,
        "end": 48
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 50,
                        "end": 51
                      }
                    },
                    "member": {
                      "name": "B",
                      "span": {
                        "start": 53,
                        "end": 54
                      }
                    }
                  }
                },
                "span": {
                  "start": 50,
                  "end": 54
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 55,
                  "end": 56
                }
              }
            }
          },
          "span": {
            "start": 50,
            "end": 57
          }
        }
      },
      "span": {
        "start": 50,
        "end": 58
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Identifier": "A"
                                  },
                                  "span": {
                                    "start": 59,
                                    "end": 60
                                  }
                                },
                                "member": {
                                  "name": "B",
                                  "span": {
                                    "start": 62,
                                    "end": 63
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 59,
                              "end": 63
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 64,
                              "end": 65
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 59,
                        "end": 66
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 67,
                        "end": 68
                      }
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 69
                }
              },
              "index": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 70,
                  "end": 71
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 72
          }
        }
      },
      "span": {
        "start": 59,
        "end": 73
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 74,
                        "end": 75
                      }
                    },
                    "member": {
                      "name": "B",
                      "span": {
                        "start": 77,
                        "end": 78
                      }
                    }
                  }
                },
                "span": {
                  "start": 74,
                  "end": 78
                }
              },
              "property": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 80,
                  "end": 86
                }
              }
            }
          },
          "span": {
            "start": 74,
            "end": 86
          }
        }
      },
      "span": {
        "start": 74,
        "end": 87
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 88,
                        "end": 89
                      }
                    },
                    "member": {
                      "name": "B",
                      "span": {
                        "start": 91,
                        "end": 92
                      }
                    }
                  }
                },
                "span": {
                  "start": 88,
                  "end": 92
                }
              },
              "method": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 94,
                  "end": 100
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 88,
            "end": 102
          }
        }
      },
      "span": {
        "start": 88,
        "end": 103
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 104,
                        "end": 105
                      }
                    },
                    "member": {
                      "name": "B",
                      "span": {
                        "start": 107,
                        "end": 108
                      }
                    }
                  }
                },
                "span": {
                  "start": 104,
                  "end": 108
                }
              },
              "member": {
                "name": "C",
                "span": {
                  "start": 110,
                  "end": 111
                }
              }
            }
          },
          "span": {
            "start": 104,
            "end": 111
          }
        }
      },
      "span": {
        "start": 104,
        "end": 112
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticPropertyAccess": {
              "class": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 113,
                        "end": 114
                      }
                    },
                    "member": {
                      "name": "B",
                      "span": {
                        "start": 116,
                        "end": 117
                      }
                    }
                  }
                },
                "span": {
                  "start": 113,
                  "end": 117
                }
              },
              "member": {
                "name": "c",
                "span": {
                  "start": 119,
                  "end": 121
                }
              }
            }
          },
          "span": {
            "start": 113,
            "end": 121
          }
        }
      },
      "span": {
        "start": 113,
        "end": 122
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 123,
                        "end": 124
                      }
                    },
                    "member": {
                      "name": "B",
                      "span": {
                        "start": 126,
                        "end": 127
                      }
                    }
                  }
                },
                "span": {
                  "start": 123,
                  "end": 127
                }
              },
              "method": {
                "name": "c",
                "span": {
                  "start": 129,
                  "end": 130
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 123,
            "end": 132
          }
        }
      },
      "span": {
        "start": 123,
        "end": 133
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "MagicConst": "Function"
                },
                "span": {
                  "start": 135,
                  "end": 147
                }
              },
              "index": {
                "kind": {
                  "Int": 0
                },
                "span": {
                  "start": 148,
                  "end": 149
                }
              }
            }
          },
          "span": {
            "start": 135,
            "end": 150
          }
        }
      },
      "span": {
        "start": 135,
        "end": 151
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "MagicConst": "Function"
                },
                "span": {
                  "start": 152,
                  "end": 164
                }
              },
              "property": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 166,
                  "end": 172
                }
              }
            }
          },
          "span": {
            "start": 152,
            "end": 172
          }
        }
      },
      "span": {
        "start": 152,
        "end": 173
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Identifier": "__FUNCIONT__"
                },
                "span": {
                  "start": 174,
                  "end": 186
                }
              },
              "method": {
                "kind": {
                  "Identifier": "length"
                },
                "span": {
                  "start": 188,
                  "end": 194
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 174,
            "end": 196
          }
        }
      },
      "span": {
        "start": 174,
        "end": 197
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 197
  }
}
