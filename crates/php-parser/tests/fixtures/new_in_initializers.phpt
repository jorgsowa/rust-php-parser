===source===
<?php
function foo($x = new Foo(), $y = new Bar(1, 2)) {}

class MyClass {
    public $prop = new DefaultObj();
    const C = new Config();

    public function method($p = new Param()) {}
}

function baz() {
    static $cache = new Cache();
}

#[Attr(new Foo())]
function qux() {}

$f = function ($x = new Foo()) {};
$g = fn($x = new Foo()) => $x;
===errors===
New expressions are not supported in this context
New expressions are not supported in this context
===php_error <=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  New expressions are not supported in this context in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "foo",
            "span": {
              "start": 15,
              "end": 18
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 19,
                  "end": 21
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 28,
                            "end": 31
                          }
                        }
                      },
                      "span": {
                        "start": 28,
                        "end": 31
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 24,
                  "end": 33
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 19,
                "end": 33
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 35,
                  "end": 37
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Bar"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 44,
                            "end": 47
                          }
                        }
                      },
                      "span": {
                        "start": 44,
                        "end": 47
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
                              "start": 48,
                              "end": 49
                            }
                          }
                        },
                        "span": {
                          "start": 48,
                          "end": 49
                        }
                      },
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Int": 2
                            },
                            "span": {
                              "start": 51,
                              "end": 52
                            }
                          }
                        },
                        "span": {
                          "start": 51,
                          "end": 52
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 40,
                  "end": 53
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 35,
                "end": 53
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
        "start": 6,
        "end": 57
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "MyClass",
            "span": {
              "start": 65,
              "end": 72
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
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 86,
                      "end": 91
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "DefaultObj"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 98,
                                "end": 108
                              }
                            }
                          },
                          "span": {
                            "start": 98,
                            "end": 108
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 94,
                      "end": 110
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 79,
                "end": 110
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 122,
                      "end": 123
                    }
                  },
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Config"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 130,
                                "end": 136
                              }
                            }
                          },
                          "span": {
                            "start": 130,
                            "end": 136
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 126,
                      "end": 138
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 116,
                "end": 139
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "method",
                    "span": {
                      "start": 161,
                      "end": 167
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "p",
                        "span": {
                          "start": 168,
                          "end": 170
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "New": {
                            "class": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "Param"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 177,
                                    "end": 182
                                  }
                                }
                              },
                              "span": {
                                "start": 177,
                                "end": 182
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 173,
                          "end": 184
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 168,
                        "end": 184
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 145,
                "end": 188
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 59,
        "end": 190
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "baz",
            "span": {
              "start": 201,
              "end": 204
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "cache",
                      "span": {
                        "start": 220,
                        "end": 226
                      }
                    },
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Cache"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 233,
                                  "end": 238
                                }
                              }
                            },
                            "span": {
                              "start": 233,
                              "end": 238
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 229,
                        "end": 240
                      }
                    },
                    "span": {
                      "start": 220,
                      "end": 240
                    }
                  }
                ]
              },
              "span": {
                "start": 213,
                "end": 241
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 192,
        "end": 243
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "qux",
            "span": {
              "start": 273,
              "end": 276
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 247,
                  "end": 251
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Foo"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 256,
                                  "end": 259
                                }
                              }
                            },
                            "span": {
                              "start": 256,
                              "end": 259
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 252,
                        "end": 261
                      }
                    }
                  },
                  "span": {
                    "start": 252,
                    "end": 261
                  }
                }
              ],
              "span": {
                "start": 247,
                "end": 262
              }
            }
          ]
        }
      },
      "span": {
        "start": 264,
        "end": 281
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 283,
                  "end": 285
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 298,
                            "end": 300
                          }
                        },
                        "type_hint": null,
                        "default": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "Foo"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 307,
                                      "end": 310
                                    }
                                  }
                                },
                                "span": {
                                  "start": 307,
                                  "end": 310
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 303,
                            "end": 312
                          }
                        },
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 298,
                          "end": 312
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 288,
                  "end": 316
                }
              }
            }
          },
          "span": {
            "start": 283,
            "end": 316
          }
        }
      },
      "span": {
        "start": 283,
        "end": 317
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 318,
                  "end": 320
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
                        "name": {
                          "name": "x",
                          "span": {
                            "start": 326,
                            "end": 328
                          }
                        },
                        "type_hint": null,
                        "default": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "Foo"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 335,
                                      "end": 338
                                    }
                                  }
                                },
                                "span": {
                                  "start": 335,
                                  "end": 338
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 331,
                            "end": 340
                          }
                        },
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 326,
                          "end": 340
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 345,
                        "end": 347
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 323,
                  "end": 347
                }
              }
            }
          },
          "span": {
            "start": 318,
            "end": 347
          }
        }
      },
      "span": {
        "start": 318,
        "end": 348
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 348
  }
}
