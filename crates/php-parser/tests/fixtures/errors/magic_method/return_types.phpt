===source===
<?php
class A {
    function __clone(): int {}
    function __set($n, $v): mixed {}
    function __unset($n): ?string {}
    function __isset($n): bool|int {}
    function __toString(): Stringable {}
    function __debugInfo(): iterable|null {}
    function __serialize(): ?array {}
    function __unserialize(array $a): bool {}
    static function __set_state(array $a): ?object {}
    function __sleep(): string {}
    function __wakeup(): static {}
}
class B {
    function __toString(): static {}
}
class C {
    function __toString(): string|Foo {}
    static function __set_state(array $a): iterable {}
    function __debugInfo(): string {}
}
===errors <=7.4===
A::__clone(): Return type must be void when declared
A::__set(): Return type must be void when declared
A::__unset(): Return type must be void when declared
'union types' requires PHP 8.0 or higher
A::__isset(): Return type must be bool when declared
A::__toString(): Return type must be string when declared
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
A::__debugInfo(): Return type must be ?array when declared
A::__serialize(): Return type must be array when declared
A::__unserialize(): Return type must be void when declared
A::__set_state(): Return type must be object when declared
A::__sleep(): Return type must be array when declared
'static type' requires PHP 8.0 or higher
A::__wakeup(): Return type must be void when declared
'static type' requires PHP 8.0 or higher
B::__toString(): Return type must be string when declared
'union types' requires PHP 8.0 or higher
C::__toString(): Return type must be string when declared
C::__set_state(): Return type must be object when declared
C::__debugInfo(): Return type must be ?array when declared
===errors >=8.0===
A::__clone(): Return type must be void when declared
A::__set(): Return type must be void when declared
A::__unset(): Return type must be void when declared
A::__isset(): Return type must be bool when declared
A::__toString(): Return type must be string when declared
A::__debugInfo(): Return type must be ?array when declared
A::__serialize(): Return type must be array when declared
A::__unserialize(): Return type must be void when declared
A::__set_state(): Return type must be object when declared
A::__sleep(): Return type must be array when declared
A::__wakeup(): Return type must be void when declared
B::__toString(): Return type must be string when declared
C::__toString(): Return type must be string when declared
C::__set_state(): Return type must be object when declared
C::__debugInfo(): Return type must be ?array when declared
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 6
===php_error >=8.0===
PHP Fatal error:  A::__clone(): Return type must be void when declared in Standard input code on line 3
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
                    "name": "__clone",
                    "span": {
                      "start": 29,
                      "end": 36
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 40,
                          "end": 43
                        }
                      }
                    },
                    "span": {
                      "start": 40,
                      "end": 43
                    }
                  },
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
                    "name": "__set",
                    "span": {
                      "start": 60,
                      "end": 65
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 66,
                          "end": 68
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 66,
                        "end": 68
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 70,
                          "end": 72
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 70,
                        "end": 72
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "mixed"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 75,
                          "end": 80
                        }
                      }
                    },
                    "span": {
                      "start": 75,
                      "end": 80
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 51,
                "end": 83
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unset",
                    "span": {
                      "start": 97,
                      "end": 104
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 105,
                          "end": 107
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 105,
                        "end": 107
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 111,
                              "end": 117
                            }
                          }
                        },
                        "span": {
                          "start": 111,
                          "end": 117
                        }
                      }
                    },
                    "span": {
                      "start": 110,
                      "end": 117
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 88,
                "end": 120
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__isset",
                    "span": {
                      "start": 134,
                      "end": 141
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 142,
                          "end": 144
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 142,
                        "end": 144
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "bool"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 147,
                                "end": 151
                              }
                            }
                          },
                          "span": {
                            "start": 147,
                            "end": 151
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 152,
                                "end": 155
                              }
                            }
                          },
                          "span": {
                            "start": 152,
                            "end": 155
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 147,
                      "end": 155
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 125,
                "end": 158
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 172,
                      "end": 182
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Stringable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 186,
                          "end": 196
                        }
                      }
                    },
                    "span": {
                      "start": 186,
                      "end": 196
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 163,
                "end": 199
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__debugInfo",
                    "span": {
                      "start": 213,
                      "end": 224
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
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
                                "start": 228,
                                "end": 236
                              }
                            }
                          },
                          "span": {
                            "start": 228,
                            "end": 236
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "null"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 237,
                                "end": 241
                              }
                            }
                          },
                          "span": {
                            "start": 237,
                            "end": 241
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 228,
                      "end": 241
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 204,
                "end": 244
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__serialize",
                    "span": {
                      "start": 258,
                      "end": 269
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 274,
                              "end": 279
                            }
                          }
                        },
                        "span": {
                          "start": 274,
                          "end": 279
                        }
                      }
                    },
                    "span": {
                      "start": 273,
                      "end": 279
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 249,
                "end": 282
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unserialize",
                    "span": {
                      "start": 296,
                      "end": 309
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 316,
                          "end": 318
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
                              "start": 310,
                              "end": 315
                            }
                          }
                        },
                        "span": {
                          "start": 310,
                          "end": 315
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 310,
                        "end": 318
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "bool"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 321,
                          "end": 325
                        }
                      }
                    },
                    "span": {
                      "start": 321,
                      "end": 325
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 287,
                "end": 328
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 349,
                      "end": 360
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
                          "start": 367,
                          "end": 369
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
                              "start": 361,
                              "end": 366
                            }
                          }
                        },
                        "span": {
                          "start": 361,
                          "end": 366
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 361,
                        "end": 369
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "object"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 373,
                              "end": 379
                            }
                          }
                        },
                        "span": {
                          "start": 373,
                          "end": 379
                        }
                      }
                    },
                    "span": {
                      "start": 372,
                      "end": 379
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 333,
                "end": 382
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__sleep",
                    "span": {
                      "start": 396,
                      "end": 403
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 407,
                          "end": 413
                        }
                      }
                    },
                    "span": {
                      "start": 407,
                      "end": 413
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 387,
                "end": 416
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__wakeup",
                    "span": {
                      "start": 430,
                      "end": 438
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 442,
                          "end": 448
                        }
                      }
                    },
                    "span": {
                      "start": 442,
                      "end": 448
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 421,
                "end": 451
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 453
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 460,
              "end": 461
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
                    "name": "__toString",
                    "span": {
                      "start": 477,
                      "end": 487
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 491,
                          "end": 497
                        }
                      }
                    },
                    "span": {
                      "start": 491,
                      "end": 497
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 468,
                "end": 500
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 454,
        "end": 502
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 509,
              "end": 510
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
                    "name": "__toString",
                    "span": {
                      "start": 526,
                      "end": 536
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 540,
                                "end": 546
                              }
                            }
                          },
                          "span": {
                            "start": 540,
                            "end": 546
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
                                "start": 547,
                                "end": 550
                              }
                            }
                          },
                          "span": {
                            "start": 547,
                            "end": 550
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 540,
                      "end": 550
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 517,
                "end": 553
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 574,
                      "end": 585
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
                          "start": 592,
                          "end": 594
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
                              "start": 586,
                              "end": 591
                            }
                          }
                        },
                        "span": {
                          "start": 586,
                          "end": 591
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 586,
                        "end": 594
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "iterable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 597,
                          "end": 605
                        }
                      }
                    },
                    "span": {
                      "start": 597,
                      "end": 605
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 558,
                "end": 608
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__debugInfo",
                    "span": {
                      "start": 622,
                      "end": 633
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 637,
                          "end": 643
                        }
                      }
                    },
                    "span": {
                      "start": 637,
                      "end": 643
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 613,
                "end": 646
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 503,
        "end": 648
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 648
  }
}
