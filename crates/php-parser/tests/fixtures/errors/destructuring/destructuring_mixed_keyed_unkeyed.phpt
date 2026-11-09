===source===
<?php
[$a, 'k' => $b] = $x;
['k' => $a, $b] = $x;
[1 => $a, 2 => $b, $c] = $x;
list('k' => $a, $b) = $x;
list($a, 'k' => $b) = $x;
[$a, 'k' => &$b] = $x;
[[$a, 'k' => $b]] = $x;
['k' => [$a, 'j' => $b]] = $x;
[$a, [$b, 'k' => $c], 'k' => $d] = $x;
[$a, 'k' => $b] = [$c, 'j' => $d] = $x;
[$a, 'k' => $b, 'j' => $c, $d] = $x;
foreach ($x as ['k' => $a, $b]) {}
foreach ($x as $k => [$a, 'k' => $b]) {}
foreach ($x as list('k' => $a, $b)):
endforeach;
===errors===
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
Cannot mix keyed and unkeyed array entries in assignments
===php_error===
PHP Fatal error:  Cannot mix keyed and unkeyed array entries in assignments in Standard input code on line 2
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
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 11,
                          "end": 14
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 18,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 20
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 21
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 24,
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 29,
                          "end": 32
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 36,
                            "end": 38
                          }
                        }
                      },
                      "span": {
                        "start": 29,
                        "end": 38
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
                            "start": 40,
                            "end": 42
                          }
                        }
                      },
                      "span": {
                        "start": 40,
                        "end": 42
                      }
                    }
                  ]
                },
                "span": {
                  "start": 28,
                  "end": 43
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 46,
                  "end": 48
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 48
          }
        }
      },
      "span": {
        "start": 28,
        "end": 49
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
                          "Int": 1
                        },
                        "span": {
                          "start": 51,
                          "end": 52
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 56,
                            "end": 58
                          }
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 58
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 60,
                          "end": 61
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 65,
                            "end": 67
                          }
                        }
                      },
                      "span": {
                        "start": 60,
                        "end": 67
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 69,
                            "end": 71
                          }
                        }
                      },
                      "span": {
                        "start": 69,
                        "end": 71
                      }
                    }
                  ]
                },
                "span": {
                  "start": 50,
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
            "start": 50,
            "end": 77
          }
        }
      },
      "span": {
        "start": 50,
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
                          "start": 84,
                          "end": 87
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 91,
                            "end": 93
                          }
                        }
                      },
                      "span": {
                        "start": 84,
                        "end": 93
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
                            "start": 95,
                            "end": 97
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 97
                      }
                    }
                  ]
                },
                "span": {
                  "start": 79,
                  "end": 98
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 101,
                  "end": 103
                }
              }
            }
          },
          "span": {
            "start": 79,
            "end": 103
          }
        }
      },
      "span": {
        "start": 79,
        "end": 104
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
                            "start": 110,
                            "end": 112
                          }
                        }
                      },
                      "span": {
                        "start": 110,
                        "end": 112
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 114,
                          "end": 117
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 121,
                            "end": 123
                          }
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 123
                      }
                    }
                  ]
                },
                "span": {
                  "start": 105,
                  "end": 124
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 127,
                  "end": 129
                }
              }
            }
          },
          "span": {
            "start": 105,
            "end": 129
          }
        }
      },
      "span": {
        "start": 105,
        "end": 130
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
                            "start": 132,
                            "end": 134
                          }
                        }
                      },
                      "span": {
                        "start": 132,
                        "end": 134
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 136,
                          "end": 139
                        }
                      },
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 144,
                            "end": 146
                          }
                        }
                      },
                      "span": {
                        "start": 136,
                        "end": 146
                      }
                    }
                  ]
                },
                "span": {
                  "start": 131,
                  "end": 147
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 150,
                  "end": 152
                }
              }
            }
          },
          "span": {
            "start": 131,
            "end": 152
          }
        }
      },
      "span": {
        "start": 131,
        "end": 153
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
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 156,
                                      "end": 158
                                    }
                                  }
                                },
                                "span": {
                                  "start": 156,
                                  "end": 158
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "k"
                                  },
                                  "span": {
                                    "start": 160,
                                    "end": 163
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 167,
                                      "end": 169
                                    }
                                  }
                                },
                                "span": {
                                  "start": 160,
                                  "end": 169
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 155,
                            "end": 170
                          }
                        }
                      },
                      "span": {
                        "start": 155,
                        "end": 170
                      }
                    }
                  ]
                },
                "span": {
                  "start": 154,
                  "end": 171
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 174,
                  "end": 176
                }
              }
            }
          },
          "span": {
            "start": 154,
            "end": 176
          }
        }
      },
      "span": {
        "start": 154,
        "end": 177
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
                          "start": 179,
                          "end": 182
                        }
                      },
                      "kind": {
                        "Value": {
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
                                      "start": 187,
                                      "end": 189
                                    }
                                  }
                                },
                                "span": {
                                  "start": 187,
                                  "end": 189
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "j"
                                  },
                                  "span": {
                                    "start": 191,
                                    "end": 194
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 198,
                                      "end": 200
                                    }
                                  }
                                },
                                "span": {
                                  "start": 191,
                                  "end": 200
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 186,
                            "end": 201
                          }
                        }
                      },
                      "span": {
                        "start": 179,
                        "end": 201
                      }
                    }
                  ]
                },
                "span": {
                  "start": 178,
                  "end": 202
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 205,
                  "end": 207
                }
              }
            }
          },
          "span": {
            "start": 178,
            "end": 207
          }
        }
      },
      "span": {
        "start": 178,
        "end": 208
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
                            "start": 210,
                            "end": 212
                          }
                        }
                      },
                      "span": {
                        "start": 210,
                        "end": 212
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 215,
                                      "end": 217
                                    }
                                  }
                                },
                                "span": {
                                  "start": 215,
                                  "end": 217
                                }
                              },
                              {
                                "key": {
                                  "kind": {
                                    "String": "k"
                                  },
                                  "span": {
                                    "start": 219,
                                    "end": 222
                                  }
                                },
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "c"
                                    },
                                    "span": {
                                      "start": 226,
                                      "end": 228
                                    }
                                  }
                                },
                                "span": {
                                  "start": 219,
                                  "end": 228
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 214,
                            "end": 229
                          }
                        }
                      },
                      "span": {
                        "start": 214,
                        "end": 229
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 231,
                          "end": 234
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "d"
                          },
                          "span": {
                            "start": 238,
                            "end": 240
                          }
                        }
                      },
                      "span": {
                        "start": 231,
                        "end": 240
                      }
                    }
                  ]
                },
                "span": {
                  "start": 209,
                  "end": 241
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 244,
                  "end": 246
                }
              }
            }
          },
          "span": {
            "start": 209,
            "end": 246
          }
        }
      },
      "span": {
        "start": 209,
        "end": 247
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
                            "start": 249,
                            "end": 251
                          }
                        }
                      },
                      "span": {
                        "start": 249,
                        "end": 251
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 253,
                          "end": 256
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 260,
                            "end": 262
                          }
                        }
                      },
                      "span": {
                        "start": 253,
                        "end": 262
                      }
                    }
                  ]
                },
                "span": {
                  "start": 248,
                  "end": 263
                }
              },
              "op": "Assign",
              "value": {
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
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 267,
                                  "end": 269
                                }
                              }
                            },
                            "span": {
                              "start": 267,
                              "end": 269
                            }
                          },
                          {
                            "key": {
                              "kind": {
                                "String": "j"
                              },
                              "span": {
                                "start": 271,
                                "end": 274
                              }
                            },
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "d"
                                },
                                "span": {
                                  "start": 278,
                                  "end": 280
                                }
                              }
                            },
                            "span": {
                              "start": 271,
                              "end": 280
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 266,
                        "end": 281
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 284,
                        "end": 286
                      }
                    }
                  }
                },
                "span": {
                  "start": 266,
                  "end": 286
                }
              }
            }
          },
          "span": {
            "start": 248,
            "end": 286
          }
        }
      },
      "span": {
        "start": 248,
        "end": 287
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
                            "start": 289,
                            "end": 291
                          }
                        }
                      },
                      "span": {
                        "start": 289,
                        "end": 291
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 293,
                          "end": 296
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 300,
                            "end": 302
                          }
                        }
                      },
                      "span": {
                        "start": 293,
                        "end": 302
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "j"
                        },
                        "span": {
                          "start": 304,
                          "end": 307
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "c"
                          },
                          "span": {
                            "start": 311,
                            "end": 313
                          }
                        }
                      },
                      "span": {
                        "start": 304,
                        "end": 313
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "d"
                          },
                          "span": {
                            "start": 315,
                            "end": 317
                          }
                        }
                      },
                      "span": {
                        "start": 315,
                        "end": 317
                      }
                    }
                  ]
                },
                "span": {
                  "start": 288,
                  "end": 318
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 321,
                  "end": 323
                }
              }
            }
          },
          "span": {
            "start": 288,
            "end": 323
          }
        }
      },
      "span": {
        "start": 288,
        "end": 324
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
              "start": 334,
              "end": 336
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
                      "start": 341,
                      "end": 344
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 348,
                        "end": 350
                      }
                    }
                  },
                  "span": {
                    "start": 341,
                    "end": 350
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
                        "start": 352,
                        "end": 354
                      }
                    }
                  },
                  "span": {
                    "start": 352,
                    "end": 354
                  }
                }
              ]
            },
            "span": {
              "start": 340,
              "end": 355
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 357,
              "end": 359
            }
          }
        }
      },
      "span": {
        "start": 325,
        "end": 359
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
              "start": 369,
              "end": 371
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 375,
              "end": 377
            }
          },
          "value": {
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
                        "start": 382,
                        "end": 384
                      }
                    }
                  },
                  "span": {
                    "start": 382,
                    "end": 384
                  }
                },
                {
                  "key": {
                    "kind": {
                      "String": "k"
                    },
                    "span": {
                      "start": 386,
                      "end": 389
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 393,
                        "end": 395
                      }
                    }
                  },
                  "span": {
                    "start": 386,
                    "end": 395
                  }
                }
              ]
            },
            "span": {
              "start": 381,
              "end": 396
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 398,
              "end": 400
            }
          }
        }
      },
      "span": {
        "start": 360,
        "end": 400
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
              "start": 410,
              "end": 412
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
                      "start": 421,
                      "end": 424
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 428,
                        "end": 430
                      }
                    }
                  },
                  "span": {
                    "start": 421,
                    "end": 430
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
                        "start": 432,
                        "end": 434
                      }
                    }
                  },
                  "span": {
                    "start": 432,
                    "end": 434
                  }
                }
              ]
            },
            "span": {
              "start": 416,
              "end": 435
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 436,
              "end": 437
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 401,
        "end": 449
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 449
  }
}
