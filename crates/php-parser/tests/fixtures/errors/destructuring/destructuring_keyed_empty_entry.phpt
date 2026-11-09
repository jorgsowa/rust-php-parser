===source===
<?php
['k' => $a, , 'j' => $b] = $x;
[, 'k' => $a] = $x;
[, , 'k' => $a] = $x;
['k' => $a, ,] = $x;
list('k' => $a, , 'j' => $b) = $x;
list(, 'k' => $a) = $x;
[$a, ['k' => $b, , 'j' => $c]] = $x;
foreach ($x as ['k' => $a, , 'j' => $b]) {}
foreach ($x as [, 'k' => $a]) {}
===errors===
Cannot use empty array entries in keyed array assignment
Cannot use empty array entries in keyed array assignment
Cannot use empty array entries in keyed array assignment
Cannot use empty array entries in keyed array assignment
Cannot use empty array entries in keyed array assignment
Cannot use empty array entries in keyed array assignment
Cannot use empty array entries in keyed array assignment
Cannot use empty array entries in keyed array assignment
Cannot use empty array entries in keyed array assignment
===php_error===
PHP Fatal error:  Cannot use empty array entries in keyed array assignment in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 7,
                          "end": 10
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 14,
                            "end": 16
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 16
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
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
                    {
                      "key": {
                        "kind": {
                          "String": "j"
                        },
                        "span": {
                          "start": 20,
                          "end": 23
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 27,
                            "end": 29
                          }
                        }
                      },
                      "span": {
                        "start": 20,
                        "end": 29
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 30
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 33,
                  "end": 35
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 35
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
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
                          "kind": "Omit",
                          "span": {
                            "start": 38,
                            "end": 39
                          }
                        }
                      },
                      "span": {
                        "start": 38,
                        "end": 39
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 40,
                          "end": 43
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 47,
                            "end": 49
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 49
                      }
                    }
                  ]
                },
                "span": {
                  "start": 37,
                  "end": 50
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 53,
                  "end": 55
                }
              }
            }
          },
          "span": {
            "start": 37,
            "end": 55
          }
        }
      },
      "span": {
        "start": 37,
        "end": 56
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
                          "kind": "Omit",
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
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 60,
                            "end": 61
                          }
                        }
                      },
                      "span": {
                        "start": 60,
                        "end": 61
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 62,
                          "end": 65
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 69,
                            "end": 71
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 71
                      }
                    }
                  ]
                },
                "span": {
                  "start": 57,
                  "end": 72
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 75,
                  "end": 77
                }
              }
            }
          },
          "span": {
            "start": 57,
            "end": 77
          }
        }
      },
      "span": {
        "start": 57,
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 80,
                          "end": 83
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 87,
                            "end": 89
                          }
                        }
                      },
                      "span": {
                        "start": 80,
                        "end": 89
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 91,
                            "end": 92
                          }
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 92
                      }
                    }
                  ]
                },
                "span": {
                  "start": 79,
                  "end": 93
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 96,
                  "end": 98
                }
              }
            }
          },
          "span": {
            "start": 79,
            "end": 98
          }
        }
      },
      "span": {
        "start": 79,
        "end": 99
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
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 105,
                          "end": 108
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 112,
                            "end": 114
                          }
                        }
                      },
                      "span": {
                        "start": 105,
                        "end": 114
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 116,
                            "end": 117
                          }
                        }
                      },
                      "span": {
                        "start": 116,
                        "end": 117
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "j"
                        },
                        "span": {
                          "start": 118,
                          "end": 121
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 125,
                            "end": 127
                          }
                        }
                      },
                      "span": {
                        "start": 118,
                        "end": 127
                      }
                    }
                  ]
                },
                "span": {
                  "start": 100,
                  "end": 128
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 131,
                  "end": 133
                }
              }
            }
          },
          "span": {
            "start": 100,
            "end": 133
          }
        }
      },
      "span": {
        "start": 100,
        "end": 134
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
                          "kind": "Omit",
                          "span": {
                            "start": 140,
                            "end": 141
                          }
                        }
                      },
                      "span": {
                        "start": 140,
                        "end": 141
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 142,
                          "end": 145
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 149,
                            "end": 151
                          }
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 151
                      }
                    }
                  ]
                },
                "span": {
                  "start": 135,
                  "end": 152
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 155,
                  "end": 157
                }
              }
            }
          },
          "span": {
            "start": 135,
            "end": 157
          }
        }
      },
      "span": {
        "start": 135,
        "end": 158
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
                            "Variable": "a"
                          },
                          "span": {
                            "start": 160,
                            "end": 162
                          }
                        }
                      },
                      "span": {
                        "start": 160,
                        "end": 162
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": {
                                  "kind": {
                                    "String": "k"
                                  },
                                  "span": {
                                    "start": 165,
                                    "end": 168
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 172,
                                      "end": 174
                                    }
                                  }
                                },
                                "span": {
                                  "start": 165,
                                  "end": 174
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": "Omit",
                                    "span": {
                                      "start": 176,
                                      "end": 177
                                    }
                                  }
                                },
                                "span": {
                                  "start": 176,
                                  "end": 177
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "j"
                                  },
                                  "span": {
                                    "start": 178,
                                    "end": 181
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "c"
                                    },
                                    "span": {
                                      "start": 185,
                                      "end": 187
                                    }
                                  }
                                },
                                "span": {
                                  "start": 178,
                                  "end": 187
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 164,
                            "end": 188
                          }
                        }
                      },
                      "span": {
                        "start": 164,
                        "end": 188
                      }
                    }
                  ]
                },
                "span": {
                  "start": 159,
                  "end": 189
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 192,
                  "end": 194
                }
              }
            }
          },
          "span": {
            "start": 159,
            "end": 194
          }
        }
      },
      "span": {
        "start": 159,
        "end": 195
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
              "start": 205,
              "end": 207
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": {
                    "kind": {
                      "String": "k"
                    },
                    "span": {
                      "start": 212,
                      "end": 215
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 219,
                        "end": 221
                      }
                    }
                  },
                  "span": {
                    "start": 212,
                    "end": 221
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": "Omit",
                      "span": {
                        "start": 223,
                        "end": 224
                      }
                    }
                  },
                  "span": {
                    "start": 223,
                    "end": 224
                  }
                },
                {
                  "key": {
                    "kind": {
                      "String": "j"
                    },
                    "span": {
                      "start": 225,
                      "end": 228
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 232,
                        "end": 234
                      }
                    }
                  },
                  "span": {
                    "start": 225,
                    "end": 234
                  }
                }
              ]
            },
            "span": {
              "start": 211,
              "end": 235
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 237,
              "end": 239
            }
          }
        }
      },
      "span": {
        "start": 196,
        "end": 239
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
              "start": 249,
              "end": 251
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
                      "kind": "Omit",
                      "span": {
                        "start": 256,
                        "end": 257
                      }
                    }
                  },
                  "span": {
                    "start": 256,
                    "end": 257
                  }
                },
                {
                  "key": {
                    "kind": {
                      "String": "k"
                    },
                    "span": {
                      "start": 258,
                      "end": 261
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 265,
                        "end": 267
                      }
                    }
                  },
                  "span": {
                    "start": 258,
                    "end": 267
                  }
                }
              ]
            },
            "span": {
              "start": 255,
              "end": 268
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 270,
              "end": 272
            }
          }
        }
      },
      "span": {
        "start": 240,
        "end": 272
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 272
  }
}
