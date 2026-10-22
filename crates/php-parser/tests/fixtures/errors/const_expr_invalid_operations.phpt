===source===
<?php
const A = $x;
const B = f();
const C = Foo::$b;
const D = Foo::b();
const E = "a$b";
const F = 1 instanceof B;
const G = @B;
const H = isset(B);
const I = 1 |> B;
const J = E::A->value();
const K = `ls`;
const L = match (1) { default => 1 };
const M = print 1;
const N = clone B;
const O = throw new E;
const P = exit;
const Q = [&$a];
const R = [$x => 1];
const S = B[$x];
const T = E::A->$x;
const U = $o->m(...);
const V = fn() => 1;
const W = Foo::{$c};
const X = -$x + 1;
===errors <=7.4===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Constant expression contains invalid operations
'pipe operator (|>)' requires PHP 8.5 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'match expressions' requires PHP 8.0 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'throw expressions' requires PHP 8.0 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'property fetch in constant expressions' requires PHP 8.2 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
Constant expression contains invalid operations
'dynamic class constant fetch' requires PHP 8.3 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
===errors 8.0===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Constant expression contains invalid operations
'pipe operator (|>)' requires PHP 8.5 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'property fetch in constant expressions' requires PHP 8.2 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
Constant expression contains invalid operations
'dynamic class constant fetch' requires PHP 8.3 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
===errors 8.1===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Constant expression contains invalid operations
'pipe operator (|>)' requires PHP 8.5 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'property fetch in constant expressions' requires PHP 8.2 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
Constant expression contains invalid operations
'dynamic class constant fetch' requires PHP 8.3 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
===errors 8.2===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Constant expression contains invalid operations
'pipe operator (|>)' requires PHP 8.5 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'first-class callables in constant expressions' requires PHP 8.5 or higher
Constant expression contains invalid operations
'dynamic class constant fetch' requires PHP 8.3 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
===errors 8.3-8.4===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Constant expression contains invalid operations
'pipe operator (|>)' requires PHP 8.5 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'first-class callables in constant expressions' requires PHP 8.5 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
===errors >=8.5===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Cannot use isset() on the result of an expression (you can use "null !== expression" instead)
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '>' in Standard input code on line 10
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token ">" in Standard input code on line 10
===php_error >=8.5===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
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
                "Variable": "x"
              },
              "span": {
                "start": 16,
                "end": 18
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 18
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 26,
                "end": 27
              }
            },
            "value": {
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
                          "start": 30,
                          "end": 31
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 30,
                "end": 33
              }
            },
            "attributes": [],
            "span": {
              "start": 26,
              "end": 33
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 34
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 41,
                "end": 42
              }
            },
            "value": {
              "kind": {
                "StaticPropertyAccess": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 45,
                          "end": 48
                        }
                      }
                    },
                    "span": {
                      "start": 45,
                      "end": 48
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 50,
                      "end": 52
                    }
                  }
                }
              },
              "span": {
                "start": 45,
                "end": 52
              }
            },
            "attributes": [],
            "span": {
              "start": 41,
              "end": 52
            }
          }
        ]
      },
      "span": {
        "start": 35,
        "end": 53
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 60,
                "end": 61
              }
            },
            "value": {
              "kind": {
                "StaticMethodCall": {
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
                  "method": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 69,
                      "end": 70
                    }
                  },
                  "args": []
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
              "name": "E",
              "span": {
                "start": 80,
                "end": 81
              }
            },
            "value": {
              "kind": {
                "InterpolatedString": [
                  {
                    "Literal": "a"
                  },
                  {
                    "Expr": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 86,
                        "end": 88
                      }
                    }
                  }
                ]
              },
              "span": {
                "start": 84,
                "end": 89
              }
            },
            "attributes": [],
            "span": {
              "start": 80,
              "end": 89
            }
          }
        ]
      },
      "span": {
        "start": 74,
        "end": 90
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "F",
              "span": {
                "start": 97,
                "end": 98
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
                      "start": 101,
                      "end": 102
                    }
                  },
                  "op": "Instanceof",
                  "right": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 114,
                          "end": 115
                        }
                      }
                    },
                    "span": {
                      "start": 114,
                      "end": 115
                    }
                  }
                }
              },
              "span": {
                "start": 101,
                "end": 115
              }
            },
            "attributes": [],
            "span": {
              "start": 97,
              "end": 115
            }
          }
        ]
      },
      "span": {
        "start": 91,
        "end": 116
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "G",
              "span": {
                "start": 123,
                "end": 124
              }
            },
            "value": {
              "kind": {
                "ErrorSuppress": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 128,
                        "end": 129
                      }
                    }
                  },
                  "span": {
                    "start": 128,
                    "end": 129
                  }
                }
              },
              "span": {
                "start": 127,
                "end": 129
              }
            },
            "attributes": [],
            "span": {
              "start": 123,
              "end": 129
            }
          }
        ]
      },
      "span": {
        "start": 117,
        "end": 130
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "H",
              "span": {
                "start": 137,
                "end": 138
              }
            },
            "value": {
              "kind": {
                "Isset": [
                  {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 147,
                          "end": 148
                        }
                      }
                    },
                    "span": {
                      "start": 147,
                      "end": 148
                    }
                  }
                ]
              },
              "span": {
                "start": 141,
                "end": 149
              }
            },
            "attributes": [],
            "span": {
              "start": 137,
              "end": 149
            }
          }
        ]
      },
      "span": {
        "start": 131,
        "end": 150
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "I",
              "span": {
                "start": 157,
                "end": 158
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
                      "start": 161,
                      "end": 162
                    }
                  },
                  "op": "Pipe",
                  "right": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 166,
                          "end": 167
                        }
                      }
                    },
                    "span": {
                      "start": 166,
                      "end": 167
                    }
                  }
                }
              },
              "span": {
                "start": 161,
                "end": 167
              }
            },
            "attributes": [],
            "span": {
              "start": 157,
              "end": 167
            }
          }
        ]
      },
      "span": {
        "start": 151,
        "end": 168
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "J",
              "span": {
                "start": 175,
                "end": 176
              }
            },
            "value": {
              "kind": {
                "MethodCall": {
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
                                "start": 179,
                                "end": 180
                              }
                            }
                          },
                          "span": {
                            "start": 179,
                            "end": 180
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 182,
                            "end": 183
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 179,
                      "end": 183
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "value"
                    },
                    "span": {
                      "start": 185,
                      "end": 190
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 179,
                "end": 192
              }
            },
            "attributes": [],
            "span": {
              "start": 175,
              "end": 192
            }
          }
        ]
      },
      "span": {
        "start": 169,
        "end": 193
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "K",
              "span": {
                "start": 200,
                "end": 201
              }
            },
            "value": {
              "kind": {
                "ShellExec": [
                  {
                    "Literal": "ls"
                  }
                ]
              },
              "span": {
                "start": 204,
                "end": 208
              }
            },
            "attributes": [],
            "span": {
              "start": 200,
              "end": 208
            }
          }
        ]
      },
      "span": {
        "start": 194,
        "end": 209
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "L",
              "span": {
                "start": 216,
                "end": 217
              }
            },
            "value": {
              "kind": {
                "Match": {
                  "subject": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 227,
                      "end": 228
                    }
                  },
                  "arms": [
                    {
                      "conditions": null,
                      "body": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 243,
                          "end": 244
                        }
                      },
                      "span": {
                        "start": 232,
                        "end": 244
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 220,
                "end": 246
              }
            },
            "attributes": [],
            "span": {
              "start": 216,
              "end": 246
            }
          }
        ]
      },
      "span": {
        "start": 210,
        "end": 247
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "M",
              "span": {
                "start": 254,
                "end": 255
              }
            },
            "value": {
              "kind": {
                "Print": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 264,
                    "end": 265
                  }
                }
              },
              "span": {
                "start": 258,
                "end": 265
              }
            },
            "attributes": [],
            "span": {
              "start": 254,
              "end": 265
            }
          }
        ]
      },
      "span": {
        "start": 248,
        "end": 266
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "N",
              "span": {
                "start": 273,
                "end": 274
              }
            },
            "value": {
              "kind": {
                "Clone": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 283,
                        "end": 284
                      }
                    }
                  },
                  "span": {
                    "start": 283,
                    "end": 284
                  }
                }
              },
              "span": {
                "start": 277,
                "end": 284
              }
            },
            "attributes": [],
            "span": {
              "start": 273,
              "end": 284
            }
          }
        ]
      },
      "span": {
        "start": 267,
        "end": 285
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "O",
              "span": {
                "start": 292,
                "end": 293
              }
            },
            "value": {
              "kind": {
                "Throw": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 306,
                              "end": 307
                            }
                          }
                        },
                        "span": {
                          "start": 306,
                          "end": 307
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 302,
                    "end": 307
                  }
                }
              },
              "span": {
                "start": 296,
                "end": 307
              }
            },
            "attributes": [],
            "span": {
              "start": 292,
              "end": 307
            }
          }
        ]
      },
      "span": {
        "start": 286,
        "end": 308
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "P",
              "span": {
                "start": 315,
                "end": 316
              }
            },
            "value": {
              "kind": {
                "Exit": null
              },
              "span": {
                "start": 319,
                "end": 323
              }
            },
            "attributes": [],
            "span": {
              "start": 315,
              "end": 323
            }
          }
        ]
      },
      "span": {
        "start": 309,
        "end": 324
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "Q",
              "span": {
                "start": 331,
                "end": 332
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": null,
                    "kind": {
                      "ByRef": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 337,
                          "end": 339
                        }
                      }
                    },
                    "span": {
                      "start": 336,
                      "end": 339
                    }
                  }
                ]
              },
              "span": {
                "start": 335,
                "end": 340
              }
            },
            "attributes": [],
            "span": {
              "start": 331,
              "end": 340
            }
          }
        ]
      },
      "span": {
        "start": 325,
        "end": 341
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "R",
              "span": {
                "start": 348,
                "end": 349
              }
            },
            "value": {
              "kind": {
                "Array": [
                  {
                    "key": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 353,
                        "end": 355
                      }
                    },
                    "kind": {
                      "Value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 359,
                          "end": 360
                        }
                      }
                    },
                    "span": {
                      "start": 353,
                      "end": 360
                    }
                  }
                ]
              },
              "span": {
                "start": 352,
                "end": 361
              }
            },
            "attributes": [],
            "span": {
              "start": 348,
              "end": 361
            }
          }
        ]
      },
      "span": {
        "start": 342,
        "end": 362
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "S",
              "span": {
                "start": 369,
                "end": 370
              }
            },
            "value": {
              "kind": {
                "ArrayAccess": {
                  "array": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "B"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 373,
                          "end": 374
                        }
                      }
                    },
                    "span": {
                      "start": 373,
                      "end": 374
                    }
                  },
                  "index": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 375,
                      "end": 377
                    }
                  }
                }
              },
              "span": {
                "start": 373,
                "end": 378
              }
            },
            "attributes": [],
            "span": {
              "start": 369,
              "end": 378
            }
          }
        ]
      },
      "span": {
        "start": 363,
        "end": 379
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "T",
              "span": {
                "start": 386,
                "end": 387
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
                                "start": 390,
                                "end": 391
                              }
                            }
                          },
                          "span": {
                            "start": 390,
                            "end": 391
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 393,
                            "end": 394
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 390,
                      "end": 394
                    }
                  },
                  "property": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 396,
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
            "attributes": [],
            "span": {
              "start": 386,
              "end": 398
            }
          }
        ]
      },
      "span": {
        "start": 380,
        "end": 399
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "U",
              "span": {
                "start": 406,
                "end": 407
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Method": {
                      "object": {
                        "kind": {
                          "Variable": "o"
                        },
                        "span": {
                          "start": 410,
                          "end": 412
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "m"
                        },
                        "span": {
                          "start": 414,
                          "end": 415
                        }
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 410,
                "end": 420
              }
            },
            "attributes": [],
            "span": {
              "start": 406,
              "end": 420
            }
          }
        ]
      },
      "span": {
        "start": 400,
        "end": 421
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "V",
              "span": {
                "start": 428,
                "end": 429
              }
            },
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
                      "start": 440,
                      "end": 441
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 432,
                "end": 441
              }
            },
            "attributes": [],
            "span": {
              "start": 428,
              "end": 441
            }
          }
        ]
      },
      "span": {
        "start": 422,
        "end": 442
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "W",
              "span": {
                "start": 449,
                "end": 450
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
                          "start": 453,
                          "end": 456
                        }
                      }
                    },
                    "span": {
                      "start": 453,
                      "end": 456
                    }
                  },
                  "member": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 459,
                      "end": 461
                    }
                  }
                }
              },
              "span": {
                "start": 453,
                "end": 462
              }
            },
            "attributes": [],
            "span": {
              "start": 449,
              "end": 462
            }
          }
        ]
      },
      "span": {
        "start": 443,
        "end": 463
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "X",
              "span": {
                "start": 470,
                "end": 471
              }
            },
            "value": {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "UnaryPrefix": {
                        "op": "Negate",
                        "operand": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 475,
                            "end": 477
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 474,
                      "end": 477
                    }
                  },
                  "op": "Add",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 480,
                      "end": 481
                    }
                  }
                }
              },
              "span": {
                "start": 474,
                "end": 481
              }
            },
            "attributes": [],
            "span": {
              "start": 470,
              "end": 481
            }
          }
        ]
      },
      "span": {
        "start": 464,
        "end": 482
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 482
  }
}
