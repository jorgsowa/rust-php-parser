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
                  "end": 12,
                  "start_line": 2,
                  "start_col": 0
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
                          "start": 16,
                          "end": 17,
                          "start_line": 2,
                          "start_col": 10
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 16,
                        "end": 17,
                        "start_line": 2,
                        "start_col": 10
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 2
                        },
                        "span": {
                          "start": 19,
                          "end": 20,
                          "start_line": 2,
                          "start_col": 13
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 19,
                        "end": 20,
                        "start_line": 2,
                        "start_col": 13
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 22,
                          "end": 23,
                          "start_line": 2,
                          "start_col": 16
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 22,
                        "end": 23,
                        "start_line": 2,
                        "start_col": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 15,
                  "end": 24,
                  "start_line": 2,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 24,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 27,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "getArr",
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Array": [
                      {
                        "key": null,
                        "value": {
                          "kind": {
                            "Int": 4
                          },
                          "span": {
                            "start": 56,
                            "end": 57,
                            "start_line": 5,
                            "start_col": 9
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 56,
                          "end": 57,
                          "start_line": 5,
                          "start_col": 9
                        }
                      },
                      {
                        "key": null,
                        "value": {
                          "kind": {
                            "Int": 5
                          },
                          "span": {
                            "start": 59,
                            "end": 60,
                            "start_line": 5,
                            "start_col": 12
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 59,
                          "end": 60,
                          "start_line": 5,
                          "start_col": 12
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 55,
                    "end": 61,
                    "start_line": 5,
                    "start_col": 8
                  }
                }
              },
              "span": {
                "start": 48,
                "end": 63,
                "start_line": 5,
                "start_col": 1
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
        "end": 64,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "arrGen",
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
                              "end": 93,
                              "start_line": 9,
                              "start_col": 5
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 11
                            },
                            "span": {
                              "start": 96,
                              "end": 98,
                              "start_line": 9,
                              "start_col": 10
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 91,
                        "end": 98,
                        "start_line": 9,
                        "start_col": 5
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
                              "end": 102,
                              "start_line": 9,
                              "start_col": 14
                            }
                          },
                          "op": "Less",
                          "right": {
                            "kind": {
                              "Int": 15
                            },
                            "span": {
                              "start": 105,
                              "end": 107,
                              "start_line": 9,
                              "start_col": 19
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 100,
                        "end": 107,
                        "start_line": 9,
                        "start_col": 14
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
                              "end": 111,
                              "start_line": 9,
                              "start_col": 23
                            }
                          },
                          "op": "PostIncrement"
                        }
                      },
                      "span": {
                        "start": 109,
                        "end": 113,
                        "start_line": 9,
                        "start_col": 23
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
                                      "end": 127,
                                      "start_line": 10,
                                      "start_col": 8
                                    }
                                  },
                                  "is_from": false
                                }
                              },
                              "span": {
                                "start": 119,
                                "end": 127,
                                "start_line": 10,
                                "start_col": 2
                              }
                            }
                          },
                          "span": {
                            "start": 119,
                            "end": 130,
                            "start_line": 10,
                            "start_col": 2
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 115,
                      "end": 131,
                      "start_line": 9,
                      "start_col": 29
                    }
                  }
                }
              },
              "span": {
                "start": 87,
                "end": 131,
                "start_line": 9,
                "start_col": 1
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
        "end": 133,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Array": []
                  },
                  "span": {
                    "start": 139,
                    "end": 141,
                    "start_line": 14,
                    "start_col": 4
                  }
                },
                "unpack": true,
                "span": {
                  "start": 136,
                  "end": 141,
                  "start_line": 14,
                  "start_col": 1
                }
              }
            ]
          },
          "span": {
            "start": 135,
            "end": 142,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 135,
        "end": 144,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
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
                            "start": 149,
                            "end": 150,
                            "start_line": 15,
                            "start_col": 5
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 149,
                          "end": 150,
                          "start_line": 15,
                          "start_col": 5
                        }
                      },
                      {
                        "key": null,
                        "value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 152,
                            "end": 153,
                            "start_line": 15,
                            "start_col": 8
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 152,
                          "end": 153,
                          "start_line": 15,
                          "start_col": 8
                        }
                      },
                      {
                        "key": null,
                        "value": {
                          "kind": {
                            "Int": 3
                          },
                          "span": {
                            "start": 155,
                            "end": 156,
                            "start_line": 15,
                            "start_col": 11
                          }
                        },
                        "unpack": false,
                        "span": {
                          "start": 155,
                          "end": 156,
                          "start_line": 15,
                          "start_col": 11
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 148,
                    "end": 157,
                    "start_line": 15,
                    "start_col": 4
                  }
                },
                "unpack": true,
                "span": {
                  "start": 145,
                  "end": 157,
                  "start_line": 15,
                  "start_col": 1
                }
              }
            ]
          },
          "span": {
            "start": 144,
            "end": 158,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 144,
        "end": 160,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Variable": "array"
                  },
                  "span": {
                    "start": 164,
                    "end": 170,
                    "start_line": 16,
                    "start_col": 4
                  }
                },
                "unpack": true,
                "span": {
                  "start": 161,
                  "end": 170,
                  "start_line": 16,
                  "start_col": 1
                }
              }
            ]
          },
          "span": {
            "start": 160,
            "end": 171,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 160,
        "end": 173,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "getArr"
                        },
                        "span": {
                          "start": 177,
                          "end": 183,
                          "start_line": 17,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 177,
                    "end": 185,
                    "start_line": 17,
                    "start_col": 4
                  }
                },
                "unpack": true,
                "span": {
                  "start": 174,
                  "end": 185,
                  "start_line": 17,
                  "start_col": 1
                }
              }
            ]
          },
          "span": {
            "start": 173,
            "end": 186,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 173,
        "end": 188,
        "start_line": 17,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "arrGen"
                        },
                        "span": {
                          "start": 192,
                          "end": 198,
                          "start_line": 18,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 192,
                    "end": 200,
                    "start_line": 18,
                    "start_col": 4
                  }
                },
                "unpack": true,
                "span": {
                  "start": 189,
                  "end": 200,
                  "start_line": 18,
                  "start_col": 1
                }
              }
            ]
          },
          "span": {
            "start": 188,
            "end": 201,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 188,
        "end": 203,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Identifier": "ArrayIterator"
                        },
                        "span": {
                          "start": 211,
                          "end": 224,
                          "start_line": 19,
                          "start_col": 8
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Array": [
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "String": "a"
                                    },
                                    "span": {
                                      "start": 226,
                                      "end": 229,
                                      "start_line": 19,
                                      "start_col": 23
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 226,
                                    "end": 229,
                                    "start_line": 19,
                                    "start_col": 23
                                  }
                                },
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "String": "b"
                                    },
                                    "span": {
                                      "start": 231,
                                      "end": 234,
                                      "start_line": 19,
                                      "start_col": 28
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 231,
                                    "end": 234,
                                    "start_line": 19,
                                    "start_col": 28
                                  }
                                },
                                {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "String": "c"
                                    },
                                    "span": {
                                      "start": 236,
                                      "end": 239,
                                      "start_line": 19,
                                      "start_col": 33
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 236,
                                    "end": 239,
                                    "start_line": 19,
                                    "start_col": 33
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 225,
                              "end": 240,
                              "start_line": 19,
                              "start_col": 22
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 225,
                            "end": 240,
                            "start_line": 19,
                            "start_col": 22
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 207,
                    "end": 241,
                    "start_line": 19,
                    "start_col": 4
                  }
                },
                "unpack": true,
                "span": {
                  "start": 204,
                  "end": 241,
                  "start_line": 19,
                  "start_col": 1
                }
              }
            ]
          },
          "span": {
            "start": 203,
            "end": 242,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 203,
        "end": 244,
        "start_line": 19,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 245,
                    "end": 246,
                    "start_line": 20,
                    "start_col": 1
                  }
                },
                "unpack": false,
                "span": {
                  "start": 245,
                  "end": 246,
                  "start_line": 20,
                  "start_col": 1
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Variable": "array"
                  },
                  "span": {
                    "start": 251,
                    "end": 257,
                    "start_line": 20,
                    "start_col": 7
                  }
                },
                "unpack": true,
                "span": {
                  "start": 248,
                  "end": 257,
                  "start_line": 20,
                  "start_col": 4
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "getArr"
                        },
                        "span": {
                          "start": 262,
                          "end": 268,
                          "start_line": 20,
                          "start_col": 18
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 262,
                    "end": 270,
                    "start_line": 20,
                    "start_col": 18
                  }
                },
                "unpack": true,
                "span": {
                  "start": 259,
                  "end": 270,
                  "start_line": 20,
                  "start_col": 15
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 6
                  },
                  "span": {
                    "start": 272,
                    "end": 273,
                    "start_line": 20,
                    "start_col": 28
                  }
                },
                "unpack": false,
                "span": {
                  "start": 272,
                  "end": 273,
                  "start_line": 20,
                  "start_col": 28
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 7
                  },
                  "span": {
                    "start": 275,
                    "end": 276,
                    "start_line": 20,
                    "start_col": 31
                  }
                },
                "unpack": false,
                "span": {
                  "start": 275,
                  "end": 276,
                  "start_line": 20,
                  "start_col": 31
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 8
                  },
                  "span": {
                    "start": 278,
                    "end": 279,
                    "start_line": 20,
                    "start_col": 34
                  }
                },
                "unpack": false,
                "span": {
                  "start": 278,
                  "end": 279,
                  "start_line": 20,
                  "start_col": 34
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 9
                  },
                  "span": {
                    "start": 281,
                    "end": 282,
                    "start_line": 20,
                    "start_col": 37
                  }
                },
                "unpack": false,
                "span": {
                  "start": 281,
                  "end": 282,
                  "start_line": 20,
                  "start_col": 37
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 10
                  },
                  "span": {
                    "start": 284,
                    "end": 286,
                    "start_line": 20,
                    "start_col": 40
                  }
                },
                "unpack": false,
                "span": {
                  "start": 284,
                  "end": 286,
                  "start_line": 20,
                  "start_col": 40
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "arrGen"
                        },
                        "span": {
                          "start": 291,
                          "end": 297,
                          "start_line": 20,
                          "start_col": 47
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 291,
                    "end": 299,
                    "start_line": 20,
                    "start_col": 47
                  }
                },
                "unpack": true,
                "span": {
                  "start": 288,
                  "end": 299,
                  "start_line": 20,
                  "start_col": 44
                }
              }
            ]
          },
          "span": {
            "start": 244,
            "end": 300,
            "start_line": 20,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 244,
        "end": 302,
        "start_line": 20,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": [
              {
                "key": null,
                "value": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 303,
                    "end": 304,
                    "start_line": 21,
                    "start_col": 1
                  }
                },
                "unpack": false,
                "span": {
                  "start": 303,
                  "end": 304,
                  "start_line": 21,
                  "start_col": 1
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Variable": "array"
                  },
                  "span": {
                    "start": 309,
                    "end": 315,
                    "start_line": 21,
                    "start_col": 7
                  }
                },
                "unpack": true,
                "span": {
                  "start": 306,
                  "end": 315,
                  "start_line": 21,
                  "start_col": 4
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "Variable": "array"
                  },
                  "span": {
                    "start": 320,
                    "end": 326,
                    "start_line": 21,
                    "start_col": 18
                  }
                },
                "unpack": true,
                "span": {
                  "start": 317,
                  "end": 326,
                  "start_line": 21,
                  "start_col": 15
                }
              },
              {
                "key": null,
                "value": {
                  "kind": {
                    "String": "end"
                  },
                  "span": {
                    "start": 328,
                    "end": 333,
                    "start_line": 21,
                    "start_col": 26
                  }
                },
                "unpack": false,
                "span": {
                  "start": 328,
                  "end": 333,
                  "start_line": 21,
                  "start_col": 26
                }
              }
            ]
          },
          "span": {
            "start": 302,
            "end": 334,
            "start_line": 21,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 302,
        "end": 335,
        "start_line": 21,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 335,
    "start_line": 1,
    "start_col": 0
  }
}
