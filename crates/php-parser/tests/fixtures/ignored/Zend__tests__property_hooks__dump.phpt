===source===
<?php

class Test {
    public $addedHooks = 'addedHooks';
    public $virtual {
        get { return strtoupper('virtual'); }
    }
    public $backed = 'backed' {
        get { return strtoupper($this->backed); }
        set { $this->backed = $value; }
    }
    public $writeOnly {
        set {}
    }
    private $private = 'private' {
        get { return strtoupper($this->private); }
        set { $this->private = $value; }
    }
    private $changed = 'changed Test' {
        get { return strtoupper($this->changed); }
    }
    public function dumpTest() {
        var_dump($this);
        var_dump(get_object_vars($this));
        var_dump(get_mangled_object_vars($this));
        var_export($this);
        echo "\n";
        echo json_encode($this), "\n";
        var_dump((array) $this);
    }
}

class Child extends Test {
    public $addedHooks = 'addedHooks' {
        get { return strtoupper(parent::$addedHooks::get()); }
    }
    private $changed = 'changed Child' {
        get { return strtoupper($this->changed); }
    }
    public function dumpChild() {
        var_dump($this);
        var_dump(get_object_vars($this));
        var_export($this);
        echo "\n";
        echo json_encode($this), "\n";
        var_dump((array) $this);
    }
}

function dump($test) {
    var_dump($test);
    var_dump(get_object_vars($test));
    var_export($test);
    echo "\n";
    echo json_encode($test), "\n";
    var_dump((array) $test);
}

echo "dump(Test):\n";
dump(new Test);

echo "\n\ndump(Child):\n";
dump(new Child);

echo "\n\nChild::dumpTest():\n";
(new Child)->dumpTest();

echo "\n\nChild::dumpChild():\n";
(new Child)->dumpChild();

