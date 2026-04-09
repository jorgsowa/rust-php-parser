===source===
<?php

function gen() {
    // statements
    yield;
    yield $value;
    yield $key => $value;

    // expressions
    $data = yield;
    $data = (yield $value);
    $data = (yield $key => $value);

    // yield in language constructs with their own parentheses
    if (yield $foo); elseif (yield $foo);
    if (yield $foo): elseif (yield $foo): endif;
    while (yield $foo);
    do {} while (yield $foo);
    switch (yield $foo) {}
    die(yield $foo);

    // yield in function calls
    func(yield $foo);
    $foo->func(yield $foo);
    new Foo(yield $foo);

    yield from $foo;
    yield from $foo and yield from $bar;
    yield from $foo + $bar;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "gen",
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": null,
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 51,
                    "start_line": 5,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 46,
                "end": 57,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "value"
                        },
                        "span": {
                          "start": 63,
                          "end": 69,
                          "start_line": 6,
                          "start_col": 10
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 57,
                    "end": 69,
                    "start_line": 6,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 57,
                "end": 75,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": {
                        "kind": {
                          "Variable": "key"
                        },
                        "span": {
                          "start": 81,
                          "end": 85,
                          "start_line": 7,
                          "start_col": 10
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "value"
                        },
                        "span": {
                          "start": 89,
                          "end": 95,
                          "start_line": 7,
                          "start_col": 18
                        }
                      },
                      "is_from": false
                    }
                  },
                  "span": {
                    "start": 75,
                    "end": 95,
                    "start_line": 7,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 75,
                "end": 121,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "data"
                        },
                        "span": {
                          "start": 121,
                          "end": 126,
                          "start_line": 10,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Yield": {
                            "key": null,
                            "value": null,
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 129,
                          "end": 134,
                          "start_line": 10,
                          "start_col": 12
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 121,
                    "end": 134,
                    "start_line": 10,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 121,
                "end": 140,
                "start_line": 10,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "data"
                        },
                        "span": {
                          "start": 140,
                          "end": 145,
                          "start_line": 11,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "Yield": {
                                "key": null,
                                "value": {
                                  "kind": {
                                    "Variable": "value"
                                  },
                                  "span": {
                                    "start": 155,
                                    "end": 161,
                                    "start_line": 11,
                                    "start_col": 19
                                  }
                                },
                                "is_from": false
                              }
                            },
                            "span": {
                              "start": 149,
                              "end": 161,
                              "start_line": 11,
                              "start_col": 13
                            }
                          }
                        },
                        "span": {
                          "start": 148,
                          "end": 162,
                          "start_line": 11,
                          "start_col": 12
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 140,
                    "end": 162,
                    "start_line": 11,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 140,
                "end": 168,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "data"
                        },
                        "span": {
                          "start": 168,
                          "end": 173,
                          "start_line": 12,
                          "start_col": 4
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "Yield": {
                                "key": {
                                  "kind": {
                                    "Variable": "key"
                                  },
                                  "span": {
                                    "start": 183,
                                    "end": 187,
                                    "start_line": 12,
                                    "start_col": 19
                                  }
                                },
                                "value": {
                                  "kind": {
                                    "Variable": "value"
                                  },
                                  "span": {
                                    "start": 191,
                                    "end": 197,
                                    "start_line": 12,
                                    "start_col": 27
                                  }
                                },
                                "is_from": false
                              }
                            },
                            "span": {
                              "start": 177,
                              "end": 197,
                              "start_line": 12,
                              "start_col": 13
                            }
                          }
                        },
                        "span": {
                          "start": 176,
                          "end": 198,
                          "start_line": 12,
                          "start_col": 12
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 168,
                    "end": 198,
                    "start_line": 12,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 168,
                "end": 268,
                "start_line": 12,
                "start_col": 4
              }
            },
            {
              "kind": {
                "If": {
                  "condition": {
                    "kind": {
                      "Yield": {
                        "key": null,
                        "value": {
                          "kind": {
                            "Variable": "foo"
                          },
                          "span": {
                            "start": 278,
                            "end": 282,
                            "start_line": 15,
                            "start_col": 14
                          }
                        },
                        "is_from": false
                      }
                    },
                    "span": {
                      "start": 272,
                      "end": 282,
                      "start_line": 15,
                      "start_col": 8
                    }
                  },
                  "then_branch": {
                    "kind": "Nop",
                    "span": {
                      "start": 283,
                      "end": 284,
                      "start_line": 15,
                      "start_col": 19
                    }
                  },
                  "elseif_branches": [
                    {
                      "condition": {
                        "kind": {
                          "Yield": {
                            "key": null,
                            "value": {
                              "kind": {
                                "Variable": "foo"
                              },
                              "span": {
                                "start": 299,
                                "end": 303,
                                "start_line": 15,
                                "start_col": 35
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 293,
                          "end": 303,
                          "start_line": 15,
                          "start_col": 29
                        }
                      },
                      "body": {
                        "kind": "Nop",
                        "span": {
                          "start": 304,
                          "end": 305,
                          "start_line": 15,
                          "start_col": 40
                        }
                      },
                      "span": {
                        "start": 292,
                        "end": 305,
                        "start_line": 15,
                        "start_col": 28
                      }
                    }
                  ],
                  "else_branch": null
                }
              },
              "span": {
                "start": 268,
                "end": 305,
                "start_line": 15,
                "start_col": 4
              }
            },
            {
              "kind": {
                "If": {
                  "condition": {
                    "kind": {
                      "Yield": {
                        "key": null,
                        "value": {
                          "kind": {
                            "Variable": "foo"
                          },
                          "span": {
                            "start": 320,
                            "end": 324,
                            "start_line": 16,
                            "start_col": 14
                          }
                        },
                        "is_from": false
                      }
                    },
                    "span": {
                      "start": 314,
                      "end": 324,
                      "start_line": 16,
                      "start_col": 8
                    }
                  },
                  "then_branch": {
                    "kind": {
                      "Block": []
                    },
                    "span": {
                      "start": 310,
                      "end": 327,
                      "start_line": 16,
                      "start_col": 4
                    }
                  },
                  "elseif_branches": [
                    {
                      "condition": {
                        "kind": {
                          "Yield": {
                            "key": null,
                            "value": {
                              "kind": {
                                "Variable": "foo"
                              },
                              "span": {
                                "start": 341,
                                "end": 345,
                                "start_line": 16,
                                "start_col": 35
                              }
                            },
                            "is_from": false
                          }
                        },
                        "span": {
                          "start": 335,
                          "end": 345,
                          "start_line": 16,
                          "start_col": 29
                        }
                      },
                      "body": {
                        "kind": {
                          "Block": []
                        },
                        "span": {
                          "start": 334,
                          "end": 348,
                          "start_line": 16,
                          "start_col": 28
                        }
                      },
                      "span": {
                        "start": 334,
                        "end": 348,
                        "start_line": 16,
                        "start_col": 28
                      }
                    }
                  ],
                  "else_branch": null
                }
              },
              "span": {
                "start": 310,
                "end": 359,
                "start_line": 16,
                "start_col": 4
              }
            },
            {
              "kind": {
                "While": {
                  "condition": {
                    "kind": {
                      "Yield": {
                        "key": null,
                        "value": {
                          "kind": {
                            "Variable": "foo"
                          },
                          "span": {
                            "start": 372,
                            "end": 376,
                            "start_line": 17,
                            "start_col": 17
                          }
                        },
                        "is_from": false
                      }
                    },
                    "span": {
                      "start": 366,
                      "end": 376,
                      "start_line": 17,
                      "start_col": 11
                    }
                  },
                  "body": {
                    "kind": "Nop",
                    "span": {
                      "start": 377,
                      "end": 378,
                      "start_line": 17,
                      "start_col": 22
                    }
                  }
                }
              },
              "span": {
                "start": 359,
                "end": 378,
                "start_line": 17,
                "start_col": 4
              }
            },
            {
              "kind": {
                "DoWhile": {
                  "body": {
                    "kind": {
                      "Block": []
                    },
                    "span": {
                      "start": 386,
                      "end": 388,
                      "start_line": 18,
                      "start_col": 7
                    }
                  },
                  "condition": {
                    "kind": {
                      "Yield": {
                        "key": null,
                        "value": {
                          "kind": {
                            "Variable": "foo"
                          },
                          "span": {
                            "start": 402,
                            "end": 406,
                            "start_line": 18,
                            "start_col": 23
                          }
                        },
                        "is_from": false
                      }
                    },
                    "span": {
                      "start": 396,
                      "end": 406,
                      "start_line": 18,
                      "start_col": 17
                    }
                  }
                }
              },
              "span": {
                "start": 383,
                "end": 413,
                "start_line": 18,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Switch": {
                  "expr": {
                    "kind": {
                      "Yield": {
                        "key": null,
                        "value": {
                          "kind": {
                            "Variable": "foo"
                          },
                          "span": {
                            "start": 427,
                            "end": 431,
                            "start_line": 19,
                            "start_col": 18
                          }
                        },
                        "is_from": false
                      }
                    },
                    "span": {
                      "start": 421,
                      "end": 431,
                      "start_line": 19,
                      "start_col": 12
                    }
                  },
                  "cases": []
                }
              },
              "span": {
                "start": 413,
                "end": 440,
                "start_line": 19,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Exit": {
                      "kind": {
                        "Yield": {
                          "key": null,
                          "value": {
                            "kind": {
                              "Variable": "foo"
                            },
                            "span": {
                              "start": 450,
                              "end": 454,
                              "start_line": 20,
                              "start_col": 14
                            }
                          },
                          "is_from": false
                        }
                      },
                      "span": {
                        "start": 444,
                        "end": 454,
                        "start_line": 20,
                        "start_col": 8
                      }
                    }
                  },
                  "span": {
                    "start": 440,
                    "end": 455,
                    "start_line": 20,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 440,
                "end": 493,
                "start_line": 20,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Identifier": "func"
                        },
                        "span": {
                          "start": 493,
                          "end": 497,
                          "start_line": 23,
                          "start_col": 4
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Yield": {
                                "key": null,
                                "value": {
                                  "kind": {
                                    "Variable": "foo"
                                  },
                                  "span": {
                                    "start": 504,
                                    "end": 508,
                                    "start_line": 23,
                                    "start_col": 15
                                  }
                                },
                                "is_from": false
                              }
                            },
                            "span": {
                              "start": 498,
                              "end": 508,
                              "start_line": 23,
                              "start_col": 9
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 498,
                            "end": 508,
                            "start_line": 23,
                            "start_col": 9
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 493,
                    "end": 509,
                    "start_line": 23,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 493,
                "end": 515,
                "start_line": 23,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "MethodCall": {
                      "object": {
                        "kind": {
                          "Variable": "foo"
                        },
                        "span": {
                          "start": 515,
                          "end": 519,
                          "start_line": 24,
                          "start_col": 4
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "func"
                        },
                        "span": {
                          "start": 521,
                          "end": 525,
                          "start_line": 24,
                          "start_col": 10
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Yield": {
                                "key": null,
                                "value": {
                                  "kind": {
                                    "Variable": "foo"
                                  },
                                  "span": {
                                    "start": 532,
                                    "end": 536,
                                    "start_line": 24,
                                    "start_col": 21
                                  }
                                },
                                "is_from": false
                              }
                            },
                            "span": {
                              "start": 526,
                              "end": 536,
                              "start_line": 24,
                              "start_col": 15
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 526,
                            "end": 536,
                            "start_line": 24,
                            "start_col": 15
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 515,
                    "end": 537,
                    "start_line": 24,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 515,
                "end": 543,
                "start_line": 24,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Identifier": "Foo"
                        },
                        "span": {
                          "start": 547,
                          "end": 550,
                          "start_line": 25,
                          "start_col": 8
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "Yield": {
                                "key": null,
                                "value": {
                                  "kind": {
                                    "Variable": "foo"
                                  },
                                  "span": {
                                    "start": 557,
                                    "end": 561,
                                    "start_line": 25,
                                    "start_col": 18
                                  }
                                },
                                "is_from": false
                              }
                            },
                            "span": {
                              "start": 551,
                              "end": 561,
                              "start_line": 25,
                              "start_col": 12
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 551,
                            "end": 561,
                            "start_line": 25,
                            "start_col": 12
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 543,
                    "end": 562,
                    "start_line": 25,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 543,
                "end": 569,
                "start_line": 25,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "foo"
                        },
                        "span": {
                          "start": 580,
                          "end": 584,
                          "start_line": 27,
                          "start_col": 15
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 569,
                    "end": 584,
                    "start_line": 27,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 569,
                "end": 590,
                "start_line": 27,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Variable": "foo"
                              },
                              "span": {
                                "start": 601,
                                "end": 605,
                                "start_line": 28,
                                "start_col": 15
                              }
                            },
                            "op": "LogicalAnd",
                            "right": {
                              "kind": {
                                "Yield": {
                                  "key": null,
                                  "value": {
                                    "kind": {
                                      "Variable": "bar"
                                    },
                                    "span": {
                                      "start": 621,
                                      "end": 625,
                                      "start_line": 28,
                                      "start_col": 35
                                    }
                                  },
                                  "is_from": true
                                }
                              },
                              "span": {
                                "start": 610,
                                "end": 625,
                                "start_line": 28,
                                "start_col": 24
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 601,
                          "end": 625,
                          "start_line": 28,
                          "start_col": 15
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 590,
                    "end": 625,
                    "start_line": 28,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 590,
                "end": 631,
                "start_line": 28,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Yield": {
                      "key": null,
                      "value": {
                        "kind": {
                          "Binary": {
                            "left": {
                              "kind": {
                                "Variable": "foo"
                              },
                              "span": {
                                "start": 642,
                                "end": 646,
                                "start_line": 29,
                                "start_col": 15
                              }
                            },
                            "op": "Add",
                            "right": {
                              "kind": {
                                "Variable": "bar"
                              },
                              "span": {
                                "start": 649,
                                "end": 653,
                                "start_line": 29,
                                "start_col": 22
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 642,
                          "end": 653,
                          "start_line": 29,
                          "start_col": 15
                        }
                      },
                      "is_from": true
                    }
                  },
                  "span": {
                    "start": 631,
                    "end": 653,
                    "start_line": 29,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 631,
                "end": 655,
                "start_line": 29,
                "start_col": 4
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 656,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 656,
    "start_line": 1,
    "start_col": 0
  }
}
