===config===
min_php=8.5
===description===
#[NoDiscard] on void or never functions, constructors and property hooks.
===source===
<?php
#[NoDiscard] function f(): void {}
#[NoDiscard] function g(): never { exit; }
$c = #[NoDiscard] function (): void {};
$d = #[NoDiscard] fn(): never => exit;
class A {
    #[NoDiscard] public function __construct() {}
    #[NoDiscard] public function __CONSTRUCT2() {}
    #[NoDiscard] public function m(): void {}
    #[NoDiscard] public function n(): never { exit; }
    #[NoDiscard] public function ok(): int { return 1; }
}
class B {
    #[nodiscard] public function __Construct() {}
}
===errors===
A void function does not return a value, but #[\NoDiscard] requires a return value
A never returning function does not return a value, but #[\NoDiscard] requires a return value
A void function does not return a value, but #[\NoDiscard] requires a return value
A never returning function does not return a value, but #[\NoDiscard] requires a return value
Method A::__construct cannot be #[\NoDiscard]
A void method does not return a value, but #[\NoDiscard] requires a return value
A never returning method does not return a value, but #[\NoDiscard] requires a return value
Method B::__Construct cannot be #[\NoDiscard]
===php_error===
PHP Fatal error:  A void function does not return a value, but #[\NoDiscard] requires a return value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 28,
              "end": 29
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "void"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 33,
                  "end": 37
                }
              }
            },
            "span": {
              "start": 33,
              "end": 37
            }
          },
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 17
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 17
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 40
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 63,
              "end": 64
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Exit": null
                  },
                  "span": {
                    "start": 76,
                    "end": 80
                  }
                }
              },
              "span": {
                "start": 76,
                "end": 81
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
                  "start": 68,
                  "end": 73
                }
              }
            },
            "span": {
              "start": 68,
              "end": 73
            }
          },
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 43,
                  "end": 52
                }
              },
              "args": [],
              "span": {
                "start": 43,
                "end": 52
              }
            }
          ]
        }
      },
      "span": {
        "start": 54,
        "end": 83
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "c"
                },
                "span": {
                  "start": 84,
                  "end": 86
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "void"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 115,
                            "end": 119
                          }
                        }
                      },
                      "span": {
                        "start": 115,
                        "end": 119
                      }
                    },
                    "body": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "NoDiscard"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 91,
                            "end": 100
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 91,
                          "end": 100
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 89,
                  "end": 122
                }
              }
            }
          },
          "span": {
            "start": 84,
            "end": 122
          }
        }
      },
      "span": {
        "start": 84,
        "end": 123
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 124,
                  "end": 126
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
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
                            "start": 148,
                            "end": 153
                          }
                        }
                      },
                      "span": {
                        "start": 148,
                        "end": 153
                      }
                    },
                    "body": {
                      "kind": {
                        "Exit": null
                      },
                      "span": {
                        "start": 157,
                        "end": 161
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "NoDiscard"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 131,
                            "end": 140
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 131,
                          "end": 140
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 129,
                  "end": 161
                }
              }
            }
          },
          "span": {
            "start": 124,
            "end": 161
          }
        }
      },
      "span": {
        "start": 124,
        "end": 162
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 169,
              "end": 170
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
                      "start": 206,
                      "end": 217
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                        "kind": "Unqualified",
                        "span": {
                          "start": 179,
                          "end": 188
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 179,
                        "end": 188
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 177,
                "end": 222
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__CONSTRUCT2",
                    "span": {
                      "start": 256,
                      "end": 268
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                        "kind": "Unqualified",
                        "span": {
                          "start": 229,
                          "end": 238
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 229,
                        "end": 238
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 227,
                "end": 273
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 307,
                      "end": 308
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                          "start": 312,
                          "end": 316
                        }
                      }
                    },
                    "span": {
                      "start": 312,
                      "end": 316
                    }
                  },
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 280,
                          "end": 289
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 280,
                        "end": 289
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 278,
                "end": 319
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "n",
                    "span": {
                      "start": 353,
                      "end": 354
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                          "start": 358,
                          "end": 363
                        }
                      }
                    },
                    "span": {
                      "start": 358,
                      "end": 363
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Exit": null
                          },
                          "span": {
                            "start": 366,
                            "end": 370
                          }
                        }
                      },
                      "span": {
                        "start": 366,
                        "end": 371
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 326,
                          "end": 335
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 326,
                        "end": 335
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 324,
                "end": 373
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "ok",
                    "span": {
                      "start": 407,
                      "end": 409
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                          "start": 413,
                          "end": 416
                        }
                      }
                    },
                    "span": {
                      "start": 413,
                      "end": 416
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
                            "start": 426,
                            "end": 427
                          }
                        }
                      },
                      "span": {
                        "start": 419,
                        "end": 428
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 380,
                          "end": 389
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 380,
                        "end": 389
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 378,
                "end": 430
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 163,
        "end": 432
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 439,
              "end": 440
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
                    "name": "__Construct",
                    "span": {
                      "start": 476,
                      "end": 487
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "nodiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 449,
                          "end": 458
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 449,
                        "end": 458
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 447,
                "end": 492
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 433,
        "end": 494
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 494
  }
}
