===config===
min_php=8.4
===source===
<?php
abstract class Foo {
    abstract public int $abstract_prop {
        get;
        set;
    }
    public int $final_prop {
        final get { return 42; }
        final set(int $value) { $this->final_prop = $value; }
    }
    public int $attr_prop {
        #[Cache]
        get { return $this->compute(); }
        #[Validate]
        set(int $value) { $this->attr_prop = $value; }
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "abstract_prop",
                  "visibility": "Public",
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
                          "start": 47,
                          "end": 50
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 50
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 76,
                        "end": 80
                      }
                    },
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 89,
                        "end": 93
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 31,
                "end": 99
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "final_prop",
                  "visibility": "Public",
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
                          "start": 111,
                          "end": 114
                        }
                      }
                    },
                    "span": {
                      "start": 111,
                      "end": 114
                    }
                  },
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
                                  "Int": 42
                                },
                                "span": {
                                  "start": 156,
                                  "end": 158
                                }
                              }
                            },
                            "span": {
                              "start": 149,
                              "end": 159
                            }
                          }
                        ]
                      },
                      "is_final": true,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 137,
                        "end": 161
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
                                              "start": 194,
                                              "end": 199
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "final_prop"
                                            },
                                            "span": {
                                              "start": 201,
                                              "end": 211
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 194,
                                        "end": 211
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 214,
                                        "end": 220
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 194,
                                  "end": 220
                                }
                              }
                            },
                            "span": {
                              "start": 194,
                              "end": 221
                            }
                          }
                        ]
                      },
                      "is_final": true,
                      "by_ref": false,
                      "params": [
                        {
                          "name": "value",
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "int"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 180,
                                  "end": 183
                                }
                              }
                            },
                            "span": {
                              "start": 180,
                              "end": 183
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
                            "start": 180,
                            "end": 190
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 170,
                        "end": 223
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 104,
                "end": 229
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "attr_prop",
                  "visibility": "Public",
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
                          "start": 241,
                          "end": 244
                        }
                      }
                    },
                    "span": {
                      "start": 241,
                      "end": 244
                    }
                  },
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
                                  "MethodCall": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 296,
                                        "end": 301
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "compute"
                                      },
                                      "span": {
                                        "start": 303,
                                        "end": 310
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 296,
                                  "end": 312
                                }
                              }
                            },
                            "span": {
                              "start": 289,
                              "end": 313
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "Cache"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 268,
                              "end": 273
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 268,
                            "end": 273
                          }
                        }
                      ],
                      "span": {
                        "start": 266,
                        "end": 315
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
                                              "start": 362,
                                              "end": 367
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "attr_prop"
                                            },
                                            "span": {
                                              "start": 369,
                                              "end": 378
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 362,
                                        "end": 378
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 381,
                                        "end": 387
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 362,
                                  "end": 387
                                }
                              }
                            },
                            "span": {
                              "start": 362,
                              "end": 388
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [
                        {
                          "name": "value",
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "int"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 348,
                                  "end": 351
                                }
                              }
                            },
                            "span": {
                              "start": 348,
                              "end": 351
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
                            "start": 348,
                            "end": 358
                          }
                        }
                      ],
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "Validate"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 326,
                              "end": 334
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 326,
                            "end": 334
                          }
                        }
                      ],
                      "span": {
                        "start": 324,
                        "end": 390
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 234,
                "end": 396
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 398
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 398
  }
}
