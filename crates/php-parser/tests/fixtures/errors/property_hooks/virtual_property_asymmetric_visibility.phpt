===source===
<?php
interface I {
    public private(set) int $a { get; }
}
class A {
    public private(set) int $b { get => 1; }
    public protected(set) int $c { set { } }
    protected private(set) int $d { set => $value; get => 1; }
    public function __construct(
        public private(set) int $e { get => 1; },
        private(set) int $f { set { } },
    ) {}
}
===errors <=7.4===
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property I::$a must not specify asymmetric visibility
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property A::$b must not specify asymmetric visibility
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
set-only virtual property A::$c must not specify asymmetric visibility
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property A::$e must not specify asymmetric visibility
'constructor property promotion' requires PHP 8.0 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
set-only virtual property A::$f must not specify asymmetric visibility
'trailing comma in parameter list' requires PHP 8.0 or higher
===errors 8.0-8.3===
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property I::$a must not specify asymmetric visibility
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property A::$b must not specify asymmetric visibility
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
set-only virtual property A::$c must not specify asymmetric visibility
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
get-only virtual property A::$e must not specify asymmetric visibility
'asymmetric visibility' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
set-only virtual property A::$f must not specify asymmetric visibility
===errors >=8.4===
get-only virtual property I::$a must not specify asymmetric visibility
get-only virtual property A::$b must not specify asymmetric visibility
set-only virtual property A::$c must not specify asymmetric visibility
get-only virtual property A::$e must not specify asymmetric visibility
set-only virtual property A::$f must not specify asymmetric visibility
===php_error <=8.3===
PHP Fatal error:  Multiple access type modifiers are not allowed in Standard input code on line 3
===php_error 8.4-8.5===
PHP Fatal error:  Read-only virtual property I::$a must not specify asymmetric visibility in Standard input code on line 3
===php_error >=8.6===
PHP Fatal error:  get-only virtual property I::$a must not specify asymmetric visibility in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 48,
                      "end": 50
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 44,
                          "end": 47
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 47
                    }
                  },
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
                        "start": 53,
                        "end": 57
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 24,
                "end": 59
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 61
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 68,
              "end": 69
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
                    "name": "b",
                    "span": {
                      "start": 100,
                      "end": 102
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 96,
                          "end": 99
                        }
                      }
                    },
                    "span": {
                      "start": 96,
                      "end": 99
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 112,
                            "end": 113
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 105,
                        "end": 114
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 76,
                "end": 116
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 147,
                      "end": 149
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "set_visibility": "Protected"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 143,
                          "end": 146
                        }
                      }
                    },
                    "span": {
                      "start": 143,
                      "end": 146
                    }
                  },
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
                        "start": 152,
                        "end": 159
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 121,
                "end": 161
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 193,
                      "end": 195
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected",
                    "set_visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 189,
                          "end": 192
                        }
                      }
                    },
                    "span": {
                      "start": 189,
                      "end": 192
                    }
                  },
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
                            "start": 205,
                            "end": 211
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 198,
                        "end": 212
                      }
                    },
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 220,
                            "end": 221
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 213,
                        "end": 222
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 166,
                "end": 224
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 245,
                      "end": 256
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "e",
                        "span": {
                          "start": 290,
                          "end": 292
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 286,
                              "end": 289
                            }
                          }
                        },
                        "span": {
                          "start": 286,
                          "end": 289
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "set_visibility": "Private"
                      },
                      "attributes": [],
                      "hooks": [
                        {
                          "kind": "Get",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Int": 1
                              },
                              "span": {
                                "start": 302,
                                "end": 303
                              }
                            }
                          },
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 295,
                            "end": 304
                          }
                        }
                      ],
                      "span": {
                        "start": 266,
                        "end": 306
                      }
                    },
                    {
                      "name": {
                        "name": "f",
                        "span": {
                          "start": 333,
                          "end": 335
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 329,
                              "end": 332
                            }
                          }
                        },
                        "span": {
                          "start": 329,
                          "end": 332
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "set_visibility": "Private"
                      },
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
                            "start": 338,
                            "end": 345
                          }
                        }
                      ],
                      "span": {
                        "start": 316,
                        "end": 347
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 229,
                "end": 357
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 62,
        "end": 359
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 359
  }
}
