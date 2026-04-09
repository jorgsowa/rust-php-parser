===source===
<?php

function clone(object $object, array $withProperties = []): object {}
clone $x;
clone($x);
clone($x, );
clone($x, [ "foo" => $foo, "bar" => $bar ]);
clone($x, $array);
clone($x, $array, $extraParameter, $trailingComma, );
clone(object: $x, withProperties: [ "foo" => $foo, "bar" => $bar ]);
clone($x, withProperties: [ "foo" => $foo, "bar" => $bar ]);
clone(object: $x);
clone(object: $x, [ "foo" => $foo, "bar" => $bar ]);
clone(...["object" => $x, "withProperties" => [ "foo" => $foo, "bar" => $bar ]]);
clone(...);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "clone",
          "params": [
            {
              "name": "object",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "object"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 22,
                      "end": 28,
                      "start_line": 3,
                      "start_col": 15
                    }
                  }
                },
                "span": {
                  "start": 22,
                  "end": 28,
                  "start_line": 3,
                  "start_col": 15
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
                "start": 22,
                "end": 36,
                "start_line": 3,
                "start_col": 15
              }
            },
            {
              "name": "withProperties",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "array"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 38,
                      "end": 43,
                      "start_line": 3,
                      "start_col": 31
                    }
                  }
                },
                "span": {
                  "start": 38,
                  "end": 43,
                  "start_line": 3,
                  "start_col": 31
                }
              },
              "default": {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 62,
                  "end": 64,
                  "start_line": 3,
                  "start_col": 55
                }
              },
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 38,
                "end": 64,
                "start_line": 3,
                "start_col": 31
              }
            }
          ],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "object"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 67,
                  "end": 73,
                  "start_line": 3,
                  "start_col": 60
                }
              }
            },
            "span": {
              "start": 67,
              "end": 73,
              "start_line": 3,
              "start_col": 60
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 76,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "Variable": "x"
              },
              "span": {
                "start": 83,
                "end": 85,
                "start_line": 4,
                "start_col": 6
              }
            }
          },
          "span": {
            "start": 77,
            "end": 85,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 77,
        "end": 87,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "Variable": "x"
              },
              "span": {
                "start": 93,
                "end": 95,
                "start_line": 5,
                "start_col": 6
              }
            }
          },
          "span": {
            "start": 87,
            "end": 96,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 87,
        "end": 98,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "Variable": "x"
              },
              "span": {
                "start": 104,
                "end": 106,
                "start_line": 6,
                "start_col": 6
              }
            }
          },
          "span": {
            "start": 98,
            "end": 109,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 98,
        "end": 111,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CloneWith": [
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 117,
                  "end": 119,
                  "start_line": 7,
                  "start_col": 6
                }
              },
              {
                "kind": {
                  "Array": [
                    {
                      "key": {
                        "kind": {
                          "String": "foo"
                        },
                        "span": {
                          "start": 123,
                          "end": 128,
                          "start_line": 7,
                          "start_col": 12
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "foo"
                        },
                        "span": {
                          "start": 132,
                          "end": 136,
                          "start_line": 7,
                          "start_col": 21
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 123,
                        "end": 136,
                        "start_line": 7,
                        "start_col": 12
                      }
                    },
                    {
                      "key": {
                        "kind": {
                          "String": "bar"
                        },
                        "span": {
                          "start": 138,
                          "end": 143,
                          "start_line": 7,
                          "start_col": 27
                        }
                      },
                      "value": {
                        "kind": {
                          "Variable": "bar"
                        },
                        "span": {
                          "start": 147,
                          "end": 151,
                          "start_line": 7,
                          "start_col": 36
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 138,
                        "end": 151,
                        "start_line": 7,
                        "start_col": 27
                      }
                    }
                  ]
                },
                "span": {
                  "start": 121,
                  "end": 153,
                  "start_line": 7,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 111,
            "end": 154,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 111,
        "end": 156,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CloneWith": [
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 162,
                  "end": 164,
                  "start_line": 8,
                  "start_col": 6
                }
              },
              {
                "kind": {
                  "Variable": "array"
                },
                "span": {
                  "start": 166,
                  "end": 172,
                  "start_line": 8,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 156,
            "end": 173,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 156,
        "end": 175,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "clone"
                },
                "span": {
                  "start": 175,
                  "end": 180,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 181,
                      "end": 183,
                      "start_line": 9,
                      "start_col": 6
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 181,
                    "end": 183,
                    "start_line": 9,
                    "start_col": 6
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "array"
                    },
                    "span": {
                      "start": 185,
                      "end": 191,
                      "start_line": 9,
                      "start_col": 10
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 185,
                    "end": 191,
                    "start_line": 9,
                    "start_col": 10
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "extraParameter"
                    },
                    "span": {
                      "start": 193,
                      "end": 208,
                      "start_line": 9,
                      "start_col": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 193,
                    "end": 208,
                    "start_line": 9,
                    "start_col": 18
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "trailingComma"
                    },
                    "span": {
                      "start": 210,
                      "end": 224,
                      "start_line": 9,
                      "start_col": 35
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 210,
                    "end": 224,
                    "start_line": 9,
                    "start_col": 35
                  }
                }
              ]
            }
          },
          "span": {
            "start": 175,
            "end": 227,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 175,
        "end": 229,
        "start_line": 9,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "clone"
                },
                "span": {
                  "start": 229,
                  "end": 234,
                  "start_line": 10,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "object",
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 243,
                      "end": 245,
                      "start_line": 10,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 235,
                    "end": 245,
                    "start_line": 10,
                    "start_col": 6
                  }
                },
                {
                  "name": "withProperties",
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "foo"
                            },
                            "span": {
                              "start": 265,
                              "end": 270,
                              "start_line": 10,
                              "start_col": 36
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "foo"
                            },
                            "span": {
                              "start": 274,
                              "end": 278,
                              "start_line": 10,
                              "start_col": 45
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 265,
                            "end": 278,
                            "start_line": 10,
                            "start_col": 36
                          }
                        },
                        {
                          "key": {
                            "kind": {
                              "String": "bar"
                            },
                            "span": {
                              "start": 280,
                              "end": 285,
                              "start_line": 10,
                              "start_col": 51
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "bar"
                            },
                            "span": {
                              "start": 289,
                              "end": 293,
                              "start_line": 10,
                              "start_col": 60
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 280,
                            "end": 293,
                            "start_line": 10,
                            "start_col": 51
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 263,
                      "end": 295,
                      "start_line": 10,
                      "start_col": 34
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 247,
                    "end": 295,
                    "start_line": 10,
                    "start_col": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 229,
            "end": 296,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 229,
        "end": 298,
        "start_line": 10,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "clone"
                },
                "span": {
                  "start": 298,
                  "end": 303,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 304,
                      "end": 306,
                      "start_line": 11,
                      "start_col": 6
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 304,
                    "end": 306,
                    "start_line": 11,
                    "start_col": 6
                  }
                },
                {
                  "name": "withProperties",
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "foo"
                            },
                            "span": {
                              "start": 326,
                              "end": 331,
                              "start_line": 11,
                              "start_col": 28
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "foo"
                            },
                            "span": {
                              "start": 335,
                              "end": 339,
                              "start_line": 11,
                              "start_col": 37
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 326,
                            "end": 339,
                            "start_line": 11,
                            "start_col": 28
                          }
                        },
                        {
                          "key": {
                            "kind": {
                              "String": "bar"
                            },
                            "span": {
                              "start": 341,
                              "end": 346,
                              "start_line": 11,
                              "start_col": 43
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "bar"
                            },
                            "span": {
                              "start": 350,
                              "end": 354,
                              "start_line": 11,
                              "start_col": 52
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 341,
                            "end": 354,
                            "start_line": 11,
                            "start_col": 43
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 324,
                      "end": 356,
                      "start_line": 11,
                      "start_col": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 308,
                    "end": 356,
                    "start_line": 11,
                    "start_col": 10
                  }
                }
              ]
            }
          },
          "span": {
            "start": 298,
            "end": 357,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 298,
        "end": 359,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "clone"
                },
                "span": {
                  "start": 359,
                  "end": 364,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "object",
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 373,
                      "end": 375,
                      "start_line": 12,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 365,
                    "end": 375,
                    "start_line": 12,
                    "start_col": 6
                  }
                }
              ]
            }
          },
          "span": {
            "start": 359,
            "end": 376,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 359,
        "end": 378,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "clone"
                },
                "span": {
                  "start": 378,
                  "end": 383,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": "object",
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 392,
                      "end": 394,
                      "start_line": 13,
                      "start_col": 14
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 384,
                    "end": 394,
                    "start_line": 13,
                    "start_col": 6
                  }
                },
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "foo"
                            },
                            "span": {
                              "start": 398,
                              "end": 403,
                              "start_line": 13,
                              "start_col": 20
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "foo"
                            },
                            "span": {
                              "start": 407,
                              "end": 411,
                              "start_line": 13,
                              "start_col": 29
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 398,
                            "end": 411,
                            "start_line": 13,
                            "start_col": 20
                          }
                        },
                        {
                          "key": {
                            "kind": {
                              "String": "bar"
                            },
                            "span": {
                              "start": 413,
                              "end": 418,
                              "start_line": 13,
                              "start_col": 35
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "bar"
                            },
                            "span": {
                              "start": 422,
                              "end": 426,
                              "start_line": 13,
                              "start_col": 44
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 413,
                            "end": 426,
                            "start_line": 13,
                            "start_col": 35
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 396,
                      "end": 428,
                      "start_line": 13,
                      "start_col": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 396,
                    "end": 428,
                    "start_line": 13,
                    "start_col": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 378,
            "end": 429,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 378,
        "end": 431,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "clone"
                },
                "span": {
                  "start": 431,
                  "end": 436,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": {
                            "kind": {
                              "String": "object"
                            },
                            "span": {
                              "start": 441,
                              "end": 449,
                              "start_line": 14,
                              "start_col": 10
                            }
                          },
                          "value": {
                            "kind": {
                              "Variable": "x"
                            },
                            "span": {
                              "start": 453,
                              "end": 455,
                              "start_line": 14,
                              "start_col": 22
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 441,
                            "end": 455,
                            "start_line": 14,
                            "start_col": 10
                          }
                        },
                        {
                          "key": {
                            "kind": {
                              "String": "withProperties"
                            },
                            "span": {
                              "start": 457,
                              "end": 473,
                              "start_line": 14,
                              "start_col": 26
                            }
                          },
                          "value": {
                            "kind": {
                              "Array": [
                                {
                                  "key": {
                                    "kind": {
                                      "String": "foo"
                                    },
                                    "span": {
                                      "start": 479,
                                      "end": 484,
                                      "start_line": 14,
                                      "start_col": 48
                                    }
                                  },
                                  "value": {
                                    "kind": {
                                      "Variable": "foo"
                                    },
                                    "span": {
                                      "start": 488,
                                      "end": 492,
                                      "start_line": 14,
                                      "start_col": 57
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 479,
                                    "end": 492,
                                    "start_line": 14,
                                    "start_col": 48
                                  }
                                },
                                {
                                  "key": {
                                    "kind": {
                                      "String": "bar"
                                    },
                                    "span": {
                                      "start": 494,
                                      "end": 499,
                                      "start_line": 14,
                                      "start_col": 63
                                    }
                                  },
                                  "value": {
                                    "kind": {
                                      "Variable": "bar"
                                    },
                                    "span": {
                                      "start": 503,
                                      "end": 507,
                                      "start_line": 14,
                                      "start_col": 72
                                    }
                                  },
                                  "unpack": false,
                                  "span": {
                                    "start": 494,
                                    "end": 507,
                                    "start_line": 14,
                                    "start_col": 63
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 477,
                              "end": 509,
                              "start_line": 14,
                              "start_col": 46
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 457,
                            "end": 509,
                            "start_line": 14,
                            "start_col": 26
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 440,
                      "end": 510,
                      "start_line": 14,
                      "start_col": 9
                    }
                  },
                  "unpack": true,
                  "by_ref": false,
                  "span": {
                    "start": 437,
                    "end": 510,
                    "start_line": 14,
                    "start_col": 6
                  }
                }
              ]
            }
          },
          "span": {
            "start": 431,
            "end": 511,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 431,
        "end": 513,
        "start_line": 14,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CallableCreate": {
              "kind": {
                "Function": {
                  "kind": {
                    "Identifier": "clone"
                  },
                  "span": {
                    "start": 513,
                    "end": 518,
                    "start_line": 15,
                    "start_col": 0
                  }
                }
              }
            }
          },
          "span": {
            "start": 513,
            "end": 523,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 513,
        "end": 524,
        "start_line": 15,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 524,
    "start_line": 1,
    "start_col": 0
  }
}
