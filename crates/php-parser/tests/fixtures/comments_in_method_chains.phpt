===source===
<?php
// Comments between chained method calls
$result = $obj
  ->method1()
  // comment between methods
  ->method2()
  /* block comment */ ->method3();

// Multiple consecutive comments before call
$x = $obj
  ->method1()
  /**
   * Doc comment
   */
  // Single line
  /* Block */
  ->method2();

// Comments with arguments in chain
$obj
  ->method1(/* arg */ $a)
  // between
  ->method2($b)
  /* before args */ ->method3(/* c1 */ $c, /* c2 */ $d);

// Property access in chain with comments
$val = $obj
  ->prop
  // comment
  ->nested
  /* block */ ->method();

// Static method chains with comments
$result = MyClass
  ::staticMethod()
  // comment
  ::anotherStatic()
  /* block */ ::finalMethod();

// Mixed instance and chain
$obj
  ->method()
  // comment 1
  ?->optional()
  // comment 2
  ->regular();

// Deep chain with many comments
$x = $a
  ->m1() // 1
  ->m2() // 2
  ->m3() // 3
  ->m4() // 4
  ->m5() // 5
  ->m6(); // 6

// Hash comments in chain
$obj
  ->method1()
  # hash comment
  ->method2()
  # another
  ->method3();

// Comments in function argument of chained call
$obj
  ->method1(
    /* arg1 */ $x,
    // arg2
    $y
  )
  // between methods
  ->method2(
    /* arg */ $z
  );

