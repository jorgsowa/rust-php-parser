===source===
<?php

class A {
    public $prop = 1;
}

class B extends A {
    public $prop = 2 { get => parent::$prop::get() * 2; }
}

class C extends B {
    public $prop = 3;
}

function test(A $a) {
    var_dump($a);
    var_dump((array)$a);
    var_dump(unserialize(serialize($a)));
    var_dump(get_object_vars($a));
    var_dump(json_decode(json_encode($a)));
}

test(new B);
test(new C);

?>
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 13,
              "end": 14
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 28,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 37
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 40
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 48,
              "end": 49
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 58,
              "end": 59
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 73,
                      "end": 78
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 81,
                      "end": 82
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 92,
                                                  "end": 98
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 92,
                                              "end": 98
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "prop"
                                            },
                                            "span": {
                                              "start": 100,
                                              "end": 105
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 92,
                                        "end": 105
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "get"
                                      },
                                      "span": {
                                        "start": 107,
                                        "end": 110
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 92,
                                  "end": 112
                                }
                              },
                              "op": "Mul",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 115,
                                  "end": 116
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 92,
                            "end": 116
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 85,
                        "end": 117
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 66,
                "end": 119
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 42,
        "end": 121
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 129,
              "end": 130
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 139,
              "end": 140
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 154,
                      "end": 159
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 162,
                      "end": 163
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 147,
                "end": 163
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 123,
        "end": 166
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test",
            "span": {
              "start": 177,
              "end": 181
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 184,
                  "end": 186
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 182,
                      "end": 183
                    }
                  }
                },
                "span": {
                  "start": 182,
                  "end": 183
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 182,
                "end": 186
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_dump"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 194,
                              "end": 202
                            }
                          }
                        },
                        "span": {
                          "start": 194,
                          "end": 202
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 203,
                                "end": 205
                              }
                            }
                          },
                          "span": {
                            "start": 203,
                            "end": 205
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 194,
                    "end": 206
                  }
                }
              },
              "span": {
                "start": 194,
                "end": 207
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_dump"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 212,
                              "end": 220
                            }
                          }
                        },
                        "span": {
                          "start": 212,
                          "end": 220
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Cast": [
                                  "Array",
                                  {
                                    "kind": {
                                      "Variable": "a"
                                    },
                                    "span": {
                                      "start": 228,
                                      "end": 230
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 221,
                                "end": 230
                              }
                            }
                          },
                          "span": {
                            "start": 221,
                            "end": 230
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 212,
                    "end": 231
                  }
                }
              },
              "span": {
                "start": 212,
                "end": 232
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_dump"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 237,
                              "end": 245
                            }
                          }
                        },
                        "span": {
                          "start": 237,
                          "end": 245
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "unserialize"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 246,
                                          "end": 257
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 246,
                                      "end": 257
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "FunctionCall": {
                                              "name": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "serialize"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 258,
                                                      "end": 267
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 258,
                                                  "end": 267
                                                }
                                              },
                                              "args": [
                                                {
                                                  "name": null,
                                                  "kind": {
                                                    "Value": {
                                                      "kind": {
                                                        "Variable": "a"
                                                      },
                                                      "span": {
                                                        "start": 268,
                                                        "end": 270
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 268,
                                                    "end": 270
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 258,
                                            "end": 271
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 258,
                                        "end": 271
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 246,
                                "end": 272
                              }
                            }
                          },
                          "span": {
                            "start": 246,
                            "end": 272
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 237,
                    "end": 273
                  }
                }
              },
              "span": {
                "start": 237,
                "end": 274
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_dump"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 279,
                              "end": 287
                            }
                          }
                        },
                        "span": {
                          "start": 279,
                          "end": 287
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "get_object_vars"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 288,
                                          "end": 303
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 288,
                                      "end": 303
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Variable": "a"
                                          },
                                          "span": {
                                            "start": 304,
                                            "end": 306
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 304,
                                        "end": 306
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 288,
                                "end": 307
                              }
                            }
                          },
                          "span": {
                            "start": 288,
                            "end": 307
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 279,
                    "end": 308
                  }
                }
              },
              "span": {
                "start": 279,
                "end": 309
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_dump"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 314,
                              "end": 322
                            }
                          }
                        },
                        "span": {
                          "start": 314,
                          "end": 322
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "json_decode"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 323,
                                          "end": 334
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 323,
                                      "end": 334
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "FunctionCall": {
                                              "name": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "json_encode"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 335,
                                                      "end": 346
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 335,
                                                  "end": 346
                                                }
                                              },
                                              "args": [
                                                {
                                                  "name": null,
                                                  "kind": {
                                                    "Value": {
                                                      "kind": {
                                                        "Variable": "a"
                                                      },
                                                      "span": {
                                                        "start": 347,
                                                        "end": 349
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 347,
                                                    "end": 349
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 335,
                                            "end": 350
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 335,
                                        "end": 350
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 323,
                                "end": 351
                              }
                            }
                          },
                          "span": {
                            "start": 323,
                            "end": 351
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 314,
                    "end": 352
                  }
                }
              },
              "span": {
                "start": 314,
                "end": 353
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 168,
        "end": 355
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "test"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 357,
                      "end": 361
                    }
                  }
                },
                "span": {
                  "start": 357,
                  "end": 361
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 366,
                                  "end": 367
                                }
                              }
                            },
                            "span": {
                              "start": 366,
                              "end": 367
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 362,
                        "end": 367
                      }
                    }
                  },
                  "span": {
                    "start": 362,
                    "end": 367
                  }
                }
              ]
            }
          },
          "span": {
            "start": 357,
            "end": 368
          }
        }
      },
      "span": {
        "start": 357,
        "end": 369
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "test"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 370,
                      "end": 374
                    }
                  }
                },
                "span": {
                  "start": 370,
                  "end": 374
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "C"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 379,
                                  "end": 380
                                }
                              }
                            },
                            "span": {
                              "start": 379,
                              "end": 380
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 375,
                        "end": 380
                      }
                    }
                  },
                  "span": {
                    "start": 375,
                    "end": 380
                  }
                }
              ]
            }
          },
          "span": {
            "start": 370,
            "end": 381
          }
        }
      },
      "span": {
        "start": 370,
        "end": 382
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 382
  }
}
