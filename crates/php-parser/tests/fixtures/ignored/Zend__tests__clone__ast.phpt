===source===
<?php

$x = new stdClass();


try {
	assert(false &&  $y = clone $x);
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone($x));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone($x, ));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone($x, [ "foo" => $foo, "bar" => $bar ]));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone($x, $array));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone($x, $array, $extraParameter, $trailingComma, ));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone(object: $x, withProperties: [ "foo" => $foo, "bar" => $bar ]));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone($x, withProperties: [ "foo" => $foo, "bar" => $bar ]));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone(object: $x));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone(object: $x, [ "foo" => $foo, "bar" => $bar ]));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone(...["object" => $x, "withProperties" => [ "foo" => $foo, "bar" => $bar ]]));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

try {
	assert(false && $y = clone(...));
} catch (Error $e) {
	echo $e->getMessage(), PHP_EOL;
}

?>
===ast >=8.5===
{
  "stmts": [
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
                  "start": 7,
                  "end": 9
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "stdClass"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 16,
                            "end": 24
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 24
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 12,
                  "end": 26
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 26
          }
        }
      },
      "span": {
        "start": 7,
        "end": 27
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 37,
                              "end": 43
                            }
                          }
                        },
                        "span": {
                          "start": 37,
                          "end": 43
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
                                      "start": 44,
                                      "end": 49
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
                                            "start": 54,
                                            "end": 56
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
                                                "start": 65,
                                                "end": 67
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 59,
                                            "end": 67
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 54,
                                      "end": 67
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 44,
                                "end": 67
                              }
                            }
                          },
                          "span": {
                            "start": 44,
                            "end": 67
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 37,
                    "end": 68
                  }
                }
              },
              "span": {
                "start": 37,
                "end": 69
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 79,
                    "end": 84
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 85,
                  "end": 87
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 97,
                                "end": 99
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 101,
                                "end": 111
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 97,
                          "end": 113
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 115,
                              "end": 122
                            }
                          }
                        },
                        "span": {
                          "start": 115,
                          "end": 122
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 92,
                    "end": 123
                  }
                }
              ],
              "span": {
                "start": 78,
                "end": 125
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 30,
        "end": 125
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 134,
                              "end": 140
                            }
                          }
                        },
                        "span": {
                          "start": 134,
                          "end": 140
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
                                      "start": 141,
                                      "end": 146
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
                                            "start": 150,
                                            "end": 152
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
                                                "start": 161,
                                                "end": 163
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 155,
                                            "end": 164
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 150,
                                      "end": 164
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 141,
                                "end": 164
                              }
                            }
                          },
                          "span": {
                            "start": 141,
                            "end": 164
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 134,
                    "end": 165
                  }
                }
              },
              "span": {
                "start": 134,
                "end": 166
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 176,
                    "end": 181
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 182,
                  "end": 184
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 194,
                                "end": 196
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 198,
                                "end": 208
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 194,
                          "end": 210
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 212,
                              "end": 219
                            }
                          }
                        },
                        "span": {
                          "start": 212,
                          "end": 219
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 189,
                    "end": 220
                  }
                }
              ],
              "span": {
                "start": 175,
                "end": 222
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 127,
        "end": 222
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 231,
                              "end": 237
                            }
                          }
                        },
                        "span": {
                          "start": 231,
                          "end": 237
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
                                      "start": 238,
                                      "end": 243
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
                                            "start": 247,
                                            "end": 249
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
                                                "start": 258,
                                                "end": 260
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 252,
                                            "end": 263
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 247,
                                      "end": 263
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 238,
                                "end": 263
                              }
                            }
                          },
                          "span": {
                            "start": 238,
                            "end": 263
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 231,
                    "end": 264
                  }
                }
              },
              "span": {
                "start": 231,
                "end": 265
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 275,
                    "end": 280
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 281,
                  "end": 283
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 293,
                                "end": 295
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 297,
                                "end": 307
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 293,
                          "end": 309
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 311,
                              "end": 318
                            }
                          }
                        },
                        "span": {
                          "start": 311,
                          "end": 318
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 288,
                    "end": 319
                  }
                }
              ],
              "span": {
                "start": 274,
                "end": 321
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 224,
        "end": 321
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 330,
                              "end": 336
                            }
                          }
                        },
                        "span": {
                          "start": 330,
                          "end": 336
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
                                      "start": 337,
                                      "end": 342
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
                                            "start": 346,
                                            "end": 348
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
                                                  "start": 357,
                                                  "end": 359
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
                                                          "start": 363,
                                                          "end": 368
                                                        }
                                                      },
                                                      "kind": {
                                                        "Value": {
                                                          "kind": {
                                                            "Variable": "foo"
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
                                                    },
                                                    {
                                                      "key": {
                                                        "kind": {
                                                          "String": "bar"
                                                        },
                                                        "span": {
                                                          "start": 378,
                                                          "end": 383
                                                        }
                                                      },
                                                      "kind": {
                                                        "Value": {
                                                          "kind": {
                                                            "Variable": "bar"
                                                          },
                                                          "span": {
                                                            "start": 387,
                                                            "end": 391
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 378,
                                                        "end": 391
                                                      }
                                                    }
                                                  ]
                                                },
                                                "span": {
                                                  "start": 361,
                                                  "end": 393
                                                }
                                              }
                                            ]
                                          },
                                          "span": {
                                            "start": 351,
                                            "end": 394
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 346,
                                      "end": 394
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 337,
                                "end": 394
                              }
                            }
                          },
                          "span": {
                            "start": 337,
                            "end": 394
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 330,
                    "end": 395
                  }
                }
              },
              "span": {
                "start": 330,
                "end": 396
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 406,
                    "end": 411
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 412,
                  "end": 414
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 424,
                                "end": 426
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 428,
                                "end": 438
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 424,
                          "end": 440
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 442,
                              "end": 449
                            }
                          }
                        },
                        "span": {
                          "start": 442,
                          "end": 449
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 419,
                    "end": 450
                  }
                }
              ],
              "span": {
                "start": 405,
                "end": 452
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 323,
        "end": 452
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 461,
                              "end": 467
                            }
                          }
                        },
                        "span": {
                          "start": 461,
                          "end": 467
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
                                      "start": 468,
                                      "end": 473
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
                                            "start": 477,
                                            "end": 479
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
                                                  "start": 488,
                                                  "end": 490
                                                }
                                              },
                                              {
                                                "kind": {
                                                  "Variable": "array"
                                                },
                                                "span": {
                                                  "start": 492,
                                                  "end": 498
                                                }
                                              }
                                            ]
                                          },
                                          "span": {
                                            "start": 482,
                                            "end": 499
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 477,
                                      "end": 499
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 468,
                                "end": 499
                              }
                            }
                          },
                          "span": {
                            "start": 468,
                            "end": 499
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 461,
                    "end": 500
                  }
                }
              },
              "span": {
                "start": 461,
                "end": 501
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 511,
                    "end": 516
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 517,
                  "end": 519
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 529,
                                "end": 531
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 533,
                                "end": 543
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 529,
                          "end": 545
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 547,
                              "end": 554
                            }
                          }
                        },
                        "span": {
                          "start": 547,
                          "end": 554
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 524,
                    "end": 555
                  }
                }
              ],
              "span": {
                "start": 510,
                "end": 557
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 454,
        "end": 557
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 566,
                              "end": 572
                            }
                          }
                        },
                        "span": {
                          "start": 566,
                          "end": 572
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
                                      "start": 573,
                                      "end": 578
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
                                            "start": 582,
                                            "end": 584
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
                                                      "start": 587,
                                                      "end": 592
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 587,
                                                  "end": 592
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
                                                        "start": 593,
                                                        "end": 595
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 593,
                                                    "end": 595
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
                                                        "start": 597,
                                                        "end": 603
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 597,
                                                    "end": 603
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
                                                        "start": 605,
                                                        "end": 620
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 605,
                                                    "end": 620
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
                                                        "start": 622,
                                                        "end": 636
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 622,
                                                    "end": 636
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 587,
                                            "end": 639
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 582,
                                      "end": 639
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 573,
                                "end": 639
                              }
                            }
                          },
                          "span": {
                            "start": 573,
                            "end": 639
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 566,
                    "end": 640
                  }
                }
              },
              "span": {
                "start": 566,
                "end": 641
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 651,
                    "end": 656
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 657,
                  "end": 659
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 669,
                                "end": 671
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 673,
                                "end": 683
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 669,
                          "end": 685
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 687,
                              "end": 694
                            }
                          }
                        },
                        "span": {
                          "start": 687,
                          "end": 694
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 664,
                    "end": 695
                  }
                }
              ],
              "span": {
                "start": 650,
                "end": 697
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 559,
        "end": 697
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 706,
                              "end": 712
                            }
                          }
                        },
                        "span": {
                          "start": 706,
                          "end": 712
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
                                      "start": 713,
                                      "end": 718
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
                                            "start": 722,
                                            "end": 724
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
                                                      "start": 727,
                                                      "end": 732
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 727,
                                                  "end": 732
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
                                                      "start": 733,
                                                      "end": 739
                                                    }
                                                  },
                                                  "kind": {
                                                    "Value": {
                                                      "kind": {
                                                        "Variable": "x"
                                                      },
                                                      "span": {
                                                        "start": 741,
                                                        "end": 743
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 733,
                                                    "end": 743
                                                  }
                                                },
                                                {
                                                  "name": {
                                                    "parts": [
                                                      "withProperties"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 745,
                                                      "end": 759
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
                                                                "start": 763,
                                                                "end": 768
                                                              }
                                                            },
                                                            "kind": {
                                                              "Value": {
                                                                "kind": {
                                                                  "Variable": "foo"
                                                                },
                                                                "span": {
                                                                  "start": 772,
                                                                  "end": 776
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 763,
                                                              "end": 776
                                                            }
                                                          },
                                                          {
                                                            "key": {
                                                              "kind": {
                                                                "String": "bar"
                                                              },
                                                              "span": {
                                                                "start": 778,
                                                                "end": 783
                                                              }
                                                            },
                                                            "kind": {
                                                              "Value": {
                                                                "kind": {
                                                                  "Variable": "bar"
                                                                },
                                                                "span": {
                                                                  "start": 787,
                                                                  "end": 791
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 778,
                                                              "end": 791
                                                            }
                                                          }
                                                        ]
                                                      },
                                                      "span": {
                                                        "start": 761,
                                                        "end": 793
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 745,
                                                    "end": 793
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 727,
                                            "end": 794
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 722,
                                      "end": 794
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 713,
                                "end": 794
                              }
                            }
                          },
                          "span": {
                            "start": 713,
                            "end": 794
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 706,
                    "end": 795
                  }
                }
              },
              "span": {
                "start": 706,
                "end": 796
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 806,
                    "end": 811
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 812,
                  "end": 814
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 824,
                                "end": 826
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 828,
                                "end": 838
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 824,
                          "end": 840
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 842,
                              "end": 849
                            }
                          }
                        },
                        "span": {
                          "start": 842,
                          "end": 849
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 819,
                    "end": 850
                  }
                }
              ],
              "span": {
                "start": 805,
                "end": 852
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 699,
        "end": 852
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 861,
                              "end": 867
                            }
                          }
                        },
                        "span": {
                          "start": 861,
                          "end": 867
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
                                      "start": 868,
                                      "end": 873
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
                                            "start": 877,
                                            "end": 879
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
                                                      "start": 882,
                                                      "end": 887
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 882,
                                                  "end": 887
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
                                                        "start": 888,
                                                        "end": 890
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 888,
                                                    "end": 890
                                                  }
                                                },
                                                {
                                                  "name": {
                                                    "parts": [
                                                      "withProperties"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 892,
                                                      "end": 906
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
                                                                "start": 910,
                                                                "end": 915
                                                              }
                                                            },
                                                            "kind": {
                                                              "Value": {
                                                                "kind": {
                                                                  "Variable": "foo"
                                                                },
                                                                "span": {
                                                                  "start": 919,
                                                                  "end": 923
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 910,
                                                              "end": 923
                                                            }
                                                          },
                                                          {
                                                            "key": {
                                                              "kind": {
                                                                "String": "bar"
                                                              },
                                                              "span": {
                                                                "start": 925,
                                                                "end": 930
                                                              }
                                                            },
                                                            "kind": {
                                                              "Value": {
                                                                "kind": {
                                                                  "Variable": "bar"
                                                                },
                                                                "span": {
                                                                  "start": 934,
                                                                  "end": 938
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 925,
                                                              "end": 938
                                                            }
                                                          }
                                                        ]
                                                      },
                                                      "span": {
                                                        "start": 908,
                                                        "end": 940
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 892,
                                                    "end": 940
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 882,
                                            "end": 941
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 877,
                                      "end": 941
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 868,
                                "end": 941
                              }
                            }
                          },
                          "span": {
                            "start": 868,
                            "end": 941
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 861,
                    "end": 942
                  }
                }
              },
              "span": {
                "start": 861,
                "end": 943
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 953,
                    "end": 958
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 959,
                  "end": 961
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 971,
                                "end": 973
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 975,
                                "end": 985
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 971,
                          "end": 987
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 989,
                              "end": 996
                            }
                          }
                        },
                        "span": {
                          "start": 989,
                          "end": 996
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 966,
                    "end": 997
                  }
                }
              ],
              "span": {
                "start": 952,
                "end": 999
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 854,
        "end": 999
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 1008,
                              "end": 1014
                            }
                          }
                        },
                        "span": {
                          "start": 1008,
                          "end": 1014
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
                                      "start": 1015,
                                      "end": 1020
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
                                            "start": 1024,
                                            "end": 1026
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
                                                      "start": 1029,
                                                      "end": 1034
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1029,
                                                  "end": 1034
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
                                                      "start": 1035,
                                                      "end": 1041
                                                    }
                                                  },
                                                  "kind": {
                                                    "Value": {
                                                      "kind": {
                                                        "Variable": "x"
                                                      },
                                                      "span": {
                                                        "start": 1043,
                                                        "end": 1045
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1035,
                                                    "end": 1045
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 1029,
                                            "end": 1046
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1024,
                                      "end": 1046
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 1015,
                                "end": 1046
                              }
                            }
                          },
                          "span": {
                            "start": 1015,
                            "end": 1046
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1008,
                    "end": 1047
                  }
                }
              },
              "span": {
                "start": 1008,
                "end": 1048
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 1058,
                    "end": 1063
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 1064,
                  "end": 1066
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 1076,
                                "end": 1078
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 1080,
                                "end": 1090
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 1076,
                          "end": 1092
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1094,
                              "end": 1101
                            }
                          }
                        },
                        "span": {
                          "start": 1094,
                          "end": 1101
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1071,
                    "end": 1102
                  }
                }
              ],
              "span": {
                "start": 1057,
                "end": 1104
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 1001,
        "end": 1104
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 1113,
                              "end": 1119
                            }
                          }
                        },
                        "span": {
                          "start": 1113,
                          "end": 1119
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
                                      "start": 1120,
                                      "end": 1125
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
                                            "start": 1129,
                                            "end": 1131
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
                                                      "start": 1134,
                                                      "end": 1139
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1134,
                                                  "end": 1139
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
                                                      "start": 1140,
                                                      "end": 1146
                                                    }
                                                  },
                                                  "kind": {
                                                    "Value": {
                                                      "kind": {
                                                        "Variable": "x"
                                                      },
                                                      "span": {
                                                        "start": 1148,
                                                        "end": 1150
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1140,
                                                    "end": 1150
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
                                                                "start": 1154,
                                                                "end": 1159
                                                              }
                                                            },
                                                            "kind": {
                                                              "Value": {
                                                                "kind": {
                                                                  "Variable": "foo"
                                                                },
                                                                "span": {
                                                                  "start": 1163,
                                                                  "end": 1167
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 1154,
                                                              "end": 1167
                                                            }
                                                          },
                                                          {
                                                            "key": {
                                                              "kind": {
                                                                "String": "bar"
                                                              },
                                                              "span": {
                                                                "start": 1169,
                                                                "end": 1174
                                                              }
                                                            },
                                                            "kind": {
                                                              "Value": {
                                                                "kind": {
                                                                  "Variable": "bar"
                                                                },
                                                                "span": {
                                                                  "start": 1178,
                                                                  "end": 1182
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 1169,
                                                              "end": 1182
                                                            }
                                                          }
                                                        ]
                                                      },
                                                      "span": {
                                                        "start": 1152,
                                                        "end": 1184
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1152,
                                                    "end": 1184
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 1134,
                                            "end": 1185
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1129,
                                      "end": 1185
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 1120,
                                "end": 1185
                              }
                            }
                          },
                          "span": {
                            "start": 1120,
                            "end": 1185
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1113,
                    "end": 1186
                  }
                }
              },
              "span": {
                "start": 1113,
                "end": 1187
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 1197,
                    "end": 1202
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 1203,
                  "end": 1205
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 1215,
                                "end": 1217
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 1219,
                                "end": 1229
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 1215,
                          "end": 1231
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1233,
                              "end": 1240
                            }
                          }
                        },
                        "span": {
                          "start": 1233,
                          "end": 1240
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1210,
                    "end": 1241
                  }
                }
              ],
              "span": {
                "start": 1196,
                "end": 1243
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 1106,
        "end": 1243
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 1252,
                              "end": 1258
                            }
                          }
                        },
                        "span": {
                          "start": 1252,
                          "end": 1258
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
                                      "start": 1259,
                                      "end": 1264
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
                                            "start": 1268,
                                            "end": 1270
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
                                                      "start": 1273,
                                                      "end": 1278
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1273,
                                                  "end": 1278
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
                                                                "start": 1283,
                                                                "end": 1291
                                                              }
                                                            },
                                                            "kind": {
                                                              "Value": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 1295,
                                                                  "end": 1297
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 1283,
                                                              "end": 1297
                                                            }
                                                          },
                                                          {
                                                            "key": {
                                                              "kind": {
                                                                "String": "withProperties"
                                                              },
                                                              "span": {
                                                                "start": 1299,
                                                                "end": 1315
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
                                                                          "start": 1321,
                                                                          "end": 1326
                                                                        }
                                                                      },
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "Variable": "foo"
                                                                          },
                                                                          "span": {
                                                                            "start": 1330,
                                                                            "end": 1334
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1321,
                                                                        "end": 1334
                                                                      }
                                                                    },
                                                                    {
                                                                      "key": {
                                                                        "kind": {
                                                                          "String": "bar"
                                                                        },
                                                                        "span": {
                                                                          "start": 1336,
                                                                          "end": 1341
                                                                        }
                                                                      },
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "Variable": "bar"
                                                                          },
                                                                          "span": {
                                                                            "start": 1345,
                                                                            "end": 1349
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1336,
                                                                        "end": 1349
                                                                      }
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 1319,
                                                                  "end": 1351
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 1299,
                                                              "end": 1351
                                                            }
                                                          }
                                                        ]
                                                      },
                                                      "span": {
                                                        "start": 1282,
                                                        "end": 1352
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1279,
                                                    "end": 1352
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 1273,
                                            "end": 1353
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1268,
                                      "end": 1353
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 1259,
                                "end": 1353
                              }
                            }
                          },
                          "span": {
                            "start": 1259,
                            "end": 1353
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1252,
                    "end": 1354
                  }
                }
              },
              "span": {
                "start": 1252,
                "end": 1355
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 1365,
                    "end": 1370
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 1371,
                  "end": 1373
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 1383,
                                "end": 1385
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 1387,
                                "end": 1397
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 1383,
                          "end": 1399
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1401,
                              "end": 1408
                            }
                          }
                        },
                        "span": {
                          "start": 1401,
                          "end": 1408
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1378,
                    "end": 1409
                  }
                }
              ],
              "span": {
                "start": 1364,
                "end": 1411
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 1245,
        "end": 1411
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                              "start": 1420,
                              "end": 1426
                            }
                          }
                        },
                        "span": {
                          "start": 1420,
                          "end": 1426
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
                                      "start": 1427,
                                      "end": 1432
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
                                            "start": 1436,
                                            "end": 1438
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
                                                        "start": 1441,
                                                        "end": 1446
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1441,
                                                    "end": 1446
                                                  }
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 1441,
                                            "end": 1451
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1436,
                                      "end": 1451
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 1427,
                                "end": 1451
                              }
                            }
                          },
                          "span": {
                            "start": 1427,
                            "end": 1451
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1420,
                    "end": 1452
                  }
                }
              },
              "span": {
                "start": 1420,
                "end": 1453
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 1463,
                    "end": 1468
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 1469,
                  "end": 1471
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 1481,
                                "end": 1483
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 1485,
                                "end": 1495
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 1481,
                          "end": 1497
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1499,
                              "end": 1506
                            }
                          }
                        },
                        "span": {
                          "start": 1499,
                          "end": 1506
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1476,
                    "end": 1507
                  }
                }
              ],
              "span": {
                "start": 1462,
                "end": 1509
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 1413,
        "end": 1509
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1509
  }
}
