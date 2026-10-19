===source===
<?php
interface I {
    public $a = 1 { get; }
}
abstract class A {
    abstract public $b = 1 { get; }
    public $c = 1 { get => 1; }
    public $d = 1 { set { } }
    public $e = 1 { get => $this->E; }
    public $f = 1 { get => $this->f(); }
    public $g = 1 { get => self::$g; }
    public $h = 1 { get => $that->h; }
    public $i = 1 { get => $this::$i; }
    public $j = 1 { get => fn() => $this->j; }
    public $k = 1 { get => function () { return $this->k; }; }
    public $l = 1 { get => new class { public $m; function f() { return $this->l; } }; }
    public $n = 1 { get { function n() { return $this->n; } return 1; } }
    public int $o = 1 { get => $this->p; }
}
===errors >=8.4===
Cannot specify default value for virtual hooked property I::$a
Cannot specify default value for virtual hooked property A::$b
Cannot specify default value for virtual hooked property A::$c
Cannot specify default value for virtual hooked property A::$d
Cannot specify default value for virtual hooked property A::$e
Cannot specify default value for virtual hooked property A::$f
Cannot specify default value for virtual hooked property A::$g
Cannot specify default value for virtual hooked property A::$h
Cannot specify default value for virtual hooked property A::$i
Cannot specify default value for virtual hooked property A::$j
Cannot specify default value for virtual hooked property A::$k
Cannot specify default value for virtual hooked property A::$l
Cannot specify default value for virtual hooked property A::$n
Cannot specify default value for virtual hooked property A::$o
===php_error===
PHP Fatal error:  Cannot specify default value for virtual hooked property I::$a in Standard input code on line 3
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 31,
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
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 40,
                        "end": 44
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 46
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 64,
              "end": 65
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                    "name": "b",
                    "span": {
                      "start": 88,
                      "end": 90
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 93,
                      "end": 94
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 97,
                        "end": 101
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 72,
                "end": 103
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 115,
                      "end": 117
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
                      "start": 120,
                      "end": 121
                    }
                  },
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
                            "start": 131,
                            "end": 132
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 124,
                        "end": 133
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 108,
                "end": 135
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 147,
                      "end": 149
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
                      "start": 152,
                      "end": 153
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 156,
                        "end": 163
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 140,
                "end": 165
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 177,
                      "end": 179
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
                      "start": 182,
                      "end": 183
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 193,
                                  "end": 198
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "E"
                                },
                                "span": {
                                  "start": 200,
                                  "end": 201
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 193,
                            "end": 201
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 186,
                        "end": 202
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 170,
                "end": 204
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 216,
                      "end": 218
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
                      "start": 221,
                      "end": 222
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 232,
                                  "end": 237
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "f"
                                },
                                "span": {
                                  "start": 239,
                                  "end": 240
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 232,
                            "end": 242
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 225,
                        "end": 243
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 209,
                "end": 245
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 257,
                      "end": 259
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
                      "start": 262,
                      "end": 263
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "StaticPropertyAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "self"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 273,
                                      "end": 277
                                    }
                                  }
                                },
                                "span": {
                                  "start": 273,
                                  "end": 277
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "g"
                                },
                                "span": {
                                  "start": 279,
                                  "end": 281
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 273,
                            "end": 281
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 266,
                        "end": 282
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 250,
                "end": 284
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 296,
                      "end": 298
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
                      "start": 301,
                      "end": 302
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "that"
                                },
                                "span": {
                                  "start": 312,
                                  "end": 317
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "h"
                                },
                                "span": {
                                  "start": 319,
                                  "end": 320
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 312,
                            "end": 320
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 305,
                        "end": 321
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 289,
                "end": 323
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 335,
                      "end": 337
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
                      "start": 340,
                      "end": 341
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "StaticPropertyAccess": {
                              "class": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 351,
                                  "end": 356
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "i"
                                },
                                "span": {
                                  "start": 358,
                                  "end": 360
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 351,
                            "end": 360
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 344,
                        "end": 361
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 328,
                "end": 363
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "j",
                    "span": {
                      "start": 375,
                      "end": 377
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
                      "start": 380,
                      "end": 381
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "ArrowFunction": {
                              "is_static": false,
                              "by_ref": false,
                              "params": [],
                              "return_type": null,
                              "body": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 399,
                                        "end": 404
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "j"
                                      },
                                      "span": {
                                        "start": 406,
                                        "end": 407
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 399,
                                  "end": 407
                                }
                              },
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 391,
                            "end": 407
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 384,
                        "end": 408
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 368,
                "end": 410
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "k",
                    "span": {
                      "start": 422,
                      "end": 424
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
                      "start": 427,
                      "end": 428
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Closure": {
                              "is_static": false,
                              "by_ref": false,
                              "params": [],
                              "use_vars": [],
                              "return_type": null,
                              "body": [
                                {
                                  "kind": {
                                    "Return": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 459,
                                              "end": 464
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "k"
                                            },
                                            "span": {
                                              "start": 466,
                                              "end": 467
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 459,
                                        "end": 467
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 452,
                                    "end": 468
                                  }
                                }
                              ],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 438,
                            "end": 470
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 431,
                        "end": 471
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 415,
                "end": 473
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "l",
                    "span": {
                      "start": 485,
                      "end": 487
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
                      "start": 490,
                      "end": 491
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
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
                                          "Property": {
                                            "name": {
                                              "name": "m",
                                              "span": {
                                                "start": 520,
                                                "end": 522
                                              }
                                            },
                                            "modifiers": {
                                              "visibility": "Public"
                                            },
                                            "type_hint": null,
                                            "default": null,
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 513,
                                          "end": 522
                                        }
                                      },
                                      {
                                        "kind": {
                                          "Method": {
                                            "name": {
                                              "name": "f",
                                              "span": {
                                                "start": 533,
                                                "end": 534
                                              }
                                            },
                                            "by_ref": false,
                                            "params": [],
                                            "return_type": null,
                                            "body": [
                                              {
                                                "kind": {
                                                  "Return": {
                                                    "kind": {
                                                      "PropertyAccess": {
                                                        "object": {
                                                          "kind": {
                                                            "Variable": "this"
                                                          },
                                                          "span": {
                                                            "start": 546,
                                                            "end": 551
                                                          }
                                                        },
                                                        "property": {
                                                          "kind": {
                                                            "Identifier": "l"
                                                          },
                                                          "span": {
                                                            "start": 553,
                                                            "end": 554
                                                          }
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 546,
                                                      "end": 554
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 539,
                                                  "end": 555
                                                }
                                              }
                                            ],
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 524,
                                          "end": 557
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 501,
                                  "end": 559
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 501,
                            "end": 559
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 494,
                        "end": 560
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 478,
                "end": 562
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "n",
                    "span": {
                      "start": 574,
                      "end": 576
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
                      "start": 579,
                      "end": 580
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Function": {
                                "name": {
                                  "name": "n",
                                  "span": {
                                    "start": 598,
                                    "end": 599
                                  }
                                },
                                "params": [],
                                "body": [
                                  {
                                    "kind": {
                                      "Return": {
                                        "kind": {
                                          "PropertyAccess": {
                                            "object": {
                                              "kind": {
                                                "Variable": "this"
                                              },
                                              "span": {
                                                "start": 611,
                                                "end": 616
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "n"
                                              },
                                              "span": {
                                                "start": 618,
                                                "end": 619
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 611,
                                          "end": 619
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 604,
                                      "end": 620
                                    }
                                  }
                                ],
                                "return_type": null,
                                "by_ref": false,
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 589,
                              "end": 622
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 630,
                                  "end": 631
                                }
                              }
                            },
                            "span": {
                              "start": 623,
                              "end": 632
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 583,
                        "end": 634
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 567,
                "end": 636
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "o",
                    "span": {
                      "start": 652,
                      "end": 654
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
                          "start": 648,
                          "end": 651
                        }
                      }
                    },
                    "span": {
                      "start": 648,
                      "end": 651
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 657,
                      "end": 658
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 668,
                                  "end": 673
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "p"
                                },
                                "span": {
                                  "start": 675,
                                  "end": 676
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 668,
                            "end": 676
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 661,
                        "end": 677
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 641,
                "end": 679
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 58,
        "end": 681
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 681
  }
}
