===source===
<?php
function f($a, $a) {}
function g($a, $b, &$a) {}
function h($a, ...$a) {}
function i(int $a = 1, string $a = '') {}
$c = function ($a, $a) {};
$d = static fn($a, $a) => 1;
class A {
    public function m($a, $a) {}
    public function __construct(public $a, $a) {}
}
interface I { public function m($a, $b, $a); }
abstract class B { abstract public function m($a, $a); }
trait T { public function m($a, $a, $a) {} }
enum E { public function m($a, $a) {} }
new class { public function m($a, $a) {} };
===errors===
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
Redefinition of parameter $a
===php_error===
PHP Fatal error:  Redefinition of parameter $a in Standard input code on line 2
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 19
              }
            },
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 21,
                  "end": 23
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
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 37,
              "end": 38
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 39,
                  "end": 41
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
                "start": 39,
                "end": 41
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 43,
                  "end": 45
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
                "start": 43,
                "end": 45
              }
            },
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 48,
                  "end": 50
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 47,
                "end": 50
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
        "start": 28,
        "end": 54
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
            "span": {
              "start": 64,
              "end": 65
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 66,
                  "end": 68
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
                "start": 66,
                "end": 68
              }
            },
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 73,
                  "end": 75
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 70,
                "end": 75
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
        "start": 55,
        "end": 79
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "i",
            "span": {
              "start": 89,
              "end": 90
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 95,
                  "end": 97
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
                      "start": 91,
                      "end": 94
                    }
                  }
                },
                "span": {
                  "start": 91,
                  "end": 94
                }
              },
              "default": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 100,
                  "end": 101
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 91,
                "end": 101
              }
            },
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 110,
                  "end": 112
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
                      "start": 103,
                      "end": 109
                    }
                  }
                },
                "span": {
                  "start": 103,
                  "end": 109
                }
              },
              "default": {
                "kind": {
                  "String": ""
                },
                "span": {
                  "start": 115,
                  "end": 117
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 103,
                "end": 117
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
        "start": 80,
        "end": 121
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
                  "start": 122,
                  "end": 124
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
                            "start": 137,
                            "end": 139
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
                          "start": 137,
                          "end": 139
                        }
                      },
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 141,
                            "end": 143
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
                          "start": 141,
                          "end": 143
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
                  "start": 127,
                  "end": 147
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 147
          }
        }
      },
      "span": {
        "start": 122,
        "end": 148
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "d"
                },
                "span": {
                  "start": 149,
                  "end": 151
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 164,
                            "end": 166
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
                          "start": 164,
                          "end": 166
                        }
                      },
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 168,
                            "end": 170
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
                          "start": 168,
                          "end": 170
                        }
                      }
                    ],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 175,
                        "end": 176
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 154,
                  "end": 176
                }
              }
            }
          },
          "span": {
            "start": 149,
            "end": 176
          }
        }
      },
      "span": {
        "start": 149,
        "end": 177
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 184,
              "end": 185
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
                      "start": 208,
                      "end": 209
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
                        "name": "a",
                        "span": {
                          "start": 210,
                          "end": 212
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
                        "start": 210,
                        "end": 212
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 214,
                          "end": 216
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
                        "start": 214,
                        "end": 216
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 192,
                "end": 220
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 241,
                      "end": 252
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
                        "name": "a",
                        "span": {
                          "start": 260,
                          "end": 262
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
                        "start": 253,
                        "end": 262
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 264,
                          "end": 266
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
                        "start": 264,
                        "end": 266
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 225,
                "end": 270
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 178,
        "end": 272
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 283,
              "end": 284
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 303,
                      "end": 304
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
                        "name": "a",
                        "span": {
                          "start": 305,
                          "end": 307
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
                        "start": 305,
                        "end": 307
                      }
                    },
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 309,
                          "end": 311
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
                        "start": 309,
                        "end": 311
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 313,
                          "end": 315
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
                        "start": 313,
                        "end": 315
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 287,
                "end": 317
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 273,
        "end": 319
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 335,
              "end": 336
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                      "start": 364,
                      "end": 365
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 366,
                          "end": 368
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
                        "start": 366,
                        "end": 368
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 370,
                          "end": 372
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
                        "start": 370,
                        "end": 372
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 339,
                "end": 374
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 329,
        "end": 376
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 383,
              "end": 384
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 403,
                      "end": 404
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
                        "name": "a",
                        "span": {
                          "start": 405,
                          "end": 407
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
                        "start": 405,
                        "end": 407
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 409,
                          "end": 411
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
                        "start": 409,
                        "end": 411
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 413,
                          "end": 415
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
                        "start": 413,
                        "end": 415
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 387,
                "end": 419
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 377,
        "end": 421
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 427,
              "end": 428
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 447,
                      "end": 448
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
                        "name": "a",
                        "span": {
                          "start": 449,
                          "end": 451
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
                        "start": 449,
                        "end": 451
                      }
                    },
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 453,
                          "end": 455
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
                        "start": 453,
                        "end": 455
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 431,
                "end": 459
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 422,
        "end": 461
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
                                "start": 490,
                                "end": 491
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
                                  "name": "a",
                                  "span": {
                                    "start": 492,
                                    "end": 494
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
                                  "start": 492,
                                  "end": 494
                                }
                              },
                              {
                                "name": {
                                  "name": "a",
                                  "span": {
                                    "start": 496,
                                    "end": 498
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
                                  "start": 496,
                                  "end": 498
                                }
                              }
                            ],
                            "return_type": null,
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 474,
                          "end": 502
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 462,
                  "end": 504
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 462,
            "end": 504
          }
        }
      },
      "span": {
        "start": 462,
        "end": 505
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 505
  }
}
