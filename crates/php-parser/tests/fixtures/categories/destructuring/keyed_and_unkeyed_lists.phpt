===source===
<?php
['k' => $a,] = $x;
[$a, ,] = $x;
[, $a] = $x;
[, , $a, , $b] = $x;
list(, $a) = $x;
['k' => [$a, $b], 'j' => ['x' => $c]] = $x;
[[, $a], ['k' => $b]] = $x;
[0 => $a, 'k' => $b] = $x;
['k' => &$a, 'j' => [&$b]] = $x;
foreach ($x as ['a' => $a, 'b' => [$b, , $c]]) {}
foreach ($x as $k => [, $a]) {}
$y = [1, 'k' => 2];
$z = [[1, 'k' => 2], 'j' => [3]];
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
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 14,
                          "end": 16
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 7,
                        "end": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 21,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
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
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 26,
                          "end": 28
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 26,
                        "end": 28
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 30,
                          "end": 31
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 30,
                        "end": 31
                      }
                    }
                  ]
                },
                "span": {
                  "start": 25,
                  "end": 32
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 35,
                  "end": 37
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 37
          }
        }
      },
      "span": {
        "start": 25,
        "end": 38
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
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 40,
                          "end": 41
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 40,
                        "end": 41
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 42,
                          "end": 44
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 42,
                        "end": 44
                      }
                    }
                  ]
                },
                "span": {
                  "start": 39,
                  "end": 45
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 48,
                  "end": 50
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 50
          }
        }
      },
      "span": {
        "start": 39,
        "end": 51
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
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 53,
                          "end": 54
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 53,
                        "end": 54
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 55,
                          "end": 56
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 55,
                        "end": 56
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 57,
                          "end": 59
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 57,
                        "end": 59
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 61,
                          "end": 62
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 61,
                        "end": 62
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 63,
                          "end": 65
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 63,
                        "end": 65
                      }
                    }
                  ]
                },
                "span": {
                  "start": 52,
                  "end": 66
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 69,
                  "end": 71
                }
              }
            }
          },
          "span": {
            "start": 52,
            "end": 71
          }
        }
      },
      "span": {
        "start": 52,
        "end": 72
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
                      "value": {
                        "kind": "Omit",
                        "span": {
                          "start": 78,
                          "end": 79
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 80,
                          "end": 82
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 80,
                        "end": 82
                      }
                    }
                  ]
                },
                "span": {
                  "start": 73,
                  "end": 83
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 86,
                  "end": 88
                }
              }
            }
          },
          "span": {
            "start": 73,
            "end": 88
          }
        }
      },
      "span": {
        "start": 73,
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
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 91,
                          "end": 94
                        }
                      },
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 99,
                                  "end": 101
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 99,
                                "end": 101
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 103,
                                  "end": 105
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 103,
                                "end": 105
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 98,
                          "end": 106
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 91,
                        "end": 106
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "j"
                        },
                        "span": {
                          "start": 108,
                          "end": 111
                        }
                      },
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": {
                                "kind": {
                                  "String": "x"
                                },
                                "span": {
                                  "start": 116,
                                  "end": 119
                                }
                              },
                              "value": {
                                "kind": {
                                  "Variable": "c"
                                },
                                "span": {
                                  "start": 123,
                                  "end": 125
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 116,
                                "end": 125
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 115,
                          "end": 126
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 108,
                        "end": 126
                      }
                    }
                  ]
                },
                "span": {
                  "start": 90,
                  "end": 127
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 130,
                  "end": 132
                }
              }
            }
          },
          "span": {
            "start": 90,
            "end": 132
          }
        }
      },
      "span": {
        "start": 90,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": "Omit",
                                "span": {
                                  "start": 136,
                                  "end": 137
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 136,
                                "end": 137
                              }
                            },
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 138,
                                  "end": 140
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 138,
                                "end": 140
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 135,
                          "end": 141
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 135,
                        "end": 141
                      }
                    },
                    {
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
                                  "start": 144,
                                  "end": 147
                                }
                              },
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 151,
                                  "end": 153
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 144,
                                "end": 153
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 143,
                          "end": 154
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 143,
                        "end": 154
                      }
                    }
                  ]
                },
                "span": {
                  "start": 134,
                  "end": 155
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 158,
                  "end": 160
                }
              }
            }
          },
          "span": {
            "start": 134,
            "end": 160
          }
        }
      },
      "span": {
        "start": 134,
        "end": 161
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
                          "Int": 0
                        },
                        "span": {
                          "start": 163,
                          "end": 164
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 168,
                          "end": 170
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 163,
                        "end": 170
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 172,
                          "end": 175
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 179,
                          "end": 181
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 172,
                        "end": 181
                      }
                    }
                  ]
                },
                "span": {
                  "start": 162,
                  "end": 182
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 185,
                  "end": 187
                }
              }
            }
          },
          "span": {
            "start": 162,
            "end": 187
          }
        }
      },
      "span": {
        "start": 162,
        "end": 188
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
                          "start": 190,
                          "end": 193
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 198,
                          "end": 200
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 190,
                        "end": 200
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "j"
                        },
                        "span": {
                          "start": 202,
                          "end": 205
                        }
                      },
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 211,
                                  "end": 213
                                }
                              },
                              "unpack": false,
                              "by_ref": true,
                              "span": {
                                "start": 210,
                                "end": 213
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 209,
                          "end": 214
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 202,
                        "end": 214
                      }
                    }
                  ]
                },
                "span": {
                  "start": 189,
                  "end": 215
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 218,
                  "end": 220
                }
              }
            }
          },
          "span": {
            "start": 189,
            "end": 220
          }
        }
      },
      "span": {
        "start": 189,
        "end": 221
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
              "start": 231,
              "end": 233
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 238,
                      "end": 241
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 245,
                      "end": 247
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 238,
                    "end": 247
                  }
                },
                {
                  "key": {
                    "kind": {
                      "String": "b"
                    },
                    "span": {
                      "start": 249,
                      "end": 252
                    }
                  },
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 257,
                              "end": 259
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 257,
                            "end": 259
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": "Omit",
                            "span": {
                              "start": 261,
                              "end": 262
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 261,
                            "end": 262
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 263,
                              "end": 265
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 263,
                            "end": 265
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 256,
                      "end": 266
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 249,
                    "end": 266
                  }
                }
              ]
            },
            "span": {
              "start": 237,
              "end": 267
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 269,
              "end": 271
            }
          }
        }
      },
      "span": {
        "start": 222,
        "end": 271
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
              "start": 281,
              "end": 283
            }
          },
          "key": {
            "kind": {
              "Variable": "k"
            },
            "span": {
              "start": 287,
              "end": 289
            }
          },
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "value": {
                    "kind": "Omit",
                    "span": {
                      "start": 294,
                      "end": 295
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 294,
                    "end": 295
                  }
                },
                {
                  "key": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 296,
                      "end": 298
                    }
                  },
                  "unpack": false,
                  "span": {
                    "start": 296,
                    "end": 298
                  }
                }
              ]
            },
            "span": {
              "start": 293,
              "end": 299
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 301,
              "end": 303
            }
          }
        }
      },
      "span": {
        "start": 272,
        "end": 303
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
                  "start": 304,
                  "end": 306
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 310,
                          "end": 311
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 310,
                        "end": 311
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 313,
                          "end": 316
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 320,
                          "end": 321
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 313,
                        "end": 321
                      }
                    }
                  ]
                },
                "span": {
                  "start": 309,
                  "end": 322
                }
              }
            }
          },
          "span": {
            "start": 304,
            "end": 322
          }
        }
      },
      "span": {
        "start": 304,
        "end": 323
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 324,
                  "end": 326
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 331,
                                  "end": 332
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 331,
                                "end": 332
                              }
                            },
                            {
                              "key": {
                                "kind": {
                                  "String": "k"
                                },
                                "span": {
                                  "start": 334,
                                  "end": 337
                                }
                              },
                              "value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 341,
                                  "end": 342
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 334,
                                "end": 342
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 330,
                          "end": 343
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 330,
                        "end": 343
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "j"
                        },
                        "span": {
                          "start": 345,
                          "end": 348
                        }
                      },
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "Int": 3
                                },
                                "span": {
                                  "start": 353,
                                  "end": 354
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 353,
                                "end": 354
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 352,
                          "end": 355
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 345,
                        "end": 355
                      }
                    }
                  ]
                },
                "span": {
                  "start": 329,
                  "end": 356
                }
              }
            }
          },
          "span": {
            "start": 324,
            "end": 356
          }
        }
      },
      "span": {
        "start": 324,
        "end": 357
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 357
  }
}
