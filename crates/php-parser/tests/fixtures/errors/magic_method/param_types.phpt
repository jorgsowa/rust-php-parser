===source===
<?php
class A {
    function __get(int $n) {}
    function __set(?int $n, string $v) {}
    function __unset(Foo $n) {}
    function __isset(Foo&Bar $n) {}
    function __call(int $n, int $a) {}
    static function __callStatic(string $n, object $a) {}
    function __unserialize(callable $a) {}
    static function __set_state(self $a) {}
}
class B {
    function __get(false $n) {}
    function __call(string $n, iterable|Foo $a) {}
    function __set(iterable $n, $v) {}
}
===errors <=7.4===
'intersection types' requires PHP 8.1 or higher
'false type' requires PHP 8.0 or higher
'false as standalone type' requires PHP 8.2 or higher
'union types' requires PHP 8.0 or higher
===errors 8.0===
A::__get(): Parameter #1 ($n) must be of type string when declared
A::__set(): Parameter #1 ($n) must be of type string when declared
A::__unset(): Parameter #1 ($n) must be of type string when declared
'intersection types' requires PHP 8.1 or higher
A::__isset(): Parameter #1 ($n) must be of type string when declared
A::__call(): Parameter #1 ($n) must be of type string when declared
A::__call(): Parameter #2 ($a) must be of type array when declared
A::__callStatic(): Parameter #2 ($a) must be of type array when declared
A::__unserialize(): Parameter #1 ($a) must be of type array when declared
A::__set_state(): Parameter #1 ($a) must be of type array when declared
'false as standalone type' requires PHP 8.2 or higher
B::__get(): Parameter #1 ($n) must be of type string when declared
B::__set(): Parameter #1 ($n) must be of type string when declared
===errors 8.1===
A::__get(): Parameter #1 ($n) must be of type string when declared
A::__set(): Parameter #1 ($n) must be of type string when declared
A::__unset(): Parameter #1 ($n) must be of type string when declared
A::__isset(): Parameter #1 ($n) must be of type string when declared
A::__call(): Parameter #1 ($n) must be of type string when declared
A::__call(): Parameter #2 ($a) must be of type array when declared
A::__callStatic(): Parameter #2 ($a) must be of type array when declared
A::__unserialize(): Parameter #1 ($a) must be of type array when declared
A::__set_state(): Parameter #1 ($a) must be of type array when declared
'false as standalone type' requires PHP 8.2 or higher
B::__get(): Parameter #1 ($n) must be of type string when declared
B::__set(): Parameter #1 ($n) must be of type string when declared
===errors >=8.2===
A::__get(): Parameter #1 ($n) must be of type string when declared
A::__set(): Parameter #1 ($n) must be of type string when declared
A::__unset(): Parameter #1 ($n) must be of type string when declared
A::__isset(): Parameter #1 ($n) must be of type string when declared
A::__call(): Parameter #1 ($n) must be of type string when declared
A::__call(): Parameter #2 ($a) must be of type array when declared
A::__callStatic(): Parameter #2 ($a) must be of type array when declared
A::__unserialize(): Parameter #1 ($a) must be of type array when declared
A::__set_state(): Parameter #1 ($a) must be of type array when declared
B::__get(): Parameter #1 ($n) must be of type string when declared
B::__set(): Parameter #1 ($n) must be of type string when declared
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Bar' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 6
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "Bar", expecting variable in Standard input code on line 6
===php_error >=8.1===
PHP Fatal error:  A::__get(): Parameter #1 ($n) must be of type string when declared in Standard input code on line 3
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
                    "name": "__get",
                    "span": {
                      "start": 29,
                      "end": 34
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 39,
                          "end": 41
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 35,
                              "end": 38
                            }
                          }
                        },
                        "span": {
                          "start": 35,
                          "end": 38
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 35,
                        "end": 41
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
                "end": 45
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 59,
                      "end": 64
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 70,
                          "end": 72
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Nullable": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "int"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 66,
                                  "end": 69
                                }
                              }
                            },
                            "span": {
                              "start": 66,
                              "end": 69
                            }
                          }
                        },
                        "span": {
                          "start": 65,
                          "end": 69
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 65,
                        "end": 72
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 81,
                          "end": 83
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 74,
                              "end": 80
                            }
                          }
                        },
                        "span": {
                          "start": 74,
                          "end": 80
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 74,
                        "end": 83
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 50,
                "end": 87
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unset",
                    "span": {
                      "start": 101,
                      "end": 108
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 113,
                          "end": 115
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 109,
                              "end": 112
                            }
                          }
                        },
                        "span": {
                          "start": 109,
                          "end": 112
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 109,
                        "end": 115
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 119
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__isset",
                    "span": {
                      "start": 133,
                      "end": 140
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 149,
                          "end": 151
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Intersection": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Foo"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 141,
                                    "end": 144
                                  }
                                }
                              },
                              "span": {
                                "start": 141,
                                "end": 144
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Bar"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 145,
                                    "end": 148
                                  }
                                }
                              },
                              "span": {
                                "start": 145,
                                "end": 148
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 141,
                          "end": 148
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 141,
                        "end": 151
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 124,
                "end": 155
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 169,
                      "end": 175
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 180,
                          "end": 182
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 176,
                              "end": 179
                            }
                          }
                        },
                        "span": {
                          "start": 176,
                          "end": 179
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 176,
                        "end": 182
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 188,
                          "end": 190
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 184,
                              "end": 187
                            }
                          }
                        },
                        "span": {
                          "start": 184,
                          "end": 187
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 184,
                        "end": 190
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 160,
                "end": 194
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__callStatic",
                    "span": {
                      "start": 215,
                      "end": 227
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 235,
                          "end": 237
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 228,
                              "end": 234
                            }
                          }
                        },
                        "span": {
                          "start": 228,
                          "end": 234
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 228,
                        "end": 237
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 246,
                          "end": 248
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "object"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 239,
                              "end": 245
                            }
                          }
                        },
                        "span": {
                          "start": 239,
                          "end": 245
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 239,
                        "end": 248
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 199,
                "end": 252
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unserialize",
                    "span": {
                      "start": 266,
                      "end": 279
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 289,
                          "end": 291
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 280,
                              "end": 288
                            }
                          }
                        },
                        "span": {
                          "start": 280,
                          "end": 288
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 280,
                        "end": 291
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 257,
                "end": 295
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 316,
                      "end": 327
                    }
                  },
                  "modifiers": {
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 333,
                          "end": 335
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "self"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 328,
                              "end": 332
                            }
                          }
                        },
                        "span": {
                          "start": 328,
                          "end": 332
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 328,
                        "end": 335
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 300,
                "end": 339
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 341
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 348,
              "end": 349
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
                    "name": "__get",
                    "span": {
                      "start": 365,
                      "end": 370
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 377,
                          "end": 379
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "false"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 371,
                              "end": 376
                            }
                          }
                        },
                        "span": {
                          "start": 371,
                          "end": 376
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 371,
                        "end": 379
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 356,
                "end": 383
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 397,
                      "end": 403
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 411,
                          "end": 413
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 404,
                              "end": 410
                            }
                          }
                        },
                        "span": {
                          "start": 404,
                          "end": 410
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 404,
                        "end": 413
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 428,
                          "end": 430
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "iterable"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 415,
                                    "end": 423
                                  }
                                }
                              },
                              "span": {
                                "start": 415,
                                "end": 423
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Foo"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 424,
                                    "end": 427
                                  }
                                }
                              },
                              "span": {
                                "start": 424,
                                "end": 427
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 415,
                          "end": 427
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 415,
                        "end": 430
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 388,
                "end": 434
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 448,
                      "end": 453
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 463,
                          "end": 465
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "iterable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 454,
                              "end": 462
                            }
                          }
                        },
                        "span": {
                          "start": 454,
                          "end": 462
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 454,
                        "end": 465
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 467,
                          "end": 469
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 467,
                        "end": 469
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 439,
                "end": 473
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 342,
        "end": 475
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 475
  }
}
