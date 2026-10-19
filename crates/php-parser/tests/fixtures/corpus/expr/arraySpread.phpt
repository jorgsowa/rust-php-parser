===source===
<?php
$array = [1, 2, 3];

function getArr() {
	return [4, 5];
}

function arrGen() {
	for($i = 11; $i < 15; $i++) {
		yield $i;
	}
}

[...[]];
[...[1, 2, 3]];
[...$array];
[...getArr()];
[...arrGen()];
[...new ArrayIterator(['a', 'b', 'c'])];
[0, ...$array, ...getArr(), 6, 7, 8, 9, 10, ...arrGen()];
[0, ...$array, ...$array, 'end'];
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
                  "Variable": "array"
                },
                "span": {
                  "start": 6,
                  "end": 12
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
                            "Int": 1
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 17
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 22,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 22,
                        "end": 23
                      }
                    }
                  ]
                },
                "span": {
                  "start": 15,
                  "end": 24
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "getArr",
            "span": {
              "start": 36,
              "end": 42
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Array": [
                      {
                        "key": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 4
                            },
                            "span": {
                              "start": 56,
                              "end": 57
                            }
                          }
                        },
                        "span": {
                          "start": 56,
                          "end": 57
                        }
                      },
                      {
                        "key": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 5
                            },
                            "span": {
                              "start": 59,
                              "end": 60
                            }
                          }
                        },
                        "span": {
                          "start": 59,
                          "end": 60
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 55,
                    "end": 61
                  }
                }
              },
              "span": {
                "start": 48,
                "end": 62
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 27,
        "end": 64
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "arrGen",
            "span": {
              "start": 75,
              "end": 81
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "For": {
                  "init": [
                    {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "i"
                            },
                            "span": {
                              "start": 91,
                              "end": 93
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 11
                            },
                            "span": {
                              "start": 96,
                              "end": 98
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 98
                      }
                    }
                  ],
                  "condition": [
                    {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "i"
                            },
                            "span": {
                              "start": 100,
                              "end": 102
                            }
                          },
                          "op": "Less",
                          "right": {
                            "kind": {
                              "Int": 15
                            },
                            "span": {
                              "start": 105,
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
                  ],
                  "update": [
                    {
                      "kind": {
                        "UnaryPostfix": {
                          "operand": {
                            "kind": {
                              "Variable": "i"
                            },
                            "span": {
                              "start": 109,
                              "end": 111
                            }
                          },
                          "op": "PostIncrement"
                        }
                      },
                      "span": {
                        "start": 109,
                        "end": 113
                      }
                    }
                  ],
                  "body": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "Expression": {
                              "kind": {
                                "Yield": {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Variable": "i"
                                    },
                                    "span": {
                                      "start": 125,
                                      "end": 127
                                    }
                                  },
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 119,
                                "end": 127
                              }
                            }
                          },
                          "span": {
                            "start": 119,
                            "end": 128
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 115,
                      "end": 131
                    }
                  }
                }
              },
              "span": {
                "start": 87,
                "end": 131
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 66,
        "end": 133
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 139,
                      "end": 141
                    }
                  }
                },
                "span": {
                  "start": 136,
                  "end": 141
                }
              }
            ]
          },
          "span": {
            "start": 135,
            "end": 142
          }
        }
      },
      "span": {
        "start": 135,
        "end": 143
      }
    },
    {
      "kind": {
        "Expression": {
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
                                "Int": 1
                              },
                              "span": {
                                "start": 149,
                                "end": 150
                              }
                            }
                          },
                          "span": {
                            "start": 149,
                            "end": 150
                          }
                        },
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 2
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
                        },
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 3
                              },
                              "span": {
                                "start": 155,
                                "end": 156
                              }
                            }
                          },
                          "span": {
                            "start": 155,
                            "end": 156
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 148,
                      "end": 157
                    }
                  }
                },
                "span": {
                  "start": 145,
                  "end": 157
                }
              }
            ]
          },
          "span": {
            "start": 144,
            "end": 158
          }
        }
      },
      "span": {
        "start": 144,
        "end": 159
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "Variable": "array"
                    },
                    "span": {
                      "start": 164,
                      "end": 170
                    }
                  }
                },
                "span": {
                  "start": 161,
                  "end": 170
                }
              }
            ]
          },
          "span": {
            "start": 160,
            "end": 171
          }
        }
      },
      "span": {
        "start": 160,
        "end": 172
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "getArr"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 177,
                                "end": 183
                              }
                            }
                          },
                          "span": {
                            "start": 177,
                            "end": 183
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 177,
                      "end": 185
                    }
                  }
                },
                "span": {
                  "start": 174,
                  "end": 185
                }
              }
            ]
          },
          "span": {
            "start": 173,
            "end": 186
          }
        }
      },
      "span": {
        "start": 173,
        "end": 187
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "arrGen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 192,
                                "end": 198
                              }
                            }
                          },
                          "span": {
                            "start": 192,
                            "end": 198
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 192,
                      "end": 200
                    }
                  }
                },
                "span": {
                  "start": 189,
                  "end": 200
                }
              }
            ]
          },
          "span": {
            "start": 188,
            "end": 201
          }
        }
      },
      "span": {
        "start": 188,
        "end": 202
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "ArrayIterator"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 211,
                                "end": 224
                              }
                            }
                          },
                          "span": {
                            "start": 211,
                            "end": 224
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Array": [
                                    {
                                      "key": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "String": "a"
                                          },
                                          "span": {
                                            "start": 226,
                                            "end": 229
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 226,
                                        "end": 229
                                      }
                                    },
                                    {
                                      "key": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "String": "b"
                                          },
                                          "span": {
                                            "start": 231,
                                            "end": 234
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 231,
                                        "end": 234
                                      }
                                    },
                                    {
                                      "key": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "String": "c"
                                          },
                                          "span": {
                                            "start": 236,
                                            "end": 239
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 236,
                                        "end": 239
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 225,
                                  "end": 240
                                }
                              }
                            },
                            "span": {
                              "start": 225,
                              "end": 240
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 207,
                      "end": 241
                    }
                  }
                },
                "span": {
                  "start": 204,
                  "end": 241
                }
              }
            ]
          },
          "span": {
            "start": 203,
            "end": 242
          }
        }
      },
      "span": {
        "start": 203,
        "end": 243
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 245,
                      "end": 246
                    }
                  }
                },
                "span": {
                  "start": 245,
                  "end": 246
                }
              },
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "Variable": "array"
                    },
                    "span": {
                      "start": 251,
                      "end": 257
                    }
                  }
                },
                "span": {
                  "start": 248,
                  "end": 257
                }
              },
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "getArr"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 262,
                                "end": 268
                              }
                            }
                          },
                          "span": {
                            "start": 262,
                            "end": 268
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 262,
                      "end": 270
                    }
                  }
                },
                "span": {
                  "start": 259,
                  "end": 270
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 6
                    },
                    "span": {
                      "start": 272,
                      "end": 273
                    }
                  }
                },
                "span": {
                  "start": 272,
                  "end": 273
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 7
                    },
                    "span": {
                      "start": 275,
                      "end": 276
                    }
                  }
                },
                "span": {
                  "start": 275,
                  "end": 276
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 8
                    },
                    "span": {
                      "start": 278,
                      "end": 279
                    }
                  }
                },
                "span": {
                  "start": 278,
                  "end": 279
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 9
                    },
                    "span": {
                      "start": 281,
                      "end": 282
                    }
                  }
                },
                "span": {
                  "start": 281,
                  "end": 282
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 284,
                      "end": 286
                    }
                  }
                },
                "span": {
                  "start": 284,
                  "end": 286
                }
              },
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "arrGen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 291,
                                "end": 297
                              }
                            }
                          },
                          "span": {
                            "start": 291,
                            "end": 297
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 291,
                      "end": 299
                    }
                  }
                },
                "span": {
                  "start": 288,
                  "end": 299
                }
              }
            ]
          },
          "span": {
            "start": 244,
            "end": 300
          }
        }
      },
      "span": {
        "start": 244,
        "end": 301
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 303,
                      "end": 304
                    }
                  }
                },
                "span": {
                  "start": 303,
                  "end": 304
                }
              },
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "Variable": "array"
                    },
                    "span": {
                      "start": 309,
                      "end": 315
                    }
                  }
                },
                "span": {
                  "start": 306,
                  "end": 315
                }
              },
              {
                "key": null,
                "kind": {
                  "Spread": {
                    "kind": {
                      "Variable": "array"
                    },
                    "span": {
                      "start": 320,
                      "end": 326
                    }
                  }
                },
                "span": {
                  "start": 317,
                  "end": 326
                }
              },
              {
                "key": null,
                "kind": {
                  "Value": {
                    "kind": {
                      "String": "end"
                    },
                    "span": {
                      "start": 328,
                      "end": 333
                    }
                  }
                },
                "span": {
                  "start": 328,
                  "end": 333
                }
              }
            ]
          },
          "span": {
            "start": 302,
            "end": 334
          }
        }
      },
      "span": {
        "start": 302,
        "end": 335
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 335
  }
}
