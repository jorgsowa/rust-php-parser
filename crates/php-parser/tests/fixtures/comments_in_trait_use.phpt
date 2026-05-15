===config===
min_php=8.2
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
    }
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
    }
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
        "end": 1004
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
                        "start": 1088,
                        "end": 1094
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
                              "start": 1171,
                              "end": 1177
                            }
                          },
                          "method": {
                            "parts": [
                              "method1"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1179,
                              "end": 1186
                            }
                          },
                          "new_modifier": "Protected",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 1171,
                        "end": 1200
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 1084,
                "end": 1204
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1051,
        "end": 1206
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
                      "start": 1304,
                      "end": 1305
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 1293,
                "end": 1306
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
                      "start": 1336,
                      "end": 1337
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 1325,
                "end": 1338
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
                "start": 1357,
                "end": 1380
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
                "start": 1397,
                "end": 1420
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1256,
        "end": 1422
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
                  "start": 1470,
                  "end": 1475
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
                                        "start": 1512,
                                        "end": 1518
                                      }
                                    },
                                    {
                                      "parts": [
                                        "Trait2"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 1538,
                                        "end": 1544
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
                                              "start": 1572,
                                              "end": 1578
                                            }
                                          },
                                          "method": {
                                            "parts": [
                                              "method1"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 1580,
                                              "end": 1587
                                            }
                                          },
                                          "insteadof": [
                                            {
                                              "parts": [
                                                "Trait2"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 1598,
                                                "end": 1604
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 1572,
                                        "end": 1605
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 1492,
                                "end": 1611
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 1478,
                        "end": 1613
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 1478,
                  "end": 1613
                }
              }
            }
          },
          "span": {
            "start": 1470,
            "end": 1613
          }
        }
      },
      "span": {
        "start": 1470,
        "end": 1614
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
                        "start": 1688,
                        "end": 1694
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 1684,
                "end": 1695
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
                        "start": 1730,
                        "end": 1736
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
                              "start": 1755,
                              "end": 1761
                            }
                          },
                          "method": {
                            "parts": [
                              "method"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1763,
                              "end": 1769
                            }
                          },
                          "new_modifier": "Private",
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 1755,
                        "end": 1781
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 1726,
                "end": 1785
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1659,
        "end": 1787
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
                        "start": 1853,
                        "end": 1859
                      }
                    },
                    {
                      "parts": [
                        "Trait2"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 1861,
                        "end": 1867
                      }
                    },
                    {
                      "parts": [
                        "Trait3"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 1869,
                        "end": 1875
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
                              "start": 1899,
                              "end": 1905
                            }
                          },
                          "method": {
                            "parts": [
                              "method"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1907,
                              "end": 1913
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "Trait2"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1924,
                                "end": 1930
                              }
                            },
                            {
                              "parts": [
                                "Trait3"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1932,
                                "end": 1938
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 1899,
                        "end": 1939
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
                              "start": 1965,
                              "end": 1971
                            }
                          },
                          "method": {
                            "parts": [
                              "other"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1973,
                              "end": 1978
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "Trait2Other"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1982,
                              "end": 1993
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 1965,
                        "end": 1994
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 1849,
                "end": 1998
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1828,
        "end": 2000
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 2000
  }
}
