===source===
<?php
abstract class Complete {
    use SomeTrait;

    public const MAX = 100;
    protected const MIN = 0;

    public string $name;
    protected int $age = 0;
    private static array $instances = [];
    public readonly string $id;

    public function __construct(string $name, public readonly int $score) {
        $this->name = $name;
    }

    public static function create(): self {
        return new self('default');
    }

    abstract protected function validate(): bool;

    final public function getId(): string {
        return $this->id;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Complete",
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "SomeTrait"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 40,
                        "end": 49
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 36,
                "end": 50
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "MAX",
                  "visibility": "Public",
                  "value": {
                    "kind": {
                      "Int": 100
                    },
                    "span": {
                      "start": 75,
                      "end": 78
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 56,
                "end": 79
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "MIN",
                  "visibility": "Protected",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 106,
                      "end": 107
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 84,
                "end": 108
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "name",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 121,
                          "end": 127
                        }
                      }
                    },
                    "span": {
                      "start": 121,
                      "end": 127
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 114,
                "end": 133
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "age",
                  "visibility": "Protected",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 149,
                          "end": 152
                        }
                      }
                    },
                    "span": {
                      "start": 149,
                      "end": 152
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 160,
                      "end": 161
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 139,
                "end": 161
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "instances",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "array"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 182,
                          "end": 187
                        }
                      }
                    },
                    "span": {
                      "start": 182,
                      "end": 187
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 201,
                      "end": 203
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 167,
                "end": 203
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "id",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 225,
                          "end": 231
                        }
                      }
                    },
                    "span": {
                      "start": 225,
                      "end": 231
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 209,
                "end": 235
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "name",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 270,
                              "end": 276
                            }
                          }
                        },
                        "span": {
                          "start": 270,
                          "end": 276
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 270,
                        "end": 282
                      }
                    },
                    {
                      "name": "score",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 300,
                              "end": 303
                            }
                          }
                        },
                        "span": {
                          "start": 300,
                          "end": 303
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 284,
                        "end": 310
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
                                        "start": 322,
                                        "end": 327
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "name"
                                      },
                                      "span": {
                                        "start": 329,
                                        "end": 333
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 322,
                                  "end": 333
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "name"
                                },
                                "span": {
                                  "start": 336,
                                  "end": 341
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 322,
                            "end": 341
                          }
                        }
                      },
                      "span": {
                        "start": 322,
                        "end": 342
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 242,
                "end": 348
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "create",
                  "visibility": "Public",
                  "is_static": true,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 387,
                          "end": 391
                        }
                      }
                    },
                    "span": {
                      "start": 387,
                      "end": 391
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Identifier": "self"
                                },
                                "span": {
                                  "start": 413,
                                  "end": 417
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "String": "default"
                                    },
                                    "span": {
                                      "start": 418,
                                      "end": 427
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 418,
                                    "end": 427
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 409,
                            "end": 428
                          }
                        }
                      },
                      "span": {
                        "start": 402,
                        "end": 429
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 354,
                "end": 435
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "validate",
                  "visibility": "Protected",
                  "is_static": false,
                  "is_abstract": true,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "bool"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 481,
                          "end": 485
                        }
                      }
                    },
                    "span": {
                      "start": 481,
                      "end": 485
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 441,
                "end": 486
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "getId",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": true,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 523,
                          "end": 529
                        }
                      }
                    },
                    "span": {
                      "start": 523,
                      "end": 529
                    }
                  },
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
                                  "start": 547,
                                  "end": 552
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "id"
                                },
                                "span": {
                                  "start": 554,
                                  "end": 556
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 547,
                            "end": 556
                          }
                        }
                      },
                      "span": {
                        "start": 540,
                        "end": 557
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 492,
                "end": 563
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 565
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 565
  }
}
