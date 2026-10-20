===source===
<?php
class A {
    public readonly int $a = 1;
    public readonly int $b, $c = 2;
    public function __construct(
        public readonly int $d = 3,
        readonly $e,
        public readonly int $f { get => 1; },
    ) {}
}
readonly class B {
    public int $g = 4;
    public static int $h;
    public int $i { get => 1; }
    public readonly $j;
    public function __construct(public int $k { get => 1; }, public readonly $l) {}
}
$x = new readonly class { public int $m = 5; };
===errors===
Readonly property cannot have default value
Readonly property cannot have default value
readonly promoted property must have type
A readonly property cannot declare hooks
readonly property must have type
readonly promoted property must have type
Readonly property cannot have default value
static properties cannot be readonly
A readonly property cannot declare hooks
A readonly property cannot declare hooks
Readonly property cannot have default value
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "int", expecting variable in Standard input code on line 3
===php_error 8.1-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting ")" in Standard input code on line 8
===php_error 8.4-8.5===
PHP Fatal error:  Readonly property A::$a cannot have default value in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  Readonly property A::$e must have type in Standard input code on line 7
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 36,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 39
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 45,
                      "end": 46
                    }
                  },
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
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 72,
                      "end": 74
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 68,
                          "end": 71
                        }
                      }
                    },
                    "span": {
                      "start": 68,
                      "end": 71
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 74
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 76,
                      "end": 78
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 68,
                          "end": 71
                        }
                      }
                    },
                    "span": {
                      "start": 68,
                      "end": 71
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 81,
                      "end": 82
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 82
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 104,
                      "end": 115
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "d",
                        "span": {
                          "start": 145,
                          "end": 147
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
                      "default": {
                        "kind": {
                          "Int": 3
                        },
                        "span": {
                          "start": 150,
                          "end": 151
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 125,
                        "end": 151
                      }
                    },
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 170,
                          "end": 172
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 161,
                        "end": 172
                      }
                    },
                    {
                      "name": {
                        "name": "f",
                        "span": {
                          "start": 202,
                          "end": 204
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
                              "start": 198,
                              "end": 201
                            }
                          }
                        },
                        "span": {
                          "start": 198,
                          "end": 201
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 214,
                                "end": 215
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 207,
                            "end": 216
                          }
                        }
                      ],
                      "span": {
                        "start": 182,
                        "end": 218
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 88,
                "end": 228
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 230
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 246,
              "end": 247
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 265,
                      "end": 267
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 261,
                          "end": 264
                        }
                      }
                    },
                    "span": {
                      "start": 261,
                      "end": 264
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 270,
                      "end": 271
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 254,
                "end": 271
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 295,
                      "end": 297
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 291,
                          "end": 294
                        }
                      }
                    },
                    "span": {
                      "start": 291,
                      "end": 294
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 277,
                "end": 297
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 314,
                      "end": 316
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 310,
                          "end": 313
                        }
                      }
                    },
                    "span": {
                      "start": 310,
                      "end": 313
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 326,
                            "end": 327
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 319,
                        "end": 328
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 303,
                "end": 330
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "j",
                    "span": {
                      "start": 351,
                      "end": 353
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 335,
                "end": 353
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 375,
                      "end": 386
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "k",
                        "span": {
                          "start": 398,
                          "end": 400
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
                              "start": 394,
                              "end": 397
                            }
                          }
                        },
                        "span": {
                          "start": 394,
                          "end": 397
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 410,
                                "end": 411
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 403,
                            "end": 412
                          }
                        }
                      ],
                      "span": {
                        "start": 387,
                        "end": 414
                      }
                    },
                    {
                      "name": {
                        "name": "l",
                        "span": {
                          "start": 432,
                          "end": 434
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 416,
                        "end": 434
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 359,
                "end": 438
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 240,
        "end": 440
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 441,
                  "end": 443
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": true
                          },
                          "extends": null,
                          "implements": [],
                          "members": [
                            {
                              "kind": {
                                "Property": {
                                  "name": {
                                    "name": "m",
                                    "span": {
                                      "start": 478,
                                      "end": 480
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Public"
                                  },
                                  "type_hint": {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "int"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 474,
                                          "end": 477
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 474,
                                      "end": 477
                                    }
                                  },
                                  "default": {
                                    "kind": {
                                      "Int": 5
                                    },
                                    "span": {
                                      "start": 483,
                                      "end": 484
                                    }
                                  },
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 467,
                                "end": 484
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 446,
                        "end": 487
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 446,
                  "end": 487
                }
              }
            }
          },
          "span": {
            "start": 441,
            "end": 487
          }
        }
      },
      "span": {
        "start": 441,
        "end": 488
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 488
  }
}
