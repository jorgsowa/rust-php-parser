===source===
<?php
$a{0}->b;
$a{0}[1];
$a{0}{1}->c;
$a{0}::$c;
$a{0}->m();
$a{0}::m();
echo "{$a{0}->b}";
[$a{0}->b] = $x;
foreach ($x as [$a{0}[1]]) {}
$y = [$a{0}::$b];
===errors >=8.4===
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
Array and string offset access syntax with curly braces is no longer supported
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "{" in Standard input code on line 2
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
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 6,
                        "end": 8
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 9,
                        "end": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 13,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
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
                        "Variable": "a"
                      },
                      "span": {
                        "start": 16,
                        "end": 18
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 16,
                  "end": 21
                }
              },
              "index": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 22,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 16,
            "end": 24
          }
        }
      },
      "span": {
        "start": 16,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 26,
                              "end": 28
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 29,
                              "end": 30
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 31
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 32,
                        "end": 33
                      }
                    }
                  }
                },
                "span": {
                  "start": 26,
                  "end": 34
                }
              },
              "property": {
                "kind": {
                  "Identifier": "c"
                },
                "span": {
                  "start": 36,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 26,
            "end": 37
          }
        }
      },
      "span": {
        "start": 26,
        "end": 38
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
                        "Variable": "a"
                      },
                      "span": {
                        "start": 39,
                        "end": 41
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 42,
                        "end": 43
                      }
                    }
                  }
                },
                "span": {
                  "start": 39,
                  "end": 44
                }
              },
              "member": {
                "kind": {
                  "Identifier": "c"
                },
                "span": {
                  "start": 46,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 48
          }
        }
      },
      "span": {
        "start": 39,
        "end": 49
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 50,
                        "end": 52
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 53,
                        "end": 54
                      }
                    }
                  }
                },
                "span": {
                  "start": 50,
                  "end": 55
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 57,
                  "end": 58
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 50,
            "end": 60
          }
        }
      },
      "span": {
        "start": 50,
        "end": 61
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
                        "start": 62,
                        "end": 64
                      }
                    },
                    "index": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 65,
                        "end": 66
                      }
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 67
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 69,
                  "end": 70
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 62,
            "end": 72
          }
        }
      },
      "span": {
        "start": 62,
        "end": 73
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
                      "PropertyAccess": {
                        "object": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 81,
                                  "end": 83
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 84,
                                  "end": 85
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 81,
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
                      "start": 81,
                      "end": 89
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 79,
              "end": 91
            }
          }
        ]
      },
      "span": {
        "start": 74,
        "end": 92
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 94,
                                        "end": 96
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 97,
                                        "end": 98
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 94,
                                  "end": 99
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 101,
                                  "end": 102
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 94,
                            "end": 102
                          }
                        }
                      },
                      "span": {
                        "start": 94,
                        "end": 102
                      }
                    }
                  ]
                },
                "span": {
                  "start": 93,
                  "end": 103
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 106,
                  "end": 108
                }
              }
            }
          },
          "span": {
            "start": 93,
            "end": 108
          }
        }
      },
      "span": {
        "start": 93,
        "end": 109
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 119,
              "end": 121
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Variable": "a"
                                  },
                                  "span": {
                                    "start": 126,
                                    "end": 128
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 0
                                  },
                                  "span": {
                                    "start": 129,
                                    "end": 130
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 126,
                              "end": 131
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 132,
                              "end": 133
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 126,
                        "end": 134
                      }
                    }
                  },
                  "span": {
                    "start": 126,
                    "end": 134
                  }
                }
              ]
            },
            "span": {
              "start": 125,
              "end": 135
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 137,
              "end": 139
            }
          }
        }
      },
      "span": {
        "start": 110,
        "end": 139
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 140,
                  "end": 142
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "StaticPropertyAccess": {
                              "class": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 146,
                                        "end": 148
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 149,
                                        "end": 150
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 146,
                                  "end": 151
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 153,
                                  "end": 155
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 146,
                            "end": 155
                          }
                        }
                      },
                      "span": {
                        "start": 146,
                        "end": 155
                      }
                    }
                  ]
                },
                "span": {
                  "start": 145,
                  "end": 156
                }
              }
            }
          },
          "span": {
            "start": 140,
            "end": 156
          }
        }
      },
      "span": {
        "start": 140,
        "end": 157
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 157
  }
}
