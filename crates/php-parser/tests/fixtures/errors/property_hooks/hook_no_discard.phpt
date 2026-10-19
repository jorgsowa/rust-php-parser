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
        public $d { #[\Override, \NoDiscard] get => 1; }
        public function __construct(public $e { #[\NoDiscard] get => 1; }) {}
    }
}
namespace {
    class B {
        public $f { #[NoDiscard] get => 1; }
    }
}
===errors >=8.5===
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
#[\NoDiscard] is not supported for property hooks
===php_error===
PHP Fatal error:  #[\NoDiscard] is not supported for property hooks in Standard input code on line 5
===ast >=8.5===
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
                                      "start": 266,
                                      "end": 267
                                    }
                                  }
                                },
                                "by_ref": false,
                                "params": [],
                                "attributes": [
                                  {
                                    "name": {
                                      "parts": [
                                        "Override"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 236,
                                        "end": 245
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 236,
                                      "end": 245
                                    }
                                  },
                                  {
                                    "name": {
                                      "parts": [
                                        "NoDiscard"
                                      ],
                                      "kind": "FullyQualified",
                                      "span": {
                                        "start": 247,
                                        "end": 257
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 247,
                                      "end": 257
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 234,
                                  "end": 268
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 222,
                          "end": 270
                        }
                      },
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "__construct",
                              "span": {
                                "start": 295,
                                "end": 306
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
                                    "start": 314,
                                    "end": 316
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
                                          "start": 340,
                                          "end": 341
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
                                            "start": 321,
                                            "end": 331
                                          }
                                        },
                                        "args": [],
                                        "span": {
                                          "start": 321,
                                          "end": 331
                                        }
                                      }
                                    ],
                                    "span": {
                                      "start": 319,
                                      "end": 342
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 307,
                                  "end": 344
                                }
                              }
                            ],
                            "return_type": null,
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 279,
                          "end": 348
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 116,
                  "end": 354
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 356
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
                        "start": 379,
                        "end": 380
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
                                "start": 398,
                                "end": 400
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
                                      "start": 423,
                                      "end": 424
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
                                        "start": 405,
                                        "end": 414
                                      }
                                    },
                                    "args": [],
                                    "span": {
                                      "start": 405,
                                      "end": 414
                                    }
                                  }
                                ],
                                "span": {
                                  "start": 403,
                                  "end": 425
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 391,
                          "end": 427
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 373,
                  "end": 433
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 357,
        "end": 435
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 435
  }
}
