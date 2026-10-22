===source===
<?php
f()->a = 1;
f()[0] = 1;
$a->b()->c = 1;
A::b()->c[0] = 1;
($a)->b = 1;
clone($a)->b = 1;
C::$a->b = 1;
$$a->b = 1;
OBJ::$a = 1;
$x = OBJ->a;
isset(OBJ->a);
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 11
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
                  "PropertyAccess": {
                    "object": {
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
                                  "start": 6,
                                  "end": 7
                                }
                              }
                            },
                            "span": {
                              "start": 6,
                              "end": 7
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 9
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 11,
                        "end": 12
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 15,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
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
                                  "start": 18,
                                  "end": 19
                                }
                              }
                            },
                            "span": {
                              "start": 18,
                              "end": 19
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 18,
                        "end": 21
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 22,
                        "end": 23
                      }
                    }
                  }
                },
                "span": {
                  "start": 18,
                  "end": 24
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
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
      },
      "span": {
        "start": 18,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
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
                              "start": 30,
                              "end": 32
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "b"
                            },
                            "span": {
                              "start": 34,
                              "end": 35
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 30,
                        "end": 37
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "c"
                      },
                      "span": {
                        "start": 39,
                        "end": 40
                      }
                    }
                  }
                },
                "span": {
                  "start": 30,
                  "end": 40
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 43,
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
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
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
                                        "start": 46,
                                        "end": 47
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 46,
                                    "end": 47
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "b"
                                  },
                                  "span": {
                                    "start": 49,
                                    "end": 50
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 46,
                              "end": 52
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "c"
                            },
                            "span": {
                              "start": 54,
                              "end": 55
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 55
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 56,
                        "end": 57
                      }
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 58
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 61,
                  "end": 62
                }
              }
            }
          },
          "span": {
            "start": 46,
            "end": 62
          }
        }
      },
      "span": {
        "start": 46,
        "end": 63
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Parenthesized": {
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
                        "end": 68
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 70,
                        "end": 71
                      }
                    }
                  }
                },
                "span": {
                  "start": 64,
                  "end": 71
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 74,
                  "end": 75
                }
              }
            }
          },
          "span": {
            "start": 64,
            "end": 75
          }
        }
      },
      "span": {
        "start": 64,
        "end": 76
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 83,
                                "end": 85
                              }
                            }
                          },
                          "span": {
                            "start": 82,
                            "end": 86
                          }
                        },
                        "property": {
                          "kind": {
                            "Identifier": "b"
                          },
                          "span": {
                            "start": 88,
                            "end": 89
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 82,
                      "end": 89
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 92,
                      "end": 93
                    }
                  }
                }
              },
              "span": {
                "start": 82,
                "end": 93
              }
            }
          },
          "span": {
            "start": 77,
            "end": 93
          }
        }
      },
      "span": {
        "start": 77,
        "end": 94
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "StaticPropertyAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "C"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 95,
                                  "end": 96
                                }
                              }
                            },
                            "span": {
                              "start": 95,
                              "end": 96
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "a"
                            },
                            "span": {
                              "start": 98,
                              "end": 100
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 100
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 102,
                        "end": 103
                      }
                    }
                  }
                },
                "span": {
                  "start": 95,
                  "end": 103
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 106,
                  "end": 107
                }
              }
            }
          },
          "span": {
            "start": 95,
            "end": 107
          }
        }
      },
      "span": {
        "start": 95,
        "end": 108
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 110,
                            "end": 112
                          }
                        }
                      },
                      "span": {
                        "start": 109,
                        "end": 112
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 114,
                        "end": 115
                      }
                    }
                  }
                },
                "span": {
                  "start": 109,
                  "end": 115
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 118,
                  "end": 119
                }
              }
            }
          },
          "span": {
            "start": 109,
            "end": 119
          }
        }
      },
      "span": {
        "start": 109,
        "end": 120
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "OBJ"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 121,
                            "end": 124
                          }
                        }
                      },
                      "span": {
                        "start": 121,
                        "end": 124
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 126,
                        "end": 128
                      }
                    }
                  }
                },
                "span": {
                  "start": 121,
                  "end": 128
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 131,
                  "end": 132
                }
              }
            }
          },
          "span": {
            "start": 121,
            "end": 132
          }
        }
      },
      "span": {
        "start": 121,
        "end": 133
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
                  "start": 134,
                  "end": 136
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "OBJ"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 139,
                            "end": 142
                          }
                        }
                      },
                      "span": {
                        "start": 139,
                        "end": 142
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 144,
                        "end": 145
                      }
                    }
                  }
                },
                "span": {
                  "start": 139,
                  "end": 145
                }
              }
            }
          },
          "span": {
            "start": 134,
            "end": 145
          }
        }
      },
      "span": {
        "start": 134,
        "end": 146
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "OBJ"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 153,
                            "end": 156
                          }
                        }
                      },
                      "span": {
                        "start": 153,
                        "end": 156
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 158,
                        "end": 159
                      }
                    }
                  }
                },
                "span": {
                  "start": 153,
                  "end": 159
                }
              }
            ]
          },
          "span": {
            "start": 147,
            "end": 160
          }
        }
      },
      "span": {
        "start": 147,
        "end": 161
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 161
  }
}
