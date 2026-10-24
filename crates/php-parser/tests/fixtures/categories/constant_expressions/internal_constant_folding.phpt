===source===
<?php
const A = PHP_INT_MAX ?? $x;
const B = \E_ALL ? 1 : $x;
const C = PHP_EOL ?: $x;
const D = (PHP_EOL)::C;
const E = ('B')::C;
const F = 1 + 1 ?: $x;
const G = __LINE__ ?? $x;
const H = B::class ?? $x;
function f($a = true ?? $x, $b = __DIR__ ?: $x) {}
class K {
    const C = 1;
    const D = self::C ?? $x;
    const E = K::C ?: $x;
    public $p = PHP_INT_MAX ?? $x;
    public $q = self::C ?? $x;
}
function g() {
    static $s = M_PI ?? $x;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "NullCoalesce": {
                  "left": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "PHP_INT_MAX"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 16,
                          "end": 27
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 27
                    }
                  },
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 31,
                      "end": 33
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 33
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 33
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 34
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 41,
                "end": 42
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "E_ALL"
                        ],
                        "kind": "FullyQualified",
                        "span": {
                          "start": 45,
                          "end": 51
                        }
                      }
                    },
                    "span": {
                      "start": 45,
                      "end": 51
                    }
                  },
                  "then_expr": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 54,
                      "end": 55
                    }
                  },
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 58,
                      "end": 60
                    }
                  }
                }
              },
              "span": {
                "start": 45,
                "end": 60
              }
            },
            "attributes": [],
            "span": {
              "start": 41,
              "end": 60
            }
          }
        ]
      },
      "span": {
        "start": 35,
        "end": 61
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 68,
                "end": 69
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "PHP_EOL"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 72,
                          "end": 79
                        }
                      }
                    },
                    "span": {
                      "start": 72,
                      "end": 79
                    }
                  },
                  "then_expr": null,
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 83,
                      "end": 85
                    }
                  }
                }
              },
              "span": {
                "start": 72,
                "end": 85
              }
            },
            "attributes": [],
            "span": {
              "start": 68,
              "end": 85
            }
          }
        ]
      },
      "span": {
        "start": 62,
        "end": 86
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 93,
                "end": 94
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 98,
                              "end": 105
                            }
                          }
                        },
                        "span": {
                          "start": 98,
                          "end": 105
                        }
                      }
                    },
                    "span": {
                      "start": 97,
                      "end": 106
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "C"
                    },
                    "span": {
                      "start": 108,
                      "end": 109
                    }
                  }
                }
              },
              "span": {
                "start": 97,
                "end": 109
              }
            },
            "attributes": [],
            "span": {
              "start": 93,
              "end": 109
            }
          }
        ]
      },
      "span": {
        "start": 87,
        "end": 110
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
              "span": {
                "start": 117,
                "end": 118
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "String": "B"
                        },
                        "span": {
                          "start": 122,
                          "end": 125
                        }
                      }
                    },
                    "span": {
                      "start": 121,
                      "end": 126
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "C"
                    },
                    "span": {
                      "start": 128,
                      "end": 129
                    }
                  }
                }
              },
              "span": {
                "start": 121,
                "end": 129
              }
            },
            "attributes": [],
            "span": {
              "start": 117,
              "end": 129
            }
          }
        ]
      },
      "span": {
        "start": 111,
        "end": 130
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "F",
              "span": {
                "start": 137,
                "end": 138
              }
            },
            "value": {
              "kind": {
                "Ternary": {
                  "condition": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 141,
                            "end": 142
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 145,
                            "end": 146
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 141,
                      "end": 146
                    }
                  },
                  "then_expr": null,
                  "else_expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 150,
                      "end": 152
                    }
                  }
                }
              },
              "span": {
                "start": 141,
                "end": 152
              }
            },
            "attributes": [],
            "span": {
              "start": 137,
              "end": 152
            }
          }
        ]
      },
      "span": {
        "start": 131,
        "end": 153
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "G",
              "span": {
                "start": 160,
                "end": 161
              }
            },
            "value": {
              "kind": {
                "NullCoalesce": {
                  "left": {
                    "kind": {
                      "MagicConst": "Line"
                    },
                    "span": {
                      "start": 164,
                      "end": 172
                    }
                  },
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 176,
                      "end": 178
                    }
                  }
                }
              },
              "span": {
                "start": 164,
                "end": 178
              }
            },
            "attributes": [],
            "span": {
              "start": 160,
              "end": 178
            }
          }
        ]
      },
      "span": {
        "start": 154,
        "end": 179
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "H",
              "span": {
                "start": 186,
                "end": 187
              }
            },
            "value": {
              "kind": {
                "NullCoalesce": {
                  "left": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 190,
                                "end": 191
                              }
                            }
                          },
                          "span": {
                            "start": 190,
                            "end": 191
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 193,
                            "end": 198
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 190,
                      "end": 198
                    }
                  },
                  "right": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 202,
                      "end": 204
                    }
                  }
                }
              },
              "span": {
                "start": 190,
                "end": 204
              }
            },
            "attributes": [],
            "span": {
              "start": 186,
              "end": 204
            }
          }
        ]
      },
      "span": {
        "start": 180,
        "end": 205
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 215,
              "end": 216
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 217,
                  "end": 219
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "NullCoalesce": {
                    "left": {
                      "kind": {
                        "Bool": true
                      },
                      "span": {
                        "start": 222,
                        "end": 226
                      }
                    },
                    "right": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 230,
                        "end": 232
                      }
                    }
                  }
                },
                "span": {
                  "start": 222,
                  "end": 232
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 217,
                "end": 232
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 234,
                  "end": 236
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Ternary": {
                    "condition": {
                      "kind": {
                        "MagicConst": "Dir"
                      },
                      "span": {
                        "start": 239,
                        "end": 246
                      }
                    },
                    "then_expr": null,
                    "else_expr": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 250,
                        "end": 252
                      }
                    }
                  }
                },
                "span": {
                  "start": 239,
                  "end": 252
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 234,
                "end": 252
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
        "start": 206,
        "end": 256
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
            "span": {
              "start": 263,
              "end": 264
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
                    "name": "C",
                    "span": {
                      "start": 277,
                      "end": 278
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 281,
                      "end": 282
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 271,
                "end": 283
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "D",
                    "span": {
                      "start": 294,
                      "end": 295
                    }
                  },
                  "value": {
                    "kind": {
                      "NullCoalesce": {
                        "left": {
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
                                      "start": 298,
                                      "end": 302
                                    }
                                  }
                                },
                                "span": {
                                  "start": 298,
                                  "end": 302
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "C"
                                },
                                "span": {
                                  "start": 304,
                                  "end": 305
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 298,
                            "end": 305
                          }
                        },
                        "right": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 309,
                            "end": 311
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 298,
                      "end": 311
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 288,
                "end": 312
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "E",
                    "span": {
                      "start": 323,
                      "end": 324
                    }
                  },
                  "value": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "K"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 327,
                                      "end": 328
                                    }
                                  }
                                },
                                "span": {
                                  "start": 327,
                                  "end": 328
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "C"
                                },
                                "span": {
                                  "start": 330,
                                  "end": 331
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 327,
                            "end": 331
                          }
                        },
                        "then_expr": null,
                        "else_expr": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 335,
                            "end": 337
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 327,
                      "end": 337
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 317,
                "end": 338
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 350,
                      "end": 352
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "NullCoalesce": {
                        "left": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "PHP_INT_MAX"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 355,
                                "end": 366
                              }
                            }
                          },
                          "span": {
                            "start": 355,
                            "end": 366
                          }
                        },
                        "right": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 370,
                            "end": 372
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 355,
                      "end": 372
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 343,
                "end": 372
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 385,
                      "end": 387
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "NullCoalesce": {
                        "left": {
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
                                      "start": 390,
                                      "end": 394
                                    }
                                  }
                                },
                                "span": {
                                  "start": 390,
                                  "end": 394
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "C"
                                },
                                "span": {
                                  "start": 396,
                                  "end": 397
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 390,
                            "end": 397
                          }
                        },
                        "right": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 401,
                            "end": 403
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 390,
                      "end": 403
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 378,
                "end": 403
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 257,
        "end": 406
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 416,
              "end": 417
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "s",
                      "span": {
                        "start": 433,
                        "end": 435
                      }
                    },
                    "default": {
                      "kind": {
                        "NullCoalesce": {
                          "left": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "M_PI"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 438,
                                  "end": 442
                                }
                              }
                            },
                            "span": {
                              "start": 438,
                              "end": 442
                            }
                          },
                          "right": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 446,
                              "end": 448
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 438,
                        "end": 448
                      }
                    },
                    "span": {
                      "start": 433,
                      "end": 448
                    }
                  }
                ]
              },
              "span": {
                "start": 426,
                "end": 449
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 407,
        "end": 451
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 451
  }
}
