===source===
<?php
// Comments between function arguments
foo(
  $a,
  // comment before arg
  $b,
  /* block comment */ $c,
  $d /* trailing */,
  /* before */ $e /* after */
);

// Comments in method calls
$obj
  ->method1(
    /* arg1 */ $x,
    $y /* arg2 */
  )
  // comment between calls
  ->method2(
    $z
  );

// Comments in nested calls
foo(
  bar(
    /* inner */
    $a,
    $b
  ),
  /* outer */ $c
);

// Comments with default values
function test(
  /* param1 */ $a = 1,
  // param2
  $b = 2
) {}

// Comments in arrow function arguments
$fn = fn(
  /* x */ $x,
  // y
  $y
) => $x + $y;

// Comments with type hints and trailing comma
function typed(
  /* string */ string $s,
  // int
  int $i,
) {}

// Comments in variadic
function variadic(
  $a,
  /* variadic */ ...$rest
) {}

// Comments in constructor promotion
class Foo {
  public function __construct(
    /* prop */ private $x,
    // another
    private $y,
  ) {}
}

// Comments in match arguments
$result = match(
  /* expr */ $value
) {
  1 /* case1 */ => 'one',
  2 => 'two',
};

// Multiple consecutive comments before argument
foo(
  /**
   * Doc comment
   */
  // Single line
  /* Block */
  $x
);

// Hash comments in argument lists
foo(
  $a,
  # hash comment
  $b,
  # another
  $c
);
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
                      "Variable": "a"
                    },
                    "span": {
                      "start": 52,
                      "end": 54
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 52,
                    "end": 54
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 82,
                      "end": 84
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 82,
                    "end": 84
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 108,
                      "end": 110
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 108,
                    "end": 110
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "d"
                    },
                    "span": {
                      "start": 114,
                      "end": 116
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 114,
                    "end": 116
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "e"
                    },
                    "span": {
                      "start": 148,
                      "end": 150
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 148,
                    "end": 150
                  }
                }
              ]
            }
          },
          "span": {
            "start": 45,
            "end": 164
          }
        }
      },
      "span": {
        "start": 45,
        "end": 165
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
                        "start": 195,
                        "end": 199
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "method1"
                      },
                      "span": {
                        "start": 204,
                        "end": 211
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
                            "start": 228,
                            "end": 230
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 228,
                          "end": 230
                        }
                      },
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Variable": "y"
                          },
                          "span": {
                            "start": 236,
                            "end": 238
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 236,
                          "end": 238
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 195,
                  "end": 253
                }
              },
              "method": {
                "kind": {
                  "Identifier": "method2"
                },
                "span": {
                  "start": 285,
                  "end": 292
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
                      "start": 298,
                      "end": 300
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 298,
                    "end": 300
                  }
                }
              ]
            }
          },
          "span": {
            "start": 195,
            "end": 304
          }
        }
      },
      "span": {
        "start": 195,
        "end": 305
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
                  "start": 335,
                  "end": 338
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Identifier": "bar"
                          },
                          "span": {
                            "start": 342,
                            "end": 345
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
                                "start": 367,
                                "end": 369
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 367,
                              "end": 369
                            }
                          },
                          {
                            "name": null,
                            "value": {
                              "kind": {
                                "Variable": "b"
                              },
                              "span": {
                                "start": 375,
                                "end": 377
                              }
                            },
                            "unpack": false,
                            "by_ref": false,
                            "span": {
                              "start": 375,
                              "end": 377
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 342,
                      "end": 381
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 342,
                    "end": 381
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 397,
                      "end": 399
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 397,
                    "end": 399
                  }
                }
              ]
            }
          },
          "span": {
            "start": 335,
            "end": 401
          }
        }
      },
      "span": {
        "start": 335,
        "end": 402
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 471,
                  "end": 472
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 466,
                "end": 472
              }
            },
            {
              "name": "b",
              "type_hint": null,
              "default": {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 493,
                  "end": 494
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 488,
                "end": 494
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
        "start": 436,
        "end": 499
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "fn"
                },
                "span": {
                  "start": 541,
                  "end": 544
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": "x",
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
                          "start": 561,
                          "end": 563
                        }
                      },
                      {
                        "name": "y",
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
                          "start": 574,
                          "end": 576
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Binary": {
                          "left": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 582,
                              "end": 584
                            }
                          },
                          "op": "Add",
                          "right": {
                            "kind": {
                              "Variable": "y"
                            },
                            "span": {
                              "start": 587,
                              "end": 589
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 582,
                        "end": 589
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 547,
                  "end": 589
                }
              }
            }
          },
          "span": {
            "start": 541,
            "end": 589
          }
        }
      },
      "span": {
        "start": 541,
        "end": 590
      }
    },
    {
      "kind": {
        "Function": {
          "name": "typed",
          "params": [
            {
              "name": "s",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 670,
                      "end": 676
                    }
                  }
                },
                "span": {
                  "start": 670,
                  "end": 676
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 670,
                "end": 679
              }
            },
            {
              "name": "i",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 692,
                      "end": 695
                    }
                  }
                },
                "span": {
                  "start": 692,
                  "end": 695
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 692,
                "end": 698
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
        "start": 639,
        "end": 704
      }
    },
    {
      "kind": {
        "Function": {
          "name": "variadic",
          "params": [
            {
              "name": "a",
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
                "start": 751,
                "end": 753
              }
            },
            {
              "name": "rest",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 772,
                "end": 780
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
        "start": 730,
        "end": 785
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 882,
                        "end": 892
                      }
                    },
                    {
                      "name": "y",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 913,
                        "end": 923
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 838,
                "end": 931
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 824,
        "end": 933
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
                  "start": 966,
                  "end": 973
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "value"
                      },
                      "span": {
                        "start": 996,
                        "end": 1002
                      }
                    },
                    "arms": [
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 1009,
                              "end": 1010
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "one"
                          },
                          "span": {
                            "start": 1026,
                            "end": 1031
                          }
                        },
                        "span": {
                          "start": 1009,
                          "end": 1031
                        }
                      },
                      {
                        "conditions": [
                          {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 1035,
                              "end": 1036
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "two"
                          },
                          "span": {
                            "start": 1040,
                            "end": 1045
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
                  "start": 976,
                  "end": 1048
                }
              }
            }
          },
          "span": {
            "start": 966,
            "end": 1048
          }
        }
      },
      "span": {
        "start": 966,
        "end": 1049
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
                  "start": 1100,
                  "end": 1103
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
                      "start": 1167,
                      "end": 1169
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 1167,
                    "end": 1169
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1100,
            "end": 1171
          }
        }
      },
      "span": {
        "start": 1100,
        "end": 1172
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
                  "start": 1209,
                  "end": 1212
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
                      "start": 1216,
                      "end": 1218
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 1216,
                    "end": 1218
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 1239,
                      "end": 1241
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 1239,
                    "end": 1241
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "c"
                    },
                    "span": {
                      "start": 1257,
                      "end": 1259
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 1257,
                    "end": 1259
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1209,
            "end": 1261
          }
        }
      },
      "span": {
        "start": 1209,
        "end": 1262
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1262
  }
}
