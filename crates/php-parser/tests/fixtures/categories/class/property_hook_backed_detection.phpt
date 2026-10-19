===config===
min_php=8.4
===source===
<?php
namespace N;

abstract class A {
    public $a = 1 { get => $this->a; }
    public $b = 1 { get => $this?->b; }
    public $c = 1 { get => $this->{'c'}; }
    public $d = 1 { get => ${'this'}->d; }
    public $e = 1 { get => ($this)->e; }
    public $f = 1 { get => "$this->f"; }
    public $g = 1 { get => isset($this->g); }
    public $h = 1 { get => $this->h[0] ?? 1; }
    public $i = 1 { set => $value; }
    public $j = 1 { set { unset($this->j); } }
    public $k = 1 { set { [$this->k] = $value; } }
    public $l = 1 { get => ${'th' . 'is'}->{('l')}; }
    public $m = 1 { get { $f = fn() => 1; return $this->m; } }
    public $n = 1 { get => 1; set { $this->n = $value; } }
    public $o = 1 { final get => $this->o; }
    public $p = 1 { #[NoDiscard] get => $this->p; }
    public $q = 1 { get => <<<E
        {$this->q}
        E; }
    public private(set) int $r { get => 1; set { } }
    public private(set) int $s { get => $this->s; }
    public protected(set) int $t { set { $this->t = $value; } }
    public function __construct(public $u = 1 { get => 1; }) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 35,
              "end": 36
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 50,
                      "end": 52
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 55,
                      "end": 56
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 66,
                                  "end": 71
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "a"
                                },
                                "span": {
                                  "start": 73,
                                  "end": 74
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 66,
                            "end": 74
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 59,
                        "end": 75
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 43,
                "end": 77
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 89,
                      "end": 91
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 94,
                      "end": 95
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "NullsafePropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 105,
                                  "end": 110
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 113,
                                  "end": 114
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 105,
                            "end": 114
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 98,
                        "end": 115
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 82,
                "end": 117
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 129,
                      "end": 131
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 134,
                      "end": 135
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 145,
                                  "end": 150
                                }
                              },
                              "property": {
                                "kind": {
                                  "String": "c"
                                },
                                "span": {
                                  "start": 153,
                                  "end": 156
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 145,
                            "end": 156
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 138,
                        "end": 158
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 122,
                "end": 160
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 172,
                      "end": 174
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 177,
                      "end": 178
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "VariableVariable": {
                                    "kind": {
                                      "String": "this"
                                    },
                                    "span": {
                                      "start": 190,
                                      "end": 196
                                    }
                                  }
                                },
                                "span": {
                                  "start": 188,
                                  "end": 197
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "d"
                                },
                                "span": {
                                  "start": 199,
                                  "end": 200
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 188,
                            "end": 200
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 181,
                        "end": 201
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 165,
                "end": 203
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 215,
                      "end": 217
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 220,
                      "end": 221
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Parenthesized": {
                                    "kind": {
                                      "Variable": "this"
                                    },
                                    "span": {
                                      "start": 232,
                                      "end": 237
                                    }
                                  }
                                },
                                "span": {
                                  "start": 231,
                                  "end": 238
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "e"
                                },
                                "span": {
                                  "start": 240,
                                  "end": 241
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 231,
                            "end": 241
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 224,
                        "end": 242
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 208,
                "end": 244
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 256,
                      "end": 258
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 261,
                      "end": 262
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "InterpolatedString": [
                              {
                                "Expr": {
                                  "kind": {
                                    "PropertyAccess": {
                                      "object": {
                                        "kind": {
                                          "Variable": "this"
                                        },
                                        "span": {
                                          "start": 273,
                                          "end": 278
                                        }
                                      },
                                      "property": {
                                        "kind": {
                                          "Identifier": "f"
                                        },
                                        "span": {
                                          "start": 280,
                                          "end": 281
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 273,
                                    "end": 281
                                  }
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 272,
                            "end": 282
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 265,
                        "end": 283
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 249,
                "end": 285
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 297,
                      "end": 299
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 302,
                      "end": 303
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Isset": [
                              {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 319,
                                        "end": 324
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "g"
                                      },
                                      "span": {
                                        "start": 326,
                                        "end": 327
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 319,
                                  "end": 327
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 313,
                            "end": 328
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 306,
                        "end": 329
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 290,
                "end": 331
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 343,
                      "end": 345
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 348,
                      "end": 349
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "NullCoalesce": {
                              "left": {
                                "kind": {
                                  "ArrayAccess": {
                                    "array": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 359,
                                              "end": 364
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "h"
                                            },
                                            "span": {
                                              "start": 366,
                                              "end": 367
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 359,
                                        "end": 367
                                      }
                                    },
                                    "index": {
                                      "kind": {
                                        "Int": 0
                                      },
                                      "span": {
                                        "start": 368,
                                        "end": 369
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 359,
                                  "end": 370
                                }
                              },
                              "right": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 374,
                                  "end": 375
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 359,
                            "end": 375
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 352,
                        "end": 376
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 336,
                "end": 378
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 390,
                      "end": 392
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 395,
                      "end": 396
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 406,
                            "end": 412
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 399,
                        "end": 413
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 383,
                "end": 415
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "j",
                    "span": {
                      "start": 427,
                      "end": 429
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 432,
                      "end": 433
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Unset": [
                                {
                                  "kind": {
                                    "PropertyAccess": {
                                      "object": {
                                        "kind": {
                                          "Variable": "this"
                                        },
                                        "span": {
                                          "start": 448,
                                          "end": 453
                                        }
                                      },
                                      "property": {
                                        "kind": {
                                          "Identifier": "j"
                                        },
                                        "span": {
                                          "start": 455,
                                          "end": 456
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 448,
                                    "end": 456
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 442,
                              "end": 458
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 436,
                        "end": 460
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 420,
                "end": 462
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "k",
                    "span": {
                      "start": 474,
                      "end": 476
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 479,
                      "end": 480
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
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
                                                  "PropertyAccess": {
                                                    "object": {
                                                      "kind": {
                                                        "Variable": "this"
                                                      },
                                                      "span": {
                                                        "start": 490,
                                                        "end": 495
                                                      }
                                                    },
                                                    "property": {
                                                      "kind": {
                                                        "Identifier": "k"
                                                      },
                                                      "span": {
                                                        "start": 497,
                                                        "end": 498
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 490,
                                                  "end": 498
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 490,
                                              "end": 498
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 489,
                                        "end": 499
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 502,
                                        "end": 508
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 489,
                                  "end": 508
                                }
                              }
                            },
                            "span": {
                              "start": 489,
                              "end": 509
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 483,
                        "end": 511
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 467,
                "end": 513
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "l",
                    "span": {
                      "start": 525,
                      "end": 527
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 530,
                      "end": 531
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "VariableVariable": {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "String": "th"
                                          },
                                          "span": {
                                            "start": 543,
                                            "end": 547
                                          }
                                        },
                                        "op": "Concat",
                                        "right": {
                                          "kind": {
                                            "String": "is"
                                          },
                                          "span": {
                                            "start": 550,
                                            "end": 554
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 543,
                                      "end": 554
                                    }
                                  }
                                },
                                "span": {
                                  "start": 541,
                                  "end": 555
                                }
                              },
                              "property": {
                                "kind": {
                                  "Parenthesized": {
                                    "kind": {
                                      "String": "l"
                                    },
                                    "span": {
                                      "start": 559,
                                      "end": 562
                                    }
                                  }
                                },
                                "span": {
                                  "start": 558,
                                  "end": 563
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 541,
                            "end": 563
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 534,
                        "end": 565
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 518,
                "end": 567
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 579,
                      "end": 581
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 584,
                      "end": 585
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
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
                                        "start": 594,
                                        "end": 596
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
                                              "Int": 1
                                            },
                                            "span": {
                                              "start": 607,
                                              "end": 608
                                            }
                                          },
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 599,
                                        "end": 608
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 594,
                                  "end": 608
                                }
                              }
                            },
                            "span": {
                              "start": 594,
                              "end": 609
                            }
                          },
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 617,
                                        "end": 622
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "m"
                                      },
                                      "span": {
                                        "start": 624,
                                        "end": 625
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 617,
                                  "end": 625
                                }
                              }
                            },
                            "span": {
                              "start": 610,
                              "end": 626
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 588,
                        "end": 628
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 572,
                "end": 630
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "n",
                    "span": {
                      "start": 642,
                      "end": 644
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 647,
                      "end": 648
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 658,
                            "end": 659
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 651,
                        "end": 660
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Assign": {
                                    "target": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 667,
                                              "end": 672
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "n"
                                            },
                                            "span": {
                                              "start": 674,
                                              "end": 675
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 667,
                                        "end": 675
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 678,
                                        "end": 684
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 667,
                                  "end": 684
                                }
                              }
                            },
                            "span": {
                              "start": 667,
                              "end": 685
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 661,
                        "end": 687
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 635,
                "end": 689
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "o",
                    "span": {
                      "start": 701,
                      "end": 703
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 706,
                      "end": 707
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 723,
                                  "end": 728
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "o"
                                },
                                "span": {
                                  "start": 730,
                                  "end": 731
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 723,
                            "end": 731
                          }
                        }
                      },
                      "is_final": true,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 710,
                        "end": 732
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 694,
                "end": 734
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 746,
                      "end": 748
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 751,
                      "end": 752
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 775,
                                  "end": 780
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "p"
                                },
                                "span": {
                                  "start": 782,
                                  "end": 783
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 775,
                            "end": 783
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "NoDiscard"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 757,
                              "end": 766
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 757,
                            "end": 766
                          }
                        }
                      ],
                      "span": {
                        "start": 755,
                        "end": 784
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 739,
                "end": 786
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 798,
                      "end": 800
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 803,
                      "end": 804
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Heredoc": {
                              "label": "E",
                              "parts": [
                                {
                                  "Expr": {
                                    "kind": {
                                      "PropertyAccess": {
                                        "object": {
                                          "kind": {
                                            "Variable": "this"
                                          },
                                          "span": {
                                            "start": 828,
                                            "end": 833
                                          }
                                        },
                                        "property": {
                                          "kind": {
                                            "Identifier": "q"
                                          },
                                          "span": {
                                            "start": 835,
                                            "end": 836
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 828,
                                      "end": 836
                                    }
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 814,
                            "end": 847
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 807,
                        "end": 848
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 791,
                "end": 850
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "r",
                    "span": {
                      "start": 879,
                      "end": 881
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 875,
                          "end": 878
                        }
                      }
                    },
                    "span": {
                      "start": 875,
                      "end": 878
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 891,
                            "end": 892
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 884,
                        "end": 893
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 894,
                        "end": 901
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 855,
                "end": 903
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "s",
                    "span": {
                      "start": 932,
                      "end": 934
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 928,
                          "end": 931
                        }
                      }
                    },
                    "span": {
                      "start": 928,
                      "end": 931
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 944,
                                  "end": 949
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "s"
                                },
                                "span": {
                                  "start": 951,
                                  "end": 952
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 944,
                            "end": 952
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 937,
                        "end": 953
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 908,
                "end": 955
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "t",
                    "span": {
                      "start": 986,
                      "end": 988
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": "Protected",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 982,
                          "end": 985
                        }
                      }
                    },
                    "span": {
                      "start": 982,
                      "end": 985
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Assign": {
                                    "target": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 997,
                                              "end": 1002
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "t"
                                            },
                                            "span": {
                                              "start": 1004,
                                              "end": 1005
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 997,
                                        "end": 1005
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 1008,
                                        "end": 1014
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 997,
                                  "end": 1014
                                }
                              }
                            },
                            "span": {
                              "start": 997,
                              "end": 1015
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 991,
                        "end": 1017
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 960,
                "end": 1019
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 1040,
                      "end": 1051
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
                        "name": "u",
                        "span": {
                          "start": 1059,
                          "end": 1061
                        }
                      },
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 1064,
                          "end": 1065
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 1075,
                                "end": 1076
                              }
                            }
                          },
                          "is_final": false,
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 1068,
                            "end": 1077
                          }
                        }
                      ],
                      "span": {
                        "start": 1052,
                        "end": 1079
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 1024,
                "end": 1083
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 29,
        "end": 1085
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1085
  }
}
