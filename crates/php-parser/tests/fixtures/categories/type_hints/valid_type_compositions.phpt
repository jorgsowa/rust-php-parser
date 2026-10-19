===config===
min_php=8.3

===source===
<?php
namespace N {
    use X\A;
    use function X\B;
    function a(): \A|A {}
    function bb(B $b): \B|B {}
    function c(): iterable|\Traversable\X|Traversable {}
}
namespace {
    function d(): ?false {}
    function e(): ?true {}
    function f(): object|iterable|callable|null {}
    function g(): (A&B)|(A&C)|(B&C)|D {}
    function h(callable $h, ?callable $i): callable {}
    $j = function (): static|null {};
    class K extends P implements I {
        const int|string|null L = null;
        const ?self M = null;
        public ?Closure $n;
        public function o(): self&I {}
        public function p(): (self&I)|(parent&J)|null {}
        public function q(): self|parent {}
        public function r() {
            return [function (): K|self {}, fn(): P|parent => 1];
        }
    }
    trait T {
        public function s(): T|self {}
    }
    interface I {
        public function t(): I|J;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "X",
                            "A"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 28,
                            "end": 31
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 28,
                          "end": 31
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 24,
                  "end": 32
                }
              },
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "X",
                            "B"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 50,
                            "end": 53
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 50,
                          "end": 53
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 37,
                  "end": 54
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 68,
                        "end": 69
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Union": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "A"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 73,
                                  "end": 75
                                }
                              }
                            },
                            "span": {
                              "start": 73,
                              "end": 75
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
                                  "start": 76,
                                  "end": 77
                                }
                              }
                            },
                            "span": {
                              "start": 76,
                              "end": 77
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 73,
                        "end": 77
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 59,
                  "end": 80
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "bb",
                      "span": {
                        "start": 94,
                        "end": 96
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 99,
                            "end": 101
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 97,
                                "end": 98
                              }
                            }
                          },
                          "span": {
                            "start": 97,
                            "end": 98
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
                          "start": 97,
                          "end": 101
                        }
                      }
                    ],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Union": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 104,
                                  "end": 106
                                }
                              }
                            },
                            "span": {
                              "start": 104,
                              "end": 106
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 107,
                                  "end": 108
                                }
                              }
                            },
                            "span": {
                              "start": 107,
                              "end": 108
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 104,
                        "end": 108
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 85,
                  "end": 111
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "c",
                      "span": {
                        "start": 125,
                        "end": 126
                      }
                    },
                    "params": [],
                    "body": [],
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
                                  "start": 130,
                                  "end": 138
                                }
                              }
                            },
                            "span": {
                              "start": 130,
                              "end": 138
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Traversable",
                                  "X"
                                ],
                                "kind": "FullyQualified",
                                "span": {
                                  "start": 139,
                                  "end": 153
                                }
                              }
                            },
                            "span": {
                              "start": 139,
                              "end": 153
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Traversable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 154,
                                  "end": 165
                                }
                              }
                            },
                            "span": {
                              "start": 154,
                              "end": 165
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 130,
                        "end": 165
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 116,
                  "end": 168
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 170
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "d",
                      "span": {
                        "start": 196,
                        "end": 197
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Nullable": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "false"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 202,
                                "end": 207
                              }
                            }
                          },
                          "span": {
                            "start": 202,
                            "end": 207
                          }
                        }
                      },
                      "span": {
                        "start": 201,
                        "end": 207
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 187,
                  "end": 210
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "e",
                      "span": {
                        "start": 224,
                        "end": 225
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Nullable": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "true"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 230,
                                "end": 234
                              }
                            }
                          },
                          "span": {
                            "start": 230,
                            "end": 234
                          }
                        }
                      },
                      "span": {
                        "start": 229,
                        "end": 234
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 215,
                  "end": 237
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 251,
                        "end": 252
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Union": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "object"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 256,
                                  "end": 262
                                }
                              }
                            },
                            "span": {
                              "start": 256,
                              "end": 262
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "iterable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 263,
                                  "end": 271
                                }
                              }
                            },
                            "span": {
                              "start": 263,
                              "end": 271
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "callable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 272,
                                  "end": 280
                                }
                              }
                            },
                            "span": {
                              "start": 272,
                              "end": 280
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
                                  "start": 281,
                                  "end": 285
                                }
                              }
                            },
                            "span": {
                              "start": 281,
                              "end": 285
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 256,
                        "end": 285
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 242,
                  "end": 288
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "g",
                      "span": {
                        "start": 302,
                        "end": 303
                      }
                    },
                    "params": [],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Union": [
                          {
                            "kind": {
                              "Intersection": [
                                {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "A"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 308,
                                        "end": 309
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 308,
                                    "end": 309
                                  }
                                },
                                {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "B"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 310,
                                        "end": 311
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 310,
                                    "end": 311
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 307,
                              "end": 312
                            }
                          },
                          {
                            "kind": {
                              "Intersection": [
                                {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "A"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 314,
                                        "end": 315
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 314,
                                    "end": 315
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
                                        "start": 316,
                                        "end": 317
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 316,
                                    "end": 317
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 313,
                              "end": 318
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
                                        "start": 320,
                                        "end": 321
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 320,
                                    "end": 321
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
                                        "start": 322,
                                        "end": 323
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 322,
                                    "end": 323
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 319,
                              "end": 324
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "D"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 325,
                                  "end": 326
                                }
                              }
                            },
                            "span": {
                              "start": 325,
                              "end": 326
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 307,
                        "end": 326
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 293,
                  "end": 329
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "h",
                      "span": {
                        "start": 343,
                        "end": 344
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "h",
                          "span": {
                            "start": 354,
                            "end": 356
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
                                "start": 345,
                                "end": 353
                              }
                            }
                          },
                          "span": {
                            "start": 345,
                            "end": 353
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
                          "start": 345,
                          "end": 356
                        }
                      },
                      {
                        "name": {
                          "name": "i",
                          "span": {
                            "start": 368,
                            "end": 370
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Nullable": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "callable"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 359,
                                    "end": 367
                                  }
                                }
                              },
                              "span": {
                                "start": 359,
                                "end": 367
                              }
                            }
                          },
                          "span": {
                            "start": 358,
                            "end": 367
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
                          "start": 358,
                          "end": 370
                        }
                      }
                    ],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "callable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 373,
                            "end": 381
                          }
                        }
                      },
                      "span": {
                        "start": 373,
                        "end": 381
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 334,
                  "end": 384
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "Variable": "j"
                          },
                          "span": {
                            "start": 389,
                            "end": 391
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
                                  "Union": [
                                    {
                                      "kind": {
                                        "Named": {
                                          "parts": [
                                            "static"
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
                                    {
                                      "kind": {
                                        "Named": {
                                          "parts": [
                                            "null"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 414,
                                            "end": 418
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 414,
                                        "end": 418
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 407,
                                  "end": 418
                                }
                              },
                              "body": [],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 394,
                            "end": 421
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 389,
                      "end": 421
                    }
                  }
                },
                "span": {
                  "start": 389,
                  "end": 422
                }
              },
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "K",
                      "span": {
                        "start": 433,
                        "end": 434
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "P"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 443,
                        "end": 444
                      }
                    },
                    "implements": [
                      {
                        "parts": [
                          "I"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 456,
                          "end": 457
                        }
                      }
                    ],
                    "members": [
                      {
                        "kind": {
                          "ClassConst": {
                            "name": {
                              "name": "L",
                              "span": {
                                "start": 490,
                                "end": 491
                              }
                            },
                            "visibility": null,
                            "is_final": false,
                            "type_hint": {
                              "kind": {
                                "Union": [
                                  {
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
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "string"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 478,
                                          "end": 484
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 478,
                                      "end": 484
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
                                          "start": 485,
                                          "end": 489
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 485,
                                      "end": 489
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 474,
                                "end": 489
                              }
                            },
                            "value": {
                              "kind": "Null",
                              "span": {
                                "start": 494,
                                "end": 498
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 468,
                          "end": 499
                        }
                      },
                      {
                        "kind": {
                          "ClassConst": {
                            "name": {
                              "name": "M",
                              "span": {
                                "start": 520,
                                "end": 521
                              }
                            },
                            "visibility": null,
                            "is_final": false,
                            "type_hint": {
                              "kind": {
                                "Nullable": {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "self"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 515,
                                        "end": 519
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 515,
                                    "end": 519
                                  }
                                }
                              },
                              "span": {
                                "start": 514,
                                "end": 519
                              }
                            },
                            "value": {
                              "kind": "Null",
                              "span": {
                                "start": 524,
                                "end": 528
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 508,
                          "end": 529
                        }
                      },
                      {
                        "kind": {
                          "Property": {
                            "name": {
                              "name": "n",
                              "span": {
                                "start": 554,
                                "end": 556
                              }
                            },
                            "visibility": "Public",
                            "set_visibility": null,
                            "is_static": false,
                            "is_readonly": false,
                            "type_hint": {
                              "kind": {
                                "Nullable": {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "Closure"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 546,
                                        "end": 553
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 546,
                                    "end": 553
                                  }
                                }
                              },
                              "span": {
                                "start": 545,
                                "end": 553
                              }
                            },
                            "default": null,
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 538,
                          "end": 556
                        }
                      },
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "o",
                              "span": {
                                "start": 582,
                                "end": 583
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
                                "Intersection": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "self"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 587,
                                          "end": 591
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 587,
                                      "end": 591
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "I"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 592,
                                          "end": 593
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 592,
                                      "end": 593
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 587,
                                "end": 593
                              }
                            },
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 566,
                          "end": 596
                        }
                      },
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "p",
                              "span": {
                                "start": 621,
                                "end": 622
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
                                "Union": [
                                  {
                                    "kind": {
                                      "Intersection": [
                                        {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "self"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 627,
                                                "end": 631
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 627,
                                            "end": 631
                                          }
                                        },
                                        {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "I"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 632,
                                                "end": 633
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 632,
                                            "end": 633
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 626,
                                      "end": 634
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Intersection": [
                                        {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "parent"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 636,
                                                "end": 642
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 636,
                                            "end": 642
                                          }
                                        },
                                        {
                                          "kind": {
                                            "Named": {
                                              "parts": [
                                                "J"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 643,
                                                "end": 644
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 643,
                                            "end": 644
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 635,
                                      "end": 645
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
                                          "start": 646,
                                          "end": 650
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 646,
                                      "end": 650
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 626,
                                "end": 650
                              }
                            },
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 605,
                          "end": 653
                        }
                      },
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "q",
                              "span": {
                                "start": 678,
                                "end": 679
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
                                "Union": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "self"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 683,
                                          "end": 687
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 683,
                                      "end": 687
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "parent"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 688,
                                          "end": 694
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 688,
                                      "end": 694
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 683,
                                "end": 694
                              }
                            },
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 662,
                          "end": 697
                        }
                      },
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "r",
                              "span": {
                                "start": 722,
                                "end": 723
                              }
                            },
                            "visibility": "Public",
                            "is_static": false,
                            "is_abstract": false,
                            "is_final": false,
                            "by_ref": false,
                            "params": [],
                            "return_type": null,
                            "body": [
                              {
                                "kind": {
                                  "Return": {
                                    "kind": {
                                      "Array": [
                                        {
                                          "key": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "Closure": {
                                                  "is_static": false,
                                                  "by_ref": false,
                                                  "params": [],
                                                  "use_vars": [],
                                                  "return_type": {
                                                    "kind": {
                                                      "Union": [
                                                        {
                                                          "kind": {
                                                            "Named": {
                                                              "parts": [
                                                                "K"
                                                              ],
                                                              "kind": "Unqualified",
                                                              "span": {
                                                                "start": 761,
                                                                "end": 762
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 761,
                                                            "end": 762
                                                          }
                                                        },
                                                        {
                                                          "kind": {
                                                            "Named": {
                                                              "parts": [
                                                                "self"
                                                              ],
                                                              "kind": "Unqualified",
                                                              "span": {
                                                                "start": 763,
                                                                "end": 767
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 763,
                                                            "end": 767
                                                          }
                                                        }
                                                      ]
                                                    },
                                                    "span": {
                                                      "start": 761,
                                                      "end": 767
                                                    }
                                                  },
                                                  "body": [],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 748,
                                                "end": 770
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 748,
                                            "end": 770
                                          }
                                        },
                                        {
                                          "key": null,
                                          "kind": {
                                            "Value": {
                                              "kind": {
                                                "ArrowFunction": {
                                                  "is_static": false,
                                                  "by_ref": false,
                                                  "params": [],
                                                  "return_type": {
                                                    "kind": {
                                                      "Union": [
                                                        {
                                                          "kind": {
                                                            "Named": {
                                                              "parts": [
                                                                "P"
                                                              ],
                                                              "kind": "Unqualified",
                                                              "span": {
                                                                "start": 778,
                                                                "end": 779
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 778,
                                                            "end": 779
                                                          }
                                                        },
                                                        {
                                                          "kind": {
                                                            "Named": {
                                                              "parts": [
                                                                "parent"
                                                              ],
                                                              "kind": "Unqualified",
                                                              "span": {
                                                                "start": 780,
                                                                "end": 786
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 780,
                                                            "end": 786
                                                          }
                                                        }
                                                      ]
                                                    },
                                                    "span": {
                                                      "start": 778,
                                                      "end": 786
                                                    }
                                                  },
                                                  "body": {
                                                    "kind": {
                                                      "Int": 1
                                                    },
                                                    "span": {
                                                      "start": 790,
                                                      "end": 791
                                                    }
                                                  },
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 772,
                                                "end": 791
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 772,
                                            "end": 791
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 747,
                                      "end": 792
                                    }
                                  }
                                },
                                "span": {
                                  "start": 740,
                                  "end": 793
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 706,
                          "end": 803
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 427,
                  "end": 809
                }
              },
              {
                "kind": {
                  "Trait": {
                    "name": {
                      "name": "T",
                      "span": {
                        "start": 820,
                        "end": 821
                      }
                    },
                    "members": [
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "s",
                              "span": {
                                "start": 848,
                                "end": 849
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
                                "Union": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "T"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 853,
                                          "end": 854
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 853,
                                      "end": 854
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "self"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 855,
                                          "end": 859
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 855,
                                      "end": 859
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 853,
                                "end": 859
                              }
                            },
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 832,
                          "end": 862
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 814,
                  "end": 868
                }
              },
              {
                "kind": {
                  "Interface": {
                    "name": {
                      "name": "I",
                      "span": {
                        "start": 883,
                        "end": 884
                      }
                    },
                    "extends": [],
                    "members": [
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "t",
                              "span": {
                                "start": 911,
                                "end": 912
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
                                "Union": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "I"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 916,
                                          "end": 917
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 916,
                                      "end": 917
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "J"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 918,
                                          "end": 919
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 918,
                                      "end": 919
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 916,
                                "end": 919
                              }
                            },
                            "body": null,
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 895,
                          "end": 920
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 873,
                  "end": 926
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 171,
        "end": 928
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 928
  }
}
