===source===
<?php
abstract class A {
    public $a { public get => 1; }
    public $b { protected get => 1; }
    public $c { private set { $this->c = $value; } }
    public int $d { private(set) get => 1; }
    public $e { final private get => 1; }
    public $f { abstract get; }
    public $g { abstract final get; }
    public $h { static get => 1; }
    public $i { readonly get => 1; }
    public $j { final final get => 1; }
    public $k { final get => 1; final set { } }
}
===errors >=8.4===
Cannot use the public modifier on a property hook
Cannot use the protected modifier on a property hook
Cannot use the private modifier on a property hook
Cannot use the private(set) modifier on a property hook
Cannot use the private modifier on a property hook
Cannot use the abstract modifier on a property hook
Non-abstract property hook must have a body
Cannot use the abstract modifier on a property hook
Non-abstract property hook must have a body
Cannot use the static modifier on a property hook
Cannot use the readonly modifier on a property hook
Multiple final modifiers are not allowed
===php_error===
PHP Fatal error:  Cannot use the public modifier on a property hook in Standard input code on line 3
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 21,
              "end": 22
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
                      "start": 36,
                      "end": 38
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
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 55,
                            "end": 56
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 41,
                        "end": 57
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 29,
                "end": 59
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 71,
                      "end": 73
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
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 93,
                            "end": 94
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 76,
                        "end": 95
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 64,
                "end": 97
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 109,
                      "end": 111
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
                                              "start": 128,
                                              "end": 133
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "c"
                                            },
                                            "span": {
                                              "start": 135,
                                              "end": 136
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 128,
                                        "end": 136
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 139,
                                        "end": 145
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 128,
                                  "end": 145
                                }
                              }
                            },
                            "span": {
                              "start": 128,
                              "end": 146
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 114,
                        "end": 148
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 102,
                "end": 150
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 166,
                      "end": 168
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 162,
                          "end": 165
                        }
                      }
                    },
                    "span": {
                      "start": 162,
                      "end": 165
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
                            "start": 191,
                            "end": 192
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 171,
                        "end": 193
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 155,
                "end": 195
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 207,
                      "end": 209
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
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 233,
                            "end": 234
                          }
                        }
                      },
                      "modifiers": {
                        "is_final": true
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 212,
                        "end": 235
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 200,
                "end": 237
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 249,
                      "end": 251
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
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 254,
                        "end": 267
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 242,
                "end": 269
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 281,
                      "end": 283
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
                      "body": "Abstract",
                      "modifiers": {
                        "is_final": true
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 286,
                        "end": 305
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 274,
                "end": 307
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 319,
                      "end": 321
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
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 338,
                            "end": 339
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 324,
                        "end": 340
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 312,
                "end": 342
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 354,
                      "end": 356
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
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 375,
                            "end": 376
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 359,
                        "end": 377
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 347,
                "end": 379
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "j",
                    "span": {
                      "start": 391,
                      "end": 393
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
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 415,
                            "end": 416
                          }
                        }
                      },
                      "modifiers": {
                        "is_final": true
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 396,
                        "end": 417
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 384,
                "end": 419
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "k",
                    "span": {
                      "start": 431,
                      "end": 433
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
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 449,
                            "end": 450
                          }
                        }
                      },
                      "modifiers": {
                        "is_final": true
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 436,
                        "end": 451
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "modifiers": {
                        "is_final": true
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 452,
                        "end": 465
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 424,
                "end": 467
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 469
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 469
  }
}
