===config===
min_php=8.5
===source===
<?php

trait Bar {
    final private function __construct() {}
}

final class Foo1 {
    use Bar;
}

final class Foo2 {
    use Bar {
        __construct as final;
    }
}

class Foo3 {
    use Bar {
        __construct as final;
    }
}

trait TraitNonConstructor {
    private final function test() {}
}

class Foo4 {
    use TraitNonConstructor { test as __construct; }
}

for ($i = 1; $i <= 4; $i++) {
    $rc = new ReflectionClass("Foo$i");
    echo $rc->getMethod("__construct"), "\n";
}

class Foo5 extends Foo3 {
    private function __construct() {}
}

?>
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "Bar",
            "span": {
              "start": 13,
              "end": 16
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 46,
                      "end": 57
                    }
                  },
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": true,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 62
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 64
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo1",
            "span": {
              "start": 78,
              "end": 82
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
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
                        "Bar"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 93,
                        "end": 96
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 89,
                "end": 97
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 72,
        "end": 99
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo2",
            "span": {
              "start": 113,
              "end": 117
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": true,
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
                        "Bar"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 128,
                        "end": 131
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "__construct"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 142,
                              "end": 153
                            }
                          },
                          "new_modifier": null,
                          "is_final": true,
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 142,
                        "end": 163
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 124,
                "end": 169
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 107,
        "end": 171
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo3",
            "span": {
              "start": 179,
              "end": 183
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "Bar"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 194,
                        "end": 197
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "__construct"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 208,
                              "end": 219
                            }
                          },
                          "new_modifier": null,
                          "is_final": true,
                          "new_name": null
                        }
                      },
                      "span": {
                        "start": 208,
                        "end": 229
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 190,
                "end": 235
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 173,
        "end": 237
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "TraitNonConstructor",
            "span": {
              "start": 245,
              "end": 264
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "test",
                    "span": {
                      "start": 294,
                      "end": 298
                    }
                  },
                  "visibility": "Private",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": true,
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 271,
                "end": 303
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 239,
        "end": 305
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo4",
            "span": {
              "start": 313,
              "end": 317
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "TraitNonConstructor"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 328,
                        "end": 347
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Alias": {
                          "trait_name": null,
                          "method": {
                            "parts": [
                              "test"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 350,
                              "end": 354
                            }
                          },
                          "new_modifier": null,
                          "new_name": {
                            "parts": [
                              "__construct"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 358,
                              "end": 369
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 350,
                        "end": 370
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 324,
                "end": 372
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 307,
        "end": 374
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 381,
                      "end": 383
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 386,
                      "end": 387
                    }
                  }
                }
              },
              "span": {
                "start": 381,
                "end": 387
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 389,
                      "end": 391
                    }
                  },
                  "op": "LessOrEqual",
                  "right": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 395,
                      "end": 396
                    }
                  }
                }
              },
              "span": {
                "start": 389,
                "end": 396
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 398,
                      "end": 400
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 398,
                "end": 402
              }
            }
          ],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Expression": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "rc"
                            },
                            "span": {
                              "start": 410,
                              "end": 413
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "New": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "ReflectionClass"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 420,
                                        "end": 435
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 420,
                                    "end": 435
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "InterpolatedString": [
                                            {
                                              "Literal": "Foo"
                                            },
                                            {
                                              "Expr": {
                                                "kind": {
                                                  "Variable": "i"
                                                },
                                                "span": {
                                                  "start": 440,
                                                  "end": 442
                                                }
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 436,
                                          "end": 443
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 436,
                                      "end": 443
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 416,
                              "end": 444
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 410,
                        "end": 444
                      }
                    }
                  },
                  "span": {
                    "start": 410,
                    "end": 445
                  }
                },
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "rc"
                              },
                              "span": {
                                "start": 455,
                                "end": 458
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMethod"
                              },
                              "span": {
                                "start": 460,
                                "end": 469
                              }
                            },
                            "args": [
                              {
                                "name": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "String": "__construct"
                                    },
                                    "span": {
                                      "start": 470,
                                      "end": 483
                                    }
                                  }
                                },
                                "span": {
                                  "start": 470,
                                  "end": 483
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 455,
                          "end": 484
                        }
                      },
                      {
                        "kind": {
                          "String": "\n"
                        },
                        "span": {
                          "start": 486,
                          "end": 490
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 450,
                    "end": 491
                  }
                }
              ]
            },
            "span": {
              "start": 404,
              "end": 493
            }
          }
        }
      },
      "span": {
        "start": 376,
        "end": 493
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo5",
            "span": {
              "start": 501,
              "end": 505
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "Foo3"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 514,
              "end": 518
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 542,
                      "end": 553
                    }
                  },
                  "visibility": "Private",
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
                "start": 525,
                "end": 558
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 495,
        "end": 560
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 560
  }
}
