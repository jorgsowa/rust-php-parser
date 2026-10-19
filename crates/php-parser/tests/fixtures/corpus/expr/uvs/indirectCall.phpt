===source===
<?php

id('var_dump')(1);
id('id')('var_dump')(2);
id()()('var_dump')(4);
id(['udef', 'id'])[1]()('var_dump')(5);
(function($x) { return $x; })('id')('var_dump')(8);
($f = function($x = null) use (&$f) {
    return $x ?: $f;
})()()()('var_dump')(9);
[$obj, 'id']()('id')($id)('var_dump')(10);
'id'()('id')('var_dump')(12);
('i' . 'd')()('var_dump')(13);
'\id'('var_dump')(14);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "id"
                          ],
                          "kind": "Unqualified",
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
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 10,
                              "end": 20
                            }
                          }
                        },
                        "span": {
                          "start": 10,
                          "end": 20
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 7,
                  "end": 21
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
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
            }
          },
          "span": {
            "start": 7,
            "end": 24
          }
        }
      },
      "span": {
        "start": 7,
        "end": 25
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "id"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 26,
                                  "end": 28
                                }
                              }
                            },
                            "span": {
                              "start": 26,
                              "end": 28
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "id"
                                  },
                                  "span": {
                                    "start": 29,
                                    "end": 33
                                  }
                                }
                              },
                              "span": {
                                "start": 29,
                                "end": 33
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 34
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 35,
                              "end": 45
                            }
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 45
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 26,
                  "end": 46
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 47,
                        "end": 48
                      }
                    }
                  },
                  "span": {
                    "start": 47,
                    "end": 48
                  }
                }
              ]
            }
          },
          "span": {
            "start": 26,
            "end": 49
          }
        }
      },
      "span": {
        "start": 26,
        "end": 50
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "id"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 51,
                                        "end": 53
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 51,
                                    "end": 53
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 51,
                              "end": 55
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 57
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 58,
                              "end": 68
                            }
                          }
                        },
                        "span": {
                          "start": 58,
                          "end": 68
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 51,
                  "end": 69
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 4
                      },
                      "span": {
                        "start": 70,
                        "end": 71
                      }
                    }
                  },
                  "span": {
                    "start": 70,
                    "end": 71
                  }
                }
              ]
            }
          },
          "span": {
            "start": 51,
            "end": 72
          }
        }
      },
      "span": {
        "start": 51,
        "end": 73
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "id"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 74,
                                              "end": 76
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 74,
                                          "end": 76
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
                                                          "String": "udef"
                                                        },
                                                        "span": {
                                                          "start": 78,
                                                          "end": 84
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 78,
                                                      "end": 84
                                                    }
                                                  },
                                                  {
                                                    "key": null,
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "String": "id"
                                                        },
                                                        "span": {
                                                          "start": 86,
                                                          "end": 90
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 86,
                                                      "end": 90
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 77,
                                                "end": 91
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 77,
                                            "end": 91
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 74,
                                    "end": 92
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 93,
                                    "end": 94
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 74,
                              "end": 95
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 74,
                        "end": 97
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 98,
                              "end": 108
                            }
                          }
                        },
                        "span": {
                          "start": 98,
                          "end": 108
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 74,
                  "end": 109
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 5
                      },
                      "span": {
                        "start": 110,
                        "end": 111
                      }
                    }
                  },
                  "span": {
                    "start": 110,
                    "end": 111
                  }
                }
              ]
            }
          },
          "span": {
            "start": 74,
            "end": 112
          }
        }
      },
      "span": {
        "start": 74,
        "end": 113
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Closure": {
                                    "is_static": false,
                                    "by_ref": false,
                                    "params": [
                                      {
                                        "name": {
                                          "name": "x",
                                          "span": {
                                            "start": 124,
                                            "end": 126
                                          }
                                        },
                                        "type_hint": null,
                                        "default": null,
                                        "by_ref": false,
                                        "variadic": false,
                                        "is_readonly": false,
                                        "is_final": false,
                                        "visibility": null,
                                        "set_visibility": null,
                                        "attributes": [],
                                        "span": {
                                          "start": 124,
                                          "end": 126
                                        }
                                      }
                                    ],
                                    "use_vars": [],
                                    "return_type": null,
                                    "body": [
                                      {
                                        "kind": {
                                          "Return": {
                                            "kind": {
                                              "Variable": "x"
                                            },
                                            "span": {
                                              "start": 137,
                                              "end": 139
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 130,
                                          "end": 140
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 115,
                                  "end": 142
                                }
                              }
                            },
                            "span": {
                              "start": 114,
                              "end": 143
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "id"
                                  },
                                  "span": {
                                    "start": 144,
                                    "end": 148
                                  }
                                }
                              },
                              "span": {
                                "start": 144,
                                "end": 148
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 149
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 150,
                              "end": 160
                            }
                          }
                        },
                        "span": {
                          "start": 150,
                          "end": 160
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 114,
                  "end": 161
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 8
                      },
                      "span": {
                        "start": 162,
                        "end": 163
                      }
                    }
                  },
                  "span": {
                    "start": 162,
                    "end": 163
                  }
                }
              ]
            }
          },
          "span": {
            "start": 114,
            "end": 164
          }
        }
      },
      "span": {
        "start": 114,
        "end": 165
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Parenthesized": {
                                            "kind": {
                                              "Assign": {
                                                "target": {
                                                  "kind": {
                                                    "Variable": "f"
                                                  },
                                                  "span": {
                                                    "start": 167,
                                                    "end": 169
                                                  }
                                                },
                                                "op": "Assign",
                                                "value": {
                                                  "kind": {
                                                    "Closure": {
                                                      "is_static": false,
                                                      "by_ref": false,
                                                      "params": [
                                                        {
                                                          "name": {
                                                            "name": "x",
                                                            "span": {
                                                              "start": 181,
                                                              "end": 183
                                                            }
                                                          },
                                                          "type_hint": null,
                                                          "default": {
                                                            "kind": "Null",
                                                            "span": {
                                                              "start": 186,
                                                              "end": 190
                                                            }
                                                          },
                                                          "by_ref": false,
                                                          "variadic": false,
                                                          "is_readonly": false,
                                                          "is_final": false,
                                                          "visibility": null,
                                                          "set_visibility": null,
                                                          "attributes": [],
                                                          "span": {
                                                            "start": 181,
                                                            "end": 190
                                                          }
                                                        }
                                                      ],
                                                      "use_vars": [
                                                        {
                                                          "name": {
                                                            "name": "f",
                                                            "span": {
                                                              "start": 198,
                                                              "end": 200
                                                            }
                                                          },
                                                          "by_ref": true,
                                                          "span": {
                                                            "start": 197,
                                                            "end": 200
                                                          }
                                                        }
                                                      ],
                                                      "return_type": null,
                                                      "body": [
                                                        {
                                                          "kind": {
                                                            "Return": {
                                                              "kind": {
                                                                "Ternary": {
                                                                  "condition": {
                                                                    "kind": {
                                                                      "Variable": "x"
                                                                    },
                                                                    "span": {
                                                                      "start": 215,
                                                                      "end": 217
                                                                    }
                                                                  },
                                                                  "then_expr": null,
                                                                  "else_expr": {
                                                                    "kind": {
                                                                      "Variable": "f"
                                                                    },
                                                                    "span": {
                                                                      "start": 221,
                                                                      "end": 223
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 215,
                                                                "end": 223
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 208,
                                                            "end": 224
                                                          }
                                                        }
                                                      ],
                                                      "attributes": []
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 172,
                                                    "end": 226
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 167,
                                              "end": 226
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 166,
                                          "end": 227
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 166,
                                    "end": 229
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 166,
                              "end": 231
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 166,
                        "end": 233
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 234,
                              "end": 244
                            }
                          }
                        },
                        "span": {
                          "start": 234,
                          "end": 244
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 166,
                  "end": 245
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 9
                      },
                      "span": {
                        "start": 246,
                        "end": 247
                      }
                    }
                  },
                  "span": {
                    "start": 246,
                    "end": 247
                  }
                }
              ]
            }
          },
          "span": {
            "start": 166,
            "end": 248
          }
        }
      },
      "span": {
        "start": 166,
        "end": 249
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Array": [
                                            {
                                              "key": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Variable": "obj"
                                                  },
                                                  "span": {
                                                    "start": 251,
                                                    "end": 255
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 251,
                                                "end": 255
                                              }
                                            },
                                            {
                                              "key": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "String": "id"
                                                  },
                                                  "span": {
                                                    "start": 257,
                                                    "end": 261
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 257,
                                                "end": 261
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 250,
                                          "end": 262
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 250,
                                    "end": 264
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "String": "id"
                                        },
                                        "span": {
                                          "start": 265,
                                          "end": 269
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 265,
                                      "end": 269
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 250,
                              "end": 270
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "Variable": "id"
                                  },
                                  "span": {
                                    "start": 271,
                                    "end": 274
                                  }
                                }
                              },
                              "span": {
                                "start": 271,
                                "end": 274
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 250,
                        "end": 275
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 276,
                              "end": 286
                            }
                          }
                        },
                        "span": {
                          "start": 276,
                          "end": 286
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 250,
                  "end": 287
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 10
                      },
                      "span": {
                        "start": 288,
                        "end": 290
                      }
                    }
                  },
                  "span": {
                    "start": 288,
                    "end": 290
                  }
                }
              ]
            }
          },
          "span": {
            "start": 250,
            "end": 291
          }
        }
      },
      "span": {
        "start": 250,
        "end": 292
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "String": "id"
                                  },
                                  "span": {
                                    "start": 293,
                                    "end": 297
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 293,
                              "end": 299
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": {
                                "Value": {
                                  "kind": {
                                    "String": "id"
                                  },
                                  "span": {
                                    "start": 300,
                                    "end": 304
                                  }
                                }
                              },
                              "span": {
                                "start": 300,
                                "end": 304
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 293,
                        "end": 305
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 306,
                              "end": 316
                            }
                          }
                        },
                        "span": {
                          "start": 306,
                          "end": 316
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 293,
                  "end": 317
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 12
                      },
                      "span": {
                        "start": 318,
                        "end": 320
                      }
                    }
                  },
                  "span": {
                    "start": 318,
                    "end": 320
                  }
                }
              ]
            }
          },
          "span": {
            "start": 293,
            "end": 321
          }
        }
      },
      "span": {
        "start": 293,
        "end": 322
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "String": "i"
                                      },
                                      "span": {
                                        "start": 324,
                                        "end": 327
                                      }
                                    },
                                    "op": "Concat",
                                    "right": {
                                      "kind": {
                                        "String": "d"
                                      },
                                      "span": {
                                        "start": 330,
                                        "end": 333
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 324,
                                  "end": 333
                                }
                              }
                            },
                            "span": {
                              "start": 323,
                              "end": 334
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 323,
                        "end": 336
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 337,
                              "end": 347
                            }
                          }
                        },
                        "span": {
                          "start": 337,
                          "end": 347
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 323,
                  "end": 348
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 13
                      },
                      "span": {
                        "start": 349,
                        "end": 351
                      }
                    }
                  },
                  "span": {
                    "start": 349,
                    "end": 351
                  }
                }
              ]
            }
          },
          "span": {
            "start": 323,
            "end": 352
          }
        }
      },
      "span": {
        "start": 323,
        "end": 353
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "String": "\\id"
                      },
                      "span": {
                        "start": 354,
                        "end": 359
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "String": "var_dump"
                            },
                            "span": {
                              "start": 360,
                              "end": 370
                            }
                          }
                        },
                        "span": {
                          "start": 360,
                          "end": 370
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 354,
                  "end": 371
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 14
                      },
                      "span": {
                        "start": 372,
                        "end": 374
                      }
                    }
                  },
                  "span": {
                    "start": 372,
                    "end": 374
                  }
                }
              ]
            }
          },
          "span": {
            "start": 354,
            "end": 375
          }
        }
      },
      "span": {
        "start": 354,
        "end": 376
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 376
  }
}
