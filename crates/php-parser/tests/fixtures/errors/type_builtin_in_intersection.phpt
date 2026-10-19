===config===
min_php=8.2

===source===
<?php
function a(): int&A {}
function b(): A&array {}
function c(): callable&A {}
function d(): A&null {}
function e(): false&A {}
function f(): (bool&A)|B {}
function g(): iterable&A {}
function h(): object&A {}
function i(): A&void {}
function j(): never&A {}
function o(A&true $o) {}
class C {
    public function k(): static&A {}
}
trait T {
    public function l(): SELF&A {}
    public function m(): A&parent {}
}
class D {
    public function n() {
        return function (): (self&A)|B {};
    }
}
===errors===
Type int cannot be part of an intersection type
Type array cannot be part of an intersection type
Type callable cannot be part of an intersection type
Type null cannot be part of an intersection type
Type false cannot be part of an intersection type
Type bool cannot be part of an intersection type
Type Traversable|array cannot be part of an intersection type
Type object cannot be part of an intersection type
Type void cannot be part of an intersection type
Type never cannot be part of an intersection type
Type true cannot be part of an intersection type
Type static cannot be part of an intersection type
Type SELF cannot be part of an intersection type
Type parent cannot be part of an intersection type
Type self cannot be part of an intersection type
===php_error===
PHP Fatal error:  Type int cannot be part of an intersection type in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "int"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 20,
                        "end": 23
                      }
                    }
                  },
                  "span": {
                    "start": 20,
                    "end": 23
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
                        "start": 24,
                        "end": 25
                      }
                    }
                  },
                  "span": {
                    "start": 24,
                    "end": 25
                  }
                }
              ]
            },
            "span": {
              "start": 20,
              "end": 25
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "b",
            "span": {
              "start": 38,
              "end": 39
            }
          },
          "params": [],
          "body": [],
          "return_type": {
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
                        "start": 43,
                        "end": 44
                      }
                    }
                  },
                  "span": {
                    "start": 43,
                    "end": 44
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "array"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 45,
                        "end": 50
                      }
                    }
                  },
                  "span": {
                    "start": 45,
                    "end": 50
                  }
                }
              ]
            },
            "span": {
              "start": 43,
              "end": 50
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 29,
        "end": 53
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "c",
            "span": {
              "start": 63,
              "end": 64
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "callable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 68,
                        "end": 76
                      }
                    }
                  },
                  "span": {
                    "start": 68,
                    "end": 76
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
                        "start": 77,
                        "end": 78
                      }
                    }
                  },
                  "span": {
                    "start": 77,
                    "end": 78
                  }
                }
              ]
            },
            "span": {
              "start": 68,
              "end": 78
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 54,
        "end": 81
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "d",
            "span": {
              "start": 91,
              "end": 92
            }
          },
          "params": [],
          "body": [],
          "return_type": {
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
                        "start": 96,
                        "end": 97
                      }
                    }
                  },
                  "span": {
                    "start": 96,
                    "end": 97
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
                        "start": 98,
                        "end": 102
                      }
                    }
                  },
                  "span": {
                    "start": 98,
                    "end": 102
                  }
                }
              ]
            },
            "span": {
              "start": 96,
              "end": 102
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 82,
        "end": 105
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "e",
            "span": {
              "start": 115,
              "end": 116
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "false"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 120,
                        "end": 125
                      }
                    }
                  },
                  "span": {
                    "start": 120,
                    "end": 125
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
                        "start": 126,
                        "end": 127
                      }
                    }
                  },
                  "span": {
                    "start": 126,
                    "end": 127
                  }
                }
              ]
            },
            "span": {
              "start": 120,
              "end": 127
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 106,
        "end": 130
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 140,
              "end": 141
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
                              "bool"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 146,
                              "end": 150
                            }
                          }
                        },
                        "span": {
                          "start": 146,
                          "end": 150
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
                              "start": 151,
                              "end": 152
                            }
                          }
                        },
                        "span": {
                          "start": 151,
                          "end": 152
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 145,
                    "end": 153
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
                        "start": 154,
                        "end": 155
                      }
                    }
                  },
                  "span": {
                    "start": 154,
                    "end": 155
                  }
                }
              ]
            },
            "span": {
              "start": 145,
              "end": 155
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 131,
        "end": 158
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 168,
              "end": 169
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "iterable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 173,
                        "end": 181
                      }
                    }
                  },
                  "span": {
                    "start": 173,
                    "end": 181
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
                        "start": 182,
                        "end": 183
                      }
                    }
                  },
                  "span": {
                    "start": 182,
                    "end": 183
                  }
                }
              ]
            },
            "span": {
              "start": 173,
              "end": 183
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 159,
        "end": 186
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
            "span": {
              "start": 196,
              "end": 197
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "object"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 201,
                        "end": 207
                      }
                    }
                  },
                  "span": {
                    "start": 201,
                    "end": 207
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
                        "start": 208,
                        "end": 209
                      }
                    }
                  },
                  "span": {
                    "start": 208,
                    "end": 209
                  }
                }
              ]
            },
            "span": {
              "start": 201,
              "end": 209
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 187,
        "end": 212
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "i",
            "span": {
              "start": 222,
              "end": 223
            }
          },
          "params": [],
          "body": [],
          "return_type": {
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
                        "start": 227,
                        "end": 228
                      }
                    }
                  },
                  "span": {
                    "start": 227,
                    "end": 228
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "void"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 229,
                        "end": 233
                      }
                    }
                  },
                  "span": {
                    "start": 229,
                    "end": 233
                  }
                }
              ]
            },
            "span": {
              "start": 227,
              "end": 233
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 213,
        "end": 236
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "j",
            "span": {
              "start": 246,
              "end": 247
            }
          },
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Intersection": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "never"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 251,
                        "end": 256
                      }
                    }
                  },
                  "span": {
                    "start": 251,
                    "end": 256
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
                        "start": 257,
                        "end": 258
                      }
                    }
                  },
                  "span": {
                    "start": 257,
                    "end": 258
                  }
                }
              ]
            },
            "span": {
              "start": 251,
              "end": 258
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 237,
        "end": 261
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "o",
            "span": {
              "start": 271,
              "end": 272
            }
          },
          "params": [
            {
              "name": {
                "name": "o",
                "span": {
                  "start": 280,
                  "end": 282
                }
              },
              "type_hint": {
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
                            "start": 273,
                            "end": 274
                          }
                        }
                      },
                      "span": {
                        "start": 273,
                        "end": 274
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "true"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 275,
                            "end": 279
                          }
                        }
                      },
                      "span": {
                        "start": 275,
                        "end": 279
                      }
                    }
                  ]
                },
                "span": {
                  "start": 273,
                  "end": 279
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 273,
                "end": 282
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
        "start": 262,
        "end": 286
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 293,
              "end": 294
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
                    "name": "k",
                    "span": {
                      "start": 317,
                      "end": 318
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "static"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 322,
                                "end": 328
                              }
                            }
                          },
                          "span": {
                            "start": 322,
                            "end": 328
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
                                "start": 329,
                                "end": 330
                              }
                            }
                          },
                          "span": {
                            "start": 329,
                            "end": 330
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 322,
                      "end": 330
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 301,
                "end": 333
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 287,
        "end": 335
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 342,
              "end": 343
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "l",
                    "span": {
                      "start": 366,
                      "end": 367
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                                "start": 371,
                                "end": 375
                              }
                            }
                          },
                          "span": {
                            "start": 371,
                            "end": 375
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
                                "start": 376,
                                "end": 377
                              }
                            }
                          },
                          "span": {
                            "start": 376,
                            "end": 377
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 371,
                      "end": 377
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 350,
                "end": 380
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 401,
                      "end": 402
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
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
                                "start": 406,
                                "end": 407
                              }
                            }
                          },
                          "span": {
                            "start": 406,
                            "end": 407
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
                                "start": 408,
                                "end": 414
                              }
                            }
                          },
                          "span": {
                            "start": 408,
                            "end": 414
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 406,
                      "end": 414
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 385,
                "end": 417
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 336,
        "end": 419
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 426,
              "end": 427
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
                    "name": "n",
                    "span": {
                      "start": 450,
                      "end": 451
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
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
                                        "Intersection": [
                                          {
                                            "kind": {
                                              "Named": {
                                                "parts": [
                                                  "self"
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
                                          },
                                          {
                                            "kind": {
                                              "Named": {
                                                "parts": [
                                                  "A"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 490,
                                                  "end": 491
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 490,
                                              "end": 491
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 484,
                                        "end": 492
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
                                            "start": 493,
                                            "end": 494
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 493,
                                        "end": 494
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 484,
                                  "end": 494
                                }
                              },
                              "body": [],
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 471,
                            "end": 497
                          }
                        }
                      },
                      "span": {
                        "start": 464,
                        "end": 498
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 434,
                "end": 504
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 420,
        "end": 506
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 506
  }
}
