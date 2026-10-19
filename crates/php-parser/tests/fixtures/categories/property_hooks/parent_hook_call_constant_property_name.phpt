===source===
<?php
class A extends B {
    public $a {
        get => parent::${'a'}::get();
        set {
            parent::${"a"}::set($value);
            parent::${"a" . ""}::set($value);
            parent::${<<<E
            a
            E}::set($value);
            parent::${<<<'E'
            a
            E}::set($value);
            parent::${X}::set($value);
            parent::${$v}::set($value);
            parent::${"b$v"}::set($value);
            parent::${-1}::set($value);
            (parent::$b)::set($value);
            (parent::${'b'})::set($value);
        }
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 37,
                      "end": 39
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "StaticPropertyAccessDynamic": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 57,
                                            "end": 63
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 57,
                                        "end": 63
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "VariableVariable": {
                                          "kind": {
                                            "String": "a"
                                          },
                                          "span": {
                                            "start": 67,
                                            "end": 70
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 65,
                                        "end": 71
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 57,
                                  "end": 71
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 73,
                                  "end": 76
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 78
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 79
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccessDynamic": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 106,
                                                  "end": 112
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 106,
                                              "end": 112
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "String": "a"
                                                },
                                                "span": {
                                                  "start": 116,
                                                  "end": 119
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 114,
                                              "end": 120
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 106,
                                        "end": 120
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 122,
                                        "end": 125
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 126,
                                              "end": 132
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 126,
                                          "end": 132
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 106,
                                  "end": 133
                                }
                              }
                            },
                            "span": {
                              "start": 106,
                              "end": 134
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccessDynamic": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 147,
                                                  "end": 153
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 147,
                                              "end": 153
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Binary": {
                                                    "left": {
                                                      "kind": {
                                                        "String": "a"
                                                      },
                                                      "span": {
                                                        "start": 157,
                                                        "end": 160
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "String": ""
                                                      },
                                                      "span": {
                                                        "start": 163,
                                                        "end": 165
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 157,
                                                  "end": 165
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 155,
                                              "end": 166
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 147,
                                        "end": 166
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 168,
                                        "end": 171
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 172,
                                              "end": 178
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 172,
                                          "end": 178
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 147,
                                  "end": 179
                                }
                              }
                            },
                            "span": {
                              "start": 147,
                              "end": 180
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccessDynamic": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 193,
                                                  "end": 199
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 193,
                                              "end": 199
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Heredoc": {
                                                    "label": "E",
                                                    "parts": [
                                                      {
                                                        "Literal": "a"
                                                      }
                                                    ]
                                                  }
                                                },
                                                "span": {
                                                  "start": 203,
                                                  "end": 235
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 201,
                                              "end": 236
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 193,
                                        "end": 236
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 238,
                                        "end": 241
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 242,
                                              "end": 248
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 242,
                                          "end": 248
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 193,
                                  "end": 249
                                }
                              }
                            },
                            "span": {
                              "start": 193,
                              "end": 250
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccessDynamic": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 263,
                                                  "end": 269
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 263,
                                              "end": 269
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Nowdoc": {
                                                    "label": "E",
                                                    "value": "a"
                                                  }
                                                },
                                                "span": {
                                                  "start": 273,
                                                  "end": 307
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 271,
                                              "end": 308
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 263,
                                        "end": 308
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 310,
                                        "end": 313
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 314,
                                              "end": 320
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 314,
                                          "end": 320
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 263,
                                  "end": 321
                                }
                              }
                            },
                            "span": {
                              "start": 263,
                              "end": 322
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccessDynamic": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 335,
                                                  "end": 341
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 335,
                                              "end": 341
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "X"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 345,
                                                      "end": 346
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 345,
                                                  "end": 346
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 343,
                                              "end": 347
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 335,
                                        "end": 347
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 349,
                                        "end": 352
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 353,
                                              "end": 359
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 353,
                                          "end": 359
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 335,
                                  "end": 360
                                }
                              }
                            },
                            "span": {
                              "start": 335,
                              "end": 361
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccessDynamic": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 374,
                                                  "end": 380
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 374,
                                              "end": 380
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Variable": "v"
                                                },
                                                "span": {
                                                  "start": 384,
                                                  "end": 386
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 382,
                                              "end": 387
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 374,
                                        "end": 387
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 389,
                                        "end": 392
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 393,
                                              "end": 399
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 393,
                                          "end": 399
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 374,
                                  "end": 400
                                }
                              }
                            },
                            "span": {
                              "start": 374,
                              "end": 401
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccessDynamic": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 414,
                                                  "end": 420
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 414,
                                              "end": 420
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "InterpolatedString": [
                                                    {
                                                      "Literal": "b"
                                                    },
                                                    {
                                                      "Expr": {
                                                        "kind": {
                                                          "Variable": "v"
                                                        },
                                                        "span": {
                                                          "start": 426,
                                                          "end": 428
                                                        }
                                                      }
                                                    }
                                                  ]
                                                },
                                                "span": {
                                                  "start": 424,
                                                  "end": 429
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 422,
                                              "end": 430
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 414,
                                        "end": 430
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 432,
                                        "end": 435
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 436,
                                              "end": 442
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 436,
                                          "end": 442
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 414,
                                  "end": 443
                                }
                              }
                            },
                            "span": {
                              "start": 414,
                              "end": 444
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccessDynamic": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 457,
                                                  "end": 463
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 457,
                                              "end": 463
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "UnaryPrefix": {
                                                    "op": "Negate",
                                                    "operand": {
                                                      "kind": {
                                                        "Int": 1
                                                      },
                                                      "span": {
                                                        "start": 468,
                                                        "end": 469
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 467,
                                                  "end": 469
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 465,
                                              "end": 470
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 457,
                                        "end": 470
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 472,
                                        "end": 475
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 476,
                                              "end": 482
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 476,
                                          "end": 482
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 457,
                                  "end": 483
                                }
                              }
                            },
                            "span": {
                              "start": 457,
                              "end": 484
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "Parenthesized": {
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
                                                      "start": 498,
                                                      "end": 504
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 498,
                                                  "end": 504
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "Identifier": "b"
                                                },
                                                "span": {
                                                  "start": 506,
                                                  "end": 508
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 498,
                                            "end": 508
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 497,
                                        "end": 509
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 511,
                                        "end": 514
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 515,
                                              "end": 521
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 515,
                                          "end": 521
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 497,
                                  "end": 522
                                }
                              }
                            },
                            "span": {
                              "start": 497,
                              "end": 523
                            }
                          },
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "Parenthesized": {
                                          "kind": {
                                            "StaticPropertyAccessDynamic": {
                                              "class": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "parent"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 537,
                                                      "end": 543
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 537,
                                                  "end": 543
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "VariableVariable": {
                                                    "kind": {
                                                      "String": "b"
                                                    },
                                                    "span": {
                                                      "start": 547,
                                                      "end": 550
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 545,
                                                  "end": 551
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 537,
                                            "end": 551
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 536,
                                        "end": 552
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 554,
                                        "end": 557
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 558,
                                              "end": 564
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 558,
                                          "end": 564
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 536,
                                  "end": 565
                                }
                              }
                            },
                            "span": {
                              "start": 536,
                              "end": 566
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 88,
                        "end": 576
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 582
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 584
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 584
  }
}
