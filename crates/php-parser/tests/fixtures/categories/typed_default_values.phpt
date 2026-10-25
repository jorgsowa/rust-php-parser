===source===
<?php
function f(
    float $a = 1,
    iterable $b = [],
    array $c = [1, "a" => [true]],
    int $d = -1,
    ?int $e = null,
    int $f = null,
    mixed $g = "a",
    int|bool $h = false,
    int $i = FOO,
    string $j = __FILE__,
    array $k = [FOO],
) {}
class A {
    public ?int $a = null;
    public float $b = 1;
    public mixed $c = null;
    public iterable $d = [];
    public int|false $e = false;
    public static array $f = [];
}
===errors <=7.4===
Default value for parameters with a class type can only be NULL
'union types' requires PHP 8.0 or higher
'trailing comma in parameter list' requires PHP 8.0 or higher
Default value for property of type mixed may not be null. Use the nullable type ?mixed to allow null default value
'union types' requires PHP 8.0 or higher
'false type' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting variable (T_VARIABLE) in Standard input code on line 10
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 28,
                  "end": 30
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "float"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 22,
                      "end": 27
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 27
                }
              },
              "default": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 33,
                  "end": 34
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 22,
                "end": 34
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 49,
                  "end": 51
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
                      "start": 40,
                      "end": 48
                    }
                  }
                },
                "span": {
                  "start": 40,
                  "end": 48
                }
              },
              "default": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 54,
                  "end": 56
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 40,
                "end": 56
              }
            },
            {
              "name": {
                "name": "c",
                "span": {
                  "start": 68,
                  "end": 70
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
                      "start": 62,
                      "end": 67
                    }
                  }
                },
                "span": {
                  "start": 62,
                  "end": 67
                }
              },
              "default": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 74,
                            "end": 75
                          }
                        }
                      },
                      "span": {
                        "start": 74,
                        "end": 75
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "a"
                        },
                        "span": {
                          "start": 77,
                          "end": 80
                        }
                      },
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Bool": true
                                    },
                                    "span": {
                                      "start": 85,
                                      "end": 89
                                    }
                                  }
                                },
                                "span": {
                                  "start": 85,
                                  "end": 89
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 84,
                            "end": 90
                          }
                        }
                      },
                      "span": {
                        "start": 77,
                        "end": 90
                      }
                    }
                  ]
                },
                "span": {
                  "start": 73,
                  "end": 91
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 62,
                "end": 91
              }
            },
            {
              "name": {
                "name": "d",
                "span": {
                  "start": 101,
                  "end": 103
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
                      "start": 97,
                      "end": 100
                    }
                  }
                },
                "span": {
                  "start": 97,
                  "end": 100
                }
              },
              "default": {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 107,
                        "end": 108
                      }
                    }
                  }
                },
                "span": {
                  "start": 106,
                  "end": 108
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 97,
                "end": 108
              }
            },
            {
              "name": {
                "name": "e",
                "span": {
                  "start": 119,
                  "end": 121
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
                          "start": 115,
                          "end": 118
                        }
                      }
                    },
                    "span": {
                      "start": 115,
                      "end": 118
                    }
                  }
                },
                "span": {
                  "start": 114,
                  "end": 118
                }
              },
              "default": {
                "kind": "Null",
                "span": {
                  "start": 124,
                  "end": 128
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 114,
                "end": 128
              }
            },
            {
              "name": {
                "name": "f",
                "span": {
                  "start": 138,
                  "end": 140
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
                      "start": 134,
                      "end": 137
                    }
                  }
                },
                "span": {
                  "start": 134,
                  "end": 137
                }
              },
              "default": {
                "kind": "Null",
                "span": {
                  "start": 143,
                  "end": 147
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 134,
                "end": 147
              }
            },
            {
              "name": {
                "name": "g",
                "span": {
                  "start": 159,
                  "end": 161
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
                      "start": 153,
                      "end": 158
                    }
                  }
                },
                "span": {
                  "start": 153,
                  "end": 158
                }
              },
              "default": {
                "kind": {
                  "String": "a"
                },
                "span": {
                  "start": 164,
                  "end": 167
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 153,
                "end": 167
              }
            },
            {
              "name": {
                "name": "h",
                "span": {
                  "start": 182,
                  "end": 184
                }
              },
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
                            "start": 173,
                            "end": 176
                          }
                        }
                      },
                      "span": {
                        "start": 173,
                        "end": 176
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "bool"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 177,
                            "end": 181
                          }
                        }
                      },
                      "span": {
                        "start": 177,
                        "end": 181
                      }
                    }
                  ]
                },
                "span": {
                  "start": 173,
                  "end": 181
                }
              },
              "default": {
                "kind": {
                  "Bool": false
                },
                "span": {
                  "start": 187,
                  "end": 192
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 173,
                "end": 192
              }
            },
            {
              "name": {
                "name": "i",
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
              "default": {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 207,
                      "end": 210
                    }
                  }
                },
                "span": {
                  "start": 207,
                  "end": 210
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 198,
                "end": 210
              }
            },
            {
              "name": {
                "name": "j",
                "span": {
                  "start": 223,
                  "end": 225
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
                      "start": 216,
                      "end": 222
                    }
                  }
                },
                "span": {
                  "start": 216,
                  "end": 222
                }
              },
              "default": {
                "kind": {
                  "MagicConst": "File"
                },
                "span": {
                  "start": 228,
                  "end": 236
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 216,
                "end": 236
              }
            },
            {
              "name": {
                "name": "k",
                "span": {
                  "start": 248,
                  "end": 250
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
                      "start": 242,
                      "end": 247
                    }
                  }
                },
                "span": {
                  "start": 242,
                  "end": 247
                }
              },
              "default": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "FOO"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 254,
                                "end": 257
                              }
                            }
                          },
                          "span": {
                            "start": 254,
                            "end": 257
                          }
                        }
                      },
                      "span": {
                        "start": 254,
                        "end": 257
                      }
                    }
                  ]
                },
                "span": {
                  "start": 253,
                  "end": 258
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 242,
                "end": 258
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
        "start": 6,
        "end": 264
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 271,
              "end": 272
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
                      "start": 291,
                      "end": 293
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                              "start": 287,
                              "end": 290
                            }
                          }
                        },
                        "span": {
                          "start": 287,
                          "end": 290
                        }
                      }
                    },
                    "span": {
                      "start": 286,
                      "end": 290
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 296,
                      "end": 300
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 279,
                "end": 300
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 319,
                      "end": 321
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "float"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 313,
                          "end": 318
                        }
                      }
                    },
                    "span": {
                      "start": 313,
                      "end": 318
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 324,
                      "end": 325
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 306,
                "end": 325
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 344,
                      "end": 346
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "mixed"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 338,
                          "end": 343
                        }
                      }
                    },
                    "span": {
                      "start": 338,
                      "end": 343
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 349,
                      "end": 353
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 331,
                "end": 353
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 375,
                      "end": 377
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "iterable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 366,
                          "end": 374
                        }
                      }
                    },
                    "span": {
                      "start": 366,
                      "end": 374
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 380,
                      "end": 382
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 359,
                "end": 382
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 405,
                      "end": 407
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
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
                                "start": 395,
                                "end": 398
                              }
                            }
                          },
                          "span": {
                            "start": 395,
                            "end": 398
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "false"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 399,
                                "end": 404
                              }
                            }
                          },
                          "span": {
                            "start": 399,
                            "end": 404
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 395,
                      "end": 404
                    }
                  },
                  "default": {
                    "kind": {
                      "Bool": false
                    },
                    "span": {
                      "start": 410,
                      "end": 415
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 388,
                "end": 415
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 441,
                      "end": 443
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
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 435,
                          "end": 440
                        }
                      }
                    },
                    "span": {
                      "start": 435,
                      "end": 440
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 446,
                      "end": 448
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 421,
                "end": 448
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 265,
        "end": 451
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 451
  }
}
