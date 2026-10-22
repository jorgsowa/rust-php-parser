===source===
<?php
class C {
    const A = $x;
    public $b = f();
    public static $c = [1, $x];
    public function m($d = $x) {}
    public function __construct(public $e = $x) {}
}
interface I {
    const A = $x;
}
enum E: int {
    case A = $x;
    const B = f();
}
#[Attr($x)]
function f($a = 1 + $x) {}
#[Attr(name: f())]
class D {}
$f = static function ($a = $x) {};
$g = fn ($a = $x) => $a;
===errors <=7.4===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'constructor property promotion' requires PHP 8.0 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
'enums' requires PHP 8.1 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
'attributes' requires PHP 8.0 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
'attributes' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
===errors 8.0===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
'enums' requires PHP 8.1 or higher
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
===errors >=8.1===
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'public' (T_PUBLIC), expecting variable (T_VARIABLE) in Standard input code on line 7
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 12
===php_error >=8.1===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 30,
                      "end": 32
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 33
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 45,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 50,
                                "end": 51
                              }
                            }
                          },
                          "span": {
                            "start": 50,
                            "end": 51
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 50,
                      "end": 53
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 53
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 73,
                      "end": 75
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": null,
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
                                "start": 79,
                                "end": 80
                              }
                            }
                          },
                          "span": {
                            "start": 79,
                            "end": 80
                          }
                        },
                        {
                          "key": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Variable": "x"
                              },
                              "span": {
                                "start": 82,
                                "end": 84
                              }
                            }
                          },
                          "span": {
                            "start": 82,
                            "end": 84
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 78,
                      "end": 85
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 59,
                "end": 85
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 107,
                      "end": 108
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
                          "start": 109,
                          "end": 111
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 114,
                          "end": 116
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 109,
                        "end": 116
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 91,
                "end": 120
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 141,
                      "end": 152
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 160,
                          "end": 162
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 165,
                          "end": 167
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 153,
                        "end": 167
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 125,
                "end": 171
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 173
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 184,
              "end": 185
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 198,
                      "end": 199
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 202,
                      "end": 204
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 192,
                "end": 205
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 174,
        "end": 207
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 213,
              "end": 214
            }
          },
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 216,
              "end": 219
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 231,
                      "end": 232
                    }
                  },
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 235,
                      "end": 237
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 226,
                "end": 238
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 249,
                      "end": 250
                    }
                  },
                  "value": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "f"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 253,
                                "end": 254
                              }
                            }
                          },
                          "span": {
                            "start": 253,
                            "end": 254
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 253,
                      "end": 256
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 243,
                "end": 257
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 208,
        "end": 259
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 281,
              "end": 282
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 283,
                  "end": 285
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 288,
                        "end": 289
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 292,
                        "end": 294
                      }
                    }
                  }
                },
                "span": {
                  "start": 288,
                  "end": 294
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 283,
                "end": 294
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 262,
                  "end": 266
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 267,
                        "end": 269
                      }
                    }
                  },
                  "span": {
                    "start": 267,
                    "end": 269
                  }
                }
              ],
              "span": {
                "start": 262,
                "end": 270
              }
            }
          ]
        }
      },
      "span": {
        "start": 272,
        "end": 298
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 324,
              "end": 325
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 301,
                  "end": 305
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "name"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 306,
                      "end": 310
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "f"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 312,
                                  "end": 313
                                }
                              }
                            },
                            "span": {
                              "start": 312,
                              "end": 313
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 312,
                        "end": 315
                      }
                    }
                  },
                  "span": {
                    "start": 306,
                    "end": 315
                  }
                }
              ],
              "span": {
                "start": 301,
                "end": 316
              }
            }
          ]
        }
      },
      "span": {
        "start": 318,
        "end": 328
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
                  "start": 329,
                  "end": 331
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 351,
                            "end": 353
                          }
                        },
                        "type_hint": null,
                        "default": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 356,
                            "end": 358
                          }
                        },
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 351,
                          "end": 358
                        }
                      }
                    ],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 334,
                  "end": 362
                }
              }
            }
          },
          "span": {
            "start": 329,
            "end": 362
          }
        }
      },
      "span": {
        "start": 329,
        "end": 363
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
                  "start": 364,
                  "end": 366
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
                            "start": 373,
                            "end": 375
                          }
                        },
                        "type_hint": null,
                        "default": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 378,
                            "end": 380
                          }
                        },
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 373,
                          "end": 380
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 385,
                        "end": 387
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 369,
                  "end": 387
                }
              }
            }
          },
          "span": {
            "start": 364,
            "end": 387
          }
        }
      },
      "span": {
        "start": 364,
        "end": 388
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 388
  }
}
