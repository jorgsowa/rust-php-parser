===source===
<?php
// Comments in trait use statements
class Base {
  use
    /* first */ Trait1,
    // second
    Trait2,
    /* third */ Trait3;
}

// Comments in conflict resolution
class WithConflict {
  use Trait1 {
    /* before */ Trait1::method1 /* after */ insteadof Trait2;
    // method2 adaptation
    Trait1::method2 as protected;
  }
}

// Comments with as alias and visibility
class WithAlias {
  use Trait1 {
    /* original */ Trait1::method1 as /* renamed */ renamedMethod;
    // visibility change
    Trait1::method2 as private originalMethod;
  }
}

// Comments between insteadof clauses
class MultiInsteadof {
  use Trait1, Trait2 {
    /* method1 resolution */ Trait1::method1 insteadof Trait2;
    // method2 resolution
    Trait2::method2 insteadof Trait1;
  }
}

// Comments after trait names and before body
class CommentAfterName {
  use
    /* first trait */ Trait1,
    // second trait
    Trait2 /* before brace */ {
      // inside body
      Trait1::method1 insteadof Trait2;
    };
}

// Multiple comment blocks before adaptation
class MultiCommentAdaptation {
  use Trait1 {
    /**
     * Doc comment
     */
    // Single line
    /* Block */
    Trait1::method1 as protected;
  }
}

// Comments in trait with methods and constants
trait BaseTrait {
  /* constant 1 */ const C1 = 1;
  // constant 2
  const C2 = 2;

  /* method 1 */ public function m1() {}
  // method 2
  public function m2() {}
}

// Trait use in anonymous class with comments
$anon = new class {
  use
    /* trait */ Trait1,
    // trait2
    Trait2 {
      // insteadof
      Trait1::method1 insteadof Trait2;
    };
};

// Multiple trait use blocks with comments
class MultipleBlocks {
  use Trait1;
  // comment between blocks
  use Trait2 {
    /* adapt */ Trait2::method as private;
  }
}

