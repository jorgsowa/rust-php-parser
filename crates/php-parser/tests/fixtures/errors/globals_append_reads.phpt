===source===
<?php
f($GLOBALS[], ...$GLOBALS[]);
$o->m(a: $GLOBALS[]);
new A($GLOBALS[]);
$x = $GLOBALS[];
echo ($GLOBALS)[]['a'];
$x = $GLOBALS[]->a ?? $GLOBALS[]::$a;
$x = $GLOBALS[]::m() . $GLOBALS[]::class;
$a[$GLOBALS[]]();
isset($GLOBALS[]['a'], $a[$GLOBALS[]]);
unset($GLOBALS[]['a']);
foreach ($GLOBALS[] as $v) {}
function &f() { return $GLOBALS[]; }
$x = [f($GLOBALS[]), $x = $GLOBALS[], fn() => $GLOBALS[]];
$x = [$GLOBALS[], 'k' => &$GLOBALS[], $GLOBALS[] => 1, ...$GLOBALS[]];
$x = [[$GLOBALS[]['a']->b], 1 + ($GLOBALS)[], $GLOBALS[]::A];
isset($GLOBALS[], $a);
$x = empty($GLOBALS[]);
$x = $GLOBALS[]::A;
unset($GLOBALS[]);
===errors===
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for reading
cannot use [] for unsetting
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
Cannot append to $GLOBALS
===php_error===
PHP Fatal error:  Cannot append to $GLOBALS in Standard input code on line 2
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
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 7
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 7
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 8,
                            "end": 16
                          }
                        },
                        "index": null
                      }
                    },
                    "span": {
                      "start": 8,
                      "end": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 8,
                    "end": 18
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 23,
                            "end": 31
                          }
                        },
                        "index": null
                      }
                    },
                    "span": {
                      "start": 23,
                      "end": 33
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 20,
                    "end": 33
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 36,
                  "end": 38
                }
              },
              "method": {
                "kind": {
                  "Identifier": "m"
                },
                "span": {
                  "start": 40,
                  "end": 41
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "a"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "value": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 45,
                            "end": 53
                          }
                        },
                        "index": null
                      }
                    },
                    "span": {
                      "start": 45,
                      "end": 55
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 42,
                    "end": 55
                  }
                }
              ]
            }
          },
          "span": {
            "start": 36,
            "end": 56
          }
        }
      },
      "span": {
        "start": 36,
        "end": 57
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 62,
                      "end": 63
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 63
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 64,
                            "end": 72
                          }
                        },
                        "index": null
                      }
                    },
                    "span": {
                      "start": 64,
                      "end": 74
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 64,
                    "end": 74
                  }
                }
              ]
            }
          },
          "span": {
            "start": 58,
            "end": 75
          }
        }
      },
      "span": {
        "start": 58,
        "end": 76
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 77,
                  "end": 79
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
                        "start": 82,
                        "end": 90
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 82,
                  "end": 92
                }
              }
            }
          },
          "span": {
            "start": 77,
            "end": 92
          }
        }
      },
      "span": {
        "start": 77,
        "end": 93
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 100,
                              "end": 108
                            }
                          }
                        },
                        "span": {
                          "start": 99,
                          "end": 109
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 99,
                    "end": 111
                  }
                },
                "index": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 112,
                    "end": 115
                  }
                }
              }
            },
            "span": {
              "start": 99,
              "end": 116
            }
          }
        ]
      },
      "span": {
        "start": 94,
        "end": 117
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 118,
                  "end": 120
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
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
                                    "start": 123,
                                    "end": 131
                                  }
                                },
                                "index": null
                              }
                            },
                            "span": {
                              "start": 123,
                              "end": 133
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "a"
                            },
                            "span": {
                              "start": 135,
                              "end": 136
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 123,
                        "end": 136
                      }
                    },
                    "right": {
                      "kind": {
                        "StaticPropertyAccess": {
                          "class": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Variable": "GLOBALS"
                                  },
                                  "span": {
                                    "start": 140,
                                    "end": 148
                                  }
                                },
                                "index": null
                              }
                            },
                            "span": {
                              "start": 140,
                              "end": 150
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "a"
                            },
                            "span": {
                              "start": 152,
                              "end": 154
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 140,
                        "end": 154
                      }
                    }
                  }
                },
                "span": {
                  "start": 123,
                  "end": 154
                }
              }
            }
          },
          "span": {
            "start": 118,
            "end": 154
          }
        }
      },
      "span": {
        "start": 118,
        "end": 155
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 156,
                  "end": 158
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "StaticMethodCall": {
                          "class": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Variable": "GLOBALS"
                                  },
                                  "span": {
                                    "start": 161,
                                    "end": 169
                                  }
                                },
                                "index": null
                              }
                            },
                            "span": {
                              "start": 161,
                              "end": 171
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "m"
                            },
                            "span": {
                              "start": 173,
                              "end": 174
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 161,
                        "end": 176
                      }
                    },
                    "op": "Concat",
                    "right": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "Variable": "GLOBALS"
                                  },
                                  "span": {
                                    "start": 179,
                                    "end": 187
                                  }
                                },
                                "index": null
                              }
                            },
                            "span": {
                              "start": 179,
                              "end": 189
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 191,
                              "end": 196
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 179,
                        "end": 196
                      }
                    }
                  }
                },
                "span": {
                  "start": 161,
                  "end": 196
                }
              }
            }
          },
          "span": {
            "start": 156,
            "end": 196
          }
        }
      },
      "span": {
        "start": 156,
        "end": 197
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 198,
                        "end": 200
                      }
                    },
                    "index": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 201,
                              "end": 209
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 201,
                        "end": 211
                      }
                    }
                  }
                },
                "span": {
                  "start": 198,
                  "end": 212
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 198,
            "end": 214
          }
        }
      },
      "span": {
        "start": 198,
        "end": 215
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
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
                              "start": 222,
                              "end": 230
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 222,
                        "end": 232
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 233,
                        "end": 236
                      }
                    }
                  }
                },
                "span": {
                  "start": 222,
                  "end": 237
                }
              },
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 239,
                        "end": 241
                      }
                    },
                    "index": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 242,
                              "end": 250
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 242,
                        "end": 252
                      }
                    }
                  }
                },
                "span": {
                  "start": 239,
                  "end": 253
                }
              }
            ]
          },
          "span": {
            "start": 216,
            "end": 254
          }
        }
      },
      "span": {
        "start": 216,
        "end": 255
      }
    },
    {
      "kind": {
        "Unset": [
          {
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
                          "start": 262,
                          "end": 270
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 262,
                    "end": 272
                  }
                },
                "index": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 273,
                    "end": 276
                  }
                }
              }
            },
            "span": {
              "start": 262,
              "end": 277
            }
          }
        ]
      },
      "span": {
        "start": 256,
        "end": 279
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "GLOBALS"
                  },
                  "span": {
                    "start": 289,
                    "end": 297
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 289,
              "end": 299
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "v"
            },
            "span": {
              "start": 303,
              "end": 305
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 307,
              "end": 309
            }
          }
        }
      },
      "span": {
        "start": 280,
        "end": 309
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 320,
              "end": 321
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Variable": "GLOBALS"
                        },
                        "span": {
                          "start": 333,
                          "end": 341
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 333,
                    "end": 343
                  }
                }
              },
              "span": {
                "start": 326,
                "end": 344
              }
            }
          ],
          "return_type": null,
          "by_ref": true,
          "attributes": []
        }
      },
      "span": {
        "start": 310,
        "end": 346
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 347,
                  "end": 349
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
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
                                    "start": 353,
                                    "end": 354
                                  }
                                }
                              },
                              "span": {
                                "start": 353,
                                "end": 354
                              }
                            },
                            "args": [
                              {
                                "name": null,
                                "value": {
                                  "kind": {
                                    "ArrayAccess": {
                                      "array": {
                                        "kind": {
                                          "Variable": "GLOBALS"
                                        },
                                        "span": {
                                          "start": 355,
                                          "end": 363
                                        }
                                      },
                                      "index": null
                                    }
                                  },
                                  "span": {
                                    "start": 355,
                                    "end": 365
                                  }
                                },
                                "unpack": false,
                                "by_ref": false,
                                "span": {
                                  "start": 355,
                                  "end": 365
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 353,
                          "end": 366
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 353,
                        "end": 366
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Assign": {
                            "target": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 368,
                                "end": 370
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
                                      "start": 373,
                                      "end": 381
                                    }
                                  },
                                  "index": null
                                }
                              },
                              "span": {
                                "start": 373,
                                "end": 383
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 368,
                          "end": 383
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 368,
                        "end": 383
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "ArrowFunction": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [],
                            "return_type": null,
                            "body": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "Variable": "GLOBALS"
                                    },
                                    "span": {
                                      "start": 393,
                                      "end": 401
                                    }
                                  },
                                  "index": null
                                }
                              },
                              "span": {
                                "start": 393,
                                "end": 403
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 385,
                          "end": 403
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 385,
                        "end": 403
                      }
                    }
                  ]
                },
                "span": {
                  "start": 352,
                  "end": 404
                }
              }
            }
          },
          "span": {
            "start": 347,
            "end": 404
          }
        }
      },
      "span": {
        "start": 347,
        "end": 405
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 406,
                  "end": 408
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "GLOBALS"
                              },
                              "span": {
                                "start": 412,
                                "end": 420
                              }
                            },
                            "index": null
                          }
                        },
                        "span": {
                          "start": 412,
                          "end": 422
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 412,
                        "end": 422
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "k"
                        },
                        "span": {
                          "start": 424,
                          "end": 427
                        }
                      },
                      "value": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "GLOBALS"
                              },
                              "span": {
                                "start": 432,
                                "end": 440
                              }
                            },
                            "index": null
                          }
                        },
                        "span": {
                          "start": 432,
                          "end": 442
                        }
                      },
                      "unpack": false,
                      "by_ref": true,
                      "span": {
                        "start": 424,
                        "end": 442
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "GLOBALS"
                              },
                              "span": {
                                "start": 444,
                                "end": 452
                              }
                            },
                            "index": null
                          }
                        },
                        "span": {
                          "start": 444,
                          "end": 454
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 458,
                          "end": 459
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 444,
                        "end": 459
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "GLOBALS"
                              },
                              "span": {
                                "start": 464,
                                "end": 472
                              }
                            },
                            "index": null
                          }
                        },
                        "span": {
                          "start": 464,
                          "end": 474
                        }
                      },
                      "unpack": true,
                      "span": {
                        "start": 461,
                        "end": 474
                      }
                    }
                  ]
                },
                "span": {
                  "start": 411,
                  "end": 475
                }
              }
            }
          },
          "span": {
            "start": 406,
            "end": 475
          }
        }
      },
      "span": {
        "start": 406,
        "end": 476
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 477,
                  "end": 479
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Array": [
                            {
                              "key": null,
                              "value": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
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
                                                    "start": 484,
                                                    "end": 492
                                                  }
                                                },
                                                "index": null
                                              }
                                            },
                                            "span": {
                                              "start": 484,
                                              "end": 494
                                            }
                                          },
                                          "index": {
                                            "kind": {
                                              "String": "a"
                                            },
                                            "span": {
                                              "start": 495,
                                              "end": 498
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 484,
                                        "end": 499
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 501,
                                        "end": 502
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 484,
                                  "end": 502
                                }
                              },
                              "unpack": false,
                              "span": {
                                "start": 484,
                                "end": 502
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 483,
                          "end": 503
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 483,
                        "end": 503
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 505,
                                "end": 506
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Variable": "GLOBALS"
                                        },
                                        "span": {
                                          "start": 510,
                                          "end": 518
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 509,
                                      "end": 519
                                    }
                                  },
                                  "index": null
                                }
                              },
                              "span": {
                                "start": 509,
                                "end": 521
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 505,
                          "end": 521
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 505,
                        "end": 521
                      }
                    },
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "ClassConstAccess": {
                            "class": {
                              "kind": {
                                "ArrayAccess": {
                                  "array": {
                                    "kind": {
                                      "Variable": "GLOBALS"
                                    },
                                    "span": {
                                      "start": 523,
                                      "end": 531
                                    }
                                  },
                                  "index": null
                                }
                              },
                              "span": {
                                "start": 523,
                                "end": 533
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "A"
                              },
                              "span": {
                                "start": 535,
                                "end": 536
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 523,
                          "end": 536
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 523,
                        "end": 536
                      }
                    }
                  ]
                },
                "span": {
                  "start": 482,
                  "end": 537
                }
              }
            }
          },
          "span": {
            "start": 477,
            "end": 537
          }
        }
      },
      "span": {
        "start": 477,
        "end": 538
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "ArrayAccess": {
                    "array": {
                      "kind": {
                        "Variable": "GLOBALS"
                      },
                      "span": {
                        "start": 545,
                        "end": 553
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 545,
                  "end": 555
                }
              },
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 557,
                  "end": 559
                }
              }
            ]
          },
          "span": {
            "start": 539,
            "end": 560
          }
        }
      },
      "span": {
        "start": 539,
        "end": 561
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 562,
                  "end": 564
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Empty": {
                    "kind": {
                      "ArrayAccess": {
                        "array": {
                          "kind": {
                            "Variable": "GLOBALS"
                          },
                          "span": {
                            "start": 573,
                            "end": 581
                          }
                        },
                        "index": null
                      }
                    },
                    "span": {
                      "start": 573,
                      "end": 583
                    }
                  }
                },
                "span": {
                  "start": 567,
                  "end": 584
                }
              }
            }
          },
          "span": {
            "start": 562,
            "end": 584
          }
        }
      },
      "span": {
        "start": 562,
        "end": 585
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 586,
                  "end": 588
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "GLOBALS"
                            },
                            "span": {
                              "start": 591,
                              "end": 599
                            }
                          },
                          "index": null
                        }
                      },
                      "span": {
                        "start": 591,
                        "end": 601
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "A"
                      },
                      "span": {
                        "start": 603,
                        "end": 604
                      }
                    }
                  }
                },
                "span": {
                  "start": 591,
                  "end": 604
                }
              }
            }
          },
          "span": {
            "start": 586,
            "end": 604
          }
        }
      },
      "span": {
        "start": 586,
        "end": 605
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "GLOBALS"
                  },
                  "span": {
                    "start": 612,
                    "end": 620
                  }
                },
                "index": null
              }
            },
            "span": {
              "start": 612,
              "end": 622
            }
          }
        ]
      },
      "span": {
        "start": 606,
        "end": 624
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 624
  }
}
