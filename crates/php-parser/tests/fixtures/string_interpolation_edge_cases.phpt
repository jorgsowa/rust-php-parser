===source===
<?php
// Complex variable variables
$var = "test";
$x = "${$var}";
$y = "{${$var}}";

// Consecutive interpolations
$z = "{$a}{$b}{$c}";

// Method call inside interpolation
$obj = new stdClass();
$obj->method = "result";
$w = "{$obj->method}";

// Array access in interpolation
$arr = ['key' => 'value'];
$k = "{$arr['key']}";

// Variable variables
$varname = 'foo';
$foo = 'bar';
$vv = "{$$varname}";

// Nested braces
$nested = "{{ {$x} }}";
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
                  "Variable": "var"
                },
                "span": {
                  "start": 36,
                  "end": 40
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "test"
                },
                "span": {
                  "start": 43,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 36,
            "end": 49
          }
        }
      },
      "span": {
        "start": 36,
        "end": 50
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
                  "start": 51,
                  "end": 53
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "VariableVariable": {
                            "kind": {
                              "Variable": "var"
                            },
                            "span": {
                              "start": 59,
                              "end": 63
                            }
                          }
                        },
                        "span": {
                          "start": 57,
                          "end": 64
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 56,
                  "end": 65
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 65
          }
        }
      },
      "span": {
        "start": 51,
        "end": 66
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 67,
                  "end": 69
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "VariableVariable": {
                            "kind": {
                              "Variable": "var"
                            },
                            "span": {
                              "start": 76,
                              "end": 80
                            }
                          }
                        },
                        "span": {
                          "start": 74,
                          "end": 81
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 72,
                  "end": 83
                }
              }
            }
          },
          "span": {
            "start": 67,
            "end": 83
          }
        }
      },
      "span": {
        "start": 67,
        "end": 84
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "z"
                },
                "span": {
                  "start": 116,
                  "end": 118
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 123,
                          "end": 125
                        }
                      }
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 127,
                          "end": 129
                        }
                      }
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 131,
                          "end": 133
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 121,
                  "end": 135
                }
              }
            }
          },
          "span": {
            "start": 116,
            "end": 135
          }
        }
      },
      "span": {
        "start": 116,
        "end": 136
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 174,
                  "end": 178
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "stdClass"
                      },
                      "span": {
                        "start": 185,
                        "end": 193
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 181,
                  "end": 195
                }
              }
            }
          },
          "span": {
            "start": 174,
            "end": 195
          }
        }
      },
      "span": {
        "start": 174,
        "end": 196
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
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 197,
                        "end": 201
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "method"
                      },
                      "span": {
                        "start": 203,
                        "end": 209
                      }
                    }
                  }
                },
                "span": {
                  "start": 197,
                  "end": 209
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "result"
                },
                "span": {
                  "start": 212,
                  "end": 220
                }
              }
            }
          },
          "span": {
            "start": 197,
            "end": 220
          }
        }
      },
      "span": {
        "start": 197,
        "end": 221
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "w"
                },
                "span": {
                  "start": 222,
                  "end": 224
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 229,
                                "end": 233
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "method"
                              },
                              "span": {
                                "start": 235,
                                "end": 241
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 229,
                          "end": 241
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 227,
                  "end": 243
                }
              }
            }
          },
          "span": {
            "start": 222,
            "end": 243
          }
        }
      },
      "span": {
        "start": 222,
        "end": 244
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "arr"
                },
                "span": {
                  "start": 279,
                  "end": 283
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "key"
                        },
                        "span": {
                          "start": 287,
                          "end": 292
                        }
                      },
                      "value": {
                        "kind": {
                          "String": "value"
                        },
                        "span": {
                          "start": 296,
                          "end": 303
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 287,
                        "end": 303
                      }
                    }
                  ]
                },
                "span": {
                  "start": 286,
                  "end": 304
                }
              }
            }
          },
          "span": {
            "start": 279,
            "end": 304
          }
        }
      },
      "span": {
        "start": 279,
        "end": 305
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "k"
                },
                "span": {
                  "start": 306,
                  "end": 308
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 313,
                                "end": 317
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "key"
                              },
                              "span": {
                                "start": 318,
                                "end": 323
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 313,
                          "end": 324
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 311,
                  "end": 326
                }
              }
            }
          },
          "span": {
            "start": 306,
            "end": 326
          }
        }
      },
      "span": {
        "start": 306,
        "end": 327
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "varname"
                },
                "span": {
                  "start": 351,
                  "end": 359
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "foo"
                },
                "span": {
                  "start": 362,
                  "end": 367
                }
              }
            }
          },
          "span": {
            "start": 351,
            "end": 367
          }
        }
      },
      "span": {
        "start": 351,
        "end": 368
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "foo"
                },
                "span": {
                  "start": 369,
                  "end": 373
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "bar"
                },
                "span": {
                  "start": 376,
                  "end": 381
                }
              }
            }
          },
          "span": {
            "start": 369,
            "end": 381
          }
        }
      },
      "span": {
        "start": 369,
        "end": 382
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "vv"
                },
                "span": {
                  "start": 383,
                  "end": 386
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "VariableVariable": {
                            "kind": {
                              "Variable": "varname"
                            },
                            "span": {
                              "start": 392,
                              "end": 400
                            }
                          }
                        },
                        "span": {
                          "start": 391,
                          "end": 400
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 389,
                  "end": 402
                }
              }
            }
          },
          "span": {
            "start": 383,
            "end": 402
          }
        }
      },
      "span": {
        "start": 383,
        "end": 403
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "nested"
                },
                "span": {
                  "start": 422,
                  "end": 429
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "{{ "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 437,
                          "end": 439
                        }
                      }
                    },
                    {
                      "Literal": " }}"
                    }
                  ]
                },
                "span": {
                  "start": 432,
                  "end": 444
                }
              }
            }
          },
          "span": {
            "start": 422,
            "end": 444
          }
        }
      },
      "span": {
        "start": 422,
        "end": 445
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 445
  }
}
