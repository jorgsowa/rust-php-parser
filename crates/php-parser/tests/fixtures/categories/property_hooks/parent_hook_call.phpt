===source===
<?php
class A extends B {
    public $a {
        get => parent::$a::get();
        set {
            parent::$a::SET($value);
        }
    }
    public function __construct(public $b { get => parent::$b::get(); }) {}
}
class C {
    public $c {
        get => parent::$c::get();
    }
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
Cannot use "parent" when current class scope has no parent
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 37,
                      "end": 39
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
                                            "start": 57,
                                            "end": 63
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 57,
                                        "end": 63
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "a"
                                      },
                                      "span": {
                                        "start": 65,
                                        "end": 67
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 57,
                                  "end": 67
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 69,
                                  "end": 72
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 57,
                            "end": 74
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 75
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
                                                  "start": 102,
                                                  "end": 108
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 102,
                                              "end": 108
                                            }
                                          },
                                          "member": {
                                            "kind": {
                                              "Identifier": "a"
                                            },
                                            "span": {
                                              "start": 110,
                                              "end": 112
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 102,
                                        "end": 112
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "SET"
                                      },
                                      "span": {
                                        "start": 114,
                                        "end": 117
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
                                              "start": 118,
                                              "end": 124
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 118,
                                          "end": 124
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 102,
                                  "end": 125
                                }
                              }
                            },
                            "span": {
                              "start": 102,
                              "end": 126
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 84,
                        "end": 136
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 142
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 163,
                      "end": 174
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 182,
                          "end": 184
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
                                                "start": 194,
                                                "end": 200
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 194,
                                            "end": 200
                                          }
                                        },
                                        "member": {
                                          "kind": {
                                            "Identifier": "b"
                                          },
                                          "span": {
                                            "start": 202,
                                            "end": 204
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 194,
                                      "end": 204
                                    }
                                  },
                                  "method": {
                                    "kind": {
                                      "Identifier": "get"
                                    },
                                    "span": {
                                      "start": 206,
                                      "end": 209
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 194,
                                "end": 211
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 187,
                            "end": 212
                          }
                        }
                      ],
                      "span": {
                        "start": 175,
                        "end": 214
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 147,
                "end": 218
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 220
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 227,
              "end": 228
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
                    "name": "c",
                    "span": {
                      "start": 242,
                      "end": 244
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
                                            "start": 262,
                                            "end": 268
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 262,
                                        "end": 268
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "c"
                                      },
                                      "span": {
                                        "start": 270,
                                        "end": 272
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 262,
                                  "end": 272
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 274,
                                  "end": 277
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 262,
                            "end": 279
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 255,
                        "end": 280
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 235,
                "end": 286
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 221,
        "end": 288
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 288
  }
}