// Comments in precedence declarations
class Precedence {
  use Trait1, Trait2, Trait3 {
    /* precedence */ Trait1::method insteadof Trait2, Trait3;
    // qualification
    Trait2::other as Trait2Other;
  }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Base",
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
                        "Trait1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 77,
                        "end": 83
                      }
                    },
                    {
                      "parts": [
                        "Trait2"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 103,
                        "end": 109
                      }
                    },
                    {
                      "parts": [
                        "Trait3"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 127,
                        "end": 133
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 57,
                "end": 134
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 42,
        "end": 136
      }
    },
    {
      "kind": {
        "Class": {
          "name": "WithConflict",
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
                        "Trait1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 200,
                        "end": 206
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "Trait1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 226,
                              "end": 232
                            }
                          },
                          "method": {
                            "parts": [
                              "method1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 234,
                              "end": 241
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "Trait2"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 264,
                                "end": 270
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 226,
                        "end": 271
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "Trait1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 302,
                              "end": 308
                            }
                          },
                          "method": {
                            "parts": [
                              "method2"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 310,
                              "end": 317
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 302,
                        "end": 331
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 196,
                "end": 335
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 173,
        "end": 337
      }
    },
    {
      "kind": {
        "Class": {
          "name": "WithAlias",
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
                        "Trait1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 404,
                        "end": 410
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "Trait1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 432,
                              "end": 438
                            }
                          },
                          "method": {
                            "parts": [
                              "method1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 440,
                              "end": 447
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "renamedMethod"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 465,
                              "end": 478
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 432,
                        "end": 479
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "Trait1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 509,
                              "end": 515
                            }
                          },
                          "method": {
                            "parts": [
                              "method2"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 517,
                              "end": 524
                            }
                          },
                          "new_modifier": "Private",
                          "new_name": {
                            "parts": [
                              "originalMethod"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 536,
                              "end": 550
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 509,
                        "end": 551
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 400,
                "end": 555
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 380,
        "end": 557
      }
    },
    {
      "kind": {
        "Class": {
          "name": "MultiInsteadof",
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
                        "Trait1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 626,
                        "end": 632
                      }
                    },
                    {
                      "parts": [
                        "Trait2"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 634,
                        "end": 640
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "Trait1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 672,
                              "end": 678
                            }
                          },
                          "method": {
                            "parts": [
                              "method1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 680,
                              "end": 687
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "Trait2"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 698,
                                "end": 704
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 672,
                        "end": 705
                      }
                    },
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "Trait2"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 736,
                              "end": 742
                            }
                          },
                          "method": {
                            "parts": [
                              "method2"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 744,
                              "end": 751
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "Trait1"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 762,
                                "end": 768
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 736,
                        "end": 769
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 622,
                "end": 773
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 597,
        "end": 775
      }
    },
    {
      "kind": {
        "Class": {
          "name": "CommentAfterName",
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
                        "Trait1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 876,
                        "end": 882
                      }
                    },
                    {
                      "parts": [
                        "Trait2"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 908,
                        "end": 914
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "Trait1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 963,
                              "end": 969
                            }
                          },
                          "method": {
                            "parts": [
                              "method1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 971,
                              "end": 978
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "Trait2"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 989,
                                "end": 995
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 963,
                        "end": 996
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 850,
                "end": 1002
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 823,
        "end": 1005
      }
    },
    {
      "kind": {
        "Class": {
          "name": "MultiCommentAdaptation",
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
                        "Trait1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 1089,
                        "end": 1095
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "Trait1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1172,
                              "end": 1178
                            }
                          },
                          "method": {
                            "parts": [
                              "method1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1180,
                              "end": 1187
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 1172,
                        "end": 1201
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 1085,
                "end": 1205
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1052,
        "end": 1207
      }
    },
    {
      "kind": {
        "Trait": {
          "name": "BaseTrait",
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "C1",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 1305,
                      "end": 1306
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 1294,
                "end": 1307
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "C2",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 1337,
                      "end": 1338
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 1326,
                "end": 1339
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "m1",
                  "visibility": "Public",
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
                "start": 1358,
                "end": 1381
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "m2",
                  "visibility": "Public",
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
                "start": 1398,
                "end": 1421
              }
            }
          ],
          "attributes": [],
          "doc_comment": {
            "kind": "Doc",
            "text": "/**\n     * Doc comment\n     */",
            "span": {
              "start": 1102,
              "end": 1132
            }
          }
        }
      },
      "span": {
        "start": 1257,
        "end": 1423
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "anon"
                },
                "span": {
                  "start": 1471,
                  "end": 1476
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
                          "members": [
                            {
                              "kind": {
                                "TraitUse": {
                                  "traits": [
                                    {
                                      "parts": [
                                        "Trait1"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 1513,
                                        "end": 1519
                                      }
                                    },
                                    {
                                      "parts": [
                                        "Trait2"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 1539,
                                        "end": 1545
                                      }
                                    }
                                  ],
                                  "adaptations": [
                                    {
                                      "kind": {
                                        "Precedence": {
                                          "trait_name": {
                                            "parts": [
                                              "Trait1"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 1573,
                                              "end": 1579
                                            }
                                          },
                                          "method": {
                                            "parts": [
                                              "method1"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 1581,
                                              "end": 1588
                                            }
                                          },
                                          "insteadof": [
                                            {
                                              "parts": [
                                                "Trait2"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 1599,
                                                "end": 1605
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 1573,
                                        "end": 1606
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 1493,
                                "end": 1612
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 1479,
                        "end": 1615
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 1479,
                  "end": 1615
                }
              }
            }
          },
          "span": {
            "start": 1471,
            "end": 1615
          }
        }
      },
      "span": {
        "start": 1471,
        "end": 1616
      }
    },
    {
      "kind": {
        "Class": {
          "name": "MultipleBlocks",
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
                        "Trait1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 1690,
                        "end": 1696
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 1686,
                "end": 1697
              }
            },
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "Trait2"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 1732,
                        "end": 1738
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "Trait2"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1757,
                              "end": 1763
                            }
                          },
                          "method": {
                            "parts": [
                              "method"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1765,
                              "end": 1771
                            }
                          },
                          "new_modifier": "Private",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 1757,
                        "end": 1783
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 1728,
                "end": 1787
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1661,
        "end": 1789
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Precedence",
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
                        "Trait1"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 1855,
                        "end": 1861
                      }
                    },
                    {
                      "parts": [
                        "Trait2"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 1863,
                        "end": 1869
                      }
                    },
                    {
                      "parts": [
                        "Trait3"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 1871,
                        "end": 1877
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "Trait1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1901,
                              "end": 1907
                            }
                          },
                          "method": {
                            "parts": [
                              "method"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1909,
                              "end": 1915
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "Trait2"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1926,
                                "end": 1932
                              }
                            },
                            {
                              "parts": [
                                "Trait3"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1934,
                                "end": 1940
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 1901,
                        "end": 1941
                      }
                    },
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": {
                            "parts": [
                              "Trait2"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1967,
                              "end": 1973
                            }
                          },
                          "method": {
                            "parts": [
                              "other"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1975,
                              "end": 1980
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "Trait2Other"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1984,
                              "end": 1995
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 1967,
                        "end": 1996
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 1851,
                "end": 2000
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1830,
        "end": 2002
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 2002
  }
}
