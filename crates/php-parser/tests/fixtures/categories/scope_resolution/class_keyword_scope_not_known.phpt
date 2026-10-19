===source===
<?php
self::f();
new parent;
echo static::class, \self::class;
const C = self::X;
$f = function (self $a): static {
    return parent::f();
};
$g = fn(parent $a) => new self;
function f($a = self::X, $b = new self, $c = parent::Y) {
    return function () {
        return [self::X, new static, parent::class];
    };
}
#[X(self::X)]
function g() {}
trait T {
    public parent $p;
    const X = parent::class;
    function f(): parent {
        return parent::f();
    }
}
class A {
    const X = parent::Y;
    public $a = parent::X;
    function m($a = parent::X) {
        return static fn(): parent => self::X;
    }
}
$h = function () {
    class B {
        public parent $b;
        const Y = parent::class;
    }
};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "self"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 10
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "method": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 12,
                  "end": 13
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "Name": {
                    "parts": [
                      "parent"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 21,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 21,
                  "end": 27
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 17,
            "end": 27
          }
        }
      },
      "span": {
        "start": 17,
        "end": 28
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "static"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 34,
                        "end": 40
                      }
                    }
                  },
                  "span": {
                    "start": 34,
                    "end": 40
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 42,
                    "end": 47
                  }
                }
              }
            },
            "span": {
              "start": 34,
              "end": 47
            }
          },
          {
            "kind": {
              "ClassConstAccess": {
                "class": {
                  "kind": {
                    "Name": {
                      "parts": [
                        "self"
                      ],
                      "kind": "FullyQualified",
                      "span": {
                        "start": 49,
                        "end": 54
                      }
                    }
                  },
                  "span": {
                    "start": 49,
                    "end": 54
                  }
                },
                "member": {
                  "kind": {
                    "Identifier": "class"
                  },
                  "span": {
                    "start": 56,
                    "end": 61
                  }
                }
              }
            },
            "span": {
              "start": 49,
              "end": 61
            }
          }
        ]
      },
      "span": {
        "start": 29,
        "end": 62
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 69,
                "end": 70
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 73,
                          "end": 77
                        }
                      }
                    },
                    "span": {
                      "start": 73,
                      "end": 77
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "X"
                    },
                    "span": {
                      "start": 79,
                      "end": 80
                    }
                  }
                }
              },
              "span": {
                "start": 73,
                "end": 80
              }
            },
            "attributes": [],
            "span": {
              "start": 69,
              "end": 80
            }
          }
        ]
      },
      "span": {
        "start": 63,
        "end": 81
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "f"
                },
                "span": {
                  "start": 82,
                  "end": 84
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 102,
                            "end": 104
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
                                "start": 97,
                                "end": 101
                              }
                            }
                          },
                          "span": {
                            "start": 97,
                            "end": 101
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 97,
                          "end": 104
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "static"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 107,
                            "end": 113
                          }
                        }
                      },
                      "span": {
                        "start": 107,
                        "end": 113
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "StaticMethodCall": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "parent"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 127,
                                        "end": 133
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 127,
                                    "end": 133
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "f"
                                  },
                                  "span": {
                                    "start": 135,
                                    "end": 136
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 127,
                              "end": 138
                            }
                          }
                        },
                        "span": {
                          "start": 120,
                          "end": 139
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 87,
                  "end": 141
                }
              }
            }
          },
          "span": {
            "start": 82,
            "end": 141
          }
        }
      },
      "span": {
        "start": 82,
        "end": 142
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 143,
                  "end": 145
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 158,
                            "end": 160
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 151,
                                "end": 157
                              }
                            }
                          },
                          "span": {
                            "start": 151,
                            "end": 157
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 151,
                          "end": 160
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "self"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 169,
                                  "end": 173
                                }
                              }
                            },
                            "span": {
                              "start": 169,
                              "end": 173
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 165,
                        "end": 173
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 148,
                  "end": 173
                }
              }
            }
          },
          "span": {
            "start": 143,
            "end": 173
          }
        }
      },
      "span": {
        "start": 143,
        "end": 174
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 184,
              "end": 185
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 186,
                  "end": 188
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "self"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 191,
                            "end": 195
                          }
                        }
                      },
                      "span": {
                        "start": 191,
                        "end": 195
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "X"
                      },
                      "span": {
                        "start": 197,
                        "end": 198
                      }
                    }
                  }
                },
                "span": {
                  "start": 191,
                  "end": 198
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 186,
                "end": 198
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 200,
                  "end": 202
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "self"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 209,
                            "end": 213
                          }
                        }
                      },
                      "span": {
                        "start": 209,
                        "end": 213
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 205,
                  "end": 213
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 200,
                "end": 213
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 215,
                  "end": 217
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "parent"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 220,
                            "end": 226
                          }
                        }
                      },
                      "span": {
                        "start": 220,
                        "end": 226
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "Y"
                      },
                      "span": {
                        "start": 228,
                        "end": 229
                      }
                    }
                  }
                },
                "span": {
                  "start": 220,
                  "end": 229
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 215,
                "end": 229
              }
            }
          ],
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
                                          "ClassConstAccess": {
                                            "class": {
                                              "kind": {
                                                "Name": {
                                                  "parts": [
                                                    "self"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 274,
                                                    "end": 278
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 274,
                                                "end": 278
                                              }
                                            },
                                            "member": {
                                              "kind": {
                                                "Identifier": "X"
                                              },
                                              "span": {
                                                "start": 280,
                                                "end": 281
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 274,
                                          "end": 281
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 274,
                                      "end": 281
                                    }
                                  },
                                  {
                                    "key": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "New": {
                                            "class": {
                                              "kind": {
                                                "Name": {
                                                  "parts": [
                                                    "static"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 287,
                                                    "end": 293
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 287,
                                                "end": 293
                                              }
                                            },
                                            "args": []
                                          }
                                        },
                                        "span": {
                                          "start": 283,
                                          "end": 293
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 283,
                                      "end": 293
                                    }
                                  },
                                  {
                                    "key": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "ClassConstAccess": {
                                            "class": {
                                              "kind": {
                                                "Name": {
                                                  "parts": [
                                                    "parent"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 295,
                                                    "end": 301
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 295,
                                                "end": 301
                                              }
                                            },
                                            "member": {
                                              "kind": {
                                                "Identifier": "class"
                                              },
                                              "span": {
                                                "start": 303,
                                                "end": 308
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 295,
                                          "end": 308
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 295,
                                      "end": 308
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 273,
                                "end": 309
                              }
                            }
                          },
                          "span": {
                            "start": 266,
                            "end": 310
                          }
                        }
                      ],
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 244,
                    "end": 316
                  }
                }
              },
              "span": {
                "start": 237,
                "end": 317
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 175,
        "end": 319
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 343,
              "end": 344
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "X"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 322,
                  "end": 323
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "self"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 324,
                                  "end": 328
                                }
                              }
                            },
                            "span": {
                              "start": 324,
                              "end": 328
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "X"
                            },
                            "span": {
                              "start": 330,
                              "end": 331
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 324,
                        "end": 331
                      }
                    }
                  },
                  "span": {
                    "start": 324,
                    "end": 331
                  }
                }
              ],
              "span": {
                "start": 322,
                "end": 332
              }
            }
          ]
        }
      },
      "span": {
        "start": 334,
        "end": 349
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 356,
              "end": 357
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 378,
                      "end": 380
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 371,
                          "end": 377
                        }
                      }
                    },
                    "span": {
                      "start": 371,
                      "end": 377
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 364,
                "end": 380
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 392,
                      "end": 393
                    }
                  },
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 396,
                                "end": 402
                              }
                            }
                          },
                          "span": {
                            "start": 396,
                            "end": 402
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 404,
                            "end": 409
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 396,
                      "end": 409
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 386,
                "end": 410
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 424,
                      "end": 425
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 429,
                          "end": 435
                        }
                      }
                    },
                    "span": {
                      "start": 429,
                      "end": 435
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 453,
                                      "end": 459
                                    }
                                  }
                                },
                                "span": {
                                  "start": 453,
                                  "end": 459
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "f"
                                },
                                "span": {
                                  "start": 461,
                                  "end": 462
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 453,
                            "end": 464
                          }
                        }
                      },
                      "span": {
                        "start": 446,
                        "end": 465
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 415,
                "end": 471
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 350,
        "end": 473
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 480,
              "end": 481
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 494,
                      "end": 495
                    }
                  },
                  "value": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 498,
                                "end": 504
                              }
                            }
                          },
                          "span": {
                            "start": 498,
                            "end": 504
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "Y"
                          },
                          "span": {
                            "start": 506,
                            "end": 507
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 498,
                      "end": 507
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 488,
                "end": 508
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 520,
                      "end": 522
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 525,
                                "end": 531
                              }
                            }
                          },
                          "span": {
                            "start": 525,
                            "end": 531
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "X"
                          },
                          "span": {
                            "start": 533,
                            "end": 534
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 525,
                      "end": 534
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 513,
                "end": 534
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 549,
                      "end": 550
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 551,
                          "end": 553
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "ClassConstAccess": {
                            "class": {
                              "kind": {
                                "Name": {
                                  "parts": [
                                    "parent"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 556,
                                    "end": 562
                                  }
                                }
                              },
                              "span": {
                                "start": 556,
                                "end": 562
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "X"
                              },
                              "span": {
                                "start": 564,
                                "end": 565
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 556,
                          "end": 565
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 551,
                        "end": 565
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "ArrowFunction": {
                              "is_static": true,
                              "by_ref": false,
                              "params": [],
                              "return_type": {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "parent"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 597,
                                      "end": 603
                                    }
                                  }
                                },
                                "span": {
                                  "start": 597,
                                  "end": 603
                                }
                              },
                              "body": {
                                "kind": {
                                  "ClassConstAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "self"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 607,
                                            "end": 611
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 607,
                                        "end": 611
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "X"
                                      },
                                      "span": {
                                        "start": 613,
                                        "end": 614
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 607,
                                  "end": 614
                                }
                              },
                              "attributes": []
                            }
                          },
                          "span": {
                            "start": 584,
                            "end": 614
                          }
                        }
                      },
                      "span": {
                        "start": 577,
                        "end": 615
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 540,
                "end": 621
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 474,
        "end": 623
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "h"
                },
                "span": {
                  "start": 624,
                  "end": 626
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
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Class": {
                            "name": {
                              "name": "B",
                              "span": {
                                "start": 653,
                                "end": 654
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
                                      "name": "b",
                                      "span": {
                                        "start": 679,
                                        "end": 681
                                      }
                                    },
                                    "modifiers": {
                                      "visibility": "Public"
                                    },
                                    "type_hint": {
                                      "kind": {
                                        "Named": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 672,
                                            "end": 678
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 672,
                                        "end": 678
                                      }
                                    },
                                    "default": null,
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 665,
                                  "end": 681
                                }
                              },
                              {
                                "kind": {
                                  "ClassConst": {
                                    "name": {
                                      "name": "Y",
                                      "span": {
                                        "start": 697,
                                        "end": 698
                                      }
                                    },
                                    "value": {
                                      "kind": {
                                        "ClassConstAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 701,
                                                  "end": 707
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 701,
                                              "end": 707
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "class"
                                            },
                                            "span": {
                                              "start": 709,
                                              "end": 714
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 701,
                                        "end": 714
                                      }
                                    },
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 691,
                                  "end": 715
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 647,
                          "end": 721
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 629,
                  "end": 723
                }
              }
            }
          },
          "span": {
            "start": 624,
            "end": 723
          }
        }
      },
      "span": {
        "start": 624,
        "end": 724
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 724
  }
}
