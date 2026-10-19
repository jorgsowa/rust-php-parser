===source===
<?php
$this .= 1;
$this++;
--$this;
$a = &$this;
$a = [&$this];
$$this = 1;
$this->a = $this[0] = $this::$b = 1;
[$this->a, $this[0]] = $a;
unset($this->a, $this[0]);
$This = $THIS = 1;
$GLOBALS['a'] = 1;
$GLOBALS['a']['b'] .= 1;
$GLOBALS[0][] = 1;
$GLOBALS['x']->a = 1;
$GLOBALS[0] = &$a;
$a = &$GLOBALS['a'];
$GLOBALS['a'] ??= 1;
unset($GLOBALS['a']);
[$GLOBALS['a']] = $a;
foreach ($a as $GLOBALS['a']) {}
f($GLOBALS);
$GLOBALs = 1;
try {} catch (E $GLOBALS) {}
function f($argv, $HTTP_RAW_POST_DATA) { global $GLOBALS, $_GET; static $GLOBALS; }
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
                  "Variable": "this"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 15,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "Variable": "this"
                },
                "span": {
                  "start": 18,
                  "end": 23
                }
              },
              "op": "PostIncrement"
            }
          },
          "span": {
            "start": 18,
            "end": 25
          }
        }
      },
      "span": {
        "start": 18,
        "end": 26
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
                  "Variable": "this"
                },
                "span": {
                  "start": 29,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 34
          }
        }
      },
      "span": {
        "start": 27,
        "end": 35
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
                  "start": 36,
                  "end": 38
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "this"
                },
                "span": {
                  "start": 42,
                  "end": 47
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 36,
            "end": 47
          }
        }
      },
      "span": {
        "start": 36,
        "end": 48
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
                  "start": 49,
                  "end": 51
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
                            "Variable": "this"
                          },
                          "span": {
                            "start": 56,
                            "end": 61
                          }
                        }
                      },
                      "span": {
                        "start": 55,
                        "end": 61
                      }
                    }
                  ]
                },
                "span": {
                  "start": 54,
                  "end": 62
                }
              }
            }
          },
          "span": {
            "start": 49,
            "end": 62
          }
        }
      },
      "span": {
        "start": 49,
        "end": 63
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "VariableVariable": {
                    "kind": {
                      "Variable": "this"
                    },
                    "span": {
                      "start": 65,
                      "end": 70
                    }
                  }
                },
                "span": {
                  "start": 64,
                  "end": 70
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 73,
                  "end": 74
                }
              }
            }
          },
          "span": {
            "start": 64,
            "end": 74
          }
        }
      },
      "span": {
        "start": 64,
        "end": 75
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "PropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "this"
                      },
                      "span": {
                        "start": 76,
                        "end": 81
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 83,
                        "end": 84
                      }
                    }
                  }
                },
                "span": {
                  "start": 76,
                  "end": 84
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "ArrayAccess": {
                          "array": {
                            "kind": {
                              "Variable": "this"
                            },
                            "span": {
                              "start": 87,
                              "end": 92
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 93,
                              "end": 94
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 87,
                        "end": 95
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "StaticPropertyAccess": {
                                "class": {
                                  "kind": {
                                    "Variable": "this"
                                  },
                                  "span": {
                                    "start": 98,
                                    "end": 103
                                  }
                                },
                                "member": {
                                  "kind": {
                                    "Identifier": "b"
                                  },
                                  "span": {
                                    "start": 105,
                                    "end": 107
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 98,
                              "end": 107
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 110,
                              "end": 111
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 98,
                        "end": 111
                      }
                    }
                  }
                },
                "span": {
                  "start": 87,
                  "end": 111
                }
              }
            }
          },
          "span": {
            "start": 76,
            "end": 111
          }
        }
      },
      "span": {
        "start": 76,
        "end": 112
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
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 114,
                                  "end": 119
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "a"
                                },
                                "span": {
                                  "start": 121,
                                  "end": 122
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 114,
                            "end": 122
                          }
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 122
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 124,
                                  "end": 129
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 130,
                                  "end": 131
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 124,
                            "end": 132
                          }
                        }
                      },
                      "span": {
                        "start": 124,
                        "end": 132
                      }
                    }
                  ]
                },
                "span": {
                  "start": 113,
                  "end": 133
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 136,
                  "end": 138
                }
              }
            }
          },
          "span": {
            "start": 113,
            "end": 138
          }
        }
      },
      "span": {
        "start": 113,
        "end": 139
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "PropertyAccess": {
                "object": {
                  "kind": {
                    "Variable": "this"
                  },
                  "span": {
                    "start": 146,
                    "end": 151
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "a"
                  },
                  "span": {
                    "start": 153,
                    "end": 154
                  }
                }
              }
            },
            "span": {
              "start": 146,
              "end": 154
            }
          },
          {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "this"
                  },
                  "span": {
                    "start": 156,
                    "end": 161
                  }
                },
                "index": {
                  "kind": {
                    "Int": 0
                  },
                  "span": {
                    "start": 162,
                    "end": 163
                  }
                }
              }
            },
            "span": {
              "start": 156,
              "end": 164
            }
          }
        ]
      },
      "span": {
        "start": 140,
        "end": 166
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "This"
                },
                "span": {
                  "start": 167,
                  "end": 172
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "THIS"
                      },
                      "span": {
                        "start": 175,
                        "end": 180
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 183,
                        "end": 184
                      }
                    }
                  }
                },
                "span": {
                  "start": 175,
                  "end": 184
                }
              }
            }
          },
          "span": {
            "start": 167,
            "end": 184
          }
        }
      },
      "span": {
        "start": 167,
        "end": 185
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
                        "start": 186,
                        "end": 194
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 195,
                        "end": 198
                      }
                    }
                  }
                },
                "span": {
                  "start": 186,
                  "end": 199
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 202,
                  "end": 203
                }
              }
            }
          },
          "span": {
            "start": 186,
            "end": 203
          }
        }
      },
      "span": {
        "start": 186,
        "end": 204
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
                              "start": 205,
                              "end": 213
                            }
                          },
                          "index": {
                            "kind": {
                              "String": "a"
                            },
                            "span": {
                              "start": 214,
                              "end": 217
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 205,
                        "end": 218
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "b"
                      },
                      "span": {
                        "start": 219,
                        "end": 222
                      }
                    }
                  }
                },
                "span": {
                  "start": 205,
                  "end": 223
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 227,
                  "end": 228
                }
              }
            }
          },
          "span": {
            "start": 205,
            "end": 228
          }
        }
      },
      "span": {
        "start": 205,
        "end": 229
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
                              "start": 230,
                              "end": 238
                            }
                          },
                          "index": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 239,
                              "end": 240
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 230,
                        "end": 241
                      }
                    },
                    "index": null
                  }
                },
                "span": {
                  "start": 230,
                  "end": 243
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 246,
                  "end": 247
                }
              }
            }
          },
          "span": {
            "start": 230,
            "end": 247
          }
        }
      },
      "span": {
        "start": 230,
        "end": 248
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
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
                              "start": 249,
                              "end": 257
                            }
                          },
                          "index": {
                            "kind": {
                              "String": "x"
                            },
                            "span": {
                              "start": 258,
                              "end": 261
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 249,
                        "end": 262
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 264,
                        "end": 265
                      }
                    }
                  }
                },
                "span": {
                  "start": 249,
                  "end": 265
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 268,
                  "end": 269
                }
              }
            }
          },
          "span": {
            "start": 249,
            "end": 269
          }
        }
      },
      "span": {
        "start": 249,
        "end": 270
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
                        "start": 271,
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
                  "start": 271,
                  "end": 282
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 286,
                  "end": 288
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 271,
            "end": 288
          }
        }
      },
      "span": {
        "start": 271,
        "end": 289
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
                  "start": 290,
                  "end": 292
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
                        "start": 296,
                        "end": 304
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 305,
                        "end": 308
                      }
                    }
                  }
                },
                "span": {
                  "start": 296,
                  "end": 309
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 290,
            "end": 309
          }
        }
      },
      "span": {
        "start": 290,
        "end": 310
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
                        "start": 311,
                        "end": 319
                      }
                    },
                    "index": {
                      "kind": {
                        "String": "a"
                      },
                      "span": {
                        "start": 320,
                        "end": 323
                      }
                    }
                  }
                },
                "span": {
                  "start": 311,
                  "end": 324
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 329,
                  "end": 330
                }
              }
            }
          },
          "span": {
            "start": 311,
            "end": 330
          }
        }
      },
      "span": {
        "start": 311,
        "end": 331
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
                    "start": 338,
                    "end": 346
                  }
                },
                "index": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 347,
                    "end": 350
                  }
                }
              }
            },
            "span": {
              "start": 338,
              "end": 351
            }
          }
        ]
      },
      "span": {
        "start": 332,
        "end": 353
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
                                  "start": 355,
                                  "end": 363
                                }
                              },
                              "index": {
                                "kind": {
                                  "String": "a"
                                },
                                "span": {
                                  "start": 364,
                                  "end": 367
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 355,
                            "end": 368
                          }
                        }
                      },
                      "span": {
                        "start": 355,
                        "end": 368
                      }
                    }
                  ]
                },
                "span": {
                  "start": 354,
                  "end": 369
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 372,
                  "end": 374
                }
              }
            }
          },
          "span": {
            "start": 354,
            "end": 374
          }
        }
      },
      "span": {
        "start": 354,
        "end": 375
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
              "start": 385,
              "end": 387
            }
          },
          "key": null,
          "value": {
            "kind": {
              "ArrayAccess": {
                "array": {
                  "kind": {
                    "Variable": "GLOBALS"
                  },
                  "span": {
                    "start": 391,
                    "end": 399
                  }
                },
                "index": {
                  "kind": {
                    "String": "a"
                  },
                  "span": {
                    "start": 400,
                    "end": 403
                  }
                }
              }
            },
            "span": {
              "start": 391,
              "end": 404
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 406,
              "end": 408
            }
          }
        }
      },
      "span": {
        "start": 376,
        "end": 408
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
                      "f"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 409,
                      "end": 410
                    }
                  }
                },
                "span": {
                  "start": 409,
                  "end": 410
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "GLOBALS"
                      },
                      "span": {
                        "start": 411,
                        "end": 419
                      }
                    }
                  },
                  "span": {
                    "start": 411,
                    "end": 419
                  }
                }
              ]
            }
          },
          "span": {
            "start": 409,
            "end": 420
          }
        }
      },
      "span": {
        "start": 409,
        "end": 421
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "GLOBALs"
                },
                "span": {
                  "start": 422,
                  "end": 430
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 433,
                  "end": 434
                }
              }
            }
          },
          "span": {
            "start": 422,
            "end": 434
          }
        }
      },
      "span": {
        "start": 422,
        "end": 435
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "E"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 450,
                    "end": 451
                  }
                }
              ],
              "var": {
                "name": "GLOBALS",
                "span": {
                  "start": 452,
                  "end": 460
                }
              },
              "body": [],
              "span": {
                "start": 449,
                "end": 464
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 436,
        "end": 464
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 474,
              "end": 475
            }
          },
          "params": [
            {
              "name": {
                "name": "argv",
                "span": {
                  "start": 476,
                  "end": 481
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 476,
                "end": 481
              }
            },
            {
              "name": {
                "name": "HTTP_RAW_POST_DATA",
                "span": {
                  "start": 483,
                  "end": 502
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 483,
                "end": 502
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "GLOBALS"
                    },
                    "span": {
                      "start": 513,
                      "end": 521
                    }
                  },
                  {
                    "kind": {
                      "Variable": "_GET"
                    },
                    "span": {
                      "start": 523,
                      "end": 528
                    }
                  }
                ]
              },
              "span": {
                "start": 506,
                "end": 529
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "GLOBALS",
                      "span": {
                        "start": 537,
                        "end": 545
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 537,
                      "end": 545
                    }
                  }
                ]
              },
              "span": {
                "start": 530,
                "end": 546
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 465,
        "end": 548
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 548
  }
}
