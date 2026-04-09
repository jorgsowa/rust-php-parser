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
                          "end": 50,
                          "start_line": 3,
                          "start_col": 20
                        }
                      }
                    },
                    "span": {
                      "start": 47,
                      "end": 50,
                      "start_line": 3,
                      "start_col": 20
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
                        "end": 89,
                        "start_line": 4,
                        "start_col": 8
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
                        "end": 98,
                        "start_line": 5,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 31,
                "end": 104,
                "start_line": 3,
                "start_col": 4
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
                          "end": 114,
                          "start_line": 7,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 111,
                      "end": 114,
                      "start_line": 7,
                      "start_col": 11
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
                                  "end": 158,
                                  "start_line": 8,
                                  "start_col": 27
                                }
                              }
                            },
                            "span": {
                              "start": 149,
                              "end": 160,
                              "start_line": 8,
                              "start_col": 20
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
                        "end": 170,
                        "start_line": 8,
                        "start_col": 8
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
                                              "end": 199,
                                              "start_line": 9,
                                              "start_col": 32
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "final_prop"
                                            },
                                            "span": {
                                              "start": 201,
                                              "end": 211,
                                              "start_line": 9,
                                              "start_col": 39
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 194,
                                        "end": 211,
                                        "start_line": 9,
                                        "start_col": 32
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 214,
                                        "end": 220,
                                        "start_line": 9,
                                        "start_col": 52
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 194,
                                  "end": 220,
                                  "start_line": 9,
                                  "start_col": 32
                                }
                              }
                            },
                            "span": {
                              "start": 194,
                              "end": 222,
                              "start_line": 9,
                              "start_col": 32
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
                                  "end": 183,
                                  "start_line": 9,
                                  "start_col": 18
                                }
                              }
                            },
                            "span": {
                              "start": 180,
                              "end": 183,
                              "start_line": 9,
                              "start_col": 18
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
                            "end": 190,
                            "start_line": 9,
                            "start_col": 18
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 170,
                        "end": 228,
                        "start_line": 9,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 104,
                "end": 234,
                "start_line": 7,
                "start_col": 4
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
                          "end": 244,
                          "start_line": 11,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 241,
                      "end": 244,
                      "start_line": 11,
                      "start_col": 11
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
                                        "end": 301,
                                        "start_line": 13,
                                        "start_col": 21
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "compute"
                                      },
                                      "span": {
                                        "start": 303,
                                        "end": 310,
                                        "start_line": 13,
                                        "start_col": 28
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 296,
                                  "end": 312,
                                  "start_line": 13,
                                  "start_col": 21
                                }
                              }
                            },
                            "span": {
                              "start": 289,
                              "end": 314,
                              "start_line": 13,
                              "start_col": 14
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
                              "end": 273,
                              "start_line": 12,
                              "start_col": 10
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 268,
                            "end": 273,
                            "start_line": 12,
                            "start_col": 10
                          }
                        }
                      ],
                      "span": {
                        "start": 266,
                        "end": 324,
                        "start_line": 12,
                        "start_col": 8
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
                                              "end": 367,
                                              "start_line": 15,
                                              "start_col": 26
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "attr_prop"
                                            },
                                            "span": {
                                              "start": 369,
                                              "end": 378,
                                              "start_line": 15,
                                              "start_col": 33
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 362,
                                        "end": 378,
                                        "start_line": 15,
                                        "start_col": 26
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "Variable": "value"
                                      },
                                      "span": {
                                        "start": 381,
                                        "end": 387,
                                        "start_line": 15,
                                        "start_col": 45
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 362,
                                  "end": 387,
                                  "start_line": 15,
                                  "start_col": 26
                                }
                              }
                            },
                            "span": {
                              "start": 362,
                              "end": 389,
                              "start_line": 15,
                              "start_col": 26
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
                                  "end": 351,
                                  "start_line": 15,
                                  "start_col": 12
                                }
                              }
                            },
                            "span": {
                              "start": 348,
                              "end": 351,
                              "start_line": 15,
                              "start_col": 12
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
                            "end": 358,
                            "start_line": 15,
                            "start_col": 12
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
                              "end": 334,
                              "start_line": 14,
                              "start_col": 10
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 326,
                            "end": 334,
                            "start_line": 14,
                            "start_col": 10
                          }
                        }
                      ],
                      "span": {
                        "start": 324,
                        "end": 395,
                        "start_line": 14,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 234,
                "end": 397,
                "start_line": 11,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 398,
        "start_line": 2,
        "start_col": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 398,
    "start_line": 1,
    "start_col": 0
  }
}
