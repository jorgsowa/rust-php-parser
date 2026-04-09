===source===
<?php

class Test {
    function array() {}
    function public() {}

    static function list() {}
    static function protected() {}

    public $class;
    public $private;

    const TRAIT = 3, FINAL = 4;

    const __CLASS__ = 1, __TRAIT__ = 2, __FUNCTION__ = 3, __METHOD__ = 4, __LINE__ = 5,
          __FILE__ = 6, __DIR__ = 7, __NAMESPACE__ = 8;
    // __halt_compiler does not work
}

$t = new Test;
$t->array();
$t->public();

Test::list();
Test::protected();

$t->class;
$t->private;

Test::TRAIT;
Test::FINAL;

class Foo {
    use TraitA, TraitB {
        TraitA::catch insteadof namespace\TraitB;
        TraitA::list as foreach;
        TraitB::throw as protected public;
        TraitB::self as protected;
        exit as die;
        \TraitC::exit as bye;
        namespace\TraitC::exit as byebye;
        TraitA::
            //
            /** doc comment */
            #
        catch /* comment */
            // comment
            # comment
        insteadof TraitB;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                  "name": "array",
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 48,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "public",
                  "visibility": null,
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 48,
                "end": 74,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "list",
                  "visibility": null,
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 74,
                "end": 104,
                "start_line": 7,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "protected",
                  "visibility": null,
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 104,
                "end": 140,
                "start_line": 8,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "class",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 140,
                "end": 153,
                "start_line": 10,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "private",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 174,
                "start_line": 11,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "TRAIT",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 195,
                      "end": 196,
                      "start_line": 13,
                      "start_col": 18
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 181,
                "end": 214,
                "start_line": 13,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "FINAL",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 206,
                      "end": 207,
                      "start_line": 13,
                      "start_col": 29
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 181,
                "end": 214,
                "start_line": 13,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "__CLASS__",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 232,
                      "end": 233,
                      "start_line": 15,
                      "start_col": 22
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 391,
                "start_line": 15,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "__TRAIT__",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 247,
                      "end": 248,
                      "start_line": 15,
                      "start_col": 37
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 391,
                "start_line": 15,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "__FUNCTION__",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 3
                    },
                    "span": {
                      "start": 265,
                      "end": 266,
                      "start_line": 15,
                      "start_col": 55
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 391,
                "start_line": 15,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "__METHOD__",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 281,
                      "end": 282,
                      "start_line": 15,
                      "start_col": 71
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 391,
                "start_line": 15,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "__LINE__",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 5
                    },
                    "span": {
                      "start": 295,
                      "end": 296,
                      "start_line": 15,
                      "start_col": 85
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 391,
                "start_line": 15,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "__FILE__",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 6
                    },
                    "span": {
                      "start": 319,
                      "end": 320,
                      "start_line": 16,
                      "start_col": 21
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 391,
                "start_line": 15,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "__DIR__",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 7
                    },
                    "span": {
                      "start": 332,
                      "end": 333,
                      "start_line": 16,
                      "start_col": 34
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 391,
                "start_line": 15,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "__NAMESPACE__",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 8
                    },
                    "span": {
                      "start": 351,
                      "end": 352,
                      "start_line": 16,
                      "start_col": 53
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 391,
                "start_line": 15,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 392,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "t"
                },
                "span": {
                  "start": 394,
                  "end": 396,
                  "start_line": 20,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Identifier": "Test"
                      },
                      "span": {
                        "start": 403,
                        "end": 407,
                        "start_line": 20,
                        "start_col": 9
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 399,
                  "end": 407,
                  "start_line": 20,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 394,
            "end": 407,
            "start_line": 20,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 394,
        "end": 409,
        "start_line": 20,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "t"
                },
                "span": {
                  "start": 409,
                  "end": 411,
                  "start_line": 21,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "array"
                },
                "span": {
                  "start": 413,
                  "end": 418,
                  "start_line": 21,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 409,
            "end": 420,
            "start_line": 21,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 409,
        "end": 422,
        "start_line": 21,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "t"
                },
                "span": {
                  "start": 422,
                  "end": 424,
                  "start_line": 22,
                  "start_col": 0
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 426,
                  "end": 432,
                  "start_line": 22,
                  "start_col": 4
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 422,
            "end": 434,
            "start_line": 22,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 422,
        "end": 437,
        "start_line": 22,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Test"
                },
                "span": {
                  "start": 437,
                  "end": 441,
                  "start_line": 24,
                  "start_col": 0
                }
              },
              "method": "list",
              "args": []
            }
          },
          "span": {
            "start": 437,
            "end": 449,
            "start_line": 24,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 437,
        "end": 451,
        "start_line": 24,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "Identifier": "Test"
                },
                "span": {
                  "start": 451,
                  "end": 455,
                  "start_line": 25,
                  "start_col": 0
                }
              },
              "method": "protected",
              "args": []
            }
          },
          "span": {
            "start": 451,
            "end": 468,
            "start_line": 25,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 451,
        "end": 471,
        "start_line": 25,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "t"
                },
                "span": {
                  "start": 471,
                  "end": 473,
                  "start_line": 27,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 475,
                  "end": 480,
                  "start_line": 27,
                  "start_col": 4
                }
              }
            }
          },
          "span": {
            "start": 471,
            "end": 480,
            "start_line": 27,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 471,
        "end": 482,
        "start_line": 27,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Variable": "t"
                },
                "span": {
                  "start": 482,
                  "end": 484,
                  "start_line": 28,
                  "start_col": 0
                }
              },
              "property": {
                "kind": {
                  "Identifier": "private"
                },
                "span": {
                  "start": 486,
                  "end": 493,
                  "start_line": 28,
                  "start_col": 4
                }
              }
            }
          },
          "span": {
            "start": 482,
            "end": 493,
            "start_line": 28,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 482,
        "end": 496,
        "start_line": 28,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "Test"
                },
                "span": {
                  "start": 496,
                  "end": 500,
                  "start_line": 30,
                  "start_col": 0
                }
              },
              "member": "TRAIT"
            }
          },
          "span": {
            "start": 496,
            "end": 507,
            "start_line": 30,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 496,
        "end": 509,
        "start_line": 30,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ClassConstAccess": {
              "class": {
                "kind": {
                  "Identifier": "Test"
                },
                "span": {
                  "start": 509,
                  "end": 513,
                  "start_line": 31,
                  "start_col": 0
                }
              },
              "member": "FINAL"
            }
          },
          "span": {
            "start": 509,
            "end": 520,
            "start_line": 31,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 509,
        "end": 523,
        "start_line": 31,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "TraitA"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 543,
                        "end": 549,
                        "start_line": 34,
                        "start_col": 8
                      }
                    },
                    {
                      "parts": [
                        "TraitB"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 551,
                        "end": 558,
                        "start_line": 34,
                        "start_col": 16
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "TraitA"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 568,
                              "end": 574,
                              "start_line": 35,
                              "start_col": 8
                            }
                          },
                          "method": "catch",
                          "insteadof": [
                            {
                              "parts": [
                                "TraitB"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 592,
                                "end": 608,
                                "start_line": 35,
                                "start_col": 32
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 568,
                        "end": 618,
                        "start_line": 35,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "TraitA"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 618,
                              "end": 624,
                              "start_line": 36,
                              "start_col": 8
                            }
                          },
                          "method": "list",
                          "new_modifier": null,
                          "new_name": "foreach"
                        }
                      },
                      "span": {
                        "start": 618,
                        "end": 651,
                        "start_line": 36,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "TraitB"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 651,
                              "end": 657,
                              "start_line": 37,
                              "start_col": 8
                            }
                          },
                          "method": "throw",
                          "new_modifier": "Protected",
                          "new_name": "public"
                        }
                      },
                      "span": {
                        "start": 651,
                        "end": 694,
                        "start_line": 37,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "TraitB"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 694,
                              "end": 700,
                              "start_line": 38,
                              "start_col": 8
                            }
                          },
                          "method": "self",
                          "new_modifier": "Protected",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 694,
                        "end": 729,
                        "start_line": 38,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": "exit",
                          "new_modifier": null,
                          "new_name": "die"
                        }
                      },
                      "span": {
                        "start": 729,
                        "end": 750,
                        "start_line": 39,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "TraitC"
                            ],
                            "kind": "FullyQualified",
                            "span": {
                              "start": 750,
                              "end": 757,
                              "start_line": 40,
                              "start_col": 8
                            }
                          },
                          "method": "exit",
                          "new_modifier": null,
                          "new_name": "bye"
                        }
                      },
                      "span": {
                        "start": 750,
                        "end": 780,
                        "start_line": 40,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "TraitC"
                            ],
                            "kind": "Relative",
                            "span": {
                              "start": 780,
                              "end": 796,
                              "start_line": 41,
                              "start_col": 8
                            }
                          },
                          "method": "exit",
                          "new_modifier": null,
                          "new_name": "byebye"
                        }
                      },
                      "span": {
                        "start": 780,
                        "end": 822,
                        "start_line": 41,
                        "start_col": 8
                      }
                    },
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "TraitA"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 822,
                              "end": 828,
                              "start_line": 42,
                              "start_col": 8
                            }
                          },
                          "method": "catch",
                          "insteadof": [
                            {
                              "parts": [
                                "TraitB"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 982,
                                "end": 988,
                                "start_line": 49,
                                "start_col": 18
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 822,
                        "end": 994,
                        "start_line": 42,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 539,
                "end": 996,
                "start_line": 34,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 523,
        "end": 997,
        "start_line": 33,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 997,
    "start_line": 1,
    "start_col": 0
  }
}
