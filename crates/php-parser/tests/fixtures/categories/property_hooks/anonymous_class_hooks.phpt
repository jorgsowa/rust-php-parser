===source===
<?php

assert(false && new class {
    public $prop1 { get; set; }
    public $prop2 {
        get {
            return parent::$prop1::get();
        }
        final set {
            $this->prop1 = 42;
        }
    }
    public $prop3 = 1 {
        get => 42;
    }
});
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 4
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 4
===ast===
{
  "stmts": [
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
                      "start": 7,
                      "end": 13
                    }
                  }
                },
                "span": {
                  "start": 7,
                  "end": 13
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
                              "start": 14,
                              "end": 19
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
                                                  "start": 46,
                                                  "end": 52
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
                                                    "start": 55,
                                                    "end": 59
                                                  }
                                                },
                                                {
                                                  "kind": "Set",
                                                  "body": "Abstract",
                                                  "by_ref": false,
                                                  "params": [],
                                                  "attributes": [],
                                                  "span": {
                                                    "start": 60,
                                                    "end": 64
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 39,
                                            "end": 66
                                          }
                                        },
                                        {
                                          "kind": {
                                            "Property": {
                                              "name": {
                                                "name": "prop2",
                                                "span": {
                                                  "start": 78,
                                                  "end": 84
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
                                                                              "start": 120,
                                                                              "end": 126
                                                                            }
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 120,
                                                                          "end": 126
                                                                        }
                                                                      },
                                                                      "member": {
                                                                        "kind": {
                                                                          "Identifier": "prop1"
                                                                        },
                                                                        "span": {
                                                                          "start": 128,
                                                                          "end": 134
                                                                        }
                                                                      }
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 120,
                                                                    "end": 134
                                                                  }
                                                                },
                                                                "method": {
                                                                  "kind": {
                                                                    "Identifier": "get"
                                                                  },
                                                                  "span": {
                                                                    "start": 136,
                                                                    "end": 139
                                                                  }
                                                                },
                                                                "args": []
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 120,
                                                              "end": 141
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 113,
                                                          "end": 142
                                                        }
                                                      }
                                                    ]
                                                  },
                                                  "by_ref": false,
                                                  "params": [],
                                                  "attributes": [],
                                                  "span": {
                                                    "start": 95,
                                                    "end": 152
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
                                                                          "start": 185,
                                                                          "end": 190
                                                                        }
                                                                      },
                                                                      "property": {
                                                                        "kind": {
                                                                          "Identifier": "prop1"
                                                                        },
                                                                        "span": {
                                                                          "start": 192,
                                                                          "end": 197
                                                                        }
                                                                      }
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 185,
                                                                    "end": 197
                                                                  }
                                                                },
                                                                "op": "Assign",
                                                                "value": {
                                                                  "kind": {
                                                                    "Int": 42
                                                                  },
                                                                  "span": {
                                                                    "start": 200,
                                                                    "end": 202
                                                                  }
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 185,
                                                              "end": 202
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 185,
                                                          "end": 203
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
                                                    "start": 161,
                                                    "end": 213
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 71,
                                            "end": 219
                                          }
                                        },
                                        {
                                          "kind": {
                                            "Property": {
                                              "name": {
                                                "name": "prop3",
                                                "span": {
                                                  "start": 231,
                                                  "end": 237
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
                                                  "start": 240,
                                                  "end": 241
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
                                                        "start": 259,
                                                        "end": 261
                                                      }
                                                    }
                                                  },
                                                  "by_ref": false,
                                                  "params": [],
                                                  "attributes": [],
                                                  "span": {
                                                    "start": 252,
                                                    "end": 262
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 224,
                                            "end": 268
                                          }
                                        }
                                      ],
                                      "attributes": []
                                    }
                                  },
                                  "span": {
                                    "start": 23,
                                    "end": 270
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 23,
                              "end": 270
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 14,
                        "end": 270
                      }
                    }
                  },
                  "span": {
                    "start": 14,
                    "end": 270
                  }
                }
              ]
            }
          },
          "span": {
            "start": 7,
            "end": 271
          }
        }
      },
      "span": {
        "start": 7,
        "end": 272
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 272
  }
}
