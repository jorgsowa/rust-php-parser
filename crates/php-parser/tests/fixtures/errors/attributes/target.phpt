===description===
Built-in attributes applied to a declaration they cannot target. PHP stops at the first; the parser reports each.
===source===
<?php
#[Attribute] function f() {}
#[Override] class A {}
#[ReturnTypeWillChange] class B {}
#[SensitiveParameter] function g() {}
#[NoDiscard] interface I {}
#[AllowDynamicProperties] function h() {}
$c = #[Attribute] function () {};
$d = #[Override] fn() => 1;
$e = new #[NoDiscard] class {};
class C {
    #[Attribute] public $p;
    #[Attribute] const X = 1;
    #[Attribute] public function m(#[Override] $a, #[Deprecated] $b) {}
    #[Deprecated] public $q;
    #[Override] const Y = 2;
    public $r { #[Attribute] get => 1; }
}
enum E {
    #[Attribute] case A;
    #[Override] case B;
}
#[Override] const K = 1;
#[Attribute] const L = 1;
===errors >=8.5===
Attribute "Attribute" cannot target function (allowed targets: class)
Attribute "Override" cannot target class (allowed targets: method, property)
Attribute "ReturnTypeWillChange" cannot target class (allowed targets: method)
Attribute "SensitiveParameter" cannot target function (allowed targets: parameter)
Attribute "NoDiscard" cannot target class (allowed targets: function, method)
Attribute "AllowDynamicProperties" cannot target function (allowed targets: class)
Attribute "Attribute" cannot target function (allowed targets: class)
Attribute "Override" cannot target function (allowed targets: method, property)
Attribute "NoDiscard" cannot target class (allowed targets: function, method)
Attribute "Attribute" cannot target property (allowed targets: class)
Attribute "Attribute" cannot target class constant (allowed targets: class)
Attribute "Override" cannot target parameter (allowed targets: method, property)
Attribute "Deprecated" cannot target parameter (allowed targets: class, function, method, class constant, constant)
Attribute "Attribute" cannot target method (allowed targets: class)
Attribute "Deprecated" cannot target property (allowed targets: class, function, method, class constant, constant)
Attribute "Override" cannot target class constant (allowed targets: method, property)
Attribute "Attribute" cannot target method (allowed targets: class)
Attribute "Attribute" cannot target class constant (allowed targets: class)
Attribute "Override" cannot target class constant (allowed targets: method, property)
Attribute "Override" cannot target constant (allowed targets: method, property)
Attribute "Attribute" cannot target constant (allowed targets: class)
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 17
===php_error 8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 23
===php_error >=8.5===
PHP Fatal error:  Attribute "Attribute" cannot target function (allowed targets: class) in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 28,
              "end": 29
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 17
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 17
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 34
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 53,
              "end": 54
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Override"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 37,
                  "end": 45
                }
              },
              "args": [],
              "span": {
                "start": 37,
                "end": 45
              }
            }
          ]
        }
      },
      "span": {
        "start": 47,
        "end": 57
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 88,
              "end": 89
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "ReturnTypeWillChange"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 60,
                  "end": 80
                }
              },
              "args": [],
              "span": {
                "start": 60,
                "end": 80
              }
            }
          ]
        }
      },
      "span": {
        "start": 82,
        "end": 92
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 124,
              "end": 125
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "SensitiveParameter"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 95,
                  "end": 113
                }
              },
              "args": [],
              "span": {
                "start": 95,
                "end": 113
              }
            }
          ]
        }
      },
      "span": {
        "start": 115,
        "end": 130
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 154,
              "end": 155
            }
          },
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 133,
                  "end": 142
                }
              },
              "args": [],
              "span": {
                "start": 133,
                "end": 142
              }
            }
          ]
        }
      },
      "span": {
        "start": 144,
        "end": 158
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
            "span": {
              "start": 194,
              "end": 195
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 161,
                  "end": 183
                }
              },
              "args": [],
              "span": {
                "start": 161,
                "end": 183
              }
            }
          ]
        }
      },
      "span": {
        "start": 185,
        "end": 200
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 201,
                  "end": 203
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Attribute"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 208,
                            "end": 217
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 208,
                          "end": 217
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 206,
                  "end": 233
                }
              }
            }
          },
          "span": {
            "start": 201,
            "end": 233
          }
        }
      },
      "span": {
        "start": 201,
        "end": 234
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 235,
                  "end": 237
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 260,
                        "end": 261
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Override"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 242,
                            "end": 250
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 242,
                          "end": 250
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 240,
                  "end": 261
                }
              }
            }
          },
          "span": {
            "start": 235,
            "end": 261
          }
        }
      },
      "span": {
        "start": 235,
        "end": 262
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "e"
                },
                "span": {
                  "start": 263,
                  "end": 265
                }
              },
              "op": "Assign",
              "value": {
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
                          "members": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "NoDiscard"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 274,
                                  "end": 283
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 274,
                                "end": 283
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 268,
                        "end": 293
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 268,
                  "end": 293
                }
              }
            }
          },
          "span": {
            "start": 263,
            "end": 293
          }
        }
      },
      "span": {
        "start": 263,
        "end": 294
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 301,
              "end": 302
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
                    "name": "p",
                    "span": {
                      "start": 329,
                      "end": 331
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attribute"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 311,
                          "end": 320
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 311,
                        "end": 320
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 309,
                "end": 331
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 356,
                      "end": 357
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 360,
                      "end": 361
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attribute"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 339,
                          "end": 348
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 339,
                        "end": 348
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 337,
                "end": 362
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 396,
                      "end": 397
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 410,
                          "end": 412
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "Override"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 400,
                              "end": 408
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 400,
                            "end": 408
                          }
                        }
                      ],
                      "span": {
                        "start": 398,
                        "end": 412
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 428,
                          "end": 430
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "Deprecated"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 416,
                              "end": 426
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 416,
                            "end": 426
                          }
                        }
                      ],
                      "span": {
                        "start": 414,
                        "end": 430
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attribute"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 369,
                          "end": 378
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 369,
                        "end": 378
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 367,
                "end": 434
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 460,
                      "end": 462
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 441,
                          "end": 451
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 441,
                        "end": 451
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 439,
                "end": 462
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 486,
                      "end": 487
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 490,
                      "end": 491
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 470,
                          "end": 478
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 470,
                        "end": 478
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 468,
                "end": 492
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "r",
                    "span": {
                      "start": 504,
                      "end": 506
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
                            "Int": 1
                          },
                          "span": {
                            "start": 529,
                            "end": 530
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "Attribute"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 511,
                              "end": 520
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 511,
                            "end": 520
                          }
                        }
                      ],
                      "span": {
                        "start": 509,
                        "end": 531
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 497,
                "end": 533
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 295,
        "end": 535
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 541,
              "end": 542
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
                      "start": 567,
                      "end": 568
                    }
                  },
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attribute"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 551,
                          "end": 560
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 551,
                        "end": 560
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 562,
                "end": 569
              }
            },
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 591,
                      "end": 592
                    }
                  },
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Override"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 576,
                          "end": 584
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 576,
                        "end": 584
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 586,
                "end": 593
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 536,
        "end": 595
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "K",
              "span": {
                "start": 614,
                "end": 615
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 618,
                "end": 619
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "Override"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 598,
                    "end": 606
                  }
                },
                "args": [],
                "span": {
                  "start": 598,
                  "end": 606
                }
              }
            ],
            "span": {
              "start": 614,
              "end": 619
            }
          }
        ]
      },
      "span": {
        "start": 608,
        "end": 620
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "L",
              "span": {
                "start": 640,
                "end": 641
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 644,
                "end": 645
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "Attribute"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 623,
                    "end": 632
                  }
                },
                "args": [],
                "span": {
                  "start": 623,
                  "end": 632
                }
              }
            ],
            "span": {
              "start": 640,
              "end": 645
            }
          }
        ]
      },
      "span": {
        "start": 634,
        "end": 646
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 646
  }
}
