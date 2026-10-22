===source===
<?php
static $top;
static $top;
function f() {
    static $a;
    static $a = 1;
    static $b, $b;
    if (true) {
        static $c;
    }
    while (true) {
        static $c;
    }
}
$g = function () { static $a; static $a; };
$h = fn() => function () { static $a, $a; };
class A {
    public function m() { static $a; static $a; }
    public $p { get { static $a; static $a; return 1; } }
}
===errors <=8.2===
'property hooks' requires PHP 8.4 or higher
===errors 8.3===
Duplicate declaration of static variable $top
Duplicate declaration of static variable $a
Duplicate declaration of static variable $b
Duplicate declaration of static variable $c
Duplicate declaration of static variable $a
Duplicate declaration of static variable $a
Duplicate declaration of static variable $a
'property hooks' requires PHP 8.4 or higher
Duplicate declaration of static variable $a
===errors >=8.4===
Duplicate declaration of static variable $top
Duplicate declaration of static variable $a
Duplicate declaration of static variable $b
Duplicate declaration of static variable $c
Duplicate declaration of static variable $a
Duplicate declaration of static variable $a
Duplicate declaration of static variable $a
Duplicate declaration of static variable $a
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 19
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 19
===php_error >=8.4===
PHP Fatal error:  Duplicate declaration of static variable $top in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "top",
              "span": {
                "start": 13,
                "end": 17
              }
            },
            "default": null,
            "span": {
              "start": 13,
              "end": 17
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "StaticVar": [
          {
            "name": {
              "name": "top",
              "span": {
                "start": 26,
                "end": 30
              }
            },
            "default": null,
            "span": {
              "start": 26,
              "end": 30
            }
          }
        ]
      },
      "span": {
        "start": 19,
        "end": 31
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 41,
              "end": 42
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
                        "start": 58,
                        "end": 60
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 58,
                      "end": 60
                    }
                  }
                ]
              },
              "span": {
                "start": 51,
                "end": 61
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "a",
                      "span": {
                        "start": 73,
                        "end": 75
                      }
                    },
                    "default": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    },
                    "span": {
                      "start": 73,
                      "end": 79
                    }
                  }
                ]
              },
              "span": {
                "start": 66,
                "end": 80
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 92,
                        "end": 94
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 92,
                      "end": 94
                    }
                  },
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 96,
                        "end": 98
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 96,
                      "end": 98
                    }
                  }
                ]
              },
              "span": {
                "start": 85,
                "end": 99
              }
            },
            {
              "kind": {
                "If": {
                  "condition": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 108,
                      "end": 112
                    }
                  },
                  "then_branch": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "StaticVar": [
                              {
                                "name": {
                                  "name": "c",
                                  "span": {
                                    "start": 131,
                                    "end": 133
                                  }
                                },
                                "default": null,
                                "span": {
                                  "start": 131,
                                  "end": 133
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 124,
                            "end": 134
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 114,
                      "end": 140
                    }
                  },
                  "elseif_branches": [],
                  "else_branch": null
                }
              },
              "span": {
                "start": 104,
                "end": 140
              }
            },
            {
              "kind": {
                "While": {
                  "condition": {
                    "kind": {
                      "Bool": true
                    },
                    "span": {
                      "start": 152,
                      "end": 156
                    }
                  },
                  "body": {
                    "kind": {
                      "Block": [
                        {
                          "kind": {
                            "StaticVar": [
                              {
                                "name": {
                                  "name": "c",
                                  "span": {
                                    "start": 175,
                                    "end": 177
                                  }
                                },
                                "default": null,
                                "span": {
                                  "start": 175,
                                  "end": 177
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 168,
                            "end": 178
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 158,
                      "end": 184
                    }
                  }
                }
              },
              "span": {
                "start": 145,
                "end": 184
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 32,
        "end": 186
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
                  "start": 187,
                  "end": 189
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
                                  "start": 213,
                                  "end": 215
                                }
                              },
                              "default": null,
                              "span": {
                                "start": 213,
                                "end": 215
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 206,
                          "end": 216
                        }
                      },
                      {
                        "kind": {
                          "StaticVar": [
                            {
                              "name": {
                                "name": "a",
                                "span": {
                                  "start": 224,
                                  "end": 226
                                }
                              },
                              "default": null,
                              "span": {
                                "start": 224,
                                "end": 226
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 217,
                          "end": 227
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 192,
                  "end": 229
                }
              }
            }
          },
          "span": {
            "start": 187,
            "end": 229
          }
        }
      },
      "span": {
        "start": 187,
        "end": 230
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
                  "start": 231,
                  "end": 233
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
                                        "start": 265,
                                        "end": 267
                                      }
                                    },
                                    "default": null,
                                    "span": {
                                      "start": 265,
                                      "end": 267
                                    }
                                  },
                                  {
                                    "name": {
                                      "name": "a",
                                      "span": {
                                        "start": 269,
                                        "end": 271
                                      }
                                    },
                                    "default": null,
                                    "span": {
                                      "start": 269,
                                      "end": 271
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 258,
                                "end": 272
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 244,
                        "end": 274
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 236,
                  "end": 274
                }
              }
            }
          },
          "span": {
            "start": 231,
            "end": 274
          }
        }
      },
      "span": {
        "start": 231,
        "end": 275
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 282,
              "end": 283
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
                      "start": 306,
                      "end": 307
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
                                "start": 319,
                                "end": 321
                              }
                            },
                            "default": null,
                            "span": {
                              "start": 319,
                              "end": 321
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 312,
                        "end": 322
                      }
                    },
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
                "start": 290,
                "end": 335
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 347,
                      "end": 349
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
                                      "start": 365,
                                      "end": 367
                                    }
                                  },
                                  "default": null,
                                  "span": {
                                    "start": 365,
                                    "end": 367
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 358,
                              "end": 368
                            }
                          },
                          {
                            "kind": {
                              "StaticVar": [
                                {
                                  "name": {
                                    "name": "a",
                                    "span": {
                                      "start": 376,
                                      "end": 378
                                    }
                                  },
                                  "default": null,
                                  "span": {
                                    "start": 376,
                                    "end": 378
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 369,
                              "end": 379
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 387,
                                  "end": 388
                                }
                              }
                            },
                            "span": {
                              "start": 380,
                              "end": 389
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 352,
                        "end": 391
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 340,
                "end": 393
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 276,
        "end": 395
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 395
  }
}
