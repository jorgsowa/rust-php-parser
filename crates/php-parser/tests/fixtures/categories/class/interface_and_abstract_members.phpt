===source===
<?php
interface I {
    const A = 1;
    public const B = 2;
    final public const C = 3;
    public function f();
    static function g();
    public function __construct($a);
    public $a { get; }
    public protected(set) int $b { get; set; }
}
abstract class A {
    abstract public function __construct($a);
    abstract protected function f();
    abstract public $c { get; set {} }
    abstract protected $d { final get => 1; set; }
}
trait T {
    abstract private function f();
    abstract public $e { get; }
}
class B {
    public function __CONSTRUCT(public $a, private readonly int $b) {}
}
class C {
    final private function __Construct() {}
}
===errors <=7.4===
'final class constants' requires PHP 8.1 or higher
'property hooks' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'readonly parameters' requires PHP 8.1 or higher
===errors 8.0===
'final class constants' requires PHP 8.1 or higher
'property hooks' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'readonly parameters' requires PHP 8.1 or higher
===errors 8.1-8.3===
'property hooks' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 9
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 9
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 34,
                      "end": 35
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 36
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 58,
                      "end": 59
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 41,
                "end": 60
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 84,
                      "end": 85
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 88,
                      "end": 89
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 65,
                "end": 90
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 111,
                      "end": 112
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 95,
                "end": 115
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 136,
                      "end": 137
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 120,
                "end": 140
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 161,
                      "end": 172
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
                          "start": 173,
                          "end": 175
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 173,
                        "end": 175
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 145,
                "end": 177
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 189,
                      "end": 191
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
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 194,
                        "end": 198
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 182,
                "end": 200
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 231,
                      "end": 233
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Protected"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 227,
                          "end": 230
                        }
                      }
                    },
                    "span": {
                      "start": 227,
                      "end": 230
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 236,
                        "end": 240
                      }
                    },
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 241,
                        "end": 245
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 205,
                "end": 247
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 249
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 265,
              "end": 266
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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 298,
                      "end": 309
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 310,
                          "end": 312
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 310,
                        "end": 312
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 273,
                "end": 314
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 347,
                      "end": 348
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 319,
                "end": 351
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 372,
                      "end": 374
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 377,
                        "end": 381
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 382,
                        "end": 388
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 356,
                "end": 390
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 414,
                      "end": 416
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "is_abstract": true
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
                            "start": 432,
                            "end": 433
                          }
                        }
                      },
                      "modifiers": {
                        "is_final": true
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 419,
                        "end": 434
                      }
                    },
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 435,
                        "end": 439
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 395,
                "end": 441
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 259,
        "end": 443
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 450,
              "end": 451
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 484,
                      "end": 485
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_abstract": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 458,
                "end": 488
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 509,
                      "end": 511
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 514,
                        "end": 518
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 493,
                "end": 520
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 444,
        "end": 522
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 529,
              "end": 530
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
                "Method": {
                  "name": {
                    "name": "__CONSTRUCT",
                    "span": {
                      "start": 553,
                      "end": 564
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
                          "start": 572,
                          "end": 574
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 565,
                        "end": 574
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 597,
                          "end": 599
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 593,
                              "end": 596
                            }
                          }
                        },
                        "span": {
                          "start": 593,
                          "end": 596
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 576,
                        "end": 599
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 537,
                "end": 603
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 523,
        "end": 605
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 612,
              "end": 613
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
                "Method": {
                  "name": {
                    "name": "__Construct",
                    "span": {
                      "start": 643,
                      "end": 654
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 620,
                "end": 659
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 606,
        "end": 661
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 661
  }
}
