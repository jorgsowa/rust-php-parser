===source===
<?php

assert(false && $y = clone $x);
assert(false && $y = clone($x));
assert(false && $y = clone($x, ));
assert(false && $y = clone($x, [ "foo" => $foo, "bar" => $bar ]));
assert(false && $y = clone($x, $array));
assert(false && $y = clone($x, $array, $extraParameter, $trailingComma, ));
assert(false && $y = clone(object: $x, withProperties: [ "foo" => $foo, "bar" => $bar ]));
assert(false && $y = clone($x, withProperties: [ "foo" => $foo, "bar" => $bar ]));
assert(false && $y = clone(object: $x));
assert(false && $y = clone(object: $x, [ "foo" => $foo, "bar" => $bar ]));
assert(false && $y = clone(...["object" => $x, "withProperties" => [ "foo" => $foo, "bar" => $bar ]]));
assert(false && $y = clone(...));
===errors <=7.4===
'clone with property overrides' requires PHP 8.5 or higher
'clone with property overrides' requires PHP 8.5 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'clone(...) first-class callable' requires PHP 8.5 or higher
===errors 8.0===
'clone with property overrides' requires PHP 8.5 or higher
'clone with property overrides' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'clone(...) first-class callable' requires PHP 8.5 or higher
===errors 8.1-8.4===
'clone with property overrides' requires PHP 8.5 or higher
'clone with property overrides' requires PHP 8.5 or higher
'clone(...) first-class callable' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',' in Standard input code on line 5
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 5
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
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 7,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 13
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 14,
                              "end": 19
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 23,
                                    "end": 25
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Clone": {
                                      "kind": {
                                        "Variable": "x"
                                      },
                                      "span": {
                                        "start": 34,
                                        "end": 36
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 28,
                                    "end": 36
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 23,
                              "end": 36
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 36
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 36
                  }
                }
              ]
            }
          },
          "span": {
            "start": 7,
            "end": 37
          }
        }
      },
      "span": {
        "start": 7,
        "end": 38
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 39,
                      "end": 45
                    }
                  }
                },
                "span": {
                  "start": 39,
                  "end": 45
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 46,
                              "end": 51
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 55,
                                    "end": 57
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Clone": {
                                      "kind": {
                                        "Variable": "x"
                                      },
                                      "span": {
                                        "start": 66,
                                        "end": 68
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 60,
                                    "end": 69
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 55,
                              "end": 69
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 46,
                        "end": 69
                      }
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 69
                  }
                }
              ]
            }
          },
          "span": {
            "start": 39,
            "end": 70
          }
        }
      },
      "span": {
        "start": 39,
        "end": 71
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 72,
                      "end": 78
                    }
                  }
                },
                "span": {
                  "start": 72,
                  "end": 78
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 79,
                              "end": 84
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 88,
                                    "end": 90
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "Clone": {
                                      "kind": {
                                        "Variable": "x"
                                      },
                                      "span": {
                                        "start": 99,
                                        "end": 101
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 93,
                                    "end": 104
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 88,
                              "end": 104
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 79,
                        "end": 104
                      }
                    }
                  },
                  "span": {
                    "start": 79,
                    "end": 104
                  }
                }
              ]
            }
          },
          "span": {
            "start": 72,
            "end": 105
          }
        }
      },
      "span": {
        "start": 72,
        "end": 106
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 107,
                      "end": 113
                    }
                  }
                },
                "span": {
                  "start": 107,
                  "end": 113
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 114,
                              "end": 119
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 123,
                                    "end": 125
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "CloneWith": [
                                      {
                                        "kind": {
                                          "Variable": "x"
                                        },
                                        "span": {
                                          "start": 134,
                                          "end": 136
                                        }
                                      },
                                      {
                                        "kind": {
                                          "Array": [
                                            {
                                              "key": {
                                                "kind": {
                                                  "String": "foo"
                                                },
                                                "span": {
                                                  "start": 140,
                                                  "end": 145
                                                }
                                              },
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Variable": "foo"
                                                  },
                                                  "span": {
                                                    "start": 149,
                                                    "end": 153
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 140,
                                                "end": 153
                                              }
                                            },
                                            {
                                              "key": {
                                                "kind": {
                                                  "String": "bar"
                                                },
                                                "span": {
                                                  "start": 155,
                                                  "end": 160
                                                }
                                              },
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Variable": "bar"
                                                  },
                                                  "span": {
                                                    "start": 164,
                                                    "end": 168
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 155,
                                                "end": 168
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 138,
                                          "end": 170
                                        }
                                      }
                                    ]
                                  },
                                  "span": {
                                    "start": 128,
                                    "end": 171
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 123,
                              "end": 171
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 171
                      }
                    }
                  },
                  "span": {
                    "start": 114,
                    "end": 171
                  }
                }
              ]
            }
          },
          "span": {
            "start": 107,
            "end": 172
          }
        }
      },
      "span": {
        "start": 107,
        "end": 173
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
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
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 181,
                              "end": 186
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 190,
                                    "end": 192
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "CloneWith": [
                                      {
                                        "kind": {
                                          "Variable": "x"
                                        },
                                        "span": {
                                          "start": 201,
                                          "end": 203
                                        }
                                      },
                                      {
                                        "kind": {
                                          "Variable": "array"
                                        },
                                        "span": {
                                          "start": 205,
                                          "end": 211
                                        }
                                      }
                                    ]
                                  },
                                  "span": {
                                    "start": 195,
                                    "end": 212
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 190,
                              "end": 212
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 181,
                        "end": 212
                      }
                    }
                  },
                  "span": {
                    "start": 181,
                    "end": 212
                  }
                }
              ]
            }
          },
          "span": {
            "start": 174,
            "end": 213
          }
        }
      },
      "span": {
        "start": 174,
        "end": 214
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 215,
                      "end": 221
                    }
                  }
                },
                "span": {
                  "start": 215,
                  "end": 221
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 222,
                              "end": 227
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 231,
                                    "end": 233
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "clone"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 236,
                                              "end": 241
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 236,
                                          "end": 241
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "x"
                                              },
                                              "span": {
                                                "start": 242,
                                                "end": 244
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 242,
                                            "end": 244
                                          }
                                        },
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "array"
                                              },
                                              "span": {
                                                "start": 246,
                                                "end": 252
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 246,
                                            "end": 252
                                          }
                                        },
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "extraParameter"
                                              },
                                              "span": {
                                                "start": 254,
                                                "end": 269
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 254,
                                            "end": 269
                                          }
                                        },
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "trailingComma"
                                              },
                                              "span": {
                                                "start": 271,
                                                "end": 285
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 271,
                                            "end": 285
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 236,
                                    "end": 288
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 231,
                              "end": 288
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 222,
                        "end": 288
                      }
                    }
                  },
                  "span": {
                    "start": 222,
                    "end": 288
                  }
                }
              ]
            }
          },
          "span": {
            "start": 215,
            "end": 289
          }
        }
      },
      "span": {
        "start": 215,
        "end": 290
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 291,
                      "end": 297
                    }
                  }
                },
                "span": {
                  "start": 291,
                  "end": 297
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 298,
                              "end": 303
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 307,
                                    "end": 309
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "clone"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 312,
                                              "end": 317
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 312,
                                          "end": 317
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": {
                                            "parts": [
                                              "object"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 318,
                                              "end": 324
                                            }
                                          },
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "x"
                                              },
                                              "span": {
                                                "start": 326,
                                                "end": 328
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 318,
                                            "end": 328
                                          }
                                        },
                                        {
                                          "name": {
                                            "parts": [
                                              "withProperties"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 330,
                                              "end": 344
                                            }
                                          },
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Array": [
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "foo"
                                                      },
                                                      "span": {
                                                        "start": 348,
                                                        "end": 353
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "foo"
                                                        },
                                                        "span": {
                                                          "start": 357,
                                                          "end": 361
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 348,
                                                      "end": 361
                                                    }
                                                  },
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "bar"
                                                      },
                                                      "span": {
                                                        "start": 363,
                                                        "end": 368
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "bar"
                                                        },
                                                        "span": {
                                                          "start": 372,
                                                          "end": 376
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 363,
                                                      "end": 376
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 346,
                                                "end": 378
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 330,
                                            "end": 378
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 312,
                                    "end": 379
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 307,
                              "end": 379
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 298,
                        "end": 379
                      }
                    }
                  },
                  "span": {
                    "start": 298,
                    "end": 379
                  }
                }
              ]
            }
          },
          "span": {
            "start": 291,
            "end": 380
          }
        }
      },
      "span": {
        "start": 291,
        "end": 381
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 382,
                      "end": 388
                    }
                  }
                },
                "span": {
                  "start": 382,
                  "end": 388
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 389,
                              "end": 394
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 398,
                                    "end": 400
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "clone"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 403,
                                              "end": 408
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 403,
                                          "end": 408
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "x"
                                              },
                                              "span": {
                                                "start": 409,
                                                "end": 411
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 409,
                                            "end": 411
                                          }
                                        },
                                        {
                                          "name": {
                                            "parts": [
                                              "withProperties"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 413,
                                              "end": 427
                                            }
                                          },
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Array": [
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "foo"
                                                      },
                                                      "span": {
                                                        "start": 431,
                                                        "end": 436
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "foo"
                                                        },
                                                        "span": {
                                                          "start": 440,
                                                          "end": 444
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 431,
                                                      "end": 444
                                                    }
                                                  },
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "bar"
                                                      },
                                                      "span": {
                                                        "start": 446,
                                                        "end": 451
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "bar"
                                                        },
                                                        "span": {
                                                          "start": 455,
                                                          "end": 459
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 446,
                                                      "end": 459
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 429,
                                                "end": 461
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 413,
                                            "end": 461
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 403,
                                    "end": 462
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 398,
                              "end": 462
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 389,
                        "end": 462
                      }
                    }
                  },
                  "span": {
                    "start": 389,
                    "end": 462
                  }
                }
              ]
            }
          },
          "span": {
            "start": 382,
            "end": 463
          }
        }
      },
      "span": {
        "start": 382,
        "end": 464
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 465,
                      "end": 471
                    }
                  }
                },
                "span": {
                  "start": 465,
                  "end": 471
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 472,
                              "end": 477
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 481,
                                    "end": 483
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "clone"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 486,
                                              "end": 491
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 486,
                                          "end": 491
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": {
                                            "parts": [
                                              "object"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 492,
                                              "end": 498
                                            }
                                          },
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "x"
                                              },
                                              "span": {
                                                "start": 500,
                                                "end": 502
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 492,
                                            "end": 502
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 486,
                                    "end": 503
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 481,
                              "end": 503
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 472,
                        "end": 503
                      }
                    }
                  },
                  "span": {
                    "start": 472,
                    "end": 503
                  }
                }
              ]
            }
          },
          "span": {
            "start": 465,
            "end": 504
          }
        }
      },
      "span": {
        "start": 465,
        "end": 505
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 506,
                      "end": 512
                    }
                  }
                },
                "span": {
                  "start": 506,
                  "end": 512
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 513,
                              "end": 518
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 522,
                                    "end": 524
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "clone"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 527,
                                              "end": 532
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 527,
                                          "end": 532
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": {
                                            "parts": [
                                              "object"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 533,
                                              "end": 539
                                            }
                                          },
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Variable": "x"
                                              },
                                              "span": {
                                                "start": 541,
                                                "end": 543
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 533,
                                            "end": 543
                                          }
                                        },
                                        {
                                          "name": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Array": [
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "foo"
                                                      },
                                                      "span": {
                                                        "start": 547,
                                                        "end": 552
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "foo"
                                                        },
                                                        "span": {
                                                          "start": 556,
                                                          "end": 560
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 547,
                                                      "end": 560
                                                    }
                                                  },
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "bar"
                                                      },
                                                      "span": {
                                                        "start": 562,
                                                        "end": 567
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "bar"
                                                        },
                                                        "span": {
                                                          "start": 571,
                                                          "end": 575
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 562,
                                                      "end": 575
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 545,
                                                "end": 577
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 545,
                                            "end": 577
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 527,
                                    "end": 578
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 522,
                              "end": 578
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 513,
                        "end": 578
                      }
                    }
                  },
                  "span": {
                    "start": 513,
                    "end": 578
                  }
                }
              ]
            }
          },
          "span": {
            "start": 506,
            "end": 579
          }
        }
      },
      "span": {
        "start": 506,
        "end": 580
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 581,
                      "end": 587
                    }
                  }
                },
                "span": {
                  "start": 581,
                  "end": 587
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 588,
                              "end": 593
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 597,
                                    "end": 599
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "clone"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 602,
                                              "end": 607
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 602,
                                          "end": 607
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "kind": {
                                            "Spread": {
                                              "kind": {
                                                "Array": [
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "object"
                                                      },
                                                      "span": {
                                                        "start": 612,
                                                        "end": 620
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "x"
                                                        },
                                                        "span": {
                                                          "start": 624,
                                                          "end": 626
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 612,
                                                      "end": 626
                                                    }
                                                  },
                                                  {
                                                    "key": {
                                                      "kind": {
                                                        "String": "withProperties"
                                                      },
                                                      "span": {
                                                        "start": 628,
                                                        "end": 644
                                                      }
                                                    },
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Array": [
                                                            {
                                                              "key": {
                                                                "kind": {
                                                                  "String": "foo"
                                                                },
                                                                "span": {
                                                                  "start": 650,
                                                                  "end": 655
                                                                }
                                                              },
                                                              "kind": {
                                                                "Value": {
                                                                  "kind": {
                                                                    "Variable": "foo"
                                                                  },
                                                                  "span": {
                                                                    "start": 659,
                                                                    "end": 663
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 650,
                                                                "end": 663
                                                              }
                                                            },
                                                            {
                                                              "key": {
                                                                "kind": {
                                                                  "String": "bar"
                                                                },
                                                                "span": {
                                                                  "start": 665,
                                                                  "end": 670
                                                                }
                                                              },
                                                              "kind": {
                                                                "Value": {
                                                                  "kind": {
                                                                    "Variable": "bar"
                                                                  },
                                                                  "span": {
                                                                    "start": 674,
                                                                    "end": 678
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 665,
                                                                "end": 678
                                                              }
                                                            }
                                                          ]
                                                        },
                                                        "span": {
                                                          "start": 648,
                                                          "end": 680
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 628,
                                                      "end": 680
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 611,
                                                "end": 681
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 608,
                                            "end": 681
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 602,
                                    "end": 682
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 597,
                              "end": 682
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 588,
                        "end": 682
                      }
                    }
                  },
                  "span": {
                    "start": 588,
                    "end": 682
                  }
                }
              ]
            }
          },
          "span": {
            "start": 581,
            "end": 683
          }
        }
      },
      "span": {
        "start": 581,
        "end": 684
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 685,
                      "end": 691
                    }
                  }
                },
                "span": {
                  "start": 685,
                  "end": 691
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Bool": false
                            },
                            "span": {
                              "start": 692,
                              "end": 697
                            }
                          },
                          "op": "BooleanAnd",
                          "right": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "y"
                                  },
                                  "span": {
                                    "start": 701,
                                    "end": 703
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": {
                                    "CallableCreate": {
                                      "kind": {
                                        "Function": {
                                          "kind": {
                                            "Name": {
                                              "parts": [
                                                "clone"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 706,
                                                "end": 711
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 706,
                                            "end": 711
                                          }
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 706,
                                    "end": 716
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 701,
                              "end": 716
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 692,
                        "end": 716
                      }
                    }
                  },
                  "span": {
                    "start": 692,
                    "end": 716
                  }
                }
              ]
            }
          },
          "span": {
            "start": 685,
            "end": 717
          }
        }
      },
      "span": {
        "start": 685,
        "end": 718
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 718
  }
}
