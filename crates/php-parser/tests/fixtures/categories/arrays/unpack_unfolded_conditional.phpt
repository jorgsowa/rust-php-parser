===source===
<?php
$a = [...(true ? [1] : 2)];
$a = [...(false ? $b : [1])];
$a = [...($b ? [1] : 2)];
$a = [...($b ?? 1)];
$a = [...(PHP_EOL ? [] : 1)];
$a = [...([1] ?: 2)];
$a = [...(null ?? [])];
$o->{true ? 1 : 'a'}();
$o->{null ?? 1}();
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Bool": true
                                    },
                                    "span": {
                                      "start": 16,
                                      "end": 20
                                    }
                                  },
                                  "then_expr": {
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
                                                "start": 24,
                                                "end": 25
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 24,
                                            "end": 25
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 23,
                                      "end": 26
                                    }
                                  },
                                  "else_expr": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 29,
                                      "end": 30
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 16,
                                "end": 30
                              }
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 32
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 32
          }
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 34,
                  "end": 36
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Bool": false
                                    },
                                    "span": {
                                      "start": 44,
                                      "end": 49
                                    }
                                  },
                                  "then_expr": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 52,
                                      "end": 54
                                    }
                                  },
                                  "else_expr": {
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
                                                "start": 58,
                                                "end": 59
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 58,
                                            "end": 59
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 57,
                                      "end": 60
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 44,
                                "end": 60
                              }
                            }
                          },
                          "span": {
                            "start": 43,
                            "end": 61
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 61
                      }
                    }
                  ]
                },
                "span": {
                  "start": 39,
                  "end": 62
                }
              }
            }
          },
          "span": {
            "start": 34,
            "end": 62
          }
        }
      },
      "span": {
        "start": 34,
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
                  "Variable": "a"
                },
                "span": {
                  "start": 64,
                  "end": 66
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 74,
                                      "end": 76
                                    }
                                  },
                                  "then_expr": {
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
                                                "start": 80,
                                                "end": 81
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 80,
                                            "end": 81
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 79,
                                      "end": 82
                                    }
                                  },
                                  "else_expr": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 85,
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
                            "start": 73,
                            "end": 87
                          }
                        }
                      },
                      "span": {
                        "start": 70,
                        "end": 87
                      }
                    }
                  ]
                },
                "span": {
                  "start": 69,
                  "end": 88
                }
              }
            }
          },
          "span": {
            "start": 64,
            "end": 88
          }
        }
      },
      "span": {
        "start": 64,
        "end": 89
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 90,
                  "end": 92
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "NullCoalesce": {
                                  "left": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 100,
                                      "end": 102
                                    }
                                  },
                                  "right": {
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
                                "start": 100,
                                "end": 107
                              }
                            }
                          },
                          "span": {
                            "start": 99,
                            "end": 108
                          }
                        }
                      },
                      "span": {
                        "start": 96,
                        "end": 108
                      }
                    }
                  ]
                },
                "span": {
                  "start": 95,
                  "end": 109
                }
              }
            }
          },
          "span": {
            "start": 90,
            "end": 109
          }
        }
      },
      "span": {
        "start": 90,
        "end": 110
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 111,
                  "end": 113
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "PHP_EOL"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 121,
                                          "end": 128
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 121,
                                      "end": 128
                                    }
                                  },
                                  "then_expr": {
                                    "kind": {
                                      "Array": []
                                    },
                                    "span": {
                                      "start": 131,
                                      "end": 133
                                    }
                                  },
                                  "else_expr": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 136,
                                      "end": 137
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 121,
                                "end": 137
                              }
                            }
                          },
                          "span": {
                            "start": 120,
                            "end": 138
                          }
                        }
                      },
                      "span": {
                        "start": 117,
                        "end": 138
                      }
                    }
                  ]
                },
                "span": {
                  "start": 116,
                  "end": 139
                }
              }
            }
          },
          "span": {
            "start": 111,
            "end": 139
          }
        }
      },
      "span": {
        "start": 111,
        "end": 140
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 141,
                  "end": 143
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "Ternary": {
                                  "condition": {
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
                                                "start": 152,
                                                "end": 153
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 152,
                                            "end": 153
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 151,
                                      "end": 154
                                    }
                                  },
                                  "then_expr": null,
                                  "else_expr": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 158,
                                      "end": 159
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 151,
                                "end": 159
                              }
                            }
                          },
                          "span": {
                            "start": 150,
                            "end": 160
                          }
                        }
                      },
                      "span": {
                        "start": 147,
                        "end": 160
                      }
                    }
                  ]
                },
                "span": {
                  "start": 146,
                  "end": 161
                }
              }
            }
          },
          "span": {
            "start": 141,
            "end": 161
          }
        }
      },
      "span": {
        "start": 141,
        "end": 162
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 163,
                  "end": 165
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "NullCoalesce": {
                                  "left": {
                                    "kind": "Null",
                                    "span": {
                                      "start": 173,
                                      "end": 177
                                    }
                                  },
                                  "right": {
                                    "kind": {
                                      "Array": []
                                    },
                                    "span": {
                                      "start": 181,
                                      "end": 183
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 173,
                                "end": 183
                              }
                            }
                          },
                          "span": {
                            "start": 172,
                            "end": 184
                          }
                        }
                      },
                      "span": {
                        "start": 169,
                        "end": 184
                      }
                    }
                  ]
                },
                "span": {
                  "start": 168,
                  "end": 185
                }
              }
            }
          },
          "span": {
            "start": 163,
            "end": 185
          }
        }
      },
      "span": {
        "start": 163,
        "end": 186
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
                  "start": 187,
                  "end": 189
                }
              },
              "method": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 192,
                        "end": 196
                      }
                    },
                    "then_expr": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 199,
                        "end": 200
                      }
                    },
                    "else_expr": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 203,
                        "end": 206
                      }
                    }
                  }
                },
                "span": {
                  "start": 192,
                  "end": 206
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 187,
            "end": 209
          }
        }
      },
      "span": {
        "start": 187,
        "end": 210
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
                  "start": 211,
                  "end": 213
                }
              },
              "method": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": "Null",
                      "span": {
                        "start": 216,
                        "end": 220
                      }
                    },
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 224,
                        "end": 225
                      }
                    }
                  }
                },
                "span": {
                  "start": 216,
                  "end": 225
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 211,
            "end": 228
          }
        }
      },
      "span": {
        "start": 211,
        "end": 229
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 229
  }
}
