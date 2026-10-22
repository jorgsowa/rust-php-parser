===source===
<?php
function f($a, $A) {}
$c = function ($a) use ($b, $B) {};
static $top;
function g($a) {
    static $a;
    static $A;
    static $top;
    global $b;
    static $b;
    $h = function () { static $a; };
    $i = fn() => function () { static $a; };
    function h() { static $a; }
    new class { public function m() { static $a; } };
}
function k() { static $a; }
class A {
    public function m($a) { static $a; }
    public function n($a) { static $a; }
    public $p { get { static $a; return 1; } }
    public $q { get { static $a; return 1; } }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 20
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 20
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
                  "start": 17,
                  "end": 19
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 19
              }
            },
            {
              "name": {
                "name": "A",
                "span": {
                  "start": 21,
                  "end": 23
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 21,
                "end": 23
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
        "end": 27
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
                  "start": 28,
                  "end": 30
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
                            "start": 43,
                            "end": 45
                          }
                        },
                        "type_hint": null,
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 43,
                          "end": 45
                        }
                      }
                    ],
                    "use_vars": [
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 52,
                            "end": 54
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 52,
                          "end": 54
                        }
                      },
                      {
                        "name": {
                          "name": "B",
                          "span": {
                            "start": 56,
                            "end": 58
                          }
                        },
                        "by_ref": false,
                        "span": {
                          "start": 56,
                          "end": 58
                        }
                      }
                    ],
                    "return_type": null,
                    "body": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 33,
                  "end": 62
                }
              }
            }
          },
          "span": {
            "start": 28,
            "end": 62
          }
        }
      },
      "span": {
        "start": 28,
        "end": 63
      }
    },
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "top",
              "span": {
                "start": 71,
                "end": 75
              }
            },
            "default": null,
            "span": {
              "start": 71,
              "end": 75
            }
          }
        ]
      },
      "span": {
        "start": 64,
        "end": 76
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 86,
              "end": 87
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 88,
                  "end": 90
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 88,
                "end": 90
              }
            }
          ],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 105,
                        "end": 107
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 105,
                      "end": 107
                    }
                  }
                ]
              },
              "span": {
                "start": 98,
                "end": 108
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "A",
                      "span": {
                        "start": 120,
                        "end": 122
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 120,
                      "end": 122
                    }
                  }
                ]
              },
              "span": {
                "start": 113,
                "end": 123
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "top",
                      "span": {
                        "start": 135,
                        "end": 139
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 135,
                      "end": 139
                    }
                  }
                ]
              },
              "span": {
                "start": 128,
                "end": 140
              }
            },
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 152,
                      "end": 154
                    }
                  }
                ]
              },
              "span": {
                "start": 145,
                "end": 155
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 167,
                        "end": 169
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 167,
                      "end": 169
                    }
                  }
                ]
              },
              "span": {
                "start": 160,
                "end": 170
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
                          "start": 175,
                          "end": 177
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
                                  "StaticVar": [
                                    {
                                      "name": {
                                        "name": "a",
                                        "span": {
                                          "start": 201,
                                          "end": 203
                                        }
                                      },
                                      "default": null,
                                      "span": {
                                        "start": 201,
                                        "end": 203
                                      }
                                    }
                                  ]
                                },
                                "span": {
                                  "start": 194,
                                  "end": 204
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 180,
                          "end": 206
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 175,
                    "end": 206
                  }
                }
              },
              "span": {
                "start": 175,
                "end": 207
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "i"
                        },
                        "span": {
                          "start": 212,
                          "end": 214
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "ArrowFunction": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [],
                            "return_type": null,
                            "body": {
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
                                        "StaticVar": [
                                          {
                                            "name": {
                                              "name": "a",
                                              "span": {
                                                "start": 246,
                                                "end": 248
                                              }
                                            },
                                            "default": null,
                                            "span": {
                                              "start": 246,
                                              "end": 248
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 239,
                                        "end": 249
                                      }
                                    }
                                  ],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 225,
                                "end": 251
                              }
                            },
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 217,
                          "end": 251
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 212,
                    "end": 251
                  }
                }
              },
              "span": {
                "start": 212,
                "end": 252
              }
            },
            {
              "kind": {
                "Function": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 266,
                      "end": 267
                    }
                  },
                  "params": [],
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "a",
                              "span": {
                                "start": 279,
                                "end": 281
                              }
                            },
                            "default": null,
                            "span": {
                              "start": 279,
                              "end": 281
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 272,
                        "end": 282
                      }
                    }
                  ],
                  "return_type": null,
                  "by_ref": false,
                  "attributes": []
                }
              },
              "span": {
                "start": 257,
                "end": 284
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "AnonymousClass": {
                            "name": null,
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
                                      "name": "m",
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
                                    "return_type": null,
                                    "body": [
                                      {
                                        "kind": {
                                          "StaticVar": [
                                            {
                                              "name": {
                                                "name": "a",
                                                "span": {
                                                  "start": 330,
                                                  "end": 332
                                                }
                                              },
                                              "default": null,
                                              "span": {
                                                "start": 330,
                                                "end": 332
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 323,
                                          "end": 333
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 301,
                                  "end": 335
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 289,
                          "end": 337
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 289,
                    "end": 337
                  }
                }
              },
              "span": {
                "start": 289,
                "end": 338
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 77,
        "end": 340
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "k",
            "span": {
              "start": 350,
              "end": 351
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 363,
                        "end": 365
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 363,
                      "end": 365
                    }
                  }
                ]
              },
              "span": {
                "start": 356,
                "end": 366
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 341,
        "end": 368
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 375,
              "end": 376
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
                    "name": "m",
                    "span": {
                      "start": 399,
                      "end": 400
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 401,
                          "end": 403
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 401,
                        "end": 403
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "a",
                              "span": {
                                "start": 414,
                                "end": 416
                              }
                            },
                            "default": null,
                            "span": {
                              "start": 414,
                              "end": 416
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 407,
                        "end": 417
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 383,
                "end": 419
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "n",
                    "span": {
                      "start": 440,
                      "end": 441
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 442,
                          "end": 444
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 442,
                        "end": 444
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "StaticVar": [
                          {
                            "name": {
                              "name": "a",
                              "span": {
                                "start": 455,
                                "end": 457
                              }
                            },
                            "default": null,
                            "span": {
                              "start": 455,
                              "end": 457
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 448,
                        "end": 458
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 424,
                "end": 460
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 472,
                      "end": 474
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "StaticVar": [
                                {
                                  "name": {
                                    "name": "a",
                                    "span": {
                                      "start": 490,
                                      "end": 492
                                    }
                                  },
                                  "default": null,
                                  "span": {
                                    "start": 490,
                                    "end": 492
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 483,
                              "end": 493
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 501,
                                  "end": 502
                                }
                              }
                            },
                            "span": {
                              "start": 494,
                              "end": 503
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 477,
                        "end": 505
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 465,
                "end": 507
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 519,
                      "end": 521
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "StaticVar": [
                                {
                                  "name": {
                                    "name": "a",
                                    "span": {
                                      "start": 537,
                                      "end": 539
                                    }
                                  },
                                  "default": null,
                                  "span": {
                                    "start": 537,
                                    "end": 539
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 530,
                              "end": 540
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 548,
                                  "end": 549
                                }
                              }
                            },
                            "span": {
                              "start": 541,
                              "end": 550
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 524,
                        "end": 552
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 512,
                "end": 554
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 369,
        "end": 556
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 556
  }
}
