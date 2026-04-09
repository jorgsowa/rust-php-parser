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
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "foo",
          "params": [
            {
              "name": "x",
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Foo"
                      },
                      "span": {
                        "start": 28,
                        "end": 31,
                        "start_line": 2,
                        "start_col": 22
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 24,
                  "end": 33,
                  "start_line": 2,
                  "start_col": 18
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
                "start": 19,
                "end": 33,
                "start_line": 2,
                "start_col": 13
              }
            },
            {
              "name": "y",
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Bar"
                      },
                      "span": {
                        "start": 44,
                        "end": 47,
                        "start_line": 2,
                        "start_col": 38
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 48,
                            "end": 49,
                            "start_line": 2,
                            "start_col": 42
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 48,
                          "end": 49,
                          "start_line": 2,
                          "start_col": 42
                        }
                      },
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 51,
                            "end": 52,
                            "start_line": 2,
                            "start_col": 45
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 51,
                          "end": 52,
                          "start_line": 2,
                          "start_col": 45
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 40,
                  "end": 53,
                  "start_line": 2,
                  "start_col": 34
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
                "start": 35,
                "end": 53,
                "start_line": 2,
                "start_col": 29
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
        "end": 57,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "MyClass",
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
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "DefaultObj"
                          },
                          "span": {
                            "start": 98,
                            "end": 108,
                            "start_line": 5,
                            "start_col": 23
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 94,
                      "end": 110,
                      "start_line": 5,
                      "start_col": 19
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 79,
                "end": 110,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "C",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Config"
                          },
                          "span": {
                            "start": 130,
                            "end": 136,
                            "start_line": 6,
                            "start_col": 18
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 126,
                      "end": 138,
                      "start_line": 6,
                      "start_col": 14
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 116,
                "end": 145,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "method",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "p",
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "New": {
                            "class": {
                              "kind": {
                                "Identifier": "Param"
                              },
                              "span": {
                                "start": 177,
                                "end": 182,
                                "start_line": 8,
                                "start_col": 36
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 173,
                          "end": 184,
                          "start_line": 8,
                          "start_col": 32
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
                        "start": 168,
                        "end": 184,
                        "start_line": 8,
                        "start_col": 27
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
                "end": 189,
                "start_line": 8,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 59,
        "end": 190,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "baz",
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": "cache",
                    "default": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Identifier": "Cache"
                            },
                            "span": {
                              "start": 233,
                              "end": 238,
                              "start_line": 12,
                              "start_col": 24
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 229,
                        "end": 240,
                        "start_line": 12,
                        "start_col": 20
                      }
                    },
                    "span": {
                      "start": 220,
                      "end": 240,
                      "start_line": 12,
                      "start_col": 11
                    }
                  }
                ]
              },
              "span": {
                "start": 213,
                "end": 242,
                "start_line": 12,
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
        "start": 192,
        "end": 243,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "qux",
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
                  "end": 251,
                  "start_line": 15,
                  "start_col": 2
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Identifier": "Foo"
                          },
                          "span": {
                            "start": 256,
                            "end": 259,
                            "start_line": 15,
                            "start_col": 11
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 252,
                      "end": 261,
                      "start_line": 15,
                      "start_col": 7
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 252,
                    "end": 261,
                    "start_line": 15,
                    "start_col": 7
                  }
                }
              ],
              "span": {
                "start": 247,
                "end": 262,
                "start_line": 15,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 264,
        "end": 281,
        "start_line": 16,
        "start_col": 0
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
                  "end": 285,
                  "start_line": 18,
                  "start_col": 0
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
                        "name": "x",
                        "type_hint": null,
                        "default": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "Foo"
                                },
                                "span": {
                                  "start": 307,
                                  "end": 310,
                                  "start_line": 18,
                                  "start_col": 24
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 303,
                            "end": 312,
                            "start_line": 18,
                            "start_col": 20
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
                          "start": 298,
                          "end": 312,
                          "start_line": 18,
                          "start_col": 15
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
                  "end": 316,
                  "start_line": 18,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 283,
            "end": 316,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 283,
        "end": 318,
        "start_line": 18,
        "start_col": 0
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
                  "end": 320,
                  "start_line": 19,
                  "start_col": 0
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
                        "default": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "Foo"
                                },
                                "span": {
                                  "start": 335,
                                  "end": 338,
                                  "start_line": 19,
                                  "start_col": 17
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 331,
                            "end": 340,
                            "start_line": 19,
                            "start_col": 13
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
                          "start": 326,
                          "end": 340,
                          "start_line": 19,
                          "start_col": 8
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
                        "end": 347,
                        "start_line": 19,
                        "start_col": 27
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 323,
                  "end": 347,
                  "start_line": 19,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 318,
            "end": 347,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 318,
        "end": 348,
        "start_line": 19,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 348,
    "start_line": 1,
    "start_col": 0
  }
}
