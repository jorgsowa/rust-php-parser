===config===
min_php=8.5
===source===
<?php

class Test {
    public $prop = 42 {
        get => $this->getProp($this->prop);
        set {
            $this->setProp($this->prop, $value);
        }
    }

    private function getProp($prop) {
        return $this->prop;
    }

    private function setProp($prop, $value) {
        $this->prop = $value;
    }

    public $prop2 = 42 {
        get => $this->prop2;
        set => $value;
    }
}

class Child extends Test {
    public $prop2 = 42 {
        get => parent::$prop2::get();
        set { parent::$prop2::set($value); }
    }
}

$test = new Test;

try {
    $test->prop = 0;
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

try {
    var_dump($test->prop);
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

$child = new Child();
$child->prop2 = 43;
var_dump($child->prop2);

?>
===ast===
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
                    "name": "prop",
                    "span": {
                      "start": 31,
                      "end": 36
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 39,
                      "end": 41
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "MethodCall": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 59,
                                  "end": 64
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "getProp"
                                },
                                "span": {
                                  "start": 66,
                                  "end": 73
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
                                              "start": 74,
                                              "end": 79
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "prop"
                                            },
                                            "span": {
                                              "start": 81,
                                              "end": 85
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 74,
                                        "end": 85
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 74,
                                    "end": 85
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 86
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 52,
                        "end": 87
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
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 114,
                                        "end": 119
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "setProp"
                                      },
                                      "span": {
                                        "start": 121,
                                        "end": 128
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
                                                    "start": 129,
                                                    "end": 134
                                                  }
                                                },
                                                "property": {
                                                  "kind": {
                                                    "Identifier": "prop"
                                                  },
                                                  "span": {
                                                    "start": 136,
                                                    "end": 140
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 129,
                                              "end": 140
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 129,
                                          "end": 140
                                        }
                                      },
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 142,
                                              "end": 148
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 142,
                                          "end": 148
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 114,
                                  "end": 149
                                }
                              }
                            },
                            "span": {
                              "start": 114,
                              "end": 150
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 96,
                        "end": 160
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 166
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "getProp",
                    "span": {
                      "start": 189,
                      "end": 196
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "prop",
                        "span": {
                          "start": 197,
                          "end": 202
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 197,
                        "end": 202
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 221,
                                  "end": 226
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "prop"
                                },
                                "span": {
                                  "start": 228,
                                  "end": 232
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 221,
                            "end": 232
                          }
                        }
                      },
                      "span": {
                        "start": 214,
                        "end": 233
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 172,
                "end": 239
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "setProp",
                    "span": {
                      "start": 262,
                      "end": 269
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "prop",
                        "span": {
                          "start": 270,
                          "end": 275
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 270,
                        "end": 275
                      }
                    },
                    {
                      "name": {
                        "name": "value",
                        "span": {
                          "start": 277,
                          "end": 283
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 277,
                        "end": 283
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
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
                                        "start": 295,
                                        "end": 300
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "prop"
                                      },
                                      "span": {
                                        "start": 302,
                                        "end": 306
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 295,
                                  "end": 306
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "value"
                                },
                                "span": {
                                  "start": 309,
                                  "end": 315
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 295,
                            "end": 315
                          }
                        }
                      },
                      "span": {
                        "start": 295,
                        "end": 316
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 245,
                "end": 322
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop2",
                    "span": {
                      "start": 335,
                      "end": 341
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 344,
                      "end": 346
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 364,
                                  "end": 369
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "prop2"
                                },
                                "span": {
                                  "start": 371,
                                  "end": 376
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 364,
                            "end": 376
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 357,
                        "end": 377
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 393,
                            "end": 399
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 386,
                        "end": 400
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 328,
                "end": 406
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 408
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Child",
            "span": {
              "start": 416,
              "end": 421
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
              "start": 430,
              "end": 434
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop2",
                    "span": {
                      "start": 448,
                      "end": 454
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 457,
                      "end": 459
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
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
                                            "start": 477,
                                            "end": 483
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 477,
                                        "end": 483
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "prop2"
                                      },
                                      "span": {
                                        "start": 485,
                                        "end": 491
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 477,
                                  "end": 491
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 493,
                                  "end": 496
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 477,
                            "end": 498
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 470,
                        "end": 499
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
                                                  "start": 514,
                                                  "end": 520
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 514,
                                              "end": 520
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "prop2"
                                            },
                                            "span": {
                                              "start": 522,
                                              "end": 528
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 514,
                                        "end": 528
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "set"
                                      },
                                      "span": {
                                        "start": 530,
                                        "end": 533
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "value"
                                            },
                                            "span": {
                                              "start": 534,
                                              "end": 540
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 534,
                                          "end": 540
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 514,
                                  "end": 541
                                }
                              }
                            },
                            "span": {
                              "start": 514,
                              "end": 542
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 508,
                        "end": 544
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 441,
                "end": 550
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 410,
        "end": 552
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "test"
                },
                "span": {
                  "start": 554,
                  "end": 559
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
                            "Test"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 566,
                            "end": 570
                          }
                        }
                      },
                      "span": {
                        "start": 566,
                        "end": 570
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 562,
                  "end": 570
                }
              }
            }
          },
          "span": {
            "start": 554,
            "end": 570
          }
        }
      },
      "span": {
        "start": 554,
        "end": 571
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                                "Variable": "test"
                              },
                              "span": {
                                "start": 583,
                                "end": 588
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "prop"
                              },
                              "span": {
                                "start": 590,
                                "end": 594
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 583,
                          "end": 594
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 597,
                          "end": 598
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 583,
                    "end": 598
                  }
                }
              },
              "span": {
                "start": 583,
                "end": 599
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 609,
                    "end": 614
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 615,
                  "end": 617
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 630,
                                "end": 632
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 634,
                                "end": 644
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 630,
                          "end": 646
                        }
                      },
                      {
                        "kind": {
                          "String": "\n"
                        },
                        "span": {
                          "start": 648,
                          "end": 652
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 625,
                    "end": 653
                  }
                }
              ],
              "span": {
                "start": 608,
                "end": 655
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 573,
        "end": 655
      }
    },
    {
      "kind": {
        "TryCatch": {
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
                              "start": 667,
                              "end": 675
                            }
                          }
                        },
                        "span": {
                          "start": 667,
                          "end": 675
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
                                      "Variable": "test"
                                    },
                                    "span": {
                                      "start": 676,
                                      "end": 681
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "prop"
                                    },
                                    "span": {
                                      "start": 683,
                                      "end": 687
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 676,
                                "end": 687
                              }
                            }
                          },
                          "span": {
                            "start": 676,
                            "end": 687
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 667,
                    "end": 688
                  }
                }
              },
              "span": {
                "start": 667,
                "end": 689
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "Error"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 699,
                    "end": 704
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 705,
                  "end": 707
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 720,
                                "end": 722
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 724,
                                "end": 734
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 720,
                          "end": 736
                        }
                      },
                      {
                        "kind": {
                          "String": "\n"
                        },
                        "span": {
                          "start": 738,
                          "end": 742
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 715,
                    "end": 743
                  }
                }
              ],
              "span": {
                "start": 698,
                "end": 745
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 657,
        "end": 745
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "child"
                },
                "span": {
                  "start": 747,
                  "end": 753
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
                            "Child"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 760,
                            "end": 765
                          }
                        }
                      },
                      "span": {
                        "start": 760,
                        "end": 765
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 756,
                  "end": 767
                }
              }
            }
          },
          "span": {
            "start": 747,
            "end": 767
          }
        }
      },
      "span": {
        "start": 747,
        "end": 768
      }
    },
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
                        "Variable": "child"
                      },
                      "span": {
                        "start": 769,
                        "end": 775
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "prop2"
                      },
                      "span": {
                        "start": 777,
                        "end": 782
                      }
                    }
                  }
                },
                "span": {
                  "start": 769,
                  "end": 782
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 43
                },
                "span": {
                  "start": 785,
                  "end": 787
                }
              }
            }
          },
          "span": {
            "start": 769,
            "end": 787
          }
        }
      },
      "span": {
        "start": 769,
        "end": 788
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
                      "start": 789,
                      "end": 797
                    }
                  }
                },
                "span": {
                  "start": 789,
                  "end": 797
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
                              "Variable": "child"
                            },
                            "span": {
                              "start": 798,
                              "end": 804
                            }
                          },
                          "property": {
                            "kind": {
                              "Identifier": "prop2"
                            },
                            "span": {
                              "start": 806,
                              "end": 811
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 798,
                        "end": 811
                      }
                    }
                  },
                  "span": {
                    "start": 798,
                    "end": 811
                  }
                }
              ]
            }
          },
          "span": {
            "start": 789,
            "end": 812
          }
        }
      },
      "span": {
        "start": 789,
        "end": 813
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 813
  }
}