?>
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 5
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 13,
              "end": 17
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
                "Property": {
                  "name": {
                    "name": "addedHooks",
                    "span": {
                      "start": 31,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "addedHooks"
                    },
                    "span": {
                      "start": 45,
                      "end": 57
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 57
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "virtual",
                    "span": {
                      "start": 70,
                      "end": 78
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
                        "Block": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strtoupper"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 102,
                                            "end": 112
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 102,
                                        "end": 112
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "virtual"
                                            },
                                            "span": {
                                              "start": 113,
                                              "end": 122
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 113,
                                          "end": 122
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 102,
                                  "end": 123
                                }
                              }
                            },
                            "span": {
                              "start": 95,
                              "end": 124
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 89,
                        "end": 126
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 63,
                "end": 132
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "backed",
                    "span": {
                      "start": 144,
                      "end": 151
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "backed"
                    },
                    "span": {
                      "start": 154,
                      "end": 162
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
                              "Return": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strtoupper"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 186,
                                            "end": 196
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 186,
                                        "end": 196
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "PropertyAccess": {
                                                "object": {
                                                  "kind": {
                                                    "Variable": "this"
                                                  },
                                                  "span": {
                                                    "start": 197,
                                                    "end": 202
                                                  }
                                                },
                                                "property": {
                                                  "kind": {
                                                    "Identifier": "backed"
                                                  },
                                                  "span": {
                                                    "start": 204,
                                                    "end": 210
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 197,
                                              "end": 210
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 197,
                                          "end": 210
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 186,
                                  "end": 211
                                }
                              }
                            },
                            "span": {
                              "start": 179,
                              "end": 212
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 173,
                        "end": 214
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
                                              "start": 229,
                                              "end": 234
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "backed"
                                            },
                                            "span": {
                                              "start": 236,
                                              "end": 242
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 229,
                                        "end": 242
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 245,
                                        "end": 251
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 229,
                                  "end": 251
                                }
                              }
                            },
                            "span": {
                              "start": 229,
                              "end": 252
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 223,
                        "end": 254
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 137,
                "end": 260
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "writeOnly",
                    "span": {
                      "start": 272,
                      "end": 282
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
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 293,
                        "end": 299
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 265,
                "end": 305
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "private",
                    "span": {
                      "start": 318,
                      "end": 326
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "private"
                    },
                    "span": {
                      "start": 329,
                      "end": 338
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
                              "Return": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strtoupper"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 362,
                                            "end": 372
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 362,
                                        "end": 372
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "PropertyAccess": {
                                                "object": {
                                                  "kind": {
                                                    "Variable": "this"
                                                  },
                                                  "span": {
                                                    "start": 373,
                                                    "end": 378
                                                  }
                                                },
                                                "property": {
                                                  "kind": {
                                                    "Identifier": "private"
                                                  },
                                                  "span": {
                                                    "start": 380,
                                                    "end": 387
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 373,
                                              "end": 387
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 373,
                                          "end": 387
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 362,
                                  "end": 388
                                }
                              }
                            },
                            "span": {
                              "start": 355,
                              "end": 389
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 349,
                        "end": 391
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
                                              "start": 406,
                                              "end": 411
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "private"
                                            },
                                            "span": {
                                              "start": 413,
                                              "end": 420
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 406,
                                        "end": 420
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 423,
                                        "end": 429
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 406,
                                  "end": 429
                                }
                              }
                            },
                            "span": {
                              "start": 406,
                              "end": 430
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 400,
                        "end": 432
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 310,
                "end": 438
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "changed",
                    "span": {
                      "start": 451,
                      "end": 459
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "changed Test"
                    },
                    "span": {
                      "start": 462,
                      "end": 476
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
                              "Return": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strtoupper"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 500,
                                            "end": 510
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 500,
                                        "end": 510
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "PropertyAccess": {
                                                "object": {
                                                  "kind": {
                                                    "Variable": "this"
                                                  },
                                                  "span": {
                                                    "start": 511,
                                                    "end": 516
                                                  }
                                                },
                                                "property": {
                                                  "kind": {
                                                    "Identifier": "changed"
                                                  },
                                                  "span": {
                                                    "start": 518,
                                                    "end": 525
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 511,
                                              "end": 525
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 511,
                                          "end": 525
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 500,
                                  "end": 526
                                }
                              }
                            },
                            "span": {
                              "start": 493,
                              "end": 527
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 487,
                        "end": 529
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 443,
                "end": 535
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "dumpTest",
                    "span": {
                      "start": 556,
                      "end": 564
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_dump"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 577,
                                      "end": 585
                                    }
                                  }
                                },
                                "span": {
                                  "start": 577,
                                  "end": 585
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 586,
                                        "end": 591
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 586,
                                    "end": 591
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 577,
                            "end": 592
                          }
                        }
                      },
                      "span": {
                        "start": 577,
                        "end": 593
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_dump"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 602,
                                      "end": 610
                                    }
                                  }
                                },
                                "span": {
                                  "start": 602,
                                  "end": 610
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "FunctionCall": {
                                          "name": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "get_object_vars"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 611,
                                                  "end": 626
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 611,
                                              "end": 626
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Variable": "this"
                                                  },
                                                  "span": {
                                                    "start": 627,
                                                    "end": 632
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 627,
                                                "end": 632
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 611,
                                        "end": 633
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 611,
                                    "end": 633
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 602,
                            "end": 634
                          }
                        }
                      },
                      "span": {
                        "start": 602,
                        "end": 635
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_dump"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 644,
                                      "end": 652
                                    }
                                  }
                                },
                                "span": {
                                  "start": 644,
                                  "end": 652
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "FunctionCall": {
                                          "name": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "get_mangled_object_vars"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 653,
                                                  "end": 676
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 653,
                                              "end": 676
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Variable": "this"
                                                  },
                                                  "span": {
                                                    "start": 677,
                                                    "end": 682
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 677,
                                                "end": 682
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 653,
                                        "end": 683
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 653,
                                    "end": 683
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 644,
                            "end": 684
                          }
                        }
                      },
                      "span": {
                        "start": 644,
                        "end": 685
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_export"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 694,
                                      "end": 704
                                    }
                                  }
                                },
                                "span": {
                                  "start": 694,
                                  "end": 704
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 705,
                                        "end": 710
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 705,
                                    "end": 710
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 694,
                            "end": 711
                          }
                        }
                      },
                      "span": {
                        "start": 694,
                        "end": 712
                      }
                    },
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "\n"
                            },
                            "span": {
                              "start": 726,
                              "end": 730
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 721,
                        "end": 731
                      }
                    },
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "json_encode"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 745,
                                        "end": 756
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 745,
                                    "end": 756
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "Variable": "this"
                                        },
                                        "span": {
                                          "start": 757,
                                          "end": 762
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 757,
                                      "end": 762
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 745,
                              "end": 763
                            }
                          },
                          {
                            "kind": {
                              "String": "\n"
                            },
                            "span": {
                              "start": 765,
                              "end": 769
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 740,
                        "end": 770
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_dump"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 779,
                                      "end": 787
                                    }
                                  }
                                },
                                "span": {
                                  "start": 779,
                                  "end": 787
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Cast": [
                                          "Array",
                                          {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 796,
                                              "end": 801
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 788,
                                        "end": 801
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 788,
                                    "end": 801
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 779,
                            "end": 802
                          }
                        }
                      },
                      "span": {
                        "start": 779,
                        "end": 803
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 540,
                "end": 809
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 811
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Child",
            "span": {
              "start": 819,
              "end": 824
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "Test"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 833,
              "end": 837
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "addedHooks",
                    "span": {
                      "start": 851,
                      "end": 862
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "addedHooks"
                    },
                    "span": {
                      "start": 865,
                      "end": 877
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
                              "Return": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strtoupper"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 901,
                                            "end": 911
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 901,
                                        "end": 911
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "StaticMethodCall": {
                                                "class": {
                                                  "kind": {
                                                    "StaticPropertyAccess": {
                                                      "class": {
                                                        "kind": {
                                                          "Name": {
                                                            "parts": [
                                                              "parent"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 912,
                                                              "end": 918
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 912,
                                                          "end": 918
                                                        }
                                                      },
                                                      "member": {
                                                        "kind": {
                                                          "Identifier": "addedHooks"
                                                        },
                                                        "span": {
                                                          "start": 920,
                                                          "end": 931
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 912,
                                                    "end": 931
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "get"
                                                  },
                                                  "span": {
                                                    "start": 933,
                                                    "end": 936
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 912,
                                              "end": 938
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 912,
                                          "end": 938
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 901,
                                  "end": 939
                                }
                              }
                            },
                            "span": {
                              "start": 894,
                              "end": 940
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 888,
                        "end": 942
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 844,
                "end": 948
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "changed",
                    "span": {
                      "start": 961,
                      "end": 969
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "String": "changed Child"
                    },
                    "span": {
                      "start": 972,
                      "end": 987
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
                              "Return": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strtoupper"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 1011,
                                            "end": 1021
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1011,
                                        "end": 1021
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "PropertyAccess": {
                                                "object": {
                                                  "kind": {
                                                    "Variable": "this"
                                                  },
                                                  "span": {
                                                    "start": 1022,
                                                    "end": 1027
                                                  }
                                                },
                                                "property": {
                                                  "kind": {
                                                    "Identifier": "changed"
                                                  },
                                                  "span": {
                                                    "start": 1029,
                                                    "end": 1036
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 1022,
                                              "end": 1036
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 1022,
                                          "end": 1036
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 1011,
                                  "end": 1037
                                }
                              }
                            },
                            "span": {
                              "start": 1004,
                              "end": 1038
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 998,
                        "end": 1040
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 953,
                "end": 1046
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "dumpChild",
                    "span": {
                      "start": 1067,
                      "end": 1076
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_dump"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1089,
                                      "end": 1097
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1089,
                                  "end": 1097
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 1098,
                                        "end": 1103
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1098,
                                    "end": 1103
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 1089,
                            "end": 1104
                          }
                        }
                      },
                      "span": {
                        "start": 1089,
                        "end": 1105
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_dump"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1114,
                                      "end": 1122
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1114,
                                  "end": 1122
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "FunctionCall": {
                                          "name": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "get_object_vars"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 1123,
                                                  "end": 1138
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 1123,
                                              "end": 1138
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Variable": "this"
                                                  },
                                                  "span": {
                                                    "start": 1139,
                                                    "end": 1144
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1139,
                                                "end": 1144
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 1123,
                                        "end": 1145
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1123,
                                    "end": 1145
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 1114,
                            "end": 1146
                          }
                        }
                      },
                      "span": {
                        "start": 1114,
                        "end": 1147
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_export"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1156,
                                      "end": 1166
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1156,
                                  "end": 1166
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 1167,
                                        "end": 1172
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1167,
                                    "end": 1172
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 1156,
                            "end": 1173
                          }
                        }
                      },
                      "span": {
                        "start": 1156,
                        "end": 1174
                      }
                    },
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "String": "\n"
                            },
                            "span": {
                              "start": 1188,
                              "end": 1192
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1183,
                        "end": 1193
                      }
                    },
                    {
                      "kind": {
                        "Echo": [
                          {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "json_encode"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 1207,
                                        "end": 1218
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1207,
                                    "end": 1218
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "kind": {
                                      "Value": {
                                        "kind": {
                                          "Variable": "this"
                                        },
                                        "span": {
                                          "start": 1219,
                                          "end": 1224
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1219,
                                      "end": 1224
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 1207,
                              "end": 1225
                            }
                          },
                          {
                            "kind": {
                              "String": "\n"
                            },
                            "span": {
                              "start": 1227,
                              "end": 1231
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1202,
                        "end": 1232
                      }
                    },
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "var_dump"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1241,
                                      "end": 1249
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1241,
                                  "end": 1249
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Cast": [
                                          "Array",
                                          {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 1258,
                                              "end": 1263
                                            }
                                          }
                                        ]
                                      },
                                      "span": {
                                        "start": 1250,
                                        "end": 1263
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 1250,
                                    "end": 1263
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 1241,
                            "end": 1264
                          }
                        }
                      },
                      "span": {
                        "start": 1241,
                        "end": 1265
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1051,
                "end": 1271
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 813,
        "end": 1273
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "dump",
            "span": {
              "start": 1284,
              "end": 1288
            }
          },
          "params": [
            {
              "name": {
                "name": "test",
                "span": {
                  "start": 1289,
                  "end": 1294
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 1289,
                "end": 1294
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_dump"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1302,
                              "end": 1310
                            }
                          }
                        },
                        "span": {
                          "start": 1302,
                          "end": 1310
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Variable": "test"
                              },
                              "span": {
                                "start": 1311,
                                "end": 1316
                              }
                            }
                          },
                          "span": {
                            "start": 1311,
                            "end": 1316
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1302,
                    "end": 1317
                  }
                }
              },
              "span": {
                "start": 1302,
                "end": 1318
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_dump"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1323,
                              "end": 1331
                            }
                          }
                        },
                        "span": {
                          "start": 1323,
                          "end": 1331
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "get_object_vars"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1332,
                                          "end": 1347
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1332,
                                      "end": 1347
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Variable": "test"
                                          },
                                          "span": {
                                            "start": 1348,
                                            "end": 1353
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 1348,
                                        "end": 1353
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 1332,
                                "end": 1354
                              }
                            }
                          },
                          "span": {
                            "start": 1332,
                            "end": 1354
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1323,
                    "end": 1355
                  }
                }
              },
              "span": {
                "start": 1323,
                "end": 1356
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_export"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1361,
                              "end": 1371
                            }
                          }
                        },
                        "span": {
                          "start": 1361,
                          "end": 1371
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Variable": "test"
                              },
                              "span": {
                                "start": 1372,
                                "end": 1377
                              }
                            }
                          },
                          "span": {
                            "start": 1372,
                            "end": 1377
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1361,
                    "end": 1378
                  }
                }
              },
              "span": {
                "start": 1361,
                "end": 1379
              }
            },
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "String": "\n"
                    },
                    "span": {
                      "start": 1389,
                      "end": 1393
                    }
                  }
                ]
              },
              "span": {
                "start": 1384,
                "end": 1394
              }
            },
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "json_encode"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1404,
                                "end": 1415
                              }
                            }
                          },
                          "span": {
                            "start": 1404,
                            "end": 1415
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Variable": "test"
                                },
                                "span": {
                                  "start": 1416,
                                  "end": 1421
                                }
                              }
                            },
                            "span": {
                              "start": 1416,
                              "end": 1421
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 1404,
                      "end": 1422
                    }
                  },
                  {
                    "kind": {
                      "String": "\n"
                    },
                    "span": {
                      "start": 1424,
                      "end": 1428
                    }
                  }
                ]
              },
              "span": {
                "start": 1399,
                "end": 1429
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "var_dump"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1434,
                              "end": 1442
                            }
                          }
                        },
                        "span": {
                          "start": 1434,
                          "end": 1442
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Cast": [
                                  "Array",
                                  {
                                    "kind": {
                                      "Variable": "test"
                                    },
                                    "span": {
                                      "start": 1451,
                                      "end": 1456
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 1443,
                                "end": 1456
                              }
                            }
                          },
                          "span": {
                            "start": 1443,
                            "end": 1456
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1434,
                    "end": 1457
                  }
                }
              },
              "span": {
                "start": 1434,
                "end": 1458
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 1275,
        "end": 1460
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "dump(Test):\n"
            },
            "span": {
              "start": 1467,
              "end": 1482
            }
          }
        ]
      },
      "span": {
        "start": 1462,
        "end": 1483
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1484,
                      "end": 1488
                    }
                  }
                },
                "span": {
                  "start": 1484,
                  "end": 1488
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Test"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1493,
                                  "end": 1497
                                }
                              }
                            },
                            "span": {
                              "start": 1493,
                              "end": 1497
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 1489,
                        "end": 1497
                      }
                    }
                  },
                  "span": {
                    "start": 1489,
                    "end": 1497
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1484,
            "end": 1498
          }
        }
      },
      "span": {
        "start": 1484,
        "end": 1499
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "\n\ndump(Child):\n"
            },
            "span": {
              "start": 1506,
              "end": 1526
            }
          }
        ]
      },
      "span": {
        "start": 1501,
        "end": 1527
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Name": {
                    "parts": [
                      "dump"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1528,
                      "end": 1532
                    }
                  }
                },
                "span": {
                  "start": 1528,
                  "end": 1532
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "Child"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1537,
                                  "end": 1542
                                }
                              }
                            },
                            "span": {
                              "start": 1537,
                              "end": 1542
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 1533,
                        "end": 1542
                      }
                    }
                  },
                  "span": {
                    "start": 1533,
                    "end": 1542
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1528,
            "end": 1543
          }
        }
      },
      "span": {
        "start": 1528,
        "end": 1544
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "\n\nChild::dumpTest():\n"
            },
            "span": {
              "start": 1551,
              "end": 1577
            }
          }
        ]
      },
      "span": {
        "start": 1546,
        "end": 1578
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Child"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1584,
                                "end": 1589
                              }
                            }
                          },
                          "span": {
                            "start": 1584,
                            "end": 1589
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 1580,
                      "end": 1589
                    }
                  }
                },
                "span": {
                  "start": 1579,
                  "end": 1590
                }
              },
              "method": {
                "kind": {
                  "Identifier": "dumpTest"
                },
                "span": {
                  "start": 1592,
                  "end": 1600
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 1579,
            "end": 1602
          }
        }
      },
      "span": {
        "start": 1579,
        "end": 1603
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "String": "\n\nChild::dumpChild():\n"
            },
            "span": {
              "start": 1610,
              "end": 1637
            }
          }
        ]
      },
      "span": {
        "start": 1605,
        "end": 1638
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Child"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1644,
                                "end": 1649
                              }
                            }
                          },
                          "span": {
                            "start": 1644,
                            "end": 1649
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 1640,
                      "end": 1649
                    }
                  }
                },
                "span": {
                  "start": 1639,
                  "end": 1650
                }
              },
              "method": {
                "kind": {
                  "Identifier": "dumpChild"
                },
                "span": {
                  "start": 1652,
                  "end": 1661
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 1639,
            "end": 1663
          }
        }
      },
      "span": {
        "start": 1639,
        "end": 1664
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1664
  }
}
