===config===
min_php=8.4
===source===
<?php
interface I {
    public $a { get {} }
    public $b { get; set => 1; }
    public $c { final get; }
}
abstract class A {
    public $d { get; }
    abstract public $e { get {} set {} }
    abstract public $f { final get; set {} }
    abstract private $g { get; }
}
class B {
    public function __construct(public $h { set; }) {}
}
trait T {
    abstract private $i { get; }
}
===errors===
Abstract property hook cannot have body
Abstract property hook cannot have body
Property hook cannot be both abstract and final
Non-abstract property hook must have a body
Abstract property A::$e must specify at least one abstract hook
Property hook cannot be both abstract and final
Property hook cannot be both abstract and private
Non-abstract property hook must have a body
Property hook cannot be both abstract and private
===php_error===
PHP Fatal error:  Abstract property hook cannot have body in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 31,
                      "end": 33
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": []
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 42
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 44
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 56,
                      "end": 58
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 61,
                        "end": 65
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 73,
                            "end": 74
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 66,
                        "end": 75
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 49,
                "end": 77
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
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
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": true,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 94,
                        "end": 104
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 82,
                "end": 106
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 108
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 124,
              "end": 125
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
                    "name": "d",
                    "span": {
                      "start": 139,
                      "end": 141
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 144,
                        "end": 148
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 132,
                "end": 150
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 171,
                      "end": 173
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "is_abstract": true,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": []
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 176,
                        "end": 182
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
                        "start": 183,
                        "end": 189
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 155,
                "end": 191
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 212,
                      "end": 214
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "is_abstract": true,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": true,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 217,
                        "end": 227
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
                        "start": 228,
                        "end": 234
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 196,
                "end": 236
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 258,
                      "end": 260
                    }
                  },
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "is_abstract": true,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 263,
                        "end": 267
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 241,
                "end": 269
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 118,
        "end": 271
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 278,
              "end": 279
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
                      "start": 302,
                      "end": 313
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
                        "name": "h",
                        "span": {
                          "start": 321,
                          "end": 323
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
                      "hooks": [
                        {
                          "kind": "Set",
                          "body": "Abstract",
                          "is_final": false,
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 326,
                            "end": 330
                          }
                        }
                      ],
                      "span": {
                        "start": 314,
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
                "start": 286,
                "end": 336
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 272,
        "end": 338
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 345,
              "end": 346
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "i",
                    "span": {
                      "start": 370,
                      "end": 372
                    }
                  },
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "is_abstract": true,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 375,
                        "end": 379
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 353,
                "end": 381
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 339,
        "end": 383
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 383
  }
}
