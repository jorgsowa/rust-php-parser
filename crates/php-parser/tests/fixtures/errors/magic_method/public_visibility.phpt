===description===
PHP warns (does not fatal) when a magic method other than __construct, __destruct and __clone is not public.
===source===
<?php
class A {
    private function __get($n) {}
    protected function __set($n, $v) {}
    private function __unset($n) {}
    protected function __isset($n) {}
    private function __call($n, $a) {}
    protected static function __callStatic($n, $a) {}
    private function __toString(): string {}
    private function __debugInfo() {}
    private function __serialize(): array {}
    private function __unserialize(array $a) {}
    private static function __set_state(array $a) {}
    private function __invoke() {}
    private function __sleep() {}
    private function __wakeup() {}
    private function __construct() {}
    private function __destruct() {}
    private function __clone() {}
}
===errors===
The magic method A::__get() must have public visibility
The magic method A::__set() must have public visibility
The magic method A::__unset() must have public visibility
The magic method A::__isset() must have public visibility
The magic method A::__call() must have public visibility
The magic method A::__callStatic() must have public visibility
The magic method A::__toString() must have public visibility
The magic method A::__debugInfo() must have public visibility
The magic method A::__serialize() must have public visibility
The magic method A::__unserialize() must have public visibility
The magic method A::__set_state() must have public visibility
The magic method A::__invoke() must have public visibility
The magic method A::__sleep() must have public visibility
The magic method A::__wakeup() must have public visibility
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
                      "start": 37,
                      "end": 42
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
                        "name": "n",
                        "span": {
                          "start": 43,
                          "end": 45
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
                        "start": 43,
                        "end": 45
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
                "end": 49
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set",
                    "span": {
                      "start": 73,
                      "end": 78
                    }
                  },
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 79,
                          "end": 81
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
                        "start": 79,
                        "end": 81
                      }
                    },
                    {
                      "name": {
                        "name": "v",
                        "span": {
                          "start": 83,
                          "end": 85
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
                        "start": 83,
                        "end": 85
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 89
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unset",
                    "span": {
                      "start": 111,
                      "end": 118
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
                        "name": "n",
                        "span": {
                          "start": 119,
                          "end": 121
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
                        "start": 119,
                        "end": 121
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 94,
                "end": 125
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__isset",
                    "span": {
                      "start": 149,
                      "end": 156
                    }
                  },
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 157,
                          "end": 159
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
                        "start": 157,
                        "end": 159
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 130,
                "end": 163
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__call",
                    "span": {
                      "start": 185,
                      "end": 191
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
                        "name": "n",
                        "span": {
                          "start": 192,
                          "end": 194
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
                        "start": 192,
                        "end": 194
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 196,
                          "end": 198
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
                        "start": 196,
                        "end": 198
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 168,
                "end": 202
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__callStatic",
                    "span": {
                      "start": 233,
                      "end": 245
                    }
                  },
                  "visibility": "Protected",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "n",
                        "span": {
                          "start": 246,
                          "end": 248
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
                        "start": 246,
                        "end": 248
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 250,
                          "end": 252
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
                        "start": 250,
                        "end": 252
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 207,
                "end": 256
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__toString",
                    "span": {
                      "start": 278,
                      "end": 288
                    }
                  },
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                          "start": 292,
                          "end": 298
                        }
                      }
                    },
                    "span": {
                      "start": 292,
                      "end": 298
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 261,
                "end": 301
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__debugInfo",
                    "span": {
                      "start": 323,
                      "end": 334
                    }
                  },
                  "visibility": "Private",
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
                "start": 306,
                "end": 339
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__serialize",
                    "span": {
                      "start": 361,
                      "end": 372
                    }
                  },
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                          "start": 376,
                          "end": 381
                        }
                      }
                    },
                    "span": {
                      "start": 376,
                      "end": 381
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 344,
                "end": 384
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__unserialize",
                    "span": {
                      "start": 406,
                      "end": 419
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
                        "name": "a",
                        "span": {
                          "start": 426,
                          "end": 428
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
                              "start": 420,
                              "end": 425
                            }
                          }
                        },
                        "span": {
                          "start": 420,
                          "end": 425
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
                        "start": 420,
                        "end": 428
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 389,
                "end": 432
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__set_state",
                    "span": {
                      "start": 461,
                      "end": 472
                    }
                  },
                  "visibility": "Private",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 479,
                          "end": 481
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
                              "start": 473,
                              "end": 478
                            }
                          }
                        },
                        "span": {
                          "start": 473,
                          "end": 478
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
                        "start": 473,
                        "end": 481
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 437,
                "end": 485
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__invoke",
                    "span": {
                      "start": 507,
                      "end": 515
                    }
                  },
                  "visibility": "Private",
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
                "start": 490,
                "end": 520
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__sleep",
                    "span": {
                      "start": 542,
                      "end": 549
                    }
                  },
                  "visibility": "Private",
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
                "start": 525,
                "end": 554
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__wakeup",
                    "span": {
                      "start": 576,
                      "end": 584
                    }
                  },
                  "visibility": "Private",
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
                "start": 559,
                "end": 589
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 611,
                      "end": 622
                    }
                  },
                  "visibility": "Private",
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
                "start": 594,
                "end": 627
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__destruct",
                    "span": {
                      "start": 649,
                      "end": 659
                    }
                  },
                  "visibility": "Private",
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
                "start": 632,
                "end": 664
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__clone",
                    "span": {
                      "start": 686,
                      "end": 693
                    }
                  },
                  "visibility": "Private",
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
                "start": 669,
                "end": 698
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 700
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 700
  }
}
