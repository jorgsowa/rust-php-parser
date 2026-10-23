===source===
<?php

#[
    A1,
    A2(),
    A3(0),
    A4(x: 1),
]
function a() {
}

#[A5]
class C {
    #[A6]
    public function m(
        #[A7] $param,
    ) {}
    #[A14]
    public $prop;
}

#[A8]
interface I {}
#[A9]
trait T {}

$x = #[A10] function() {};
$y = #[A11] fn() => 0;
$a = #[A12] static function() {};
$b = #[A13] static fn() => 0;
===errors <=7.4===
expected ';' after expression
expected expression, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',' in Standard input code on line 4
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "A1"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 14,
                "end": 16
              }
            }
          },
          "span": {
            "start": 14,
            "end": 16
          }
        }
      },
      "span": {
        "start": 14,
        "end": 16
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 16,
        "end": 54
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 64,
              "end": 65
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 55,
        "end": 71
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 85,
              "end": 86
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 119,
                      "end": 120
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 103,
                "end": 152
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 175,
                      "end": 180
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 168,
                "end": 180
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 79,
        "end": 183
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 201,
              "end": 202
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 191,
        "end": 205
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 218,
              "end": 219
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 212,
        "end": 222
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 224,
                  "end": 226
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "y"
                      },
                      "span": {
                        "start": 251,
                        "end": 253
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Assign": {
                          "target": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 274,
                              "end": 276
                            }
                          },
                          "op": "Assign",
                          "value": {
                            "kind": {
                              "Assign": {
                                "target": {
                                  "kind": {
                                    "Variable": "b"
                                  },
                                  "span": {
                                    "start": 308,
                                    "end": 310
                                  }
                                },
                                "op": "Assign",
                                "value": {
                                  "kind": "Error",
                                  "span": {
                                    "start": 312,
                                    "end": 312
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 308,
                              "end": 312
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 274,
                        "end": 312
                      }
                    }
                  }
                },
                "span": {
                  "start": 251,
                  "end": 312
                }
              }
            }
          },
          "span": {
            "start": 224,
            "end": 312
          }
        }
      },
      "span": {
        "start": 224,
        "end": 312
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 312
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "a",
            "span": {
              "start": 64,
              "end": 65
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "A1"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 14,
                  "end": 16
                }
              },
              "args": [],
              "span": {
                "start": 14,
                "end": 16
              }
            },
            {
              "name": {
                "parts": [
                  "A2"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "args": [],
              "span": {
                "start": 22,
                "end": 26
              }
            },
            {
              "name": {
                "parts": [
                  "A3"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 32,
                  "end": 34
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 35,
                        "end": 36
                      }
                    }
                  },
                  "span": {
                    "start": 35,
                    "end": 36
                  }
                }
              ],
              "span": {
                "start": 32,
                "end": 37
              }
            },
            {
              "name": {
                "parts": [
                  "A4"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 43,
                  "end": 45
                }
              },
              "args": [
                {
                  "name": {
                    "parts": [
                      "x"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 46,
                      "end": 47
                    }
                  },
                  "kind": {
                    "Value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 49,
                        "end": 50
                      }
                    }
                  },
                  "span": {
                    "start": 46,
                    "end": 50
                  }
                }
              ],
              "span": {
                "start": 43,
                "end": 51
              }
            }
          ]
        }
      },
      "span": {
        "start": 55,
        "end": 71
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 85,
              "end": 86
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 119,
                      "end": 120
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "param",
                        "span": {
                          "start": 136,
                          "end": 142
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "A7"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 132,
                              "end": 134
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 132,
                            "end": 134
                          }
                        }
                      ],
                      "span": {
                        "start": 130,
                        "end": 142
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A6"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 95,
                          "end": 97
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 95,
                        "end": 97
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 93,
                "end": 152
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 175,
                      "end": 180
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "A14"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 159,
                          "end": 162
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 159,
                        "end": 162
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 157,
                "end": 180
              }
            }
          ],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A5"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 75,
                  "end": 77
                }
              },
              "args": [],
              "span": {
                "start": 75,
                "end": 77
              }
            }
          ]
        }
      },
      "span": {
        "start": 79,
        "end": 183
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 201,
              "end": 202
            }
          },
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A8"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 187,
                  "end": 189
                }
              },
              "args": [],
              "span": {
                "start": 187,
                "end": 189
              }
            }
          ]
        }
      },
      "span": {
        "start": 191,
        "end": 205
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 218,
              "end": 219
            }
          },
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A9"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 208,
                  "end": 210
                }
              },
              "args": [],
              "span": {
                "start": 208,
                "end": 210
              }
            }
          ]
        }
      },
      "span": {
        "start": 212,
        "end": 222
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 224,
                  "end": 226
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A10"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 231,
                            "end": 234
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 231,
                          "end": 234
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 229,
                  "end": 249
                }
              }
            }
          },
          "span": {
            "start": 224,
            "end": 249
          }
        }
      },
      "span": {
        "start": 224,
        "end": 250
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 251,
                  "end": 253
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 271,
                        "end": 272
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A11"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 258,
                            "end": 261
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 258,
                          "end": 261
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 256,
                  "end": 272
                }
              }
            }
          },
          "span": {
            "start": 251,
            "end": 272
          }
        }
      },
      "span": {
        "start": 251,
        "end": 273
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 274,
                  "end": 276
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [],
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A12"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 281,
                            "end": 284
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 281,
                          "end": 284
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 279,
                  "end": 306
                }
              }
            }
          },
          "span": {
            "start": 274,
            "end": 306
          }
        }
      },
      "span": {
        "start": 274,
        "end": 307
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 308,
                  "end": 310
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": true,
                    "by_ref": false,
                    "params": [],
                    "return_type": null,
                    "body": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 335,
                        "end": 336
                      }
                    },
                    "attributes": [
                      {
                        "name": {
                          "parts": [
                            "A13"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 315,
                            "end": 318
                          }
                        },
                        "args": [],
                        "span": {
                          "start": 315,
                          "end": 318
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 313,
                  "end": 336
                }
              }
            }
          },
          "span": {
            "start": 308,
            "end": 336
          }
        }
      },
      "span": {
        "start": 308,
        "end": 337
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 337
  }
}
