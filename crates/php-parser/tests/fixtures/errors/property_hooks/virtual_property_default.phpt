===config===
min_php=8.4
===source===
<?php
interface I {
    public $a = 1 { get; }
}
abstract class A {
    public $b = 1 { get; }
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
===errors===
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
===ast===
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
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                      "is_final": false,
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
                      "start": 79,
                      "end": 81
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 84,
                      "end": 85
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 88,
                        "end": 92
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 72,
                "end": 94
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 106,
                      "end": 108
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 111,
                      "end": 112
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
                            "start": 122,
                            "end": 123
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 115,
                        "end": 124
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 99,
                "end": 126
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 138,
                      "end": 140
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 143,
                      "end": 144
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 147,
                        "end": 154
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 131,
                "end": 156
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 168,
                      "end": 170
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 173,
                      "end": 174
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
                                  "start": 184,
                                  "end": 189
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "E"
                                },
                                "span": {
                                  "start": 191,
                                  "end": 192
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 184,
                            "end": 192
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 177,
                        "end": 193
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 161,
                "end": 195
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 207,
                      "end": 209
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 212,
                      "end": 213
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
                                  "start": 223,
                                  "end": 228
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "f"
                                },
                                "span": {
                                  "start": 230,
                                  "end": 231
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 223,
                            "end": 233
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 216,
                        "end": 234
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 200,
                "end": 236
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 248,
                      "end": 250
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 253,
                      "end": 254
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
                                      "start": 264,
                                      "end": 268
                                    }
                                  }
                                },
                                "span": {
                                  "start": 264,
                                  "end": 268
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "g"
                                },
                                "span": {
                                  "start": 270,
                                  "end": 272
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 264,
                            "end": 272
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 257,
                        "end": 273
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 241,
                "end": 275
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 287,
                      "end": 289
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 292,
                      "end": 293
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
                                  "start": 303,
                                  "end": 308
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "h"
                                },
                                "span": {
                                  "start": 310,
                                  "end": 311
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 303,
                            "end": 311
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 296,
                        "end": 312
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 280,
                "end": 314
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 326,
                      "end": 328
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 331,
                      "end": 332
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
                                  "start": 342,
                                  "end": 347
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "i"
                                },
                                "span": {
                                  "start": 349,
                                  "end": 351
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 342,
                            "end": 351
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 335,
                        "end": 352
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 319,
                "end": 354
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "j",
                    "span": {
                      "start": 366,
                      "end": 368
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 371,
                      "end": 372
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
                                        "start": 390,
                                        "end": 395
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "j"
                                      },
                                      "span": {
                                        "start": 397,
                                        "end": 398
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 390,
                                  "end": 398
                                }
                              },
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 382,
                            "end": 398
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 375,
                        "end": 399
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 359,
                "end": 401
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "k",
                    "span": {
                      "start": 413,
                      "end": 415
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 418,
                      "end": 419
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
                                              "start": 450,
                                              "end": 455
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "k"
                                            },
                                            "span": {
                                              "start": 457,
                                              "end": 458
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 450,
                                        "end": 458
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 443,
                                    "end": 459
                                  }
                                }
                              ],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 429,
                            "end": 461
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 422,
                        "end": 462
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 406,
                "end": 464
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "l",
                    "span": {
                      "start": 476,
                      "end": 478
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 481,
                      "end": 482
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
                                                "start": 511,
                                                "end": 513
                                              }
                                            },
                                            "visibility": "Public",
                                            "set_visibility": null,
                                            "is_static": false,
                                            "is_readonly": false,
                                            "type_hint": null,
                                            "default": null,
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 504,
                                          "end": 513
                                        }
                                      },
                                      {
                                        "kind": {
                                          "Method": {
                                            "name": {
                                              "name": "f",
                                              "span": {
                                                "start": 524,
                                                "end": 525
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
                                                      "PropertyAccess": {
                                                        "object": {
                                                          "kind": {
                                                            "Variable": "this"
                                                          },
                                                          "span": {
                                                            "start": 537,
                                                            "end": 542
                                                          }
                                                        },
                                                        "property": {
                                                          "kind": {
                                                            "Identifier": "l"
                                                          },
                                                          "span": {
                                                            "start": 544,
                                                            "end": 545
                                                          }
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 537,
                                                      "end": 545
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 530,
                                                  "end": 546
                                                }
                                              }
                                            ],
                                            "attributes": []
                                          }
                                        },
                                        "span": {
                                          "start": 515,
                                          "end": 548
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 492,
                                  "end": 550
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 492,
                            "end": 550
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 485,
                        "end": 551
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 469,
                "end": 553
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "n",
                    "span": {
                      "start": 565,
                      "end": 567
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 570,
                      "end": 571
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
                                    "start": 589,
                                    "end": 590
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
                                                "start": 602,
                                                "end": 607
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "n"
                                              },
                                              "span": {
                                                "start": 609,
                                                "end": 610
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 602,
                                          "end": 610
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 595,
                                      "end": 611
                                    }
                                  }
                                ],
                                "return_type": null,
                                "by_ref": false,
                                "attributes": []
                              }
                            },
                            "span": {
                              "start": 580,
                              "end": 613
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 621,
                                  "end": 622
                                }
                              }
                            },
                            "span": {
                              "start": 614,
                              "end": 623
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 574,
                        "end": 625
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 558,
                "end": 627
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "o",
                    "span": {
                      "start": 643,
                      "end": 645
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
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 639,
                          "end": 642
                        }
                      }
                    },
                    "span": {
                      "start": 639,
                      "end": 642
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 648,
                      "end": 649
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
                                  "start": 659,
                                  "end": 664
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "p"
                                },
                                "span": {
                                  "start": 666,
                                  "end": 667
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 659,
                            "end": 667
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 652,
                        "end": 668
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 632,
                "end": 670
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 58,
        "end": 672
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 672
  }
}
