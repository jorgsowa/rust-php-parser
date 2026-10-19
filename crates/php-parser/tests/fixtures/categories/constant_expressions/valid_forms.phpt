===source===
<?php
const A = Foo::{'B'};
const B = Foo::{'a' . C};
const C = Foo::{B};
const D = ('a')::B;
const E = ('a' . 'b')::class;
const F = (PHP_EOL)::C;
const G = E::A->value;
const H = E::A?->value;
const I = E::A->{'value'};
const J = (new B)->c;
const K = new B()->c;
const L = [1][0];
const M = 'a'[0];
const N = [...B, 1];
const O = 1 and 2 xor 3;
const P = !1 . ~2 . -3 . +4;
const Q = 1 <=> 2;
const R = __CLASS__ . __FUNCTION__;
const S = B::class;
const T = <<<EOT
    a
    EOT;
const U = new Foo(1, a: 2);
const V = new ('a' . 'b');
const W = new (PHP_EOL);
class Foo {
    const A = self::class;
    const B = static function () { return $x + f() . static::class; };
    public $c = strlen(...);
    public $d = Foo::m(...);
    public $e = self::m(...);
    public $f = 'strlen'(...);
    public $g = ('str' . 'len')(...);
    public $h = Foo::{'m'}(...);
    public $i = \strlen(...);
    const J = (int) '1' + (float) '2' . (string) 3 . (bool) 4;
    const K = (array) 'a';
    public function m($a = new self, $b = (object) [], $c = 1 ?: null) {}
}
#[Attr(new Foo, static function () {}, a: [1, 2])]
function f($a = new Foo(new Bar)) {
    static $b = $x, $c = new Foo, $d = f();
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "ClassConstAccessDynamic": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 19
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 19
                    }
                  },
                  "member": {
                    "kind": {
                      "String": "B"
                    },
                    "span": {
                      "start": 22,
                      "end": 25
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 26
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 26
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 27
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 34,
                "end": 35
              }
            },
            "value": {
              "kind": {
                "ClassConstAccessDynamic": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 38,
                          "end": 41
                        }
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 41
                    }
                  },
                  "member": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 44,
                            "end": 47
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "C"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 50,
                                "end": 51
                              }
                            }
                          },
                          "span": {
                            "start": 50,
                            "end": 51
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 51
                    }
                  }
                }
              },
              "span": {
                "start": 38,
                "end": 52
              }
            },
            "attributes": [],
            "span": {
              "start": 34,
              "end": 52
            }
          }
        ]
      },
      "span": {
        "start": 28,
        "end": 53
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 60,
                "end": 61
              }
            },
            "value": {
              "kind": {
                "ClassConstAccessDynamic": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 64,
                          "end": 67
                        }
                      }
                    },
                    "span": {
                      "start": 64,
                      "end": 67
                    }
                  },
                  "member": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
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
                }
              },
              "span": {
                "start": 64,
                "end": 72
              }
            },
            "attributes": [],
            "span": {
              "start": 60,
              "end": 72
            }
          }
        ]
      },
      "span": {
        "start": 54,
        "end": 73
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 80,
                "end": 81
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 85,
                          "end": 88
                        }
                      }
                    },
                    "span": {
                      "start": 84,
                      "end": 89
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "B"
                    },
                    "span": {
                      "start": 91,
                      "end": 92
                    }
                  }
                }
              },
              "span": {
                "start": 84,
                "end": 92
              }
            },
            "attributes": [],
            "span": {
              "start": 80,
              "end": 92
            }
          }
        ]
      },
      "span": {
        "start": 74,
        "end": 93
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
              "span": {
                "start": 100,
                "end": 101
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 105,
                                "end": 108
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 111,
                                "end": 114
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 105,
                          "end": 114
                        }
                      }
                    },
                    "span": {
                      "start": 104,
                      "end": 115
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "class"
                    },
                    "span": {
                      "start": 117,
                      "end": 122
                    }
                  }
                }
              },
              "span": {
                "start": 104,
                "end": 122
              }
            },
            "attributes": [],
            "span": {
              "start": 100,
              "end": 122
            }
          }
        ]
      },
      "span": {
        "start": 94,
        "end": 123
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "F",
              "span": {
                "start": 130,
                "end": 131
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 135,
                              "end": 142
                            }
                          }
                        },
                        "span": {
                          "start": 135,
                          "end": 142
                        }
                      }
                    },
                    "span": {
                      "start": 134,
                      "end": 143
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "C"
                    },
                    "span": {
                      "start": 145,
                      "end": 146
                    }
                  }
                }
              },
              "span": {
                "start": 134,
                "end": 146
              }
            },
            "attributes": [],
            "span": {
              "start": 130,
              "end": 146
            }
          }
        ]
      },
      "span": {
        "start": 124,
        "end": 147
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "G",
              "span": {
                "start": 154,
                "end": 155
              }
            },
            "value": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "E"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 158,
                                "end": 159
                              }
                            }
                          },
                          "span": {
                            "start": 158,
                            "end": 159
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 161,
                            "end": 162
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 158,
                      "end": 162
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "value"
                    },
                    "span": {
                      "start": 164,
                      "end": 169
                    }
                  }
                }
              },
              "span": {
                "start": 158,
                "end": 169
              }
            },
            "attributes": [],
            "span": {
              "start": 154,
              "end": 169
            }
          }
        ]
      },
      "span": {
        "start": 148,
        "end": 170
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "H",
              "span": {
                "start": 177,
                "end": 178
              }
            },
            "value": {
              "kind": {
                "NullsafePropertyAccess": {
                  "object": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "E"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 181,
                                "end": 182
                              }
                            }
                          },
                          "span": {
                            "start": 181,
                            "end": 182
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 184,
                            "end": 185
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 181,
                      "end": 185
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "value"
                    },
                    "span": {
                      "start": 188,
                      "end": 193
                    }
                  }
                }
              },
              "span": {
                "start": 181,
                "end": 193
              }
            },
            "attributes": [],
            "span": {
              "start": 177,
              "end": 193
            }
          }
        ]
      },
      "span": {
        "start": 171,
        "end": 194
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "I",
              "span": {
                "start": 201,
                "end": 202
              }
            },
            "value": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "E"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 205,
                                "end": 206
                              }
                            }
                          },
                          "span": {
                            "start": 205,
                            "end": 206
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 208,
                            "end": 209
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 205,
                      "end": 209
                    }
                  },
                  "property": {
                    "kind": {
                      "String": "value"
                    },
                    "span": {
                      "start": 212,
                      "end": 219
                    }
                  }
                }
              },
              "span": {
                "start": 205,
                "end": 219
              }
            },
            "attributes": [],
            "span": {
              "start": 201,
              "end": 219
            }
          }
        ]
      },
      "span": {
        "start": 195,
        "end": 221
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "J",
              "span": {
                "start": 228,
                "end": 229
              }
            },
            "value": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "Parenthesized": {
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
                                    "start": 237,
                                    "end": 238
                                  }
                                }
                              },
                              "span": {
                                "start": 237,
                                "end": 238
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 233,
                          "end": 238
                        }
                      }
                    },
                    "span": {
                      "start": 232,
                      "end": 239
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "c"
                    },
                    "span": {
                      "start": 241,
                      "end": 242
                    }
                  }
                }
              },
              "span": {
                "start": 232,
                "end": 242
              }
            },
            "attributes": [],
            "span": {
              "start": 228,
              "end": 242
            }
          }
        ]
      },
      "span": {
        "start": 222,
        "end": 243
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "K",
              "span": {
                "start": 250,
                "end": 251
              }
            },
            "value": {
              "kind": {
                "PropertyAccess": {
                  "object": {
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
                                "start": 258,
                                "end": 259
                              }
                            }
                          },
                          "span": {
                            "start": 258,
                            "end": 259
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 254,
                      "end": 261
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "c"
                    },
                    "span": {
                      "start": 263,
                      "end": 264
                    }
                  }
                }
              },
              "span": {
                "start": 254,
                "end": 264
              }
            },
            "attributes": [],
            "span": {
              "start": 250,
              "end": 264
            }
          }
        ]
      },
      "span": {
        "start": 244,
        "end": 265
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "L",
              "span": {
                "start": 272,
                "end": 273
              }
            },
            "value": {
              "kind": {
                "ArrayAccess": {
                  "array": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 277,
                                "end": 278
                              }
                            }
                          },
                          "span": {
                            "start": 277,
                            "end": 278
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 276,
                      "end": 279
                    }
                  },
                  "index": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 280,
                      "end": 281
                    }
                  }
                }
              },
              "span": {
                "start": 276,
                "end": 282
              }
            },
            "attributes": [],
            "span": {
              "start": 272,
              "end": 282
            }
          }
        ]
      },
      "span": {
        "start": 266,
        "end": 283
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "M",
              "span": {
                "start": 290,
                "end": 291
              }
            },
            "value": {
              "kind": {
                "ArrayAccess": {
                  "array": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 294,
                      "end": 297
                    }
                  },
                  "index": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 298,
                      "end": 299
                    }
                  }
                }
              },
              "span": {
                "start": 294,
                "end": 300
              }
            },
            "attributes": [],
            "span": {
              "start": 290,
              "end": 300
            }
          }
        ]
      },
      "span": {
        "start": 284,
        "end": 301
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "N",
              "span": {
                "start": 308,
                "end": 309
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "kind": {
                      "Spread": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 316,
                              "end": 317
                            }
                          }
                        },
                        "span": {
                          "start": 316,
                          "end": 317
                        }
                      }
                    },
                    "span": {
                      "start": 313,
                      "end": 317
                    }
                  },
                  {
                    "key": null,
                    "kind": {
                      "Value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 319,
                          "end": 320
                        }
                      }
                    },
                    "span": {
                      "start": 319,
                      "end": 320
                    }
                  }
                ]
              },
              "span": {
                "start": 312,
                "end": 321
              }
            },
            "attributes": [],
            "span": {
              "start": 308,
              "end": 321
            }
          }
        ]
      },
      "span": {
        "start": 302,
        "end": 322
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "O",
              "span": {
                "start": 329,
                "end": 330
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 333,
                            "end": 334
                          }
                        },
                        "op": "LogicalAnd",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 339,
                            "end": 340
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 333,
                      "end": 340
                    }
                  },
                  "op": "LogicalXor",
                  "right": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 345,
                      "end": 346
                    }
                  }
                }
              },
              "span": {
                "start": 333,
                "end": 346
              }
            },
            "attributes": [],
            "span": {
              "start": 329,
              "end": 346
            }
          }
        ]
      },
      "span": {
        "start": 323,
        "end": 347
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "P",
              "span": {
                "start": 354,
                "end": 355
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "UnaryPrefix": {
                                    "op": "BooleanNot",
                                    "operand": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 359,
                                        "end": 360
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 358,
                                  "end": 360
                                }
                              },
                              "op": "Concat",
                              "right": {
                                "kind": {
                                  "UnaryPrefix": {
                                    "op": "BitwiseNot",
                                    "operand": {
                                      "kind": {
                                        "Int": 2
                                      },
                                      "span": {
                                        "start": 364,
                                        "end": 365
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 363,
                                  "end": 365
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 358,
                            "end": 365
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "UnaryPrefix": {
                              "op": "Negate",
                              "operand": {
                                "kind": {
                                  "Int": 3
                                },
                                "span": {
                                  "start": 369,
                                  "end": 370
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 368,
                            "end": 370
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 358,
                      "end": 370
                    }
                  },
                  "op": "Concat",
                  "right": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Plus",
                        "operand": {
                          "kind": {
                            "Int": 4
                          },
                          "span": {
                            "start": 374,
                            "end": 375
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 373,
                      "end": 375
                    }
                  }
                }
              },
              "span": {
                "start": 358,
                "end": 375
              }
            },
            "attributes": [],
            "span": {
              "start": 354,
              "end": 375
            }
          }
        ]
      },
      "span": {
        "start": 348,
        "end": 376
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "Q",
              "span": {
                "start": 383,
                "end": 384
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 387,
                      "end": 388
                    }
                  },
                  "op": "Spaceship",
                  "right": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 393,
                      "end": 394
                    }
                  }
                }
              },
              "span": {
                "start": 387,
                "end": 394
              }
            },
            "attributes": [],
            "span": {
              "start": 383,
              "end": 394
            }
          }
        ]
      },
      "span": {
        "start": 377,
        "end": 395
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "R",
              "span": {
                "start": 402,
                "end": 403
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "MagicConst": "Class"
                    },
                    "span": {
                      "start": 406,
                      "end": 415
                    }
                  },
                  "op": "Concat",
                  "right": {
                    "kind": {
                      "MagicConst": "Function"
                    },
                    "span": {
                      "start": 418,
                      "end": 430
                    }
                  }
                }
              },
              "span": {
                "start": 406,
                "end": 430
              }
            },
            "attributes": [],
            "span": {
              "start": 402,
              "end": 430
            }
          }
        ]
      },
      "span": {
        "start": 396,
        "end": 431
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "S",
              "span": {
                "start": 438,
                "end": 439
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 442,
                          "end": 443
                        }
                      }
                    },
                    "span": {
                      "start": 442,
                      "end": 443
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "class"
                    },
                    "span": {
                      "start": 445,
                      "end": 450
                    }
                  }
                }
              },
              "span": {
                "start": 442,
                "end": 450
              }
            },
            "attributes": [],
            "span": {
              "start": 438,
              "end": 450
            }
          }
        ]
      },
      "span": {
        "start": 432,
        "end": 451
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "T",
              "span": {
                "start": 458,
                "end": 459
              }
            },
            "value": {
              "kind": {
                "Heredoc": {
                  "label": "EOT",
                  "parts": [
                    {
                      "Literal": "a"
                    }
                  ]
                }
              },
              "span": {
                "start": 462,
                "end": 482
              }
            },
            "attributes": [],
            "span": {
              "start": 458,
              "end": 482
            }
          }
        ]
      },
      "span": {
        "start": 452,
        "end": 483
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "U",
              "span": {
                "start": 490,
                "end": 491
              }
            },
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 498,
                          "end": 501
                        }
                      }
                    },
                    "span": {
                      "start": 498,
                      "end": 501
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
                            "start": 502,
                            "end": 503
                          }
                        }
                      },
                      "span": {
                        "start": 502,
                        "end": 503
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "a"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 505,
                          "end": 506
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 508,
                            "end": 509
                          }
                        }
                      },
                      "span": {
                        "start": 505,
                        "end": 509
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 494,
                "end": 510
              }
            },
            "attributes": [],
            "span": {
              "start": 490,
              "end": 510
            }
          }
        ]
      },
      "span": {
        "start": 484,
        "end": 511
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "V",
              "span": {
                "start": 518,
                "end": 519
              }
            },
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "String": "a"
                              },
                              "span": {
                                "start": 527,
                                "end": 530
                              }
                            },
                            "op": "Concat",
                            "right": {
                              "kind": {
                                "String": "b"
                              },
                              "span": {
                                "start": 533,
                                "end": 536
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 527,
                          "end": 536
                        }
                      }
                    },
                    "span": {
                      "start": 526,
                      "end": 537
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 522,
                "end": 537
              }
            },
            "attributes": [],
            "span": {
              "start": 518,
              "end": 537
            }
          }
        ]
      },
      "span": {
        "start": 512,
        "end": 538
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "W",
              "span": {
                "start": 545,
                "end": 546
              }
            },
            "value": {
              "kind": {
                "New": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 554,
                              "end": 561
                            }
                          }
                        },
                        "span": {
                          "start": 554,
                          "end": 561
                        }
                      }
                    },
                    "span": {
                      "start": 553,
                      "end": 562
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 549,
                "end": 562
              }
            },
            "attributes": [],
            "span": {
              "start": 545,
              "end": 562
            }
          }
        ]
      },
      "span": {
        "start": 539,
        "end": 563
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 570,
              "end": 573
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 586,
                      "end": 587
                    }
                  },
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 590,
                                "end": 594
                              }
                            }
                          },
                          "span": {
                            "start": 590,
                            "end": 594
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 596,
                            "end": 601
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 590,
                      "end": 601
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 580,
                "end": 602
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 613,
                      "end": 614
                    }
                  },
                  "value": {
                    "kind": {
                      "Closure": {
                        "is_static": true,
                        "by_ref": false,
                        "params": [],
                        "use_vars": [],
                        "return_type": null,
                        "body": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "Binary": {
                                          "left": {
                                            "kind": {
                                              "Variable": "x"
                                            },
                                            "span": {
                                              "start": 645,
                                              "end": 647
                                            }
                                          },
                                          "op": "Add",
                                          "right": {
                                            "kind": {
                                              "FunctionCall": {
                                                "name": {
                                                  "kind": {
                                                    "Name": {
                                                      "parts": [
                                                        "f"
                                                      ],
                                                      "kind": "Unqualified",
                                                      "span": {
                                                        "start": 650,
                                                        "end": 651
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 650,
                                                    "end": 651
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 650,
                                              "end": 653
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 645,
                                        "end": 653
                                      }
                                    },
                                    "op": "Concat",
                                    "right": {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "static"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 656,
                                                  "end": 662
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 656,
                                              "end": 662
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "class"
                                            },
                                            "span": {
                                              "start": 664,
                                              "end": 669
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 656,
                                        "end": 669
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 645,
                                  "end": 669
                                }
                              }
                            },
                            "span": {
                              "start": 638,
                              "end": 670
                            }
                          }
                        ],
                        "attributes": []
                      }
                    },
                    "span": {
                      "start": 617,
                      "end": 672
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 607,
                "end": 673
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 685,
                      "end": 687
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "Function": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "strlen"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 690,
                                  "end": 696
                                }
                              }
                            },
                            "span": {
                              "start": 690,
                              "end": 696
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 690,
                      "end": 701
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 678,
                "end": 701
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 714,
                      "end": 716
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "StaticMethod": {
                            "class": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "Foo"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 719,
                                    "end": 722
                                  }
                                }
                              },
                              "span": {
                                "start": 719,
                                "end": 722
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "m"
                              },
                              "span": {
                                "start": 724,
                                "end": 725
                              }
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 719,
                      "end": 730
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 707,
                "end": 730
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 743,
                      "end": 745
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "StaticMethod": {
                            "class": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "self"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 748,
                                    "end": 752
                                  }
                                }
                              },
                              "span": {
                                "start": 748,
                                "end": 752
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "m"
                              },
                              "span": {
                                "start": 754,
                                "end": 755
                              }
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 748,
                      "end": 760
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 736,
                "end": 760
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 773,
                      "end": 775
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "Function": {
                            "kind": {
                              "String": "strlen"
                            },
                            "span": {
                              "start": 778,
                              "end": 786
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 778,
                      "end": 791
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 766,
                "end": 791
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 804,
                      "end": 806
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "Function": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "String": "str"
                                      },
                                      "span": {
                                        "start": 810,
                                        "end": 815
                                      }
                                    },
                                    "op": "Concat",
                                    "right": {
                                      "kind": {
                                        "String": "len"
                                      },
                                      "span": {
                                        "start": 818,
                                        "end": 823
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 810,
                                  "end": 823
                                }
                              }
                            },
                            "span": {
                              "start": 809,
                              "end": 824
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 809,
                      "end": 829
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 797,
                "end": 829
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 842,
                      "end": 844
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "StaticMethod": {
                            "class": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "Foo"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 847,
                                    "end": 850
                                  }
                                }
                              },
                              "span": {
                                "start": 847,
                                "end": 850
                              }
                            },
                            "method": {
                              "kind": {
                                "String": "m"
                              },
                              "span": {
                                "start": 853,
                                "end": 856
                              }
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 847,
                      "end": 862
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 835,
                "end": 862
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 875,
                      "end": 877
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "Function": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "strlen"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 880,
                                  "end": 887
                                }
                              }
                            },
                            "span": {
                              "start": 880,
                              "end": 887
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 880,
                      "end": 892
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 868,
                "end": 892
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "J",
                    "span": {
                      "start": 904,
                      "end": 905
                    }
                  },
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "Cast": [
                                          "Int",
                                          {
                                            "kind": {
                                              "String": "1"
                                            },
                                            "span": {
                                              "start": 914,
                                              "end": 917
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 908,
                                        "end": 917
                                      }
                                    },
                                    "op": "Add",
                                    "right": {
                                      "kind": {
                                        "Cast": [
                                          "Float",
                                          {
                                            "kind": {
                                              "String": "2"
                                            },
                                            "span": {
                                              "start": 928,
                                              "end": 931
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 920,
                                        "end": 931
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 908,
                                  "end": 931
                                }
                              },
                              "op": "Concat",
                              "right": {
                                "kind": {
                                  "Cast": [
                                    "String",
                                    {
                                      "kind": {
                                        "Int": 3
                                      },
                                      "span": {
                                        "start": 943,
                                        "end": 944
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 934,
                                  "end": 944
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 908,
                            "end": 944
                          }
                        },
                        "op": "Concat",
                        "right": {
                          "kind": {
                            "Cast": [
                              "Bool",
                              {
                                "kind": {
                                  "Int": 4
                                },
                                "span": {
                                  "start": 954,
                                  "end": 955
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 947,
                            "end": 955
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 908,
                      "end": 955
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 898,
                "end": 956
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "K",
                    "span": {
                      "start": 967,
                      "end": 968
                    }
                  },
                  "value": {
                    "kind": {
                      "Cast": [
                        "Array",
                        {
                          "kind": {
                            "String": "a"
                          },
                          "span": {
                            "start": 979,
                            "end": 982
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 971,
                      "end": 982
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 961,
                "end": 983
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 1004,
                      "end": 1005
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
                          "start": 1006,
                          "end": 1008
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "New": {
                            "class": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "self"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 1015,
                                    "end": 1019
                                  }
                                }
                              },
                              "span": {
                                "start": 1015,
                                "end": 1019
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 1011,
                          "end": 1019
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1006,
                        "end": 1019
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 1021,
                          "end": 1023
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Cast": [
                            "Object",
                            {
                              "kind": {
                                "Array": []
                              },
                              "span": {
                                "start": 1035,
                                "end": 1037
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 1026,
                          "end": 1037
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1021,
                        "end": 1037
                      }
                    },
                    {
                      "name": {
                        "name": "c",
                        "span": {
                          "start": 1039,
                          "end": 1041
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Ternary": {
                            "condition": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 1044,
                                "end": 1045
                              }
                            },
                            "then_expr": null,
                            "else_expr": {
                              "kind": "Null",
                              "span": {
                                "start": 1049,
                                "end": 1053
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 1044,
                          "end": 1053
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1039,
                        "end": 1053
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 988,
                "end": 1057
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 564,
        "end": 1059
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 1120,
              "end": 1121
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 1122,
                  "end": 1124
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1131,
                            "end": 1134
                          }
                        }
                      },
                      "span": {
                        "start": 1131,
                        "end": 1134
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
                                        "Bar"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 1139,
                                        "end": 1142
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1139,
                                    "end": 1142
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 1135,
                              "end": 1142
                            }
                          }
                        },
                        "span": {
                          "start": 1135,
                          "end": 1142
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 1127,
                  "end": 1143
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 1122,
                "end": 1143
              }
            }
          ],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 1158,
                        "end": 1160
                      }
                    },
                    "default": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 1163,
                        "end": 1165
                      }
                    },
                    "span": {
                      "start": 1158,
                      "end": 1165
                    }
                  },
                  {
                    "name": {
                      "name": "c",
                      "span": {
                        "start": 1167,
                        "end": 1169
                      }
                    },
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1176,
                                  "end": 1179
                                }
                              }
                            },
                            "span": {
                              "start": 1176,
                              "end": 1179
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 1172,
                        "end": 1179
                      }
                    },
                    "span": {
                      "start": 1167,
                      "end": 1179
                    }
                  },
                  {
                    "name": {
                      "name": "d",
                      "span": {
                        "start": 1181,
                        "end": 1183
                      }
                    },
                    "default": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "f"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1186,
                                  "end": 1187
                                }
                              }
                            },
                            "span": {
                              "start": 1186,
                              "end": 1187
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 1186,
                        "end": 1189
                      }
                    },
                    "span": {
                      "start": 1181,
                      "end": 1189
                    }
                  }
                ]
              },
              "span": {
                "start": 1151,
                "end": 1190
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 1062,
                  "end": 1066
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
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1071,
                                  "end": 1074
                                }
                              }
                            },
                            "span": {
                              "start": 1071,
                              "end": 1074
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 1067,
                        "end": 1074
                      }
                    }
                  },
                  "span": {
                    "start": 1067,
                    "end": 1074
                  }
                },
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Closure": {
                          "is_static": true,
                          "by_ref": false,
                          "params": [],
                          "use_vars": [],
                          "return_type": null,
                          "body": [],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 1076,
                        "end": 1097
                      }
                    }
                  },
                  "span": {
                    "start": 1076,
                    "end": 1097
                  }
                },
                {
                  "name": {
                    "parts": [
                      "a"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1099,
                      "end": 1100
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Array": [
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 1103,
                                  "end": 1104
                                }
                              }
                            },
                            "span": {
                              "start": 1103,
                              "end": 1104
                            }
                          },
                          {
                            "key": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 1106,
                                  "end": 1107
                                }
                              }
                            },
                            "span": {
                              "start": 1106,
                              "end": 1107
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1102,
                        "end": 1108
                      }
                    }
                  },
                  "span": {
                    "start": 1099,
                    "end": 1108
                  }
                }
              ],
              "span": {
                "start": 1062,
                "end": 1109
              }
            }
          ]
        }
      },
      "span": {
        "start": 1111,
        "end": 1192
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1192
  }
}
