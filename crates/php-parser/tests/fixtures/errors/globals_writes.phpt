===source===
<?php
$GLOBALS = 1;
$GLOBALS .= 1;
$GLOBALS ??= 1;
$GLOBALS++;
--$GLOBALS;
$GLOBALS = &$a;
$a = &$GLOBALS;
$a = [&$GLOBALS, 'k' => &$GLOBALS];
[$a, [$GLOBALS]] = $a;
foreach ($a as $GLOBALS) {}
foreach ($a as &$GLOBALS) {}
unset($GLOBALS);
$GLOBALS[] = 1;
$GLOBALS[]['a'] .= 1;
$GLOBALS[]->a++;
$a = &$GLOBALS[];
[$GLOBALS[]] = $a;
function f($GLOBALS, &$_GET, ...$_SESSION) {}
fn($_SERVER) => 1;
function () use ($_POST, &$GLOBALS) {};
class A { public function __construct(public $_ENV) {} }
===errors===
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
Cannot acquire reference to $GLOBALS
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
$GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax
Cannot re-assign auto-global variable GLOBALS
Cannot re-assign auto-global variable _GET
Cannot re-assign auto-global variable _SESSION
Cannot re-assign auto-global variable _SERVER
Cannot use auto-global as lexical variable
Cannot use auto-global as lexical variable
Cannot re-assign auto-global variable _ENV
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
===php_error <=8.0===
PHP Fatal error:  Cannot re-assign auto-global variable GLOBALS in Standard input code on line 19
===php_error >=8.1===
PHP Fatal error:  $GLOBALS can only be modified using the $GLOBALS[$name] = $value syntax in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 20,
                  "end": 28
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 32,
                  "end": 33
                }
              }
            }
          },
          "span": {
            "start": 20,
            "end": 33
          }
        }
      },
      "span": {
        "start": 20,
        "end": 34
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 35,
                  "end": 43
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 48,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 35,
            "end": 49
          }
        }
      },
      "span": {
        "start": 35,
        "end": 50
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 51,
                  "end": 59
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 51,
            "end": 61
          }
        }
      },
      "span": {
        "start": 51,
        "end": 62
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreDecrement",
              "operand": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 65,
                  "end": 73
                }
              }
            }
          },
          "span": {
            "start": 63,
            "end": 73
          }
        }
      },
      "span": {
        "start": 63,
        "end": 74
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 75,
                  "end": 83
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 87,
                  "end": 89
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 75,
            "end": 89
          }
        }
      },
      "span": {
        "start": 75,
        "end": 90
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 91,
                  "end": 93
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "GLOBALS"
                },
                "span": {
                  "start": 97,
                  "end": 105
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 91,
            "end": 105
          }
        }
      },
      "span": {
        "start": 91,
        "end": 106
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 107,
                  "end": 109
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 114,
                            "end": 122
                          }
                        }
                      },
                      "span": {
                        "start": 113,
                        "end": 122
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 124,
                          "end": 127
                        }
                      },
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 132,
                            "end": 140
                          }
                        }
                      },
                      "span": {
                        "start": 124,
                        "end": 140
                      }
                    }
                  ]
                },
                "span": {
                  "start": 112,
                  "end": 141
                }
              }
            }
          },
          "span": {
            "start": 107,
            "end": 141
          }
        }
      },
      "span": {
        "start": 107,
        "end": 142
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 144,
                            "end": 146
                          }
                        }
                      },
                      "span": {
                        "start": 144,
                        "end": 146
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "GLOBALS"
                                    },
                                    "span": {
                                      "start": 149,
                                      "end": 157
                                    }
                                  }
                                },
                                "span": {
                                  "start": 149,
                                  "end": 157
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 148,
                            "end": 158
                          }
                        }
                      },
                      "span": {
                        "start": 148,
                        "end": 158
                      }
                    }
                  ]
                },
                "span": {
                  "start": 143,
                  "end": 159
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 162,
                  "end": 164
                }
              }
            }
          },
          "span": {
            "start": 143,
            "end": 164
          }
        }
      },
      "span": {
        "start": 143,
        "end": 165
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 175,
              "end": 177
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "GLOBALS"
            },
            "span": {
              "start": 181,
              "end": 189
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 191,
              "end": 193
            }
          }
        }
      },
      "span": {
        "start": 166,
        "end": 193
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 203,
              "end": 205
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "GLOBALS"
            },
            "span": {
              "start": 210,
              "end": 218
            }
          },
          "by_ref": true,
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 220,
              "end": 222
            }
          }
        }
      },
      "span": {
        "start": 194,
        "end": 222
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "GLOBALS"
            },
            "span": {
              "start": 229,
              "end": 237
            }
          }
        ]
      },
      "span": {
        "start": 223,
        "end": 239
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "GLOBALS"
                      },
                      "span": {
                        "start": 240,
                        "end": 248
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 240,
                  "end": 250
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 253,
                  "end": 254
                }
              }
            }
          },
          "span": {
            "start": 240,
            "end": 254
          }
        }
      },
      "span": {
        "start": 240,
        "end": 255
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 256,
                              "end": 264
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 256,
                        "end": 266
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 267,
                        "end": 270
                      }
                    }
                  }
                },
                "span": {
                  "start": 256,
                  "end": 271
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 275,
                  "end": 276
                }
              }
            }
          },
          "span": {
            "start": 256,
            "end": 276
          }
        }
      },
      "span": {
        "start": 256,
        "end": 277
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 278,
                              "end": 286
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 278,
                        "end": 288
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 290,
                        "end": 291
                      }
                    }
                  }
                },
                "span": {
                  "start": 278,
                  "end": 291
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 278,
            "end": 293
          }
        }
      },
      "span": {
        "start": 278,
        "end": 294
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 295,
                  "end": 297
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "GLOBALS"
                      },
                      "span": {
                        "start": 301,
                        "end": 309
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 301,
                  "end": 311
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 295,
            "end": 311
          }
        }
      },
      "span": {
        "start": 295,
        "end": 312
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "GLOBALS"
                                },
                                "span": {
                                  "start": 314,
                                  "end": 322
                                }
                              },
                              "index": null
                            }
                          },
                          "span": {
                            "start": 314,
                            "end": 324
                          }
                        }
                      },
                      "span": {
                        "start": 314,
                        "end": 324
                      }
                    }
                  ]
                },
                "span": {
                  "start": 313,
                  "end": 325
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 328,
                  "end": 330
                }
              }
            }
          },
          "span": {
            "start": 313,
            "end": 330
          }
        }
      },
      "span": {
        "start": 313,
        "end": 331
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 341,
              "end": 342
            }
          },
          "params": [
            {
              "name": {
                "name": "GLOBALS",
                "span": {
                  "start": 343,
                  "end": 351
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 343,
                "end": 351
              }
            },
            {
              "name": {
                "name": "_GET",
                "span": {
                  "start": 354,
                  "end": 359
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 353,
                "end": 359
              }
            },
            {
              "name": {
                "name": "_SESSION",
                "span": {
                  "start": 364,
                  "end": 373
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "attributes": [],
              "span": {
                "start": 361,
                "end": 373
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 332,
        "end": 377
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": {
                    "name": "_SERVER",
                    "span": {
                      "start": 381,
                      "end": 389
                    }
                  },
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "attributes": [],
                  "span": {
                    "start": 381,
                    "end": 389
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 394,
                  "end": 395
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 378,
            "end": 395
          }
        }
      },
      "span": {
        "start": 378,
        "end": 396
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [
                {
                  "name": {
                    "name": "_POST",
                    "span": {
                      "start": 414,
                      "end": 420
                    }
                  },
                  "by_ref": false,
                  "span": {
                    "start": 414,
                    "end": 420
                  }
                },
                {
                  "name": {
                    "name": "GLOBALS",
                    "span": {
                      "start": 423,
                      "end": 431
                    }
                  },
                  "by_ref": true,
                  "span": {
                    "start": 422,
                    "end": 431
                  }
                }
              ],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 397,
            "end": 435
          }
        }
      },
      "span": {
        "start": 397,
        "end": 436
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 443,
              "end": 444
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
                    "name": "__construct",
                    "span": {
                      "start": 463,
                      "end": 474
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "_ENV",
                        "span": {
                          "start": 482,
                          "end": 487
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
                        "start": 475,
                        "end": 487
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 447,
                "end": 491
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 437,
        "end": 493
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 493
  }
}
