===config===
min_php=8.5
===source===
<?php
class A {
    private function __call($strMethod, $arrArgs) {
        echo "In " . __METHOD__ . "($strMethod, array(" . implode(',',$arrArgs) . "))\n";
        var_dump($this);
    }
}

class B extends A {
    function test() {
        A::test1(1,'a');
        B::test2(1,'a');
        self::test3(1,'a');
        parent::test4(1,'a');
    }
}

$b = new B();
$b->test();
?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
                    "name": "__call",
                    "span": {
                      "start": 37,
                      "end": 43
                    }
                  },
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "strMethod",
                        "span": {
                          "start": 44,
                          "end": 54
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
                        "start": 44,
                        "end": 54
                      }
                    },
                    {
                      "name": {
                        "name": "arrArgs",
                        "span": {
                          "start": 56,
                          "end": 64
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
                        "start": 56,
                        "end": 64
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "Binary": {
                                "left": {
                                  "kind": {
                                    "Binary": {
                                      "left": {
                                        "kind": {
                                          "Binary": {
                                            "left": {
                                              "kind": {
                                                "Binary": {
                                                  "left": {
                                                    "kind": {
                                                      "String": "In "
                                                    },
                                                    "span": {
                                                      "start": 81,
                                                      "end": 86
                                                    }
                                                  },
                                                  "op": "Concat",
                                                  "right": {
                                                    "kind": {
                                                      "MagicConst": "Method"
                                                    },
                                                    "span": {
                                                      "start": 89,
                                                      "end": 99
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 81,
                                                "end": 99
                                              }
                                            },
                                            "op": "Concat",
                                            "right": {
                                              "kind": {
                                                "InterpolatedString": [
                                                  {
                                                    "Literal": "("
                                                  },
                                                  {
                                                    "Expr": {
                                                      "kind": {
                                                        "Variable": "strMethod"
                                                      },
                                                      "span": {
                                                        "start": 104,
                                                        "end": 114
                                                      }
                                                    }
                                                  },
                                                  {
                                                    "Literal": ", array("
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 102,
                                                "end": 123
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 81,
                                          "end": 123
                                        }
                                      },
                                      "op": "Concat",
                                      "right": {
                                        "kind": {
                                          "FunctionCall": {
                                            "name": {
                                              "kind": {
                                                "Name": {
                                                  "parts": [
                                                    "implode"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 126,
                                                    "end": 133
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 126,
                                                "end": 133
                                              }
                                            },
                                            "args": [
                                              {
                                                "name": null,
                                                "kind": {
                                                  "Value": {
                                                    "kind": {
                                                      "String": ","
                                                    },
                                                    "span": {
                                                      "start": 134,
                                                      "end": 137
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 134,
                                                  "end": 137
                                                }
                                              },
                                              {
                                                "name": null,
                                                "kind": {
                                                  "Value": {
                                                    "kind": {
                                                      "Variable": "arrArgs"
                                                    },
                                                    "span": {
                                                      "start": 138,
                                                      "end": 146
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 138,
                                                  "end": 146
                                                }
                                              }
                                            ]
                                          }
                                        },
                                        "span": {
                                          "start": 126,
                                          "end": 147
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 81,
                                    "end": 147
                                  }
                                },
                                "op": "Concat",
                                "right": {
                                  "kind": {
                                    "String": "))\n"
                                  },
                                  "span": {
                                    "start": 150,
                                    "end": 156
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 81,
                              "end": 156
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 76,
                        "end": 157
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
                                      "var_dump"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 166,
                                      "end": 174
                                    }
                                  }
                                },
                                "span": {
                                  "start": 166,
                                  "end": 174
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 175,
                                        "end": 180
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 175,
                                    "end": 180
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 166,
                            "end": 181
                          }
                        }
                      },
                      "span": {
                        "start": 166,
                        "end": 182
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 188
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 190
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 198,
              "end": 199
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 208,
              "end": 209
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "test",
                    "span": {
                      "start": 225,
                      "end": 229
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 242,
                                      "end": 243
                                    }
                                  }
                                },
                                "span": {
                                  "start": 242,
                                  "end": 243
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "test1"
                                },
                                "span": {
                                  "start": 245,
                                  "end": 250
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 251,
                                        "end": 252
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 251,
                                    "end": 252
                                  }
                                },
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "a"
                                      },
                                      "span": {
                                        "start": 253,
                                        "end": 256
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 253,
                                    "end": 256
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 242,
                            "end": 257
                          }
                        }
                      },
                      "span": {
                        "start": 242,
                        "end": 258
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "B"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 267,
                                      "end": 268
                                    }
                                  }
                                },
                                "span": {
                                  "start": 267,
                                  "end": 268
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "test2"
                                },
                                "span": {
                                  "start": 270,
                                  "end": 275
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 276,
                                        "end": 277
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 276,
                                    "end": 277
                                  }
                                },
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "a"
                                      },
                                      "span": {
                                        "start": 278,
                                        "end": 281
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 278,
                                    "end": 281
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 267,
                            "end": 282
                          }
                        }
                      },
                      "span": {
                        "start": 267,
                        "end": 283
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "self"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 292,
                                      "end": 296
                                    }
                                  }
                                },
                                "span": {
                                  "start": 292,
                                  "end": 296
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "test3"
                                },
                                "span": {
                                  "start": 298,
                                  "end": 303
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 304,
                                        "end": 305
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 304,
                                    "end": 305
                                  }
                                },
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "a"
                                      },
                                      "span": {
                                        "start": 306,
                                        "end": 309
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 306,
                                    "end": 309
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 292,
                            "end": 310
                          }
                        }
                      },
                      "span": {
                        "start": 292,
                        "end": 311
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 320,
                                      "end": 326
                                    }
                                  }
                                },
                                "span": {
                                  "start": 320,
                                  "end": 326
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "test4"
                                },
                                "span": {
                                  "start": 328,
                                  "end": 333
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 334,
                                        "end": 335
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 334,
                                    "end": 335
                                  }
                                },
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "String": "a"
                                      },
                                      "span": {
                                        "start": 336,
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
                            }
                          },
                          "span": {
                            "start": 320,
                            "end": 340
                          }
                        }
                      },
                      "span": {
                        "start": 320,
                        "end": 341
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 216,
                "end": 347
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 192,
        "end": 349
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 351,
                  "end": 353
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
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 360,
                            "end": 361
                          }
                        }
                      },
                      "span": {
                        "start": 360,
                        "end": 361
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 356,
                  "end": 363
                }
              }
            }
          },
          "span": {
            "start": 351,
            "end": 363
          }
        }
      },
      "span": {
        "start": 351,
        "end": 364
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 365,
                  "end": 367
                }
              },
              "method": {
                "kind": {
                  "Identifier": "test"
                },
                "span": {
                  "start": 369,
                  "end": 373
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 365,
            "end": 375
          }
        }
      },
      "span": {
        "start": 365,
        "end": 376
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 376
  }
}
