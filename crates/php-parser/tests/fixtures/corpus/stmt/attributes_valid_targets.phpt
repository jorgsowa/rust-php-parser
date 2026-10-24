===description===
Built-in attributes on accepted targets; DelayedTargetValidation defers target errors; an attributed by-reference function is a declaration.
===source===
<?php
use Attribute as Attr;
use Foo\Bar as Attribute2;

#[Attribute] class A {}
#[Attribute(Attribute::TARGET_ALL)] final readonly class B {}
#[Attr] class C {}
#[AllowDynamicProperties] abstract class D {}
#[Deprecated] trait T {}
#[Deprecated, NoDiscard] function &f(): int { return 1; }
#[Deprecated] const K = 1;
#[Deprecated] function &g() {}
function h(#[SensitiveParameter] $a, #[SensitiveParameter] $b = 1) {}
#[DelayedTargetValidation, Attribute, Override] function i() {}
#[DelayedTargetValidation] #[ReturnTypeWillChange] class E {}
#[Attribute] #[Attribute2] #[Attribute2] class F {}
$a = new #[Attribute] class {};
$b = #[Deprecated, NoDiscard] fn(): int => 1;
$c = #[NoDiscard] static function (): int { return 1; };
enum G {
    #[Deprecated] case X;
    #[Deprecated] const Y = 1;
}
class H {
    #[Deprecated] const A = 1, B = 2;
    #[Deprecated] public function m() {}
    #[ReturnTypeWillChange] #[NoDiscard] public function n(): int { return 1; }
    #[Foo] public $p, $q;
    public function __construct(#[SensitiveParameter] public $r) {}
}
===errors <=7.4===
Cannot use expression as assignment target.
missing closing ')'
expected ';', found '{'
expected ';' after expression
expected variable, found '}'
===errors 8.0===
'readonly class' requires PHP 8.2 or higher
'attributes on constants' requires PHP 8.5 or higher
Attribute "Attribute" cannot target function (allowed targets: class)
'enums' requires PHP 8.1 or higher
===errors 8.1===
'readonly class' requires PHP 8.2 or higher
'attributes on constants' requires PHP 8.5 or higher
Attribute "Attribute" cannot target function (allowed targets: class)
Attribute "ReturnTypeWillChange" cannot target class (allowed targets: method)
===errors 8.2===
'attributes on constants' requires PHP 8.5 or higher
Attribute "Attribute" cannot target function (allowed targets: class)
Attribute "ReturnTypeWillChange" cannot target class (allowed targets: method)
===errors 8.3-8.4===
'attributes on constants' requires PHP 8.5 or higher
Attribute "Attribute" cannot target function (allowed targets: class)
Attribute "Override" cannot target function (allowed targets: method)
Attribute "ReturnTypeWillChange" cannot target class (allowed targets: method)
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=', expecting ')' in Standard input code on line 18
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "readonly", expecting "abstract" or "final" or "class" in Standard input code on line 6
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting "abstract" or "final" or "class" in Standard input code on line 6
===php_error 8.2-8.4===
PHP Parse error:  syntax error, unexpected token "const" in Standard input code on line 11
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 19
                }
              },
              "alias": {
                "name": "Attr",
                "span": {
                  "start": 23,
                  "end": 27
                }
              },
              "span": {
                "start": 10,
                "end": 27
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 33,
                  "end": 40
                }
              },
              "alias": {
                "name": "Attribute2",
                "span": {
                  "start": 44,
                  "end": 54
                }
              },
              "span": {
                "start": 33,
                "end": 54
              }
            }
          ]
        }
      },
      "span": {
        "start": 29,
        "end": 55
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
            "span": {
              "start": 358,
              "end": 359
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 597,
                  "end": 599
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 629,
                              "end": 631
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 602,
                        "end": 631
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "c"
                            },
                            "span": {
                              "start": 675,
                              "end": 677
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "enum"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 732,
                                  "end": 736
                                }
                              }
                            },
                            "span": {
                              "start": 732,
                              "end": 736
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 675,
                        "end": 736
                      }
                    }
                  }
                },
                "span": {
                  "start": 602,
                  "end": 736
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 597,
                "end": 736
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "ArrayAccess": {
                      "array": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "G"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 737,
                              "end": 738
                            }
                          }
                        },
                        "span": {
                          "start": 737,
                          "end": 738
                        }
                      },
                      "index": null
                    }
                  },
                  "span": {
                    "start": 737,
                    "end": 799
                  }
                }
              },
              "span": {
                "start": 737,
                "end": 799
              }
            },
            {
              "kind": {
                "Class": {
                  "name": {
                    "name": "H",
                    "span": {
                      "start": 806,
                      "end": 807
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
                              "start": 1015,
                              "end": 1026
                            }
                          },
                          "modifiers": {
                            "visibility": "Public"
                          },
                          "by_ref": false,
                          "params": [
                            {
                              "name": null,
                              "type_hint": null,
                              "default": null,
                              "by_ref": false,
                              "variadic": false,
                              "attributes": [],
                              "span": {
                                "start": 1027,
                                "end": 1027
                              }
                            }
                          ],
                          "return_type": null,
                          "body": null,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 999,
                        "end": 1027
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 800,
                "end": 1064
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 349,
        "end": 1064
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1064
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 19
                }
              },
              "alias": {
                "name": "Attr",
                "span": {
                  "start": 23,
                  "end": 27
                }
              },
              "span": {
                "start": 10,
                "end": 27
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "Bar"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 33,
                  "end": 40
                }
              },
              "alias": {
                "name": "Attribute2",
                "span": {
                  "start": 44,
                  "end": 54
                }
              },
              "span": {
                "start": 33,
                "end": 54
              }
            }
          ]
        }
      },
      "span": {
        "start": 29,
        "end": 55
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 76,
              "end": 77
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
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 59,
                  "end": 68
                }
              },
              "args": [],
              "span": {
                "start": 59,
                "end": 68
              }
            }
          ]
        }
      },
      "span": {
        "start": 57,
        "end": 80
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 138,
              "end": 139
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 83,
                  "end": 92
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Attribute"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 93,
                                  "end": 102
                                }
                              }
                            },
                            "span": {
                              "start": 93,
                              "end": 102
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "TARGET_ALL"
                            },
                            "span": {
                              "start": 104,
                              "end": 114
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 93,
                        "end": 114
                      }
                    }
                  },
                  "span": {
                    "start": 93,
                    "end": 114
                  }
                }
              ],
              "span": {
                "start": 83,
                "end": 115
              }
            }
          ]
        }
      },
      "span": {
        "start": 81,
        "end": 142
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 157,
              "end": 158
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
                  "start": 145,
                  "end": 149
                }
              },
              "args": [],
              "span": {
                "start": 145,
                "end": 149
              }
            }
          ]
        }
      },
      "span": {
        "start": 143,
        "end": 161
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 203,
              "end": 204
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 164,
                  "end": 186
                }
              },
              "args": [],
              "span": {
                "start": 164,
                "end": 186
              }
            }
          ]
        }
      },
      "span": {
        "start": 162,
        "end": 207
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 228,
              "end": 229
            }
          },
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 210,
                  "end": 220
                }
              },
              "args": [],
              "span": {
                "start": 210,
                "end": 220
              }
            }
          ]
        }
      },
      "span": {
        "start": 208,
        "end": 232
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 268,
              "end": 269
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 286,
                    "end": 287
                  }
                }
              },
              "span": {
                "start": 279,
                "end": 288
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 273,
                  "end": 276
                }
              }
            },
            "span": {
              "start": 273,
              "end": 276
            }
          },
          "by_ref": true,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 235,
                  "end": 245
                }
              },
              "args": [],
              "span": {
                "start": 235,
                "end": 245
              }
            },
            {
              "name": {
                "parts": [
                  "NoDiscard"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 247,
                  "end": 256
                }
              },
              "args": [],
              "span": {
                "start": 247,
                "end": 256
              }
            }
          ]
        }
      },
      "span": {
        "start": 233,
        "end": 290
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "K",
              "span": {
                "start": 311,
                "end": 312
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 315,
                "end": 316
              }
            },
            "attributes": [
              {
                "name": {
                  "parts": [
                    "Deprecated"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 293,
                    "end": 303
                  }
                },
                "args": [],
                "span": {
                  "start": 293,
                  "end": 303
                }
              }
            ],
            "span": {
              "start": 311,
              "end": 316
            }
          }
        ]
      },
      "span": {
        "start": 291,
        "end": 317
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 342,
              "end": 343
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": true,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 320,
                  "end": 330
                }
              },
              "args": [],
              "span": {
                "start": 320,
                "end": 330
              }
            }
          ]
        }
      },
      "span": {
        "start": 318,
        "end": 348
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "h",
            "span": {
              "start": 358,
              "end": 359
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 382,
                  "end": 384
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "SensitiveParameter"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 362,
                      "end": 380
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 362,
                    "end": 380
                  }
                }
              ],
              "span": {
                "start": 360,
                "end": 384
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 408,
                  "end": 410
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 413,
                  "end": 414
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "SensitiveParameter"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 388,
                      "end": 406
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 388,
                    "end": 406
                  }
                }
              ],
              "span": {
                "start": 386,
                "end": 414
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
        "start": 349,
        "end": 418
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "i",
            "span": {
              "start": 476,
              "end": 477
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 421,
                  "end": 444
                }
              },
              "args": [],
              "span": {
                "start": 421,
                "end": 444
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 446,
                  "end": 455
                }
              },
              "args": [],
              "span": {
                "start": 446,
                "end": 455
              }
            },
            {
              "name": {
                "parts": [
                  "Override"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 457,
                  "end": 465
                }
              },
              "args": [],
              "span": {
                "start": 457,
                "end": 465
              }
            }
          ]
        }
      },
      "span": {
        "start": 419,
        "end": 482
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "E",
            "span": {
              "start": 540,
              "end": 541
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
                  "DelayedTargetValidation"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 485,
                  "end": 508
                }
              },
              "args": [],
              "span": {
                "start": 485,
                "end": 508
              }
            },
            {
              "name": {
                "parts": [
                  "ReturnTypeWillChange"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 512,
                  "end": 532
                }
              },
              "args": [],
              "span": {
                "start": 512,
                "end": 532
              }
            }
          ]
        }
      },
      "span": {
        "start": 483,
        "end": 544
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "F",
            "span": {
              "start": 592,
              "end": 593
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
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 547,
                  "end": 556
                }
              },
              "args": [],
              "span": {
                "start": 547,
                "end": 556
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute2"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 560,
                  "end": 570
                }
              },
              "args": [],
              "span": {
                "start": 560,
                "end": 570
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute2"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 574,
                  "end": 584
                }
              },
              "args": [],
              "span": {
                "start": 574,
                "end": 584
              }
            }
          ]
        }
      },
      "span": {
        "start": 545,
        "end": 596
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
                  "start": 597,
                  "end": 599
                }
              },
              "op": "Assign",
              "value": {
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
                          "members": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "Attribute"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 608,
                                  "end": 617
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 608,
                                "end": 617
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 602,
                        "end": 627
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 602,
                  "end": 627
                }
              }
            }
          },
          "span": {
            "start": 597,
            "end": 627
          }
        }
      },
      "span": {
        "start": 597,
        "end": 628
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 629,
                  "end": 631
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 665,
                            "end": 668
                          }
                        }
                      },
                      "span": {
                        "start": 665,
                        "end": 668
                      }
                    },
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 672,
                        "end": 673
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "Deprecated"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 636,
                            "end": 646
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 636,
                          "end": 646
                        }
                      },
                      {
                        "name": {
                          "parts": [
                            "NoDiscard"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 648,
                            "end": 657
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 648,
                          "end": 657
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 634,
                  "end": 673
                }
              }
            }
          },
          "span": {
            "start": 629,
            "end": 673
          }
        }
      },
      "span": {
        "start": 629,
        "end": 674
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
                  "start": 675,
                  "end": 677
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 713,
                            "end": 716
                          }
                        }
                      },
                      "span": {
                        "start": 713,
                        "end": 716
                      }
                    },
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 726,
                              "end": 727
                            }
                          }
                        },
                        "span": {
                          "start": 719,
                          "end": 728
                        }
                      }
                    ],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "NoDiscard"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 682,
                            "end": 691
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 682,
                          "end": 691
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 680,
                  "end": 730
                }
              }
            }
          },
          "span": {
            "start": 675,
            "end": 730
          }
        }
      },
      "span": {
        "start": 675,
        "end": 731
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "G",
            "span": {
              "start": 737,
              "end": 738
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 764,
                      "end": 765
                    }
                  },
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 747,
                          "end": 757
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 747,
                        "end": 757
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 745,
                "end": 766
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 791,
                      "end": 792
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 795,
                      "end": 796
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 773,
                          "end": 783
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 773,
                        "end": 783
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 771,
                "end": 797
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 732,
        "end": 799
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "H",
            "span": {
              "start": 806,
              "end": 807
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
                      "start": 834,
                      "end": 835
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 838,
                      "end": 839
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 816,
                          "end": 826
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 816,
                        "end": 826
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 814,
                "end": 839
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 841,
                      "end": 842
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 845,
                      "end": 846
                    }
                  },
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 816,
                          "end": 826
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 816,
                        "end": 826
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 841,
                "end": 847
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 882,
                      "end": 883
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 854,
                          "end": 864
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 854,
                        "end": 864
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 852,
                "end": 888
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "n",
                    "span": {
                      "start": 946,
                      "end": 947
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 951,
                          "end": 954
                        }
                      }
                    },
                    "span": {
                      "start": 951,
                      "end": 954
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 964,
                            "end": 965
                          }
                        }
                      },
                      "span": {
                        "start": 957,
                        "end": 966
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "ReturnTypeWillChange"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 895,
                          "end": 915
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 895,
                        "end": 915
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "NoDiscard"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 919,
                          "end": 928
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 919,
                        "end": 928
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 893,
                "end": 968
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 987,
                      "end": 989
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 975,
                          "end": 978
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 975,
                        "end": 978
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 973,
                "end": 989
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 991,
                      "end": 993
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 975,
                          "end": 978
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 975,
                        "end": 978
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 991,
                "end": 993
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 1015,
                      "end": 1026
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "r",
                        "span": {
                          "start": 1056,
                          "end": 1058
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "SensitiveParameter"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1029,
                              "end": 1047
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 1029,
                            "end": 1047
                          }
                        }
                      ],
                      "span": {
                        "start": 1027,
                        "end": 1058
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 999,
                "end": 1062
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 800,
        "end": 1064
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1064
  }
}
