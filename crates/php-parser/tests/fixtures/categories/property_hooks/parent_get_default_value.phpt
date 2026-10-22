===source===
<?php

class P {
    public $a = 1;
    public int $b = 1;
    public $c = 1;
    public int $d = 1;
}

class C extends P {
    public $a { get => parent::$a::get(); }
    public int $b { get => parent::$b::get(); }
    public $c = 2 { get => parent::$c::get(); }
    public int $d = 2 { get => parent::$d::get(); }
}

class GC extends C {
    public $a { get => parent::$a::get(); }
    public int $b { get => parent::$b::get(); }
    public $c { get => parent::$c::get(); }
    public int $d { get => parent::$d::get(); }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 11
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 11
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "P",
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
                    "name": "a",
                    "span": {
                      "start": 28,
                      "end": 30
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
                      "start": 33,
                      "end": 34
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 21,
                "end": 34
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 51,
                      "end": 53
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 47,
                          "end": 50
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 50
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 56,
                      "end": 57
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 57
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 70,
                      "end": 72
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
                      "start": 75,
                      "end": 76
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 63,
                "end": 76
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 93,
                      "end": 95
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 89,
                          "end": 92
                        }
                      }
                    },
                    "span": {
                      "start": 89,
                      "end": 92
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 98,
                      "end": 99
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 82,
                "end": 99
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 102
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 110,
              "end": 111
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "P"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 120,
              "end": 121
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
                      "start": 135,
                      "end": 137
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                                  "StaticPropertyAccess": {
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
                                        "Identifier": "a"
                                      },
                                      "span": {
                                        "start": 155,
                                        "end": 157
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 147,
                                  "end": 157
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 159,
                                  "end": 162
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 147,
                            "end": 164
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 140,
                        "end": 165
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 128,
                "end": 167
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 183,
                      "end": 185
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 179,
                          "end": 182
                        }
                      }
                    },
                    "span": {
                      "start": 179,
                      "end": 182
                    }
                  },
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
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 195,
                                            "end": 201
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 195,
                                        "end": 201
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 203,
                                        "end": 205
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 195,
                                  "end": 205
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 207,
                                  "end": 210
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 195,
                            "end": 212
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 188,
                        "end": 213
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 172,
                "end": 215
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 227,
                      "end": 229
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
                      "start": 232,
                      "end": 233
                    }
                  },
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
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 243,
                                            "end": 249
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 243,
                                        "end": 249
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "c"
                                      },
                                      "span": {
                                        "start": 251,
                                        "end": 253
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 243,
                                  "end": 253
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 255,
                                  "end": 258
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 243,
                            "end": 260
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 236,
                        "end": 261
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 220,
                "end": 263
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 279,
                      "end": 281
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 275,
                          "end": 278
                        }
                      }
                    },
                    "span": {
                      "start": 275,
                      "end": 278
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 284,
                      "end": 285
                    }
                  },
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
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 295,
                                            "end": 301
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 295,
                                        "end": 301
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "d"
                                      },
                                      "span": {
                                        "start": 303,
                                        "end": 305
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 295,
                                  "end": 305
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 307,
                                  "end": 310
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 295,
                            "end": 312
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 288,
                        "end": 313
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 268,
                "end": 315
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 104,
        "end": 317
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "GC",
            "span": {
              "start": 325,
              "end": 327
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "C"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 336,
              "end": 337
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
                      "start": 351,
                      "end": 353
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 363,
                                            "end": 369
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 363,
                                        "end": 369
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "a"
                                      },
                                      "span": {
                                        "start": 371,
                                        "end": 373
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 363,
                                  "end": 373
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 375,
                                  "end": 378
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 363,
                            "end": 380
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 356,
                        "end": 381
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 344,
                "end": 383
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 399,
                      "end": 401
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 395,
                          "end": 398
                        }
                      }
                    },
                    "span": {
                      "start": 395,
                      "end": 398
                    }
                  },
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
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 411,
                                            "end": 417
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 411,
                                        "end": 417
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 419,
                                        "end": 421
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 411,
                                  "end": 421
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 423,
                                  "end": 426
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 411,
                            "end": 428
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 404,
                        "end": 429
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 388,
                "end": 431
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 443,
                      "end": 445
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 455,
                                            "end": 461
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 455,
                                        "end": 461
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "c"
                                      },
                                      "span": {
                                        "start": 463,
                                        "end": 465
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 455,
                                  "end": 465
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 467,
                                  "end": 470
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 455,
                            "end": 472
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 448,
                        "end": 473
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 436,
                "end": 475
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 491,
                      "end": 493
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 487,
                          "end": 490
                        }
                      }
                    },
                    "span": {
                      "start": 487,
                      "end": 490
                    }
                  },
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
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 503,
                                            "end": 509
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 503,
                                        "end": 509
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "d"
                                      },
                                      "span": {
                                        "start": 511,
                                        "end": 513
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 503,
                                  "end": 513
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 515,
                                  "end": 518
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 503,
                            "end": 520
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 496,
                        "end": 521
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 480,
                "end": 523
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 319,
        "end": 525
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 525
  }
}
