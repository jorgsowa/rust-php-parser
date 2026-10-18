===source===
<?php
class A {
    public parent $a;
    public $b = parent::class;
    const parent C = 1;
    #[X(parent::class)]
    function m(parent $p = parent::class) {
        parent::m();
        return new class(parent::X) {
            function n() { return parent::Y; }
        };
    }
    public $c { get => parent::X; }
}
interface I extends J {
    function f(): parent;
}
enum E {
    case A;
    function f() { return parent::X; }
}
===errors===
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
Cannot use "parent" when current class scope has no parent
===php_error===
PHP Fatal error:  Cannot use "parent" when current class scope has no parent in Standard input code on line 3
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
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 34,
                      "end": 36
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 33
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 36
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 49,
                      "end": 51
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 54,
                                "end": 60
                              }
                            }
                          },
                          "span": {
                            "start": 54,
                            "end": 60
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 62,
                            "end": 67
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 67
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 67
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 86,
                      "end": 87
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 79,
                          "end": 85
                        }
                      }
                    },
                    "span": {
                      "start": 79,
                      "end": 85
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 90,
                      "end": 91
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 73,
                "end": 92
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 130,
                      "end": 131
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "p",
                        "span": {
                          "start": 139,
                          "end": 141
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "parent"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 132,
                              "end": 138
                            }
                          }
                        },
                        "span": {
                          "start": 132,
                          "end": 138
                        }
                      },
                      "default": {
                        "kind": {
                          "ClassConstAccess": {
                            "class": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "parent"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 144,
                                    "end": 150
                                  }
                                }
                              },
                              "span": {
                                "start": 144,
                                "end": 150
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "class"
                              },
                              "span": {
                                "start": 152,
                                "end": 157
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 144,
                          "end": 157
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
                        "start": 132,
                        "end": 157
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 169,
                                      "end": 175
                                    }
                                  }
                                },
                                "span": {
                                  "start": 169,
                                  "end": 175
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "m"
                                },
                                "span": {
                                  "start": 177,
                                  "end": 178
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 169,
                            "end": 180
                          }
                        }
                      },
                      "span": {
                        "start": 169,
                        "end": 181
                      }
                    },
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "AnonymousClass": {
                                    "name": null,
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
                                          "Method": {
                                            "name": {
                                              "name": "n",
                                              "span": {
                                                "start": 241,
                                                "end": 242
                                              }
                                            },
                                            "visibility": null,
                                            "is_static": false,
                                            "is_abstract": false,
                                            "is_final": false,
                                            "by_ref": false,
                                            "params": [],
                                            "return_type": null,
                                            "body": [
                                              {
                                                "kind": {
                                                  "Return": {
                                                    "kind": {
                                                      "ClassConstAccess": {
                                                        "class": {
                                                          "kind": {
                                                            "Name": {
                                                              "parts": [
                                                                "parent"
                                                              ],
                                                              "kind": "Unqualified",
                                                              "span": {
                                                                "start": 254,
                                                                "end": 260
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 254,
                                                            "end": 260
                                                          }
                                                        },
                                                        "member": {
                                                          "kind": {
                                                            "Identifier": "Y"
                                                          },
                                                          "span": {
                                                            "start": 262,
                                                            "end": 263
                                                          }
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 254,
                                                      "end": 263
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 247,
                                                  "end": 264
                                                }
                                              }
                                            ],
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 232,
                                          "end": 266
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 197,
                                  "end": 276
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "ClassConstAccess": {
                                        "class": {
                                          "kind": {
                                            "Name": {
                                              "parts": [
                                                "parent"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 207,
                                                "end": 213
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 207,
                                            "end": 213
                                          }
                                        },
                                        "member": {
                                          "kind": {
                                            "Identifier": "X"
                                          },
                                          "span": {
                                            "start": 215,
                                            "end": 216
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 207,
                                      "end": 216
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 207,
                                    "end": 216
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 197,
                            "end": 276
                          }
                        }
                      },
                      "span": {
                        "start": 190,
                        "end": 277
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "X"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 99,
                          "end": 100
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "ClassConstAccess": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "parent"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 101,
                                        "end": 107
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 101,
                                    "end": 107
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "class"
                                  },
                                  "span": {
                                    "start": 109,
                                    "end": 114
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 101,
                              "end": 114
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 101,
                            "end": 114
                          }
                        }
                      ],
                      "span": {
                        "start": 99,
                        "end": 115
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 97,
                "end": 283
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 295,
                      "end": 297
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
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 307,
                                      "end": 313
                                    }
                                  }
                                },
                                "span": {
                                  "start": 307,
                                  "end": 313
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "X"
                                },
                                "span": {
                                  "start": 315,
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
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 300,
                        "end": 317
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 288,
                "end": 319
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 321
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 332,
              "end": 333
            }
          },
          "extends": [
            {
              "parts": [
                "J"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 342,
                "end": 343
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 359,
                      "end": 360
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 364,
                          "end": 370
                        }
                      }
                    },
                    "span": {
                      "start": 364,
                      "end": 370
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 350,
                "end": 371
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 322,
        "end": 373
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 379,
              "end": 380
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 392,
                      "end": 393
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 387,
                "end": 394
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 408,
                      "end": 409
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 421,
                                      "end": 427
                                    }
                                  }
                                },
                                "span": {
                                  "start": 421,
                                  "end": 427
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "X"
                                },
                                "span": {
                                  "start": 429,
                                  "end": 430
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 421,
                            "end": 430
                          }
                        }
                      },
                      "span": {
                        "start": 414,
                        "end": 431
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 399,
                "end": 433
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 374,
        "end": 435
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 435
  }
}
