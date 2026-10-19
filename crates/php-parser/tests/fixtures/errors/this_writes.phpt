===source===
<?php
$this = 1;
$this = &$a;
$this ??= 1;
$a = $this = 1;
[$this, [$b, ($this)]] = $a;
list(, $b, &$this) = $a;
foreach ($a as $this => [$this]) {}
foreach ($a as &$this) {}
unset($a, $this);
try {} catch (E $this) {}
function f($a, int &...$this) { global $b, $this; static $c, $this; }
fn($this) => 1;
function () use ($a, &$this) {};
class A { public function __construct(public $this) {} }
===errors===
Cannot re-assign $this
Cannot re-assign $this
Cannot re-assign $this
Cannot re-assign $this
Cannot re-assign $this
Cannot re-assign $this
Cannot re-assign $this
Cannot re-assign $this
Cannot re-assign $this
Cannot re-assign $this
Cannot unset $this
Cannot re-assign $this
Cannot use $this as parameter
Cannot use $this as global variable
Cannot use $this as static variable
Cannot use $this as parameter
Cannot use $this as lexical variable
Cannot use $this as parameter
===php_error===
PHP Fatal error:  Cannot re-assign $this in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "this"
                },
                "span": {
                  "start": 6,
                  "end": 11
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 14,
                  "end": 15
                }
              }
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
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "this"
                },
                "span": {
                  "start": 17,
                  "end": 22
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 26,
                  "end": 28
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 17,
            "end": 28
          }
        }
      },
      "span": {
        "start": 17,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "this"
                },
                "span": {
                  "start": 30,
                  "end": 35
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 40,
                  "end": 41
                }
              }
            }
          },
          "span": {
            "start": 30,
            "end": 41
          }
        }
      },
      "span": {
        "start": 30,
        "end": 42
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 43,
                  "end": 45
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "this"
                      },
                      "span": {
                        "start": 48,
                        "end": 53
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 56,
                        "end": 57
                      }
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 57
                }
              }
            }
          },
          "span": {
            "start": 43,
            "end": 57
          }
        }
      },
      "span": {
        "start": 43,
        "end": 58
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "this"
                          },
                          "span": {
                            "start": 60,
                            "end": 65
                          }
                        }
                      },
                      "span": {
                        "start": 60,
                        "end": 65
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Variable": "b"
                                    },
                                    "span": {
                                      "start": 68,
                                      "end": 70
                                    }
                                  }
                                },
                                "span": {
                                  "start": 68,
                                  "end": 70
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Variable": "this"
                                        },
                                        "span": {
                                          "start": 73,
                                          "end": 78
                                        }
                                      }
                                    },
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
                              }
                            ]
                          },
                          "span": {
                            "start": 67,
                            "end": 80
                          }
                        }
                      },
                      "span": {
                        "start": 67,
                        "end": 80
                      }
                    }
                  ]
                },
                "span": {
                  "start": 59,
                  "end": 81
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 84,
                  "end": 86
                }
              }
            }
          },
          "span": {
            "start": 59,
            "end": 86
          }
        }
      },
      "span": {
        "start": 59,
        "end": 87
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": "Omit",
                          "span": {
                            "start": 93,
                            "end": 94
                          }
                        }
                      },
                      "span": {
                        "start": 93,
                        "end": 94
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "b"
                          },
                          "span": {
                            "start": 95,
                            "end": 97
                          }
                        }
                      },
                      "span": {
                        "start": 95,
                        "end": 97
                      }
                    },
                    {
                      "key": null,
                      "kind": {
                        "ByRef": {
                          "kind": {
                            "Variable": "this"
                          },
                          "span": {
                            "start": 100,
                            "end": 105
                          }
                        }
                      },
                      "span": {
                        "start": 99,
                        "end": 105
                      }
                    }
                  ]
                },
                "span": {
                  "start": 88,
                  "end": 106
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 109,
                  "end": 111
                }
              }
            }
          },
          "span": {
            "start": 88,
            "end": 111
          }
        }
      },
      "span": {
        "start": 88,
        "end": 112
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 122,
              "end": 124
            }
          },
          "key": {
            "kind": {
              "Variable": "this"
            },
            "span": {
              "start": 128,
              "end": 133
            }
          },
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "this"
                      },
                      "span": {
                        "start": 138,
                        "end": 143
                      }
                    }
                  },
                  "span": {
                    "start": 138,
                    "end": 143
                  }
                }
              ]
            },
            "span": {
              "start": 137,
              "end": 144
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 146,
              "end": 148
            }
          }
        }
      },
      "span": {
        "start": 113,
        "end": 148
      }
    },
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 158,
              "end": 160
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Variable": "this"
            },
            "span": {
              "start": 165,
              "end": 170
            }
          },
          "by_ref": true,
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 172,
              "end": 174
            }
          }
        }
      },
      "span": {
        "start": 149,
        "end": 174
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 181,
              "end": 183
            }
          },
          {
            "kind": {
              "Variable": "this"
            },
            "span": {
              "start": 185,
              "end": 190
            }
          }
        ]
      },
      "span": {
        "start": 175,
        "end": 192
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "E"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 207,
                    "end": 208
                  }
                }
              ],
              "var": {
                "name": "this",
                "span": {
                  "start": 209,
                  "end": 214
                }
              },
              "body": [],
              "span": {
                "start": 206,
                "end": 218
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 193,
        "end": 218
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 228,
              "end": 229
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 230,
                  "end": 232
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 230,
                "end": 232
              }
            },
            {
              "name": {
                "name": "this",
                "span": {
                  "start": 242,
                  "end": 247
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
                      "start": 234,
                      "end": 237
                    }
                  }
                },
                "span": {
                  "start": 234,
                  "end": 237
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 234,
                "end": 247
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "b"
                    },
                    "span": {
                      "start": 258,
                      "end": 260
                    }
                  },
                  {
                    "kind": {
                      "Variable": "this"
                    },
                    "span": {
                      "start": 262,
                      "end": 267
                    }
                  }
                ]
              },
              "span": {
                "start": 251,
                "end": 268
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "c",
                      "span": {
                        "start": 276,
                        "end": 278
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 276,
                      "end": 278
                    }
                  },
                  {
                    "name": {
                      "name": "this",
                      "span": {
                        "start": 280,
                        "end": 285
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 280,
                      "end": 285
                    }
                  }
                ]
              },
              "span": {
                "start": 269,
                "end": 286
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 219,
        "end": 288
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [
                {
                  "name": {
                    "name": "this",
                    "span": {
                      "start": 292,
                      "end": 297
                    }
                  },
                  "type_hint": null,
                  "default": null,
                  "by_ref": false,
                  "variadic": false,
                  "is_readonly": false,
                  "is_final": false,
                  "visibility": null,
                  "set_visibility": null,
                  "attributes": [],
                  "span": {
                    "start": 292,
                    "end": 297
                  }
                }
              ],
              "return_type": null,
              "body": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 302,
                  "end": 303
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 289,
            "end": 303
          }
        }
      },
      "span": {
        "start": 289,
        "end": 304
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Closure": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "use_vars": [
                {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 322,
                      "end": 324
                    }
                  },
                  "by_ref": false,
                  "span": {
                    "start": 322,
                    "end": 324
                  }
                },
                {
                  "name": {
                    "name": "this",
                    "span": {
                      "start": 327,
                      "end": 332
                    }
                  },
                  "by_ref": true,
                  "span": {
                    "start": 326,
                    "end": 332
                  }
                }
              ],
              "return_type": null,
              "body": [],
              "attributes": []
            }
          },
          "span": {
            "start": 305,
            "end": 336
          }
        }
      },
      "span": {
        "start": 305,
        "end": 337
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 344,
              "end": 345
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
                    "name": "__construct",
                    "span": {
                      "start": 364,
                      "end": 375
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "this",
                        "span": {
                          "start": 383,
                          "end": 388
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 376,
                        "end": 388
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 348,
                "end": 392
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 338,
        "end": 394
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 394
  }
}
