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

class Foo5 extends Foo3 {
    private function __construct() {}
}

?>
===errors <=8.2===
'final trait method alias' requires PHP 8.3 or higher
'final trait method alias' requires PHP 8.3 or higher
===php_error <=8.2===
PHP Fatal error:  Cannot use 'final' as method modifier in Standard input code on line 12
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
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
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
                  "modifiers": {
                    "visibility": "Private",
                    "is_final": true
                  },
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
        "Class": {
          "name": {
            "name": "Foo5",
            "span": {
              "start": 382,
              "end": 386
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
              "start": 395,
              "end": 399
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
                      "start": 423,
                      "end": 434
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 406,
                "end": 439
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 376,
        "end": 441
      }
    },
    {
      "kind": "Nop",
      "span": {
        "start": 443,
        "end": 445
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 445
  }
}
