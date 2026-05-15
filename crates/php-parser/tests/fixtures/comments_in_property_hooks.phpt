===source===
<?php
class Test {
    public string $x {
        get /* comment in get */ => $this->_x;
    }

    private string $y;

    public string $z {
        get => /* comment after get arrow */ $this->y;
        set(string /* param comment */ $value) => $this->y = $value;
    }

    public int $counter {
        get /* get comment */ => ++$this->_counter;
        set(int /* set param */ $value) /* comment after param */ => $this->_counter = $value;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                  "name": "x",
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
                          "start": 30,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36
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
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 78,
                                  "end": 83
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "_x"
                                },
                                "span": {
                                  "start": 85,
                                  "end": 87
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 78,
                            "end": 87
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 88
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 23,
                "end": 94
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "y",
                  "visibility": "Private",
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
                          "start": 108,
                          "end": 114
                        }
                      }
                    },
                    "span": {
                      "start": 108,
                      "end": 114
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 100,
                "end": 117
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "z",
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
                          "start": 131,
                          "end": 137
                        }
                      }
                    },
                    "span": {
                      "start": 131,
                      "end": 137
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
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 188,
                                  "end": 193
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "y"
                                },
                                "span": {
                                  "start": 195,
                                  "end": 196
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 188,
                            "end": 196
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 151,
                        "end": 197
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
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
                                        "start": 248,
                                        "end": 253
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "y"
                                      },
                                      "span": {
                                        "start": 255,
                                        "end": 256
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 248,
                                  "end": 256
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "value"
                                },
                                "span": {
                                  "start": 259,
                                  "end": 265
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 248,
                            "end": 265
                          }
                        }
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
                                  "string"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 210,
                                  "end": 216
                                }
                              }
                            },
                            "span": {
                              "start": 210,
                              "end": 216
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
                            "start": 210,
                            "end": 243
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 206,
                        "end": 266
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 124,
                "end": 272
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "counter",
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
                          "start": 285,
                          "end": 288
                        }
                      }
                    },
                    "span": {
                      "start": 285,
                      "end": 288
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
                            "UnaryPrefix": {
                              "op": "PreIncrement",
                              "operand": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 335,
                                        "end": 340
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "_counter"
                                      },
                                      "span": {
                                        "start": 342,
                                        "end": 350
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 335,
                                  "end": 350
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 333,
                            "end": 350
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 308,
                        "end": 351
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
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
                                        "start": 421,
                                        "end": 426
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "_counter"
                                      },
                                      "span": {
                                        "start": 428,
                                        "end": 436
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 421,
                                  "end": 436
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "value"
                                },
                                "span": {
                                  "start": 439,
                                  "end": 445
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 421,
                            "end": 445
                          }
                        }
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
                                  "start": 364,
                                  "end": 367
                                }
                              }
                            },
                            "span": {
                              "start": 364,
                              "end": 367
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
                            "start": 364,
                            "end": 390
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 360,
                        "end": 446
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 278,
                "end": 452
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 454
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 454
  }
}
