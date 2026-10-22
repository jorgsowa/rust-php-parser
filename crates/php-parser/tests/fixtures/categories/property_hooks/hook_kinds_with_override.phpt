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
}

class Child extends Test {
    public $addedHooks = 'addedHooks' {
        get { return strtoupper(parent::$addedHooks::get()); }
    }
    private $changed = 'changed Child' {
        get { return strtoupper($this->changed); }
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 5
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 5
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
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 537
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Child",
            "span": {
              "start": 545,
              "end": 550
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
              "start": 559,
              "end": 563
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
                      "start": 577,
                      "end": 588
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
                      "start": 591,
                      "end": 603
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
                                            "start": 627,
                                            "end": 637
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 627,
                                        "end": 637
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
                                                              "start": 638,
                                                              "end": 644
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 638,
                                                          "end": 644
                                                        }
                                                      },
                                                      "member": {
                                                        "kind": {
                                                          "Identifier": "addedHooks"
                                                        },
                                                        "span": {
                                                          "start": 646,
                                                          "end": 657
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 638,
                                                    "end": 657
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "get"
                                                  },
                                                  "span": {
                                                    "start": 659,
                                                    "end": 662
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 638,
                                              "end": 664
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 638,
                                          "end": 664
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 627,
                                  "end": 665
                                }
                              }
                            },
                            "span": {
                              "start": 620,
                              "end": 666
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 614,
                        "end": 668
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 570,
                "end": 674
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "changed",
                    "span": {
                      "start": 687,
                      "end": 695
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
                      "start": 698,
                      "end": 713
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
                                            "start": 737,
                                            "end": 747
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 737,
                                        "end": 747
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
                                                    "start": 748,
                                                    "end": 753
                                                  }
                                                },
                                                "property": {
                                                  "kind": {
                                                    "Identifier": "changed"
                                                  },
                                                  "span": {
                                                    "start": 755,
                                                    "end": 762
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 748,
                                              "end": 762
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 748,
                                          "end": 762
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 737,
                                  "end": 763
                                }
                              }
                            },
                            "span": {
                              "start": 730,
                              "end": 764
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 724,
                        "end": 766
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 679,
                "end": 772
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 539,
        "end": 774
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 774
  }
}
