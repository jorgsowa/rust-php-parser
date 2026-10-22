===source===
<?php
namespace N {
    use NoDiscard as Keep;
    interface I {
        public $a { #[\NoDiscard] get; }
    }
    class A {
        public $b { #[\nodiscard] get => 1; }
        public int $c { #[Keep] set { } }
        public $d { #[\Deprecated, \NoDiscard] get => 1; }
        public function __construct(public $e { #[\NoDiscard] get => 1; }) {}
    }
}
namespace {
    class B {
        public $f { #[NoDiscard] get => 1; }
    }
}
===errors <=7.4===
'property hooks' requires PHP 8.4 or higher
'attributes' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'attributes' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'attributes' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'attributes' requires PHP 8.0 or higher
'constructor property promotion' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'attributes' requires PHP 8.0 or higher
'property hooks' requires PHP 8.4 or higher
'attributes' requires PHP 8.0 or higher
===errors 8.0-8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===errors >=8.5===
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 5
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 5
===php_error >=8.5===
PHP Fatal error:  #[\NoDiscard] is not supported for property hooks in Standard input code on line 5
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "NoDiscard"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 28,
                            "end": 37
                          }
                        },
                        "alias": {
                          "name": "Keep",
                          "span": {
                            "start": 41,
                            "end": 45
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 45
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 24,
                  "end": 46
                }
              },
              {
                "kind": {
                  "Interface": {
                    "name": {
                      "name": "I",
                      "span": {
                        "start": 61,
                        "end": 62
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
                                "start": 80,
                                "end": 82
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
                                "attributes": [
                                  {
                                    "name": {
                                      "parts": [
                                        "NoDiscard"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 87,
                                        "end": 97
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 87,
                                      "end": 97
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 85,
                                  "end": 103
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 73,
                          "end": 105
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 51,
                  "end": 111
                }
              },
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "A",
                      "span": {
                        "start": 122,
                        "end": 123
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
                                "start": 141,
                                "end": 143
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
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 167,
                                      "end": 168
                                    }
                                  }
                                },
                                "by_ref": false,
                                "params": [],
                                "attributes": [
                                  {
                                    "name": {
                                      "parts": [
                                        "nodiscard"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 148,
                                        "end": 158
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 148,
                                      "end": 158
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 146,
                                  "end": 169
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 134,
                          "end": 171
                        }
                      },
                      {
                        "kind": {
                          "Property": {
                            "name": {
                              "name": "c",
                              "span": {
                                "start": 191,
                                "end": 193
                              }
                            },
                            "modifiers": {
                              "visibility": "Public"
                            },
                            "type_hint": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "int"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 187,
                                    "end": 190
                                  }
                                }
                              },
                              "span": {
                                "start": 187,
                                "end": 190
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
                                "attributes": [
                                  {
                                    "name": {
                                      "parts": [
                                        "Keep"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 198,
                                        "end": 202
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 198,
                                      "end": 202
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 196,
                                  "end": 211
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 180,
                          "end": 213
                        }
                      },
                      {
                        "kind": {
                          "Property": {
                            "name": {
                              "name": "d",
                              "span": {
                                "start": 229,
                                "end": 231
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
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 268,
                                      "end": 269
                                    }
                                  }
                                },
                                "by_ref": false,
                                "params": [],
                                "attributes": [
                                  {
                                    "name": {
                                      "parts": [
                                        "Deprecated"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 236,
                                        "end": 247
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 236,
                                      "end": 247
                                    }
                                  },
                                  {
                                    "name": {
                                      "parts": [
                                        "NoDiscard"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 249,
                                        "end": 259
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 249,
                                      "end": 259
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 234,
                                  "end": 270
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 222,
                          "end": 272
                        }
                      },
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "__construct",
                              "span": {
                                "start": 297,
                                "end": 308
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
                                    "start": 316,
                                    "end": 318
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
                                          "Int": 1
                                        },
                                        "span": {
                                          "start": 342,
                                          "end": 343
                                        }
                                      }
                                    },
                                    "by_ref": false,
                                    "params": [],
                                    "attributes": [
                                      {
                                        "name": {
                                          "parts": [
                                            "NoDiscard"
                                          ],
                                          "kind": "FullyQualified",
                                          "span": {
                                            "start": 323,
                                            "end": 333
                                          }
                                        },
                                        "args": [],
                                        "span": {
                                          "start": 323,
                                          "end": 333
                                        }
                                      }
                                    ],
                                    "span": {
                                      "start": 321,
                                      "end": 344
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 309,
                                  "end": 346
                                }
                              }
                            ],
                            "return_type": null,
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 281,
                          "end": 350
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 116,
                  "end": 356
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 358
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": null,
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "B",
                      "span": {
                        "start": 381,
                        "end": 382
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
                              "name": "f",
                              "span": {
                                "start": 400,
                                "end": 402
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
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 425,
                                      "end": 426
                                    }
                                  }
                                },
                                "by_ref": false,
                                "params": [],
                                "attributes": [
                                  {
                                    "name": {
                                      "parts": [
                                        "NoDiscard"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 407,
                                        "end": 416
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 407,
                                      "end": 416
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 405,
                                  "end": 427
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 393,
                          "end": 429
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 375,
                  "end": 435
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 359,
        "end": 437
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 437
  }
}
