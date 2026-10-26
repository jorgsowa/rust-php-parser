===source===
<?php
$a = [...['a' => 1]];
$a = [...['01' => 1, '-0' => 2]];
$a = [...[null => 1]];
$a = [...[__CLASS__ => 1]];
$a = [...[[...['a' => 1]]]];
$a = [...['a' => 1] + [1]];
const C = [...['a' => 1]];
$a = [...['1' => 1, '-1' => 2, true => 3, 1.5 => 4]];
$a = [...['a' => 1], $b];
$a = [...['a' => $b]];
===errors <=8.0===
Cannot unpack array with string keys
Cannot unpack array with string keys
Cannot unpack array with string keys
Cannot unpack array with string keys
Cannot unpack array with string keys
Cannot unpack array with string keys
Cannot unpack array with string keys
===php_error <=8.0===
PHP Fatal error:  Cannot unpack array with string keys in Standard input code on line 2
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
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "String": "a"
                                  },
                                  "span": {
                                    "start": 16,
                                    "end": 19
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 23,
                                      "end": 24
                                    }
                                  }
                                },
                                "span": {
                                  "start": 16,
                                  "end": 24
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 15,
                            "end": 25
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 25
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27
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
                  "start": 28,
                  "end": 30
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
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "String": "01"
                                  },
                                  "span": {
                                    "start": 38,
                                    "end": 42
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 46,
                                      "end": 47
                                    }
                                  }
                                },
                                "span": {
                                  "start": 38,
                                  "end": 47
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "-0"
                                  },
                                  "span": {
                                    "start": 49,
                                    "end": 53
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 57,
                                      "end": 58
                                    }
                                  }
                                },
                                "span": {
                                  "start": 49,
                                  "end": 58
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 37,
                            "end": 59
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 59
                      }
                    }
                  ]
                },
                "span": {
                  "start": 33,
                  "end": 60
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 60
          }
        }
      },
      "span": {
        "start": 28,
        "end": 61
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
                  "start": 62,
                  "end": 64
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
                            "Array": [
                              {
                                "key": {
                                  "kind": "Null",
                                  "span": {
                                    "start": 72,
                                    "end": 76
                                  }
                                },
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
                                  "start": 72,
                                  "end": 81
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 71,
                            "end": 82
                          }
                        }
                      },
                      "span": {
                        "start": 68,
                        "end": 82
                      }
                    }
                  ]
                },
                "span": {
                  "start": 67,
                  "end": 83
                }
              }
            }
          },
          "span": {
            "start": 62,
            "end": 83
          }
        }
      },
      "span": {
        "start": 62,
        "end": 84
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
                  "start": 85,
                  "end": 87
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
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "MagicConst": "Class"
                                  },
                                  "span": {
                                    "start": 95,
                                    "end": 104
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 108,
                                      "end": 109
                                    }
                                  }
                                },
                                "span": {
                                  "start": 95,
                                  "end": 109
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 94,
                            "end": 110
                          }
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 110
                      }
                    }
                  ]
                },
                "span": {
                  "start": 90,
                  "end": 111
                }
              }
            }
          },
          "span": {
            "start": 85,
            "end": 111
          }
        }
      },
      "span": {
        "start": 85,
        "end": 112
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
                  "start": 113,
                  "end": 115
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
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Array": [
                                        {
                                          "key": null,
                                          "kind": {
                                            "Spread": {
                                              "kind": {
                                                "Array": [
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "a"
                                                      },
                                                      "span": {
                                                        "start": 128,
                                                        "end": 131
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Int": 1
                                                        },
                                                        "span": {
                                                          "start": 135,
                                                          "end": 136
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 128,
                                                      "end": 136
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 127,
                                                "end": 137
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 124,
                                            "end": 137
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 123,
                                      "end": 138
                                    }
                                  }
                                },
                                "span": {
                                  "start": 123,
                                  "end": 138
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 122,
                            "end": 139
                          }
                        }
                      },
                      "span": {
                        "start": 119,
                        "end": 139
                      }
                    }
                  ]
                },
                "span": {
                  "start": 118,
                  "end": 140
                }
              }
            }
          },
          "span": {
            "start": 113,
            "end": 140
          }
        }
      },
      "span": {
        "start": 113,
        "end": 141
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
                  "start": 142,
                  "end": 144
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
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": {
                                        "kind": {
                                          "String": "a"
                                        },
                                        "span": {
                                          "start": 152,
                                          "end": 155
                                        }
                                      },
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Int": 1
                                          },
                                          "span": {
                                            "start": 159,
                                            "end": 160
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 152,
                                        "end": 160
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 151,
                                  "end": 161
                                }
                              },
                              "op": "Add",
                              "right": {
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
                                            "start": 165,
                                            "end": 166
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 165,
                                        "end": 166
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 164,
                                  "end": 167
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 151,
                            "end": 167
                          }
                        }
                      },
                      "span": {
                        "start": 148,
                        "end": 167
                      }
                    }
                  ]
                },
                "span": {
                  "start": 147,
                  "end": 168
                }
              }
            }
          },
          "span": {
            "start": 142,
            "end": 168
          }
        }
      },
      "span": {
        "start": 142,
        "end": 169
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 176,
                "end": 177
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "kind": {
                      "Spread": {
                        "kind": {
                          "Array": [
                            {
                              "key": {
                                "kind": {
                                  "String": "a"
                                },
                                "span": {
                                  "start": 185,
                                  "end": 188
                                }
                              },
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 192,
                                    "end": 193
                                  }
                                }
                              },
                              "span": {
                                "start": 185,
                                "end": 193
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 184,
                          "end": 194
                        }
                      }
                    },
                    "span": {
                      "start": 181,
                      "end": 194
                    }
                  }
                ]
              },
              "span": {
                "start": 180,
                "end": 195
              }
            },
            "attributes": [],
            "span": {
              "start": 176,
              "end": 195
            }
          }
        ]
      },
      "span": {
        "start": 170,
        "end": 196
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
                  "start": 197,
                  "end": 199
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
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "String": "1"
                                  },
                                  "span": {
                                    "start": 207,
                                    "end": 210
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 214,
                                      "end": 215
                                    }
                                  }
                                },
                                "span": {
                                  "start": 207,
                                  "end": 215
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "-1"
                                  },
                                  "span": {
                                    "start": 217,
                                    "end": 221
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 225,
                                      "end": 226
                                    }
                                  }
                                },
                                "span": {
                                  "start": 217,
                                  "end": 226
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "Bool": true
                                  },
                                  "span": {
                                    "start": 228,
                                    "end": 232
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 3
                                    },
                                    "span": {
                                      "start": 236,
                                      "end": 237
                                    }
                                  }
                                },
                                "span": {
                                  "start": 228,
                                  "end": 237
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "Float": 1.5
                                  },
                                  "span": {
                                    "start": 239,
                                    "end": 242
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 4
                                    },
                                    "span": {
                                      "start": 246,
                                      "end": 247
                                    }
                                  }
                                },
                                "span": {
                                  "start": 239,
                                  "end": 247
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 206,
                            "end": 248
                          }
                        }
                      },
                      "span": {
                        "start": 203,
                        "end": 248
                      }
                    }
                  ]
                },
                "span": {
                  "start": 202,
                  "end": 249
                }
              }
            }
          },
          "span": {
            "start": 197,
            "end": 249
          }
        }
      },
      "span": {
        "start": 197,
        "end": 250
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
                  "start": 251,
                  "end": 253
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
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "String": "a"
                                  },
                                  "span": {
                                    "start": 261,
                                    "end": 264
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 268,
                                      "end": 269
                                    }
                                  }
                                },
                                "span": {
                                  "start": 261,
                                  "end": 269
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 260,
                            "end": 270
                          }
                        }
                      },
                      "span": {
                        "start": 257,
                        "end": 270
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 272,
                            "end": 274
                          }
                        }
                      },
                      "span": {
                        "start": 272,
                        "end": 274
                      }
                    }
                  ]
                },
                "span": {
                  "start": 256,
                  "end": 275
                }
              }
            }
          },
          "span": {
            "start": 251,
            "end": 275
          }
        }
      },
      "span": {
        "start": 251,
        "end": 276
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
                  "start": 277,
                  "end": 279
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
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "String": "a"
                                  },
                                  "span": {
                                    "start": 287,
                                    "end": 290
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 294,
                                      "end": 296
                                    }
                                  }
                                },
                                "span": {
                                  "start": 287,
                                  "end": 296
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 286,
                            "end": 297
                          }
                        }
                      },
                      "span": {
                        "start": 283,
                        "end": 297
                      }
                    }
                  ]
                },
                "span": {
                  "start": 282,
                  "end": 298
                }
              }
            }
          },
          "span": {
            "start": 277,
            "end": 298
          }
        }
      },
      "span": {
        "start": 277,
        "end": 299
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 299
  }
}
