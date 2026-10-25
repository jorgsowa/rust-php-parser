===source===
<?php
class A {
    #[\NoDiscard] public function __clone() {}
    #[\NoDiscard] public function __destruct() {}
    #[\NoDiscard] public function __SET($a, $b) {}
    #[\NoDiscard] public function __unset($a) {}
    #[\NoDiscard] public function __wakeup() {}
    #[\NoDiscard] public function __unserialize(array $a) {}
    #[\NoDiscard] public function __get($a) {}
}
trait T { #[\NoDiscard] public function __clone() {} }
interface I { #[\NoDiscard] public function __clone(); }
===errors <=7.4===
expected class member, found 'interface'
missing closing '}'
===errors >=8.5===
Method A::__clone cannot be #[\NoDiscard]
Method A::__destruct cannot be #[\NoDiscard]
Method A::__SET cannot be #[\NoDiscard]
Method A::__unset cannot be #[\NoDiscard]
Method A::__wakeup cannot be #[\NoDiscard]
Method A::__unserialize cannot be #[\NoDiscard]
Method T::__clone cannot be #[\NoDiscard]
Method I::__clone cannot be #[\NoDiscard]
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'interface' (T_INTERFACE), expecting function (T_FUNCTION) or const (T_CONST) in Standard input code on line 12
===php_error >=8.5===
PHP Fatal error:  Method A::__clone cannot be #[\NoDiscard] in Standard input code on line 3
===ast <=7.4===
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
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 370
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 377,
              "end": 378
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 371,
        "end": 439
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 439
  }
}
===ast >=8.0===
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
                    "name": "__clone",
                    "span": {
                      "start": 50,
                      "end": 57
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 22,
                          "end": 32
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 22,
                        "end": 32
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 62
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__destruct",
                    "span": {
                      "start": 97,
                      "end": 107
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 69,
                          "end": 79
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 69,
                        "end": 79
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 67,
                "end": 112
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__SET",
                    "span": {
                      "start": 147,
                      "end": 152
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 153,
                          "end": 155
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 153,
                        "end": 155
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 157,
                          "end": 159
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 157,
                        "end": 159
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 119,
                          "end": 129
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 119,
                        "end": 129
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 117,
                "end": 163
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unset",
                    "span": {
                      "start": 198,
                      "end": 205
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 206,
                          "end": 208
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 206,
                        "end": 208
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 170,
                          "end": 180
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 170,
                        "end": 180
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 168,
                "end": 212
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__wakeup",
                    "span": {
                      "start": 247,
                      "end": 255
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 219,
                          "end": 229
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 219,
                        "end": 229
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 217,
                "end": 260
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unserialize",
                    "span": {
                      "start": 295,
                      "end": 308
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 315,
                          "end": 317
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 309,
                              "end": 314
                            }
                          }
                        },
                        "span": {
                          "start": 309,
                          "end": 314
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 309,
                        "end": 317
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 267,
                          "end": 277
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 267,
                        "end": 277
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 265,
                "end": 321
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__get",
                    "span": {
                      "start": 356,
                      "end": 361
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 362,
                          "end": 364
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 362,
                        "end": 364
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 328,
                          "end": 338
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 328,
                        "end": 338
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 326,
                "end": 368
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 370
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 377,
              "end": 378
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__clone",
                    "span": {
                      "start": 411,
                      "end": 418
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 383,
                          "end": 393
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 383,
                        "end": 393
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 381,
                "end": 423
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 371,
        "end": 425
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 436,
              "end": 437
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__clone",
                    "span": {
                      "start": 470,
                      "end": 477
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 442,
                          "end": 452
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 442,
                        "end": 452
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 440,
                "end": 480
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 426,
        "end": 482
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 482
  }
}
