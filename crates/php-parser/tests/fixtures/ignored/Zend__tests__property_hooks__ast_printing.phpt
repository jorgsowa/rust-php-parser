===config===
min_php=8.5
===source===
<?php

try {
    assert(false && new class {
        public $prop1 { get; set; }
        public $prop2 {
            get {
                return parent::$prop1::get();
            }
            final set {
                echo 'Foo';
                $this->prop1 = 42;
            }
        }
        public $prop3 = 1 {
            get => 42;
        }
    });
} catch (Error $e) {
    echo $e->getMessage(), "\n";
}

?>
===ast===
{
  "stmts": [
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
                              "assert"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 17,
                              "end": 23
                            }
                          }
                        },
                        "span": {
                          "start": 17,
                          "end": 23
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Bool": false
                                    },
                                    "span": {
                                      "start": 24,
                                      "end": 29
                                    }
                                  },
                                  "op": "BooleanAnd",
                                  "right": {
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
                                                    "Property": {
                                                      "name": {
                                                        "name": "prop1",
                                                        "span": {
                                                          "start": 60,
                                                          "end": 66
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
                                                          "body": "Abstract",
                                                          "by_ref": false,
                                                          "params": [],
                                                          "attributes": [],
                                                          "span": {
                                                            "start": 69,
                                                            "end": 73
                                                          }
                                                        },
                                                        {
                                                          "kind": "Set",
                                                          "body": "Abstract",
                                                          "by_ref": false,
                                                          "params": [],
                                                          "attributes": [],
                                                          "span": {
                                                            "start": 74,
                                                            "end": 78
                                                          }
                                                        }
                                                      ]
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 53,
                                                    "end": 80
                                                  }
                                                },
                                                {
                                                  "kind": {
                                                    "Property": {
                                                      "name": {
                                                        "name": "prop2",
                                                        "span": {
                                                          "start": 96,
                                                          "end": 102
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
                                                                                      "start": 146,
                                                                                      "end": 152
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 146,
                                                                                  "end": 152
                                                                                }
                                                                              },
                                                                              "member": {
                                                                                "kind": {
                                                                                  "Identifier": "prop1"
                                                                                },
                                                                                "span": {
                                                                                  "start": 154,
                                                                                  "end": 160
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 146,
                                                                            "end": 160
                                                                          }
                                                                        },
                                                                        "method": {
                                                                          "kind": {
                                                                            "Identifier": "get"
                                                                          },
                                                                          "span": {
                                                                            "start": 162,
                                                                            "end": 165
                                                                          }
                                                                        },
                                                                        "args": []
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 146,
                                                                      "end": 167
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 139,
                                                                  "end": 168
                                                                }
                                                              }
                                                            ]
                                                          },
                                                          "by_ref": false,
                                                          "params": [],
                                                          "attributes": [],
                                                          "span": {
                                                            "start": 117,
                                                            "end": 182
                                                          }
                                                        },
                                                        {
                                                          "kind": "Set",
                                                          "body": {
                                                            "Block": [
                                                              {
                                                                "kind": {
                                                                  "Echo": [
                                                                    {
                                                                      "kind": {
                                                                        "String": "Foo"
                                                                      },
                                                                      "span": {
                                                                        "start": 228,
                                                                        "end": 233
                                                                      }
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 223,
                                                                  "end": 234
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
                                                                                  "Variable": "this"
                                                                                },
                                                                                "span": {
                                                                                  "start": 251,
                                                                                  "end": 256
                                                                                }
                                                                              },
                                                                              "property": {
                                                                                "kind": {
                                                                                  "Identifier": "prop1"
                                                                                },
                                                                                "span": {
                                                                                  "start": 258,
                                                                                  "end": 263
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 251,
                                                                            "end": 263
                                                                          }
                                                                        },
                                                                        "op": "Assign",
                                                                        "value": {
                                                                          "kind": {
                                                                            "Int": 42
                                                                          },
                                                                          "span": {
                                                                            "start": 266,
                                                                            "end": 268
                                                                          }
                                                                        }
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 251,
                                                                      "end": 268
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 251,
                                                                  "end": 269
                                                                }
                                                              }
                                                            ]
                                                          },
                                                          "modifiers": {
                                                            "is_final": true
                                                          },
                                                          "by_ref": false,
                                                          "params": [],
                                                          "attributes": [],
                                                          "span": {
                                                            "start": 195,
                                                            "end": 283
                                                          }
                                                        }
                                                      ]
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 89,
                                                    "end": 293
                                                  }
                                                },
                                                {
                                                  "kind": {
                                                    "Property": {
                                                      "name": {
                                                        "name": "prop3",
                                                        "span": {
                                                          "start": 309,
                                                          "end": 315
                                                        }
                                                      },
                                                      "modifiers": {
                                                        "visibility": "Public"
                                                      },
                                                      "type_hint": null,
                                                      "default": {
                                                        "kind": {
                                                          "Int": 1
                                                        },
                                                        "span": {
                                                          "start": 318,
                                                          "end": 319
                                                        }
                                                      },
                                                      "attributes": [],
                                                      "hooks": [
                                                        {
                                                          "kind": "Get",
                                                          "body": {
                                                            "Expression": {
                                                              "kind": {
                                                                "Int": 42
                                                              },
                                                              "span": {
                                                                "start": 341,
                                                                "end": 343
                                                              }
                                                            }
                                                          },
                                                          "by_ref": false,
                                                          "params": [],
                                                          "attributes": [],
                                                          "span": {
                                                            "start": 334,
                                                            "end": 344
                                                          }
                                                        }
                                                      ]
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 302,
                                                    "end": 354
                                                  }
                                                }
                                              ],
                                              "attributes": []
                                            }
                                          },
                                          "span": {
                                            "start": 33,
                                            "end": 360
                                          }
                                        },
                                        "args": []
                                      }
                                    },
                                    "span": {
                                      "start": 33,
                                      "end": 360
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 24,
                                "end": 360
                              }
                            }
                          },
                          "span": {
                            "start": 24,
                            "end": 360
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 361
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 362
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
                    "start": 372,
                    "end": 377
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 378,
                  "end": 380
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
                                "start": 393,
                                "end": 395
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 397,
                                "end": 407
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 393,
                          "end": 409
                        }
                      },
                      {
                        "kind": {
                          "String": "\n"
                        },
                        "span": {
                          "start": 411,
                          "end": 415
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 388,
                    "end": 416
                  }
                }
              ],
              "span": {
                "start": 371,
                "end": 418
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 7,
        "end": 418
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 418
  }
}
