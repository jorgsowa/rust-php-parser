===source===
<?php
class A {
    function __destruct($a) {}
    function __clone($a, $b) {}
    function __get() {}
    function __set($n) {}
    function __unset($n, $m) {}
    function __isset() {}
    function __call($n) {}
    static function __callStatic($n, $a, $b) {}
    function __toString($a = 1) {}
    function __debugInfo($a) {}
    function __serialize($a) {}
    function __unserialize() {}
    static function __set_state() {}
    function __sleep($a) {}
    function __wakeup($a) {}
}
class B {
    function __GET(...$n) {}
}
===errors===
Method A::__destruct() cannot take arguments
Method A::__clone() cannot take arguments
Method A::__get() must take exactly 1 argument
Method A::__set() must take exactly 2 arguments
Method A::__unset() must take exactly 1 argument
Method A::__isset() must take exactly 1 argument
Method A::__call() must take exactly 2 arguments
Method A::__callStatic() must take exactly 2 arguments
Method A::__toString() cannot take arguments
Method A::__debugInfo() cannot take arguments
Method A::__serialize() cannot take arguments
Method A::__unserialize() must take exactly 1 argument
Method A::__set_state() must take exactly 1 argument
Method A::__sleep() cannot take arguments
Method A::__wakeup() cannot take arguments
Method B::__GET() must take exactly 1 argument
===php_error===
PHP Fatal error:  Method A::__destruct() cannot take arguments in Standard input code on line 3
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
                    "name": "__destruct",
                    "span": {
                      "start": 29,
                      "end": 39
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 40,
                          "end": 42
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
                        "start": 40,
                        "end": 42
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 46
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__clone",
                    "span": {
                      "start": 60,
                      "end": 67
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 68,
                          "end": 70
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
                        "start": 68,
                        "end": 70
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 72,
                          "end": 74
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
                        "start": 72,
                        "end": 74
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 51,
                "end": 78
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__get",
                    "span": {
                      "start": 92,
                      "end": 97
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 83,
                "end": 102
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 116,
                      "end": 121
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 122,
                          "end": 124
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
                        "start": 122,
                        "end": 124
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 107,
                "end": 128
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unset",
                    "span": {
                      "start": 142,
                      "end": 149
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 150,
                          "end": 152
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
                        "start": 150,
                        "end": 152
                      }
                    },
                    {
                      "name": {
                        "name": "m",
                        "span": {
                          "start": 154,
                          "end": 156
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
                        "start": 154,
                        "end": 156
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 133,
                "end": 160
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__isset",
                    "span": {
                      "start": 174,
                      "end": 181
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 165,
                "end": 186
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 200,
                      "end": 206
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 207,
                          "end": 209
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
                        "start": 207,
                        "end": 209
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 191,
                "end": 213
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__callStatic",
                    "span": {
                      "start": 234,
                      "end": 246
                    }
                  },
                  "visibility": null,
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 247,
                          "end": 249
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
                        "start": 247,
                        "end": 249
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 251,
                          "end": 253
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
                        "start": 251,
                        "end": 253
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 255,
                          "end": 257
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
                        "start": 255,
                        "end": 257
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 218,
                "end": 261
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 275,
                      "end": 285
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 286,
                          "end": 288
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 291,
                          "end": 292
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
                        "start": 286,
                        "end": 292
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 266,
                "end": 296
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__debugInfo",
                    "span": {
                      "start": 310,
                      "end": 321
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 322,
                          "end": 324
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
                        "start": 322,
                        "end": 324
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 301,
                "end": 328
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__serialize",
                    "span": {
                      "start": 342,
                      "end": 353
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 354,
                          "end": 356
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
                        "start": 354,
                        "end": 356
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 333,
                "end": 360
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unserialize",
                    "span": {
                      "start": 374,
                      "end": 387
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 365,
                "end": 392
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 413,
                      "end": 424
                    }
                  },
                  "visibility": null,
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 397,
                "end": 429
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__sleep",
                    "span": {
                      "start": 443,
                      "end": 450
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 451,
                          "end": 453
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
                        "start": 451,
                        "end": 453
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 434,
                "end": 457
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__wakeup",
                    "span": {
                      "start": 471,
                      "end": 479
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 480,
                          "end": 482
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
                        "start": 480,
                        "end": 482
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 462,
                "end": 486
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 488
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 495,
              "end": 496
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
                    "name": "__GET",
                    "span": {
                      "start": 512,
                      "end": 517
                    }
                  },
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 521,
                          "end": 523
                        }
                      },
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
                        "start": 518,
                        "end": 523
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 503,
                "end": 527
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 489,
        "end": 529
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 529
  }
}
