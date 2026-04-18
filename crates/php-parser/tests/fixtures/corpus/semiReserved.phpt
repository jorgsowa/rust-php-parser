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
                "end": 43
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
                "end": 68
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
                "end": 99
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
                "end": 134
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
                "end": 153
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
                "end": 174
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
                      "end": 196
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 181,
                "end": 208
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
                      "end": 207
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 181,
                "end": 208
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
                      "end": 233
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 353
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
                      "end": 248
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 353
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
                      "end": 266
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 353
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
                      "end": 282
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 353
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
                      "end": 296
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 353
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
                      "end": 320
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 353
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
                      "end": 333
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 353
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
                      "end": 352
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 214,
                "end": 353
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 392
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
                  "end": 396
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
                        "end": 407
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 399,
                  "end": 407
                }
              }
            }
          },
          "span": {
            "start": 394,
            "end": 407
          }
        }
      },
      "span": {
        "start": 394,
        "end": 408
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
                  "end": 411
                }
              },
              "method": {
                "kind": {
                  "Identifier": "array"
                },
                "span": {
                  "start": 413,
                  "end": 418
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 409,
            "end": 420
          }
        }
      },
      "span": {
        "start": 409,
        "end": 421
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
                  "end": 424
                }
              },
              "method": {
                "kind": {
                  "Identifier": "public"
                },
                "span": {
                  "start": 426,
                  "end": 432
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 422,
            "end": 434
          }
        }
      },
      "span": {
        "start": 422,
        "end": 435
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
                  "end": 441
                }
              },
              "method": {
                "parts": [
                  "list"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 443,
                  "end": 447
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 437,
            "end": 449
          }
        }
      },
      "span": {
        "start": 437,
        "end": 450
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
                  "end": 455
                }
              },
              "method": {
                "parts": [
                  "protected"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 457,
                  "end": 466
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 451,
            "end": 468
          }
        }
      },
      "span": {
        "start": 451,
        "end": 469
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
                  "end": 473
                }
              },
              "property": {
                "kind": {
                  "Identifier": "class"
                },
                "span": {
                  "start": 475,
                  "end": 480
                }
              }
            }
          },
          "span": {
            "start": 471,
            "end": 480
          }
        }
      },
      "span": {
        "start": 471,
        "end": 481
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
                  "end": 484
                }
              },
              "property": {
                "kind": {
                  "Identifier": "private"
                },
                "span": {
                  "start": 486,
                  "end": 493
                }
              }
            }
          },
          "span": {
            "start": 482,
            "end": 493
          }
        }
      },
      "span": {
        "start": 482,
        "end": 494
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
                  "end": 500
                }
              },
              "member": {
                "kind": {
                  "Identifier": "TRAIT"
                },
                "span": {
                  "start": 502,
                  "end": 507
                }
              }
            }
          },
          "span": {
            "start": 496,
            "end": 507
          }
        }
      },
      "span": {
        "start": 496,
        "end": 508
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
                  "end": 513
                }
              },
              "member": {
                "kind": {
                  "Identifier": "FINAL"
                },
                "span": {
                  "start": 515,
                  "end": 520
                }
              }
            }
          },
          "span": {
            "start": 509,
            "end": 520
          }
        }
      },
      "span": {
        "start": 509,
        "end": 521
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
                        "end": 549
                      }
                    },
                    {
                      "parts": [
                        "TraitB"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 551,
                        "end": 557
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
                              "end": 574
                            }
                          },
                          "method": {
                            "parts": [
                              "catch"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 576,
                              "end": 581
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "TraitB"
                              ],
                              "kind": "Relative",
                              "span": {
                                "start": 592,
                                "end": 608
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 568,
                        "end": 609
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
                              "end": 624
                            }
                          },
                          "method": {
                            "parts": [
                              "list"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 626,
                              "end": 630
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "foreach"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 634,
                              "end": 641
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 618,
                        "end": 642
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
                              "end": 657
                            }
                          },
                          "method": {
                            "parts": [
                              "throw"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 659,
                              "end": 664
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": {
                            "parts": [
                              "public"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 678,
                              "end": 684
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 651,
                        "end": 685
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
                              "end": 700
                            }
                          },
                          "method": {
                            "parts": [
                              "self"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 702,
                              "end": 706
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 694,
                        "end": 720
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "exit"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 729,
                              "end": 733
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "die"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 737,
                              "end": 740
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 729,
                        "end": 741
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
                              "end": 757
                            }
                          },
                          "method": {
                            "parts": [
                              "exit"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 759,
                              "end": 763
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "bye"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 767,
                              "end": 770
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 750,
                        "end": 771
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
                              "end": 796
                            }
                          },
                          "method": {
                            "parts": [
                              "exit"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 798,
                              "end": 802
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "byebye"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 806,
                              "end": 812
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 780,
                        "end": 813
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
                              "end": 828
                            }
                          },
                          "method": {
                            "parts": [
                              "catch"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 899,
                              "end": 904
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "TraitB"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 982,
                                "end": 988
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 822,
                        "end": 989
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 539,
                "end": 995
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 523,
        "end": 997
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 997
  }
}
