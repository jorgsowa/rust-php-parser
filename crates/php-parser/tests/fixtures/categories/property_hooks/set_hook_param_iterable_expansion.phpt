===source===
<?php
class C {
    public iterable $a { set(Traversable|array $v) {} }
    public iterable $b { set(array|\Traversable $v) {} }
    public Traversable|array $c { set(iterable $v) {} }
    public iterable $d { set(Foo|array $v) {} }
    public iterable $e { set(object|array $v) {} }
    public ?iterable $f { set(Traversable|array|null $v) {} }
    public iterable|int $g { set(Traversable|array|int $v) {} }
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
'union types' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'union types' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'union types' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'union types' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
'union types' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'union types' requires PHP 8.0 or higher
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                      "start": 36,
                      "end": 38
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
                          "start": 27,
                          "end": 35
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 35
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 63,
                              "end": 65
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Union": [
                                {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "Traversable"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 45,
                                        "end": 56
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 45,
                                    "end": 56
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
                                        "start": 57,
                                        "end": 62
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 57,
                                    "end": 62
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 45,
                              "end": 62
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 45,
                            "end": 65
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 41,
                        "end": 69
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 71
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 92,
                      "end": 94
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
                          "start": 83,
                          "end": 91
                        }
                      }
                    },
                    "span": {
                      "start": 83,
                      "end": 91
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 120,
                              "end": 122
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
                                        "start": 101,
                                        "end": 106
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 101,
                                    "end": 106
                                  }
                                },
                                {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "Traversable"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 107,
                                        "end": 119
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 107,
                                    "end": 119
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 101,
                              "end": 119
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 101,
                            "end": 122
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 97,
                        "end": 126
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 76,
                "end": 128
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 158,
                      "end": 160
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
                                "Traversable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 140,
                                "end": 151
                              }
                            }
                          },
                          "span": {
                            "start": 140,
                            "end": 151
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
                                "start": 152,
                                "end": 157
                              }
                            }
                          },
                          "span": {
                            "start": 152,
                            "end": 157
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 140,
                      "end": 157
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 176,
                              "end": 178
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
                                  "start": 167,
                                  "end": 175
                                }
                              }
                            },
                            "span": {
                              "start": 167,
                              "end": 175
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 167,
                            "end": 178
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 163,
                        "end": 182
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 133,
                "end": 184
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 205,
                      "end": 207
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
                          "start": 196,
                          "end": 204
                        }
                      }
                    },
                    "span": {
                      "start": 196,
                      "end": 204
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 224,
                              "end": 226
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Union": [
                                {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "Foo"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 214,
                                        "end": 217
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 214,
                                    "end": 217
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
                                        "start": 218,
                                        "end": 223
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 218,
                                    "end": 223
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 214,
                              "end": 223
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 214,
                            "end": 226
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 210,
                        "end": 230
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 189,
                "end": 232
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 253,
                      "end": 255
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
                          "start": 244,
                          "end": 252
                        }
                      }
                    },
                    "span": {
                      "start": 244,
                      "end": 252
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 275,
                              "end": 277
                            }
                          },
                          "type_hint": {
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
                                        "start": 262,
                                        "end": 268
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 262,
                                    "end": 268
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
                                        "start": 269,
                                        "end": 274
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 269,
                                    "end": 274
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 262,
                              "end": 274
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 262,
                            "end": 277
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 258,
                        "end": 281
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 237,
                "end": 283
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 305,
                      "end": 307
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
                              "iterable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 296,
                              "end": 304
                            }
                          }
                        },
                        "span": {
                          "start": 296,
                          "end": 304
                        }
                      }
                    },
                    "span": {
                      "start": 295,
                      "end": 304
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 337,
                              "end": 339
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Union": [
                                {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "Traversable"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 314,
                                        "end": 325
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 314,
                                    "end": 325
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
                                        "start": 326,
                                        "end": 331
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 326,
                                    "end": 331
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
                                        "start": 332,
                                        "end": 336
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 332,
                                    "end": 336
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 314,
                              "end": 336
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 314,
                            "end": 339
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 310,
                        "end": 343
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 288,
                "end": 345
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 370,
                      "end": 372
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
                                "iterable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 357,
                                "end": 365
                              }
                            }
                          },
                          "span": {
                            "start": 357,
                            "end": 365
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
                                "start": 366,
                                "end": 369
                              }
                            }
                          },
                          "span": {
                            "start": 366,
                            "end": 369
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 357,
                      "end": 369
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 401,
                              "end": 403
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Union": [
                                {
                                  "kind": {
                                    "Named": {
                                      "parts": [
                                        "Traversable"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 379,
                                        "end": 390
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 379,
                                    "end": 390
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
                                        "start": 391,
                                        "end": 396
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 391,
                                    "end": 396
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
                                        "start": 397,
                                        "end": 400
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 397,
                                    "end": 400
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 379,
                              "end": 400
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 379,
                            "end": 403
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 375,
                        "end": 407
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 350,
                "end": 409
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 411
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 411
  }
}
