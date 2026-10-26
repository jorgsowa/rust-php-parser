===source===
<?php
namespace A {
    use function strlen;
    use function count as c;
    use function \gettype;
    strlen('x')[0] = 1;
    c($a)[0] = 1;
    $r = &gettype($a);
    [c($a)[0]] = $x;
}
namespace B {
    use function C\strlen;
    use C\{function count};
    strlen('x')[0] = 1;
    count($a)[0] = 1;
    is_int($a)[0] = 1;
}
===errors===
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
Cannot use result of built-in function in write context
===php_error===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 6
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
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
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "strlen"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 37,
                            "end": 43
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 37,
                          "end": 43
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 24,
                  "end": 44
                }
              },
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "count"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 62,
                            "end": 67
                          }
                        },
                        "alias": {
                          "name": "c",
                          "span": {
                            "start": 71,
                            "end": 72
                          }
                        },
                        "span": {
                          "start": 62,
                          "end": 72
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 49,
                  "end": 73
                }
              },
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "gettype"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 91,
                            "end": 99
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 91,
                          "end": 99
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 78,
                  "end": 100
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strlen"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 105,
                                            "end": 111
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 105,
                                        "end": 111
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "x"
                                            },
                                            "span": {
                                              "start": 112,
                                              "end": 115
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 112,
                                          "end": 115
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 105,
                                  "end": 116
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 117,
                                  "end": 118
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 105,
                            "end": 119
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 122,
                            "end": 123
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 105,
                      "end": 123
                    }
                  }
                },
                "span": {
                  "start": 105,
                  "end": 124
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "c"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 129,
                                            "end": 130
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 129,
                                        "end": 130
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 131,
                                              "end": 133
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 131,
                                          "end": 133
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 129,
                                  "end": 134
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 135,
                                  "end": 136
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 129,
                            "end": 137
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 140,
                            "end": 141
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 129,
                      "end": 141
                    }
                  }
                },
                "span": {
                  "start": 129,
                  "end": 142
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "Variable": "r"
                          },
                          "span": {
                            "start": 147,
                            "end": 149
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "gettype"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 153,
                                      "end": 160
                                    }
                                  }
                                },
                                "span": {
                                  "start": 153,
                                  "end": 160
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "Variable": "a"
                                      },
                                      "span": {
                                        "start": 161,
                                        "end": 163
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 161,
                                    "end": 163
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 153,
                            "end": 164
                          }
                        },
                        "by_ref": true
                      }
                    },
                    "span": {
                      "start": 147,
                      "end": 164
                    }
                  }
                },
                "span": {
                  "start": 147,
                  "end": 165
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "ArrayAccess": {
                                        "array": {
                                          "kind": {
                                            "FunctionCall": {
                                              "name": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "c"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 171,
                                                      "end": 172
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 171,
                                                  "end": 172
                                                }
                                              },
                                              "args": [
                                                {
                                                  "name": null,
                                                  "kind": {
                                                    "Value": {
                                                      "kind": {
                                                        "Variable": "a"
                                                      },
                                                      "span": {
                                                        "start": 173,
                                                        "end": 175
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 173,
                                                    "end": 175
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 171,
                                            "end": 176
                                          }
                                        },
                                        "index": {
                                          "kind": {
                                            "Int": 0
                                          },
                                          "span": {
                                            "start": 177,
                                            "end": 178
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 171,
                                      "end": 179
                                    }
                                  }
                                },
                                "span": {
                                  "start": 171,
                                  "end": 179
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 170,
                            "end": 180
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 183,
                            "end": 185
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 170,
                      "end": 185
                    }
                  }
                },
                "span": {
                  "start": 170,
                  "end": 186
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 188
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 199,
              "end": 200
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Use": {
                    "kind": "Function",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "C",
                            "strlen"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 220,
                            "end": 228
                          }
                        },
                        "alias": null,
                        "span": {
                          "start": 220,
                          "end": 228
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 207,
                  "end": 229
                }
              },
              {
                "kind": {
                  "Use": {
                    "kind": "Normal",
                    "uses": [
                      {
                        "name": {
                          "parts": [
                            "C",
                            "count"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 250,
                            "end": 255
                          }
                        },
                        "alias": null,
                        "kind": "Function",
                        "span": {
                          "start": 241,
                          "end": 255
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 234,
                  "end": 257
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "strlen"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 262,
                                            "end": 268
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 262,
                                        "end": 268
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "String": "x"
                                            },
                                            "span": {
                                              "start": 269,
                                              "end": 272
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 269,
                                          "end": 272
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 262,
                                  "end": 273
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 274,
                                  "end": 275
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 262,
                            "end": 276
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 279,
                            "end": 280
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 262,
                      "end": 280
                    }
                  }
                },
                "span": {
                  "start": 262,
                  "end": 281
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "count"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 286,
                                            "end": 291
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 286,
                                        "end": 291
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 292,
                                              "end": 294
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 292,
                                          "end": 294
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 286,
                                  "end": 295
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 296,
                                  "end": 297
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 286,
                            "end": 298
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 301,
                            "end": 302
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 286,
                      "end": 302
                    }
                  }
                },
                "span": {
                  "start": 286,
                  "end": 303
                }
              },
              {
                "kind": {
                  "Expression": {
                    "kind": {
                      "Assign": {
                        "target": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "FunctionCall": {
                                    "name": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "is_int"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 308,
                                            "end": 314
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 308,
                                        "end": 314
                                      }
                                    },
                                    "args": [
                                      {
                                        "name": null,
                                        "kind": {
                                          "Value": {
                                            "kind": {
                                              "Variable": "a"
                                            },
                                            "span": {
                                              "start": 315,
                                              "end": 317
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 315,
                                          "end": 317
                                        }
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 308,
                                  "end": 318
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 319,
                                  "end": 320
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 308,
                            "end": 321
                          }
                        },
                        "op": "Assign",
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 324,
                            "end": 325
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 308,
                      "end": 325
                    }
                  }
                },
                "span": {
                  "start": 308,
                  "end": 326
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 189,
        "end": 328
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 328
  }
}
