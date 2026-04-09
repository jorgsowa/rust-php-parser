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
                        "end": 49,
                        "start_line": 3,
                        "start_col": 8
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 36,
                "end": 56,
                "start_line": 3,
                "start_col": 4
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
                      "end": 78,
                      "start_line": 5,
                      "start_col": 23
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 56,
                "end": 84,
                "start_line": 5,
                "start_col": 4
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
                      "end": 107,
                      "start_line": 6,
                      "start_col": 26
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 84,
                "end": 114,
                "start_line": 6,
                "start_col": 4
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
                          "end": 127,
                          "start_line": 8,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 121,
                      "end": 127,
                      "start_line": 8,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 114,
                "end": 133,
                "start_line": 8,
                "start_col": 4
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
                          "end": 152,
                          "start_line": 9,
                          "start_col": 14
                        }
                      }
                    },
                    "span": {
                      "start": 149,
                      "end": 152,
                      "start_line": 9,
                      "start_col": 14
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 160,
                      "end": 161,
                      "start_line": 9,
                      "start_col": 25
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 139,
                "end": 161,
                "start_line": 9,
                "start_col": 4
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
                          "end": 187,
                          "start_line": 10,
                          "start_col": 19
                        }
                      }
                    },
                    "span": {
                      "start": 182,
                      "end": 187,
                      "start_line": 10,
                      "start_col": 19
                    }
                  },
                  "default": {
                    "kind": {
                      "Array": []
                    },
                    "span": {
                      "start": 201,
                      "end": 203,
                      "start_line": 10,
                      "start_col": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 167,
                "end": 203,
                "start_line": 10,
                "start_col": 4
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
                          "end": 231,
                          "start_line": 11,
                          "start_col": 20
                        }
                      }
                    },
                    "span": {
                      "start": 225,
                      "end": 231,
                      "start_line": 11,
                      "start_col": 20
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 209,
                "end": 235,
                "start_line": 11,
                "start_col": 4
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
                              "end": 276,
                              "start_line": 13,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 270,
                          "end": 276,
                          "start_line": 13,
                          "start_col": 32
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
                        "end": 282,
                        "start_line": 13,
                        "start_col": 32
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
                              "end": 303,
                              "start_line": 13,
                              "start_col": 62
                            }
                          }
                        },
                        "span": {
                          "start": 300,
                          "end": 303,
                          "start_line": 13,
                          "start_col": 62
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
                        "end": 310,
                        "start_line": 13,
                        "start_col": 46
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
                                        "end": 327,
                                        "start_line": 14,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "name"
                                      },
                                      "span": {
                                        "start": 329,
                                        "end": 333,
                                        "start_line": 14,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 322,
                                  "end": 333,
                                  "start_line": 14,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "name"
                                },
                                "span": {
                                  "start": 336,
                                  "end": 341,
                                  "start_line": 14,
                                  "start_col": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 322,
                            "end": 341,
                            "start_line": 14,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 322,
                        "end": 347,
                        "start_line": 14,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 242,
                "end": 354,
                "start_line": 13,
                "start_col": 4
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
                          "end": 391,
                          "start_line": 17,
                          "start_col": 37
                        }
                      }
                    },
                    "span": {
                      "start": 387,
                      "end": 391,
                      "start_line": 17,
                      "start_col": 37
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
                                  "end": 417,
                                  "start_line": 18,
                                  "start_col": 19
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
                                      "end": 427,
                                      "start_line": 18,
                                      "start_col": 24
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 418,
                                    "end": 427,
                                    "start_line": 18,
                                    "start_col": 24
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 409,
                            "end": 428,
                            "start_line": 18,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 402,
                        "end": 434,
                        "start_line": 18,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 354,
                "end": 441,
                "start_line": 17,
                "start_col": 4
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
                          "end": 485,
                          "start_line": 21,
                          "start_col": 44
                        }
                      }
                    },
                    "span": {
                      "start": 481,
                      "end": 485,
                      "start_line": 21,
                      "start_col": 44
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 441,
                "end": 492,
                "start_line": 21,
                "start_col": 4
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
                          "end": 529,
                          "start_line": 23,
                          "start_col": 35
                        }
                      }
                    },
                    "span": {
                      "start": 523,
                      "end": 529,
                      "start_line": 23,
                      "start_col": 35
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
                                  "end": 552,
                                  "start_line": 24,
                                  "start_col": 15
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "id"
                                },
                                "span": {
                                  "start": 554,
                                  "end": 556,
                                  "start_line": 24,
                                  "start_col": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 547,
                            "end": 556,
                            "start_line": 24,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 540,
                        "end": 562,
                        "start_line": 24,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 492,
                "end": 564,
                "start_line": 23,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 565,
        "start_line": 2,
        "start_col": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 565,
    "start_line": 1,
    "start_col": 0
  }
}
