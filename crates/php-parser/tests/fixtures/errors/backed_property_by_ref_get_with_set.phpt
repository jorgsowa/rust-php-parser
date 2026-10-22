===source===
<?php
class A {
    public $a { &get => $this->a; set => $value; }
    public $b { set => $value; &get => $this->b; }
    public $c { &get => $this->d; set { $this->d = $value; } }
    public $e { &get => $this->e; }
    public function __construct(public $f { &get => $this->f; set => $value; }) {}
}
abstract class B {
    abstract public $g { &get; set; }
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
Get hook of backed property A::a with set hook may not return by reference
'property hooks' requires PHP 8.4 or higher
Get hook of backed property A::b with set hook may not return by reference
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
Get hook of backed property A::f with set hook may not return by reference
'property hooks' requires PHP 8.4 or higher
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
Get hook of backed property A::a with set hook may not return by reference
'property hooks' requires PHP 8.4 or higher
Get hook of backed property A::b with set hook may not return by reference
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
Get hook of backed property A::f with set hook may not return by reference
'property hooks' requires PHP 8.4 or higher
===errors >=8.4===
Get hook of backed property A::a with set hook may not return by reference
Get hook of backed property A::b with set hook may not return by reference
Get hook of backed property A::f with set hook may not return by reference
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Get hook of backed property A::a with set hook may not return by reference in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
                    "name": "a",
                    "span": {
                      "start": 27,
                      "end": 29
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
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 40,
                                  "end": 45
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "a"
                                },
                                "span": {
                                  "start": 47,
                                  "end": 48
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 40,
                            "end": 48
                          }
                        }
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 49
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
                            "start": 57,
                            "end": 63
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 64
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 66
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 78,
                      "end": 80
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
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 90,
                            "end": 96
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 83,
                        "end": 97
                      }
                    },
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
                                  "start": 106,
                                  "end": 111
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "b"
                                },
                                "span": {
                                  "start": 113,
                                  "end": 114
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 106,
                            "end": 114
                          }
                        }
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 98,
                        "end": 115
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 71,
                "end": 117
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 129,
                      "end": 131
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
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 142,
                                  "end": 147
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "d"
                                },
                                "span": {
                                  "start": 149,
                                  "end": 150
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 142,
                            "end": 150
                          }
                        }
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 134,
                        "end": 151
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
                                              "start": 158,
                                              "end": 163
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "d"
                                            },
                                            "span": {
                                              "start": 165,
                                              "end": 166
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 158,
                                        "end": 166
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 169,
                                        "end": 175
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 158,
                                  "end": 175
                                }
                              }
                            },
                            "span": {
                              "start": 158,
                              "end": 176
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 152,
                        "end": 178
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 122,
                "end": 180
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 192,
                      "end": 194
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
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 205,
                                  "end": 210
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "e"
                                },
                                "span": {
                                  "start": 212,
                                  "end": 213
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 205,
                            "end": 213
                          }
                        }
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 197,
                        "end": 214
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 185,
                "end": 216
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 237,
                      "end": 248
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "f",
                        "span": {
                          "start": 256,
                          "end": 258
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
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
                                      "start": 269,
                                      "end": 274
                                    }
                                  },
                                  "property": {
                                    "kind": {
                                      "Identifier": "f"
                                    },
                                    "span": {
                                      "start": 276,
                                      "end": 277
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 269,
                                "end": 277
                              }
                            }
                          },
                          "by_ref": true,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 261,
                            "end": 278
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
                                "start": 286,
                                "end": 292
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 279,
                            "end": 293
                          }
                        }
                      ],
                      "span": {
                        "start": 249,
                        "end": 295
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 221,
                "end": 299
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 301
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 317,
              "end": 318
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                    "name": "g",
                    "span": {
                      "start": 341,
                      "end": 343
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 346,
                        "end": 351
                      }
                    },
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 352,
                        "end": 356
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 325,
                "end": 358
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 311,
        "end": 360
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 360
  }
}