// Nested calls with comments in chain
$obj
  ->outer(
    $inner
      ->innerMethod()
      // inner comment
      ->anotherInner()
  )
  // outer comment
  ->nextMethod();
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
                  "Variable": "result"
                },
                "span": {
                  "start": 47,
                  "end": 54
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "MethodCall": {
                                "object": {
                                  "kind": {
                                    "Variable": "obj"
                                  },
                                  "span": {
                                    "start": 57,
                                    "end": 61
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "method1"
                                  },
                                  "span": {
                                    "start": 66,
                                    "end": 73
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 57,
                              "end": 75
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "method2"
                            },
                            "span": {
                              "start": 109,
                              "end": 116
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 57,
                        "end": 118
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method3"
                      },
                      "span": {
                        "start": 143,
                        "end": 150
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 57,
                  "end": 152
                }
              }
            }
          },
          "span": {
            "start": 47,
            "end": 152
          }
        }
      },
      "span": {
        "start": 47,
        "end": 153
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
                  "start": 200,
                  "end": 202
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "obj"
                            },
                            "span": {
                              "start": 205,
                              "end": 209
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "method1"
                            },
                            "span": {
                              "start": 214,
                              "end": 221
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 205,
                        "end": 223
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method2"
                      },
                      "span": {
                        "start": 288,
                        "end": 295
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 205,
                  "end": 297
                }
              }
            }
          },
          "span": {
            "start": 200,
            "end": 297
          }
        }
      },
      "span": {
        "start": 200,
        "end": 298
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "obj"
                            },
                            "span": {
                              "start": 336,
                              "end": 340
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "method1"
                            },
                            "span": {
                              "start": 345,
                              "end": 352
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "value": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 363,
                                  "end": 365
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 363,
                                "end": 365
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 336,
                        "end": 366
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method2"
                      },
                      "span": {
                        "start": 384,
                        "end": 391
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 392,
                            "end": 394
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 392,
                          "end": 394
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 336,
                  "end": 395
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method3"
                },
                "span": {
                  "start": 418,
                  "end": 425
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 435,
                      "end": 437
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 435,
                    "end": 437
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "d"
                    },
                    "span": {
                      "start": 448,
                      "end": 450
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 448,
                    "end": 450
                  }
                }
              ]
            }
          },
          "span": {
            "start": 336,
            "end": 451
          }
        }
      },
      "span": {
        "start": 336,
        "end": 452
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "val"
                },
                "span": {
                  "start": 496,
                  "end": 500
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "PropertyAccess": {
                          "object": {
                            "kind": {
                              "PropertyAccess": {
                                "object": {
                                  "kind": {
                                    "Variable": "obj"
                                  },
                                  "span": {
                                    "start": 503,
                                    "end": 507
                                  }
                                },
                                "property": {
                                  "kind": {
                                    "Identifier": "prop"
                                  },
                                  "span": {
                                    "start": 512,
                                    "end": 516
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 503,
                              "end": 516
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "nested"
                            },
                            "span": {
                              "start": 534,
                              "end": 540
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 503,
                        "end": 540
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method"
                      },
                      "span": {
                        "start": 557,
                        "end": 563
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 503,
                  "end": 565
                }
              }
            }
          },
          "span": {
            "start": 496,
            "end": 565
          }
        }
      },
      "span": {
        "start": 496,
        "end": 566
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "result"
                },
                "span": {
                  "start": 606,
                  "end": 613
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "StaticMethodCall": {
                    "class": {
                      "kind": {
                        "StaticMethodCall": {
                          "class": {
                            "kind": {
                              "StaticMethodCall": {
                                "class": {
                                  "kind": {
                                    "Identifier": "MyClass"
                                  },
                                  "span": {
                                    "start": 616,
                                    "end": 623
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "staticMethod"
                                  },
                                  "span": {
                                    "start": 628,
                                    "end": 640
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 616,
                              "end": 642
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "anotherStatic"
                            },
                            "span": {
                              "start": 660,
                              "end": 673
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 616,
                        "end": 675
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "finalMethod"
                      },
                      "span": {
                        "start": 692,
                        "end": 703
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 616,
                  "end": 705
                }
              }
            }
          },
          "span": {
            "start": 606,
            "end": 705
          }
        }
      },
      "span": {
        "start": 606,
        "end": 706
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "NullsafeMethodCall": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "obj"
                            },
                            "span": {
                              "start": 736,
                              "end": 740
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "method"
                            },
                            "span": {
                              "start": 745,
                              "end": 751
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 736,
                        "end": 753
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "optional"
                      },
                      "span": {
                        "start": 774,
                        "end": 782
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 736,
                  "end": 784
                }
              },
              "method": {
                "kind": {
                  "Identifier": "regular"
                },
                "span": {
                  "start": 804,
                  "end": 811
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 736,
            "end": 813
          }
        }
      },
      "span": {
        "start": 736,
        "end": 814
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
                  "start": 849,
                  "end": 851
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "MethodCall": {
                                "object": {
                                  "kind": {
                                    "MethodCall": {
                                      "object": {
                                        "kind": {
                                          "MethodCall": {
                                            "object": {
                                              "kind": {
                                                "MethodCall": {
                                                  "object": {
                                                    "kind": {
                                                      "Variable": "a"
                                                    },
                                                    "span": {
                                                      "start": 854,
                                                      "end": 856
                                                    }
                                                  },
                                                  "method": {
                                                    "kind": {
                                                      "Identifier": "m1"
                                                    },
                                                    "span": {
                                                      "start": 861,
                                                      "end": 863
                                                    }
                                                  },
                                                  "args": []
                                                }
                                              },
                                              "span": {
                                                "start": 854,
                                                "end": 865
                                              }
                                            },
                                            "method": {
                                              "kind": {
                                                "Identifier": "m2"
                                              },
                                              "span": {
                                                "start": 875,
                                                "end": 877
                                              }
                                            },
                                            "args": []
                                          }
                                        },
                                        "span": {
                                          "start": 854,
                                          "end": 879
                                        }
                                      },
                                      "method": {
                                        "kind": {
                                          "Identifier": "m3"
                                        },
                                        "span": {
                                          "start": 889,
                                          "end": 891
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 854,
                                    "end": 893
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "m4"
                                  },
                                  "span": {
                                    "start": 903,
                                    "end": 905
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 854,
                              "end": 907
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "m5"
                            },
                            "span": {
                              "start": 917,
                              "end": 919
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 854,
                        "end": 921
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "m6"
                      },
                      "span": {
                        "start": 931,
                        "end": 933
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 854,
                  "end": 935
                }
              }
            }
          },
          "span": {
            "start": 849,
            "end": 935
          }
        }
      },
      "span": {
        "start": 849,
        "end": 936
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "MethodCall": {
                          "object": {
                            "kind": {
                              "Variable": "obj"
                            },
                            "span": {
                              "start": 969,
                              "end": 973
                            }
                          },
                          "method": {
                            "kind": {
                              "Identifier": "method1"
                            },
                            "span": {
                              "start": 978,
                              "end": 985
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 969,
                        "end": 987
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method2"
                      },
                      "span": {
                        "start": 1009,
                        "end": 1016
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 969,
                  "end": 1018
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method3"
                },
                "span": {
                  "start": 1035,
                  "end": 1042
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 969,
            "end": 1044
          }
        }
      },
      "span": {
        "start": 969,
        "end": 1045
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 1096,
                        "end": 1100
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method1"
                      },
                      "span": {
                        "start": 1105,
                        "end": 1112
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 1129,
                            "end": 1131
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 1129,
                          "end": 1131
                        }
                      },
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Variable": "y"
                          },
                          "span": {
                            "start": 1149,
                            "end": 1151
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 1149,
                          "end": 1151
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 1096,
                  "end": 1155
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method2"
                },
                "span": {
                  "start": 1181,
                  "end": 1188
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "z"
                    },
                    "span": {
                      "start": 1204,
                      "end": 1206
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 1204,
                    "end": 1206
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1096,
            "end": 1210
          }
        }
      },
      "span": {
        "start": 1096,
        "end": 1211
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "obj"
                      },
                      "span": {
                        "start": 1252,
                        "end": 1256
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "outer"
                      },
                      "span": {
                        "start": 1261,
                        "end": 1266
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "Variable": "inner"
                                      },
                                      "span": {
                                        "start": 1272,
                                        "end": 1278
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "innerMethod"
                                      },
                                      "span": {
                                        "start": 1287,
                                        "end": 1298
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 1272,
                                  "end": 1300
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "anotherInner"
                                },
                                "span": {
                                  "start": 1332,
                                  "end": 1344
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 1272,
                            "end": 1346
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 1272,
                          "end": 1346
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 1252,
                  "end": 1350
                }
              },
              "method": {
                "kind": {
                  "Identifier": "nextMethod"
                },
                "span": {
                  "start": 1374,
                  "end": 1384
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 1252,
            "end": 1386
          }
        }
      },
      "span": {
        "start": 1252,
        "end": 1387
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1387
  }
}
