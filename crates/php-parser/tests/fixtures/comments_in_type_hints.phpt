===config===
min_php=8.4
===source===
<?php
function test1(
    string /* before pipe */ | int $x,
    float | /* after pipe */ int $y,
    (Countable & /* in intersection */ Traversable) | bool $z
): string /* return type */ | null {
    return null;
}

class Test {
    private string /* prop */ | int $prop;

    public function method(
        Countable /* comment */ & Traversable $param
    ): (Countable & Traversable) /* intersection comment */ | null {
        return null;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test1",
            "span": {
              "start": 15,
              "end": 20
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 57,
                  "end": 59
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 26,
                            "end": 32
                          }
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 32
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
                            "start": 53,
                            "end": 56
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 56
                      }
                    }
                  ]
                },
                "span": {
                  "start": 26,
                  "end": 56
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
                "start": 26,
                "end": 59
              }
            },
            {
              "name": {
                "name": "y",
                "span": {
                  "start": 94,
                  "end": 96
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "float"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 65,
                            "end": 70
                          }
                        }
                      },
                      "span": {
                        "start": 65,
                        "end": 70
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
                            "start": 90,
                            "end": 93
                          }
                        }
                      },
                      "span": {
                        "start": 90,
                        "end": 93
                      }
                    }
                  ]
                },
                "span": {
                  "start": 65,
                  "end": 93
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
                "start": 65,
                "end": 96
              }
            },
            {
              "name": {
                "name": "z",
                "span": {
                  "start": 157,
                  "end": 159
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Countable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 103,
                                  "end": 112
                                }
                              }
                            },
                            "span": {
                              "start": 103,
                              "end": 112
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Traversable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 137,
                                  "end": 148
                                }
                              }
                            },
                            "span": {
                              "start": 137,
                              "end": 148
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 102,
                        "end": 149
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "bool"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 152,
                            "end": 156
                          }
                        }
                      },
                      "span": {
                        "start": 152,
                        "end": 156
                      }
                    }
                  ]
                },
                "span": {
                  "start": 102,
                  "end": 156
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
                "start": 102,
                "end": 159
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": "Null",
                  "span": {
                    "start": 208,
                    "end": 212
                  }
                }
              },
              "span": {
                "start": 201,
                "end": 213
              }
            }
          ],
          "return_type": {
            "kind": {
              "Union": [
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "string"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 163,
                        "end": 169
                      }
                    }
                  },
                  "span": {
                    "start": 163,
                    "end": 169
                  }
                },
                {
                  "kind": {
                    "Named": {
                      "parts": [
                        "null"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 190,
                        "end": 194
                      }
                    }
                  },
                  "span": {
                    "start": 190,
                    "end": 194
                  }
                }
              ]
            },
            "span": {
              "start": 163,
              "end": 194
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 215
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 223,
              "end": 227
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
                    "name": "prop",
                    "span": {
                      "start": 266,
                      "end": 271
                    }
                  },
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "string"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 242,
                                "end": 248
                              }
                            }
                          },
                          "span": {
                            "start": 242,
                            "end": 248
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
                                "start": 262,
                                "end": 265
                              }
                            }
                          },
                          "span": {
                            "start": 262,
                            "end": 265
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 242,
                      "end": 265
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 234,
                "end": 271
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "method",
                    "span": {
                      "start": 294,
                      "end": 300
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "param",
                        "span": {
                          "start": 348,
                          "end": 354
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Intersection": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Countable"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 310,
                                    "end": 319
                                  }
                                }
                              },
                              "span": {
                                "start": 310,
                                "end": 319
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "Traversable"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 336,
                                    "end": 347
                                  }
                                }
                              },
                              "span": {
                                "start": 336,
                                "end": 347
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 310,
                          "end": 347
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
                        "start": 310,
                        "end": 354
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Countable"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 363,
                                      "end": 372
                                    }
                                  }
                                },
                                "span": {
                                  "start": 363,
                                  "end": 372
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Traversable"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 375,
                                      "end": 386
                                    }
                                  }
                                },
                                "span": {
                                  "start": 375,
                                  "end": 386
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 362,
                            "end": 387
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "null"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 417,
                                "end": 421
                              }
                            }
                          },
                          "span": {
                            "start": 417,
                            "end": 421
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 362,
                      "end": 421
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": "Null",
                          "span": {
                            "start": 439,
                            "end": 443
                          }
                        }
                      },
                      "span": {
                        "start": 432,
                        "end": 444
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 278,
                "end": 450
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 217,
        "end": 452
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 452
  }
}
