===description===
Magic method signatures PHP accepts: untyped, widened and union types, never returns, extra variadics, and methods without signature rules.
===source===
<?php
class A {
    public function __construct(&$a, ...$b) {}
    private function __destruct() {}
    private function __clone(): void {}
    public function __get(string|int $n): int { return 1; }
    function __set(mixed $n, $v): never {}
    function __unset(?string $n): void {}
    function __isset($n): true {}
    function __call(string $n, iterable $a, ...$rest) {}
    static function __callStatic($n, ?array $a): int {}
    function __toString(...$rest): string {}
    function __debugInfo(): null {}
    function __serialize(): array {}
    function __unserialize(array|Foo $a) {}
    static function __set_state(array $a): static|A|(B&C) {}
    function __invoke(&$a, int $b): int {}
    function __sleep(): never {}
    function __wakeup(): void {}
    function __other(&$a): int {}
}
class B {
    function __isset($n): false {}
    function __debugInfo(): ?array {}
    static function __set_state($a): object {}
    function __get((Foo&Bar)|string $n) {}
}
interface I {
    function __toString(): string;
    static function __set_state(array $a): self;
}
enum E {
    function __call($n, $a) {}
}
function __get() {}
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
                    "name": "__construct",
                    "span": {
                      "start": 36,
                      "end": 47
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
                          "start": 49,
                          "end": 51
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 48,
                        "end": 51
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 56,
                          "end": 58
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "attributes": [],
                      "span": {
                        "start": 53,
                        "end": 58
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
                "end": 62
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__destruct",
                    "span": {
                      "start": 84,
                      "end": 94
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 67,
                "end": 99
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__clone",
                    "span": {
                      "start": 121,
                      "end": 128
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 132,
                          "end": 136
                        }
                      }
                    },
                    "span": {
                      "start": 132,
                      "end": 136
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 104,
                "end": 139
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__get",
                    "span": {
                      "start": 160,
                      "end": 165
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 177,
                          "end": 179
                        }
                      },
                      "type_hint": {
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
                                    "start": 166,
                                    "end": 172
                                  }
                                }
                              },
                              "span": {
                                "start": 166,
                                "end": 172
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
                                    "start": 173,
                                    "end": 176
                                  }
                                }
                              },
                              "span": {
                                "start": 173,
                                "end": 176
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 166,
                          "end": 176
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 166,
                        "end": 179
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 182,
                          "end": 185
                        }
                      }
                    },
                    "span": {
                      "start": 182,
                      "end": 185
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 195,
                            "end": 196
                          }
                        }
                      },
                      "span": {
                        "start": 188,
                        "end": 197
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 144,
                "end": 199
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 213,
                      "end": 218
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 225,
                          "end": 227
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "mixed"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 219,
                              "end": 224
                            }
                          }
                        },
                        "span": {
                          "start": 219,
                          "end": 224
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 219,
                        "end": 227
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 229,
                          "end": 231
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 229,
                        "end": 231
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 234,
                          "end": 239
                        }
                      }
                    },
                    "span": {
                      "start": 234,
                      "end": 239
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 204,
                "end": 242
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unset",
                    "span": {
                      "start": 256,
                      "end": 263
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 272,
                          "end": 274
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Nullable": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "string"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 265,
                                  "end": 271
                                }
                              }
                            },
                            "span": {
                              "start": 265,
                              "end": 271
                            }
                          }
                        },
                        "span": {
                          "start": 264,
                          "end": 271
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 264,
                        "end": 274
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 277,
                          "end": 281
                        }
                      }
                    },
                    "span": {
                      "start": 277,
                      "end": 281
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 247,
                "end": 284
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__isset",
                    "span": {
                      "start": 298,
                      "end": 305
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 306,
                          "end": 308
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 306,
                        "end": 308
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "true"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 311,
                          "end": 315
                        }
                      }
                    },
                    "span": {
                      "start": 311,
                      "end": 315
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 289,
                "end": 318
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 332,
                      "end": 338
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 346,
                          "end": 348
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
                              "start": 339,
                              "end": 345
                            }
                          }
                        },
                        "span": {
                          "start": 339,
                          "end": 345
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 339,
                        "end": 348
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 359,
                          "end": 361
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
                              "start": 350,
                              "end": 358
                            }
                          }
                        },
                        "span": {
                          "start": 350,
                          "end": 358
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 350,
                        "end": 361
                      }
                    },
                    {
                      "name": {
                        "name": "rest",
                        "span": {
                          "start": 366,
                          "end": 371
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "attributes": [],
                      "span": {
                        "start": 363,
                        "end": 371
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 323,
                "end": 375
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__callStatic",
                    "span": {
                      "start": 396,
                      "end": 408
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
                          "start": 409,
                          "end": 411
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 409,
                        "end": 411
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 420,
                          "end": 422
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Nullable": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "array"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 414,
                                  "end": 419
                                }
                              }
                            },
                            "span": {
                              "start": 414,
                              "end": 419
                            }
                          }
                        },
                        "span": {
                          "start": 413,
                          "end": 419
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 413,
                        "end": 422
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 425,
                          "end": 428
                        }
                      }
                    },
                    "span": {
                      "start": 425,
                      "end": 428
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 380,
                "end": 431
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 445,
                      "end": 455
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "rest",
                        "span": {
                          "start": 459,
                          "end": 464
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "attributes": [],
                      "span": {
                        "start": 456,
                        "end": 464
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 467,
                          "end": 473
                        }
                      }
                    },
                    "span": {
                      "start": 467,
                      "end": 473
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 436,
                "end": 476
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__debugInfo",
                    "span": {
                      "start": 490,
                      "end": 501
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "null"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 505,
                          "end": 509
                        }
                      }
                    },
                    "span": {
                      "start": 505,
                      "end": 509
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 481,
                "end": 512
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__serialize",
                    "span": {
                      "start": 526,
                      "end": 537
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 541,
                          "end": 546
                        }
                      }
                    },
                    "span": {
                      "start": 541,
                      "end": 546
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 517,
                "end": 549
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unserialize",
                    "span": {
                      "start": 563,
                      "end": 576
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 587,
                          "end": 589
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "array"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 577,
                                    "end": 582
                                  }
                                }
                              },
                              "span": {
                                "start": 577,
                                "end": 582
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
                                    "start": 583,
                                    "end": 586
                                  }
                                }
                              },
                              "span": {
                                "start": 583,
                                "end": 586
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 577,
                          "end": 586
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 577,
                        "end": 589
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 554,
                "end": 593
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 614,
                      "end": 625
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
                          "start": 632,
                          "end": 634
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
                              "start": 626,
                              "end": 631
                            }
                          }
                        },
                        "span": {
                          "start": 626,
                          "end": 631
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 626,
                        "end": 634
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
                                "static"
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
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 644,
                                "end": 645
                              }
                            }
                          },
                          "span": {
                            "start": 644,
                            "end": 645
                          }
                        },
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "B"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 647,
                                      "end": 648
                                    }
                                  }
                                },
                                "span": {
                                  "start": 647,
                                  "end": 648
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "C"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 649,
                                      "end": 650
                                    }
                                  }
                                },
                                "span": {
                                  "start": 649,
                                  "end": 650
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 646,
                            "end": 651
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 637,
                      "end": 651
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 598,
                "end": 654
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__invoke",
                    "span": {
                      "start": 668,
                      "end": 676
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 678,
                          "end": 680
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 677,
                        "end": 680
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 686,
                          "end": 688
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
                              "start": 682,
                              "end": 685
                            }
                          }
                        },
                        "span": {
                          "start": 682,
                          "end": 685
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 682,
                        "end": 688
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 691,
                          "end": 694
                        }
                      }
                    },
                    "span": {
                      "start": 691,
                      "end": 694
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 659,
                "end": 697
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__sleep",
                    "span": {
                      "start": 711,
                      "end": 718
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 722,
                          "end": 727
                        }
                      }
                    },
                    "span": {
                      "start": 722,
                      "end": 727
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 702,
                "end": 730
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__wakeup",
                    "span": {
                      "start": 744,
                      "end": 752
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 756,
                          "end": 760
                        }
                      }
                    },
                    "span": {
                      "start": 756,
                      "end": 760
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 735,
                "end": 763
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__other",
                    "span": {
                      "start": 777,
                      "end": 784
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 786,
                          "end": 788
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 785,
                        "end": 788
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 791,
                          "end": 794
                        }
                      }
                    },
                    "span": {
                      "start": 791,
                      "end": 794
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 768,
                "end": 797
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 799
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 806,
              "end": 807
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
                    "name": "__isset",
                    "span": {
                      "start": 823,
                      "end": 830
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 831,
                          "end": 833
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 831,
                        "end": 833
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "false"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 836,
                          "end": 841
                        }
                      }
                    },
                    "span": {
                      "start": 836,
                      "end": 841
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 814,
                "end": 844
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__debugInfo",
                    "span": {
                      "start": 858,
                      "end": 869
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
                              "start": 874,
                              "end": 879
                            }
                          }
                        },
                        "span": {
                          "start": 874,
                          "end": 879
                        }
                      }
                    },
                    "span": {
                      "start": 873,
                      "end": 879
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 849,
                "end": 882
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 903,
                      "end": 914
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
                          "start": 915,
                          "end": 917
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 915,
                        "end": 917
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "object"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 920,
                          "end": 926
                        }
                      }
                    },
                    "span": {
                      "start": 920,
                      "end": 926
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 887,
                "end": 929
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__get",
                    "span": {
                      "start": 943,
                      "end": 948
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 966,
                          "end": 968
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
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
                                          "start": 950,
                                          "end": 953
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 950,
                                      "end": 953
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
                                          "start": 954,
                                          "end": 957
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 954,
                                      "end": 957
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 949,
                                "end": 958
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "string"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 959,
                                    "end": 965
                                  }
                                }
                              },
                              "span": {
                                "start": 959,
                                "end": 965
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 949,
                          "end": 965
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 949,
                        "end": 968
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 934,
                "end": 972
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 800,
        "end": 974
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 985,
              "end": 986
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 1002,
                      "end": 1012
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
                          "start": 1016,
                          "end": 1022
                        }
                      }
                    },
                    "span": {
                      "start": 1016,
                      "end": 1022
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 993,
                "end": 1023
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 1044,
                      "end": 1055
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
                          "start": 1062,
                          "end": 1064
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
                              "start": 1056,
                              "end": 1061
                            }
                          }
                        },
                        "span": {
                          "start": 1056,
                          "end": 1061
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1056,
                        "end": 1064
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 1067,
                          "end": 1071
                        }
                      }
                    },
                    "span": {
                      "start": 1067,
                      "end": 1071
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 1028,
                "end": 1072
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 975,
        "end": 1074
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 1080,
              "end": 1081
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 1097,
                      "end": 1103
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 1104,
                          "end": 1106
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1104,
                        "end": 1106
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 1108,
                          "end": 1110
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1108,
                        "end": 1110
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 1088,
                "end": 1114
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1075,
        "end": 1116
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "__get",
            "span": {
              "start": 1126,
              "end": 1131
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 1117,
        "end": 1136
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1136
  }
}
