===source===
<?php
// Test 1: Function call without space
foo(1);

// Test 2: Function call with spaces in args
foo( 1 , 2 );

// Test 3: Static call with no spaces
Math::sqrt(4);

// Test 4: Static call with various spacing
Math  ::  sqrt  (  4  );

// Test 5: Method call
$obj->method(1);

// Test 6: Method call with spacing
$obj  ->  method  (  1  );

// Test 7: Nullsafe method call
$obj?->method(1);

// Test 8: Property access
$obj->prop;

// Test 9: Nullsafe property access
$obj?->prop;

// Test 10: Chained calls
foo()->bar(1);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 45,
                  "end": 48
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 49,
                      "end": 50
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 49,
                    "end": 50
                  }
                }
              ]
            }
          },
          "span": {
            "start": 45,
            "end": 51
          }
        }
      },
      "span": {
        "start": 45,
        "end": 52
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 99,
                  "end": 102
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 104,
                      "end": 105
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 104,
                    "end": 105
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 108,
                      "end": 109
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 108,
                    "end": 109
                  }
                }
              ]
            }
          },
          "span": {
            "start": 99,
            "end": 111
          }
        }
      },
      "span": {
        "start": 99,
        "end": 112
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Math"
                },
                "span": {
                  "start": 152,
                  "end": 156
                }
              },
              "method": {
                "kind": {
                  "Identifier": "sqrt"
                },
                "span": {
                  "start": 158,
                  "end": 162
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 163,
                      "end": 164
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 163,
                    "end": 164
                  }
                }
              ]
            }
          },
          "span": {
            "start": 152,
            "end": 165
          }
        }
      },
      "span": {
        "start": 152,
        "end": 166
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Math"
                },
                "span": {
                  "start": 212,
                  "end": 216
                }
              },
              "method": {
                "kind": {
                  "Identifier": "sqrt"
                },
                "span": {
                  "start": 222,
                  "end": 226
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 231,
                      "end": 232
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 231,
                    "end": 232
                  }
                }
              ]
            }
          },
          "span": {
            "start": 212,
            "end": 235
          }
        }
      },
      "span": {
        "start": 212,
        "end": 236
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 261,
                  "end": 265
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method"
                },
                "span": {
                  "start": 267,
                  "end": 273
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 274,
                      "end": 275
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 274,
                    "end": 275
                  }
                }
              ]
            }
          },
          "span": {
            "start": 261,
            "end": 276
          }
        }
      },
      "span": {
        "start": 261,
        "end": 277
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 315,
                  "end": 319
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method"
                },
                "span": {
                  "start": 325,
                  "end": 331
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 336,
                      "end": 337
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 336,
                    "end": 337
                  }
                }
              ]
            }
          },
          "span": {
            "start": 315,
            "end": 340
          }
        }
      },
      "span": {
        "start": 315,
        "end": 341
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafeMethodCall": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 375,
                  "end": 379
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method"
                },
                "span": {
                  "start": 382,
                  "end": 388
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 389,
                      "end": 390
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 389,
                    "end": 390
                  }
                }
              ]
            }
          },
          "span": {
            "start": 375,
            "end": 391
          }
        }
      },
      "span": {
        "start": 375,
        "end": 392
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 421,
                  "end": 425
                }
              },
              "property": {
                "kind": {
                  "Identifier": "prop"
                },
                "span": {
                  "start": 427,
                  "end": 431
                }
              }
            }
          },
          "span": {
            "start": 421,
            "end": 431
          }
        }
      },
      "span": {
        "start": 421,
        "end": 432
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "NullsafePropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 470,
                  "end": 474
                }
              },
              "property": {
                "kind": {
                  "Identifier": "prop"
                },
                "span": {
                  "start": 477,
                  "end": 481
                }
              }
            }
          },
          "span": {
            "start": 470,
            "end": 481
          }
        }
      },
      "span": {
        "start": 470,
        "end": 482
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "foo"
                      },
                      "span": {
                        "start": 510,
                        "end": 513
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 510,
                  "end": 515
                }
              },
              "method": {
                "kind": {
                  "Identifier": "bar"
                },
                "span": {
                  "start": 517,
                  "end": 520
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 521,
                      "end": 522
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 521,
                    "end": 522
                  }
                }
              ]
            }
          },
          "span": {
            "start": 510,
            "end": 523
          }
        }
      },
      "span": {
        "start": 510,
        "end": 524
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 524
  }
}
