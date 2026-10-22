===source===
<?php
namespace N1 {
    use A as readonly;
    use A\readonly as R;
}
namespace N2 {
    class Readonly extends readonly implements Readonly {}
}
namespace N3 {
    interface readonly {}
}
namespace N4 {
    trait readonly { function foo() {} }
    const readonly = 1;
    function f(Readonly $a, readonly|int $b, readonly &$c, Readonly ...$d): readonly {}
    class C {
        use T { foo as readonly; }
        public readonly $x;
    }
    readonly: goto readonly;
}
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "readonly", expecting identifier in Standard input code on line 3
===ast 8.0===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N1"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 18
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
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 29,
                            "end": 30
                          }
                        },
                        "alias": {
                          "name": "readonly",
                          "span": {
                            "start": 34,
                            "end": 42
                          }
                        },
                        "span": {
                          "start": 29,
                          "end": 42
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 25,
                  "end": 43
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
                            "A",
                            "readonly"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 52,
                            "end": 62
                          }
                        },
                        "alias": {
                          "name": "R",
                          "span": {
                            "start": 66,
                            "end": 67
                          }
                        },
                        "span": {
                          "start": 52,
                          "end": 67
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 48,
                  "end": 68
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 70
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N2"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 81,
              "end": 83
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "Readonly",
                      "span": {
                        "start": 96,
                        "end": 104
                      }
                    },
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": {
                      "parts": [
                        "readonly"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 113,
                        "end": 121
                      }
                    },
                    "implements": [
                      {
                        "parts": [
                          "Readonly"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 133,
                          "end": 141
                        }
                      }
                    ],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 90,
                  "end": 144
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 71,
        "end": 146
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N3"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 157,
              "end": 159
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Interface": {
                    "name": {
                      "name": "readonly",
                      "span": {
                        "start": 176,
                        "end": 184
                      }
                    },
                    "extends": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 166,
                  "end": 187
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 147,
        "end": 189
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N4"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 200,
              "end": 202
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Trait": {
                    "name": {
                      "name": "readonly",
                      "span": {
                        "start": 215,
                        "end": 223
                      }
                    },
                    "members": [
                      {
                        "kind": {
                          "Method": {
                            "name": {
                              "name": "foo",
                              "span": {
                                "start": 235,
                                "end": 238
                              }
                            },
                            "by_ref": false,
                            "params": [],
                            "return_type": null,
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 226,
                          "end": 243
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 209,
                  "end": 245
                }
              },
              {
                "kind": {
                  "Const": [
                    {
                      "name": {
                        "name": "readonly",
                        "span": {
                          "start": 256,
                          "end": 264
                        }
                      },
                      "value": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 267,
                          "end": 268
                        }
                      },
                      "attributes": [],
                      "span": {
                        "start": 256,
                        "end": 268
                      }
                    }
                  ]
                },
                "span": {
                  "start": 250,
                  "end": 269
                }
              },
              {
                "kind": {
                  "Function": {
                    "name": {
                      "name": "f",
                      "span": {
                        "start": 283,
                        "end": 284
                      }
                    },
                    "params": [
                      {
                        "name": {
                          "name": "a",
                          "span": {
                            "start": 294,
                            "end": 296
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Readonly"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 285,
                                "end": 293
                              }
                            }
                          },
                          "span": {
                            "start": 285,
                            "end": 293
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 285,
                          "end": 296
                        }
                      },
                      {
                        "name": {
                          "name": "b",
                          "span": {
                            "start": 311,
                            "end": 313
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Union": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "readonly"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 298,
                                      "end": 306
                                    }
                                  }
                                },
                                "span": {
                                  "start": 298,
                                  "end": 306
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "int"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 307,
                                      "end": 310
                                    }
                                  }
                                },
                                "span": {
                                  "start": 307,
                                  "end": 310
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 298,
                            "end": 310
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 298,
                          "end": 313
                        }
                      },
                      {
                        "name": {
                          "name": "c",
                          "span": {
                            "start": 325,
                            "end": 327
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "readonly"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 315,
                                "end": 323
                              }
                            }
                          },
                          "span": {
                            "start": 315,
                            "end": 323
                          }
                        },
                        "default": null,
                        "by_ref": true,
                        "variadic": false,
                        "attributes": [],
                        "span": {
                          "start": 315,
                          "end": 327
                        }
                      },
                      {
                        "name": {
                          "name": "d",
                          "span": {
                            "start": 341,
                            "end": 343
                          }
                        },
                        "type_hint": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Readonly"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 329,
                                "end": 337
                              }
                            }
                          },
                          "span": {
                            "start": 329,
                            "end": 337
                          }
                        },
                        "default": null,
                        "by_ref": false,
                        "variadic": true,
                        "attributes": [],
                        "span": {
                          "start": 329,
                          "end": 343
                        }
                      }
                    ],
                    "body": [],
                    "return_type": {
                      "kind": {
                        "Named": {
                          "parts": [
                            "readonly"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 346,
                            "end": 354
                          }
                        }
                      },
                      "span": {
                        "start": 346,
                        "end": 354
                      }
                    },
                    "by_ref": false,
                    "attributes": []
                  }
                },
                "span": {
                  "start": 274,
                  "end": 357
                }
              },
              {
                "kind": {
                  "Class": {
                    "name": {
                      "name": "C",
                      "span": {
                        "start": 368,
                        "end": 369
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
                          "TraitUse": {
                            "traits": [
                              {
                                "parts": [
                                  "T"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 384,
                                  "end": 385
                                }
                              }
                            ],
                            "adaptations": [
                              {
                                "kind": {
                                  "Alias": {
                                    "trait_name": null,
                                    "method": {
                                      "parts": [
                                        "foo"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 388,
                                        "end": 391
                                      }
                                    },
                                    "new_modifier": null,
                                    "new_name": {
                                      "parts": [
                                        "readonly"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 395,
                                        "end": 403
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 388,
                                  "end": 404
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 380,
                          "end": 406
                        }
                      },
                      {
                        "kind": {
                          "Property": {
                            "name": {
                              "name": "x",
                              "span": {
                                "start": 431,
                                "end": 433
                              }
                            },
                            "modifiers": {
                              "visibility": "Public"
                            },
                            "type_hint": {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "readonly"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 422,
                                    "end": 430
                                  }
                                }
                              },
                              "span": {
                                "start": 422,
                                "end": 430
                              }
                            },
                            "default": null,
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 415,
                          "end": 433
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 362,
                  "end": 440
                }
              },
              {
                "kind": {
                  "Label": {
                    "name": "readonly",
                    "span": {
                      "start": 445,
                      "end": 453
                    }
                  }
                },
                "span": {
                  "start": 445,
                  "end": 454
                }
              },
              {
                "kind": {
                  "Goto": {
                    "name": "readonly",
                    "span": {
                      "start": 460,
                      "end": 468
                    }
                  }
                },
                "span": {
                  "start": 455,
                  "end": 469
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 190,
        "end": 471
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 471
  }
}
