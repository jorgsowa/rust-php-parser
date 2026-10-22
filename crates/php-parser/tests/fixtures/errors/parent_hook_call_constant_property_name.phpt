===source===
<?php
parent::${0}::get();
class A extends B {
    function m() {
        parent::${'a'}::set(1);
        $f = parent::${"a"}::get(...);
    }
    public $a {
        get => parent::${0}::get();
        set {
            parent::${"a"}::get();
            parent::${'b'}::set($value);
            parent::${"b" . "c"}::set($value);
            parent::${1 . 2}::set($value);
            parent::${("b")}::set($value);
            parent::${0x1F}::set($value);
            parent::${1.5}::set($value);
            parent::${1.0}::set($value);
            parent::${1e25}::set($value);
            parent::${1e-7}::set($value);
            parent::${9223372036854775808}::set($value);
            parent::${<<<'E'
            b
            E}::set($value);
        }
    }
}
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'property hooks' requires PHP 8.4 or higher
Cannot use "parent" when no class scope is active
Must not use parent::$a::set() outside a property hook
Cannot create Closure for parent property hook call
Must not use parent::$0::get() in a different property ($a)
Must not use parent::$a::get() in a different property hook (set)
Must not use parent::$b::set() in a different property ($a)
Must not use parent::$bc::set() in a different property ($a)
Must not use parent::$12::set() in a different property ($a)
Must not use parent::$b::set() in a different property ($a)
Must not use parent::$31::set() in a different property ($a)
Must not use parent::$1.5::set() in a different property ($a)
Must not use parent::$1::set() in a different property ($a)
Must not use parent::$1.0E+25::set() in a different property ($a)
Must not use parent::$1.0E-7::set() in a different property ($a)
Must not use parent::$9.2233720368548E+18::set() in a different property ($a)
Must not use parent::$b::set() in a different property ($a)
===errors 8.1-8.3===
'property hooks' requires PHP 8.4 or higher
Cannot use "parent" when no class scope is active
Must not use parent::$a::set() outside a property hook
Cannot create Closure for parent property hook call
Must not use parent::$0::get() in a different property ($a)
Must not use parent::$a::get() in a different property hook (set)
Must not use parent::$b::set() in a different property ($a)
Must not use parent::$bc::set() in a different property ($a)
Must not use parent::$12::set() in a different property ($a)
Must not use parent::$b::set() in a different property ($a)
Must not use parent::$31::set() in a different property ($a)
Must not use parent::$1.5::set() in a different property ($a)
Must not use parent::$1::set() in a different property ($a)
Must not use parent::$1.0E+25::set() in a different property ($a)
Must not use parent::$1.0E-7::set() in a different property ($a)
Must not use parent::$9.2233720368548E+18::set() in a different property ($a)
Must not use parent::$b::set() in a different property ($a)
===errors >=8.4===
Cannot use "parent" when no class scope is active
Must not use parent::$a::set() outside a property hook
Cannot create Closure for parent property hook call
Must not use parent::$0::get() in a different property ($a)
Must not use parent::$a::get() in a different property hook (set)
Must not use parent::$b::set() in a different property ($a)
Must not use parent::$bc::set() in a different property ($a)
Must not use parent::$12::set() in a different property ($a)
Must not use parent::$b::set() in a different property ($a)
Must not use parent::$31::set() in a different property ($a)
Must not use parent::$1.5::set() in a different property ($a)
Must not use parent::$1::set() in a different property ($a)
Must not use parent::$1.0E+25::set() in a different property ($a)
Must not use parent::$1.0E-7::set() in a different property ($a)
Must not use parent::$9.2233720368548E+18::set() in a different property ($a)
Must not use parent::$b::set() in a different property ($a)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 6
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 6
===php_error 8.1-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 8
===php_error >=8.4===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 2
===ast===
{
  "stmts": [
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
                            "start": 6,
                            "end": 12
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 12
                      }
                    },
                    "member": {
                      "kind": {
                        "VariableVariable": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 18
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 18
                }
              },
              "method": {
                "kind": {
                  "Identifier": "get"
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 33,
              "end": 34
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
              "start": 43,
              "end": 44
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 60,
                      "end": 61
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
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
                                            "start": 74,
                                            "end": 80
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 74,
                                        "end": 80
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "VariableVariable": {
                                          "kind": {
                                            "String": "a"
                                          },
                                          "span": {
                                            "start": 84,
                                            "end": 87
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 82,
                                        "end": 88
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 74,
                                  "end": 88
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "set"
                                },
                                "span": {
                                  "start": 90,
                                  "end": 93
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
                                        "start": 94,
                                        "end": 95
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 94,
                                    "end": 95
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 74,
                            "end": 96
                          }
                        }
                      },
                      "span": {
                        "start": 74,
                        "end": 97
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "f"
                                },
                                "span": {
                                  "start": 106,
                                  "end": 108
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "StaticMethod": {
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
                                                      "start": 111,
                                                      "end": 117
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 111,
                                                  "end": 117
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "VariableVariable": {
                                                    "kind": {
                                                      "String": "a"
                                                    },
                                                    "span": {
                                                      "start": 121,
                                                      "end": 124
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 119,
                                                  "end": 125
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 111,
                                            "end": 125
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "get"
                                          },
                                          "span": {
                                            "start": 127,
                                            "end": 130
                                          }
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 111,
                                  "end": 135
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 106,
                            "end": 135
                          }
                        }
                      },
                      "span": {
                        "start": 106,
                        "end": 136
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 51,
                "end": 142
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 154,
                      "end": 156
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
                                  "StaticPropertyAccessDynamic": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 174,
                                            "end": 180
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 174,
                                        "end": 180
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "VariableVariable": {
                                          "kind": {
                                            "Int": 0
                                          },
                                          "span": {
                                            "start": 184,
                                            "end": 185
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 182,
                                        "end": 186
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 174,
                                  "end": 186
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 188,
                                  "end": 191
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 174,
                            "end": 193
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 167,
                        "end": 194
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
                                                  "start": 221,
                                                  "end": 227
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 221,
                                              "end": 227
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "String": "a"
                                                },
                                                "span": {
                                                  "start": 231,
                                                  "end": 234
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 229,
                                              "end": 235
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 221,
                                        "end": 235
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "get"
                                      },
                                      "span": {
                                        "start": 237,
                                        "end": 240
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 221,
                                  "end": 242
                                }
                              }
                            },
                            "span": {
                              "start": 221,
                              "end": 243
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
                                                  "start": 256,
                                                  "end": 262
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 256,
                                              "end": 262
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "String": "b"
                                                },
                                                "span": {
                                                  "start": 266,
                                                  "end": 269
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 264,
                                              "end": 270
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 256,
                                        "end": 270
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 272,
                                        "end": 275
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
                                              "start": 276,
                                              "end": 282
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 276,
                                          "end": 282
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 256,
                                  "end": 283
                                }
                              }
                            },
                            "span": {
                              "start": 256,
                              "end": 284
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
                                                  "start": 297,
                                                  "end": 303
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 297,
                                              "end": 303
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Binary": {
                                                    "left": {
                                                      "kind": {
                                                        "String": "b"
                                                      },
                                                      "span": {
                                                        "start": 307,
                                                        "end": 310
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "String": "c"
                                                      },
                                                      "span": {
                                                        "start": 313,
                                                        "end": 316
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 307,
                                                  "end": 316
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 305,
                                              "end": 317
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 297,
                                        "end": 317
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 319,
                                        "end": 322
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
                                              "start": 323,
                                              "end": 329
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 323,
                                          "end": 329
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 297,
                                  "end": 330
                                }
                              }
                            },
                            "span": {
                              "start": 297,
                              "end": 331
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
                                                  "start": 344,
                                                  "end": 350
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 344,
                                              "end": 350
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Binary": {
                                                    "left": {
                                                      "kind": {
                                                        "Int": 1
                                                      },
                                                      "span": {
                                                        "start": 354,
                                                        "end": 355
                                                      }
                                                    },
                                                    "op": "Concat",
                                                    "right": {
                                                      "kind": {
                                                        "Int": 2
                                                      },
                                                      "span": {
                                                        "start": 358,
                                                        "end": 359
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 354,
                                                  "end": 359
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 352,
                                              "end": 360
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 344,
                                        "end": 360
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 362,
                                        "end": 365
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
                                              "start": 366,
                                              "end": 372
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 366,
                                          "end": 372
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 344,
                                  "end": 373
                                }
                              }
                            },
                            "span": {
                              "start": 344,
                              "end": 374
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
                                                  "start": 387,
                                                  "end": 393
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 387,
                                              "end": 393
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Parenthesized": {
                                                    "kind": {
                                                      "String": "b"
                                                    },
                                                    "span": {
                                                      "start": 398,
                                                      "end": 401
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 397,
                                                  "end": 402
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 395,
                                              "end": 403
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 387,
                                        "end": 403
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 405,
                                        "end": 408
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
                                              "start": 409,
                                              "end": 415
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 409,
                                          "end": 415
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 387,
                                  "end": 416
                                }
                              }
                            },
                            "span": {
                              "start": 387,
                              "end": 417
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
                                                  "start": 430,
                                                  "end": 436
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 430,
                                              "end": 436
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Int": 31
                                                },
                                                "span": {
                                                  "start": 440,
                                                  "end": 444
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 438,
                                              "end": 445
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 430,
                                        "end": 445
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 447,
                                        "end": 450
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
                                              "start": 451,
                                              "end": 457
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 451,
                                          "end": 457
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 430,
                                  "end": 458
                                }
                              }
                            },
                            "span": {
                              "start": 430,
                              "end": 459
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
                                                  "start": 472,
                                                  "end": 478
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 472,
                                              "end": 478
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Float": 1.5
                                                },
                                                "span": {
                                                  "start": 482,
                                                  "end": 485
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 480,
                                              "end": 486
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 472,
                                        "end": 486
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 488,
                                        "end": 491
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
                                              "start": 492,
                                              "end": 498
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 492,
                                          "end": 498
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 472,
                                  "end": 499
                                }
                              }
                            },
                            "span": {
                              "start": 472,
                              "end": 500
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
                                                  "start": 513,
                                                  "end": 519
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 513,
                                              "end": 519
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Float": 1.0
                                                },
                                                "span": {
                                                  "start": 523,
                                                  "end": 526
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 521,
                                              "end": 527
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 513,
                                        "end": 527
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 529,
                                        "end": 532
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
                                              "start": 533,
                                              "end": 539
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 533,
                                          "end": 539
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 513,
                                  "end": 540
                                }
                              }
                            },
                            "span": {
                              "start": 513,
                              "end": 541
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
                                                  "start": 554,
                                                  "end": 560
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 554,
                                              "end": 560
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Float": 1e+25
                                                },
                                                "span": {
                                                  "start": 564,
                                                  "end": 568
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 562,
                                              "end": 569
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 554,
                                        "end": 569
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 571,
                                        "end": 574
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
                                              "start": 575,
                                              "end": 581
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 575,
                                          "end": 581
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 554,
                                  "end": 582
                                }
                              }
                            },
                            "span": {
                              "start": 554,
                              "end": 583
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
                                                  "start": 596,
                                                  "end": 602
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 596,
                                              "end": 602
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Float": 1e-7
                                                },
                                                "span": {
                                                  "start": 606,
                                                  "end": 610
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 604,
                                              "end": 611
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 596,
                                        "end": 611
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 613,
                                        "end": 616
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
                                              "start": 617,
                                              "end": 623
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 617,
                                          "end": 623
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 596,
                                  "end": 624
                                }
                              }
                            },
                            "span": {
                              "start": 596,
                              "end": 625
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
                                                  "start": 638,
                                                  "end": 644
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 638,
                                              "end": 644
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Float": 9.223372036854776e+18
                                                },
                                                "span": {
                                                  "start": 648,
                                                  "end": 667
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 646,
                                              "end": 668
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 638,
                                        "end": 668
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 670,
                                        "end": 673
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
                                              "start": 674,
                                              "end": 680
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 674,
                                          "end": 680
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 638,
                                  "end": 681
                                }
                              }
                            },
                            "span": {
                              "start": 638,
                              "end": 682
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
                                                  "start": 695,
                                                  "end": 701
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 695,
                                              "end": 701
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "VariableVariable": {
                                                "kind": {
                                                  "Nowdoc": {
                                                    "label": "E",
                                                    "value": "b"
                                                  }
                                                },
                                                "span": {
                                                  "start": 705,
                                                  "end": 739
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 703,
                                              "end": 740
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 695,
                                        "end": 740
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 742,
                                        "end": 745
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
                                              "start": 746,
                                              "end": 752
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 746,
                                          "end": 752
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 695,
                                  "end": 753
                                }
                              }
                            },
                            "span": {
                              "start": 695,
                              "end": 754
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 203,
                        "end": 764
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 147,
                "end": 770
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 27,
        "end": 772
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 772
  }
}
