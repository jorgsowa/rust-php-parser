===source===
<?php
function test1($a, ... $b) {}
function test2($a, &... $b) {}
function test3($a, Type ... $b) {}
function test4($a, Type &... $b) {}
function test5($a, ?Type ... $b) {}
function test6($a, ?Type &... $b) {}
function test7($a, Type1|Type2 ... $b) {}
function test8($a, Type1|Type2 &... $b) {}
function test9(#[Attr] ... $b) {}
function test10(#[Attr] &... $b) {}
function test11(#[Attr] Type ... $b) {}
function test12(#[Attr] Type &... $b) {}
class Test {
    public function method1(... $b) {}
    public function method2(&... $b) {}
    public function method3(Type ... $b) {}
    public function method4(Type &... $b) {}
}
class Constructor {
    public function __construct(#[Attr] Type ... $b) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "test1",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 21,
                "end": 23
              }
            },
            {
              "name": "b",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 25,
                "end": 31
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test2",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 51,
                "end": 53
              }
            },
            {
              "name": "b",
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 55,
                "end": 62
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 36,
        "end": 66
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test3",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 82,
                "end": 84
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 86,
                      "end": 90
                    }
                  }
                },
                "span": {
                  "start": 86,
                  "end": 90
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 86,
                "end": 97
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 67,
        "end": 101
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test4",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 117,
                "end": 119
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 121,
                      "end": 125
                    }
                  }
                },
                "span": {
                  "start": 121,
                  "end": 125
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 121,
                "end": 133
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 102,
        "end": 137
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test5",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 153,
                "end": 155
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Type"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 158,
                          "end": 162
                        }
                      }
                    },
                    "span": {
                      "start": 158,
                      "end": 162
                    }
                  }
                },
                "span": {
                  "start": 157,
                  "end": 162
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 157,
                "end": 169
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 138,
        "end": 173
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test6",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 189,
                "end": 191
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Nullable": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Type"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 194,
                          "end": 198
                        }
                      }
                    },
                    "span": {
                      "start": 194,
                      "end": 198
                    }
                  }
                },
                "span": {
                  "start": 193,
                  "end": 198
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 193,
                "end": 206
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 174,
        "end": 210
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test7",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 226,
                "end": 228
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Type1"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 230,
                            "end": 235
                          }
                        }
                      },
                      "span": {
                        "start": 230,
                        "end": 235
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Type2"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 236,
                            "end": 241
                          }
                        }
                      },
                      "span": {
                        "start": 236,
                        "end": 241
                      }
                    }
                  ]
                },
                "span": {
                  "start": 230,
                  "end": 241
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 230,
                "end": 248
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 211,
        "end": 252
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test8",
          "params": [
            {
              "name": "a",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 268,
                "end": 270
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Type1"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 272,
                            "end": 277
                          }
                        }
                      },
                      "span": {
                        "start": 272,
                        "end": 277
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "Type2"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 278,
                            "end": 283
                          }
                        }
                      },
                      "span": {
                        "start": 278,
                        "end": 283
                      }
                    }
                  ]
                },
                "span": {
                  "start": 272,
                  "end": 283
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [],
              "span": {
                "start": 272,
                "end": 291
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 253,
        "end": 295
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test9",
          "params": [
            {
              "name": "b",
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "Attr"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 313,
                      "end": 317
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 313,
                    "end": 317
                  }
                }
              ],
              "span": {
                "start": 311,
                "end": 325
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 296,
        "end": 329
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test10",
          "params": [
            {
              "name": "b",
              "type_hint": null,
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "Attr"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 348,
                      "end": 352
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 348,
                    "end": 352
                  }
                }
              ],
              "span": {
                "start": 346,
                "end": 361
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 330,
        "end": 365
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test11",
          "params": [
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 390,
                      "end": 394
                    }
                  }
                },
                "span": {
                  "start": 390,
                  "end": 394
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "Attr"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 384,
                      "end": 388
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 384,
                    "end": 388
                  }
                }
              ],
              "span": {
                "start": 382,
                "end": 401
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 366,
        "end": 405
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test12",
          "params": [
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Type"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 430,
                      "end": 434
                    }
                  }
                },
                "span": {
                  "start": 430,
                  "end": 434
                }
              },
              "default": null,
              "by_ref": true,
              "variadic": true,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "Attr"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 424,
                      "end": 428
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 424,
                    "end": 428
                  }
                }
              ],
              "span": {
                "start": 422,
                "end": 442
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 406,
        "end": 446
      }
    },
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
                "Method": {
                  "name": "method1",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "b",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 488,
                        "end": 494
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 464,
                "end": 498
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "method2",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "b",
                      "type_hint": null,
                      "default": null,
                      "by_ref": true,
                      "variadic": true,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 527,
                        "end": 534
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 503,
                "end": 538
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "method3",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "b",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Type"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 567,
                              "end": 571
                            }
                          }
                        },
                        "span": {
                          "start": 567,
                          "end": 571
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 567,
                        "end": 578
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 543,
                "end": 582
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "method4",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "b",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Type"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 611,
                              "end": 615
                            }
                          }
                        },
                        "span": {
                          "start": 611,
                          "end": 615
                        }
                      },
                      "default": null,
                      "by_ref": true,
                      "variadic": true,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 611,
                        "end": 623
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 587,
                "end": 627
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 447,
        "end": 629
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Constructor",
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
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "b",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Type"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 690,
                              "end": 694
                            }
                          }
                        },
                        "span": {
                          "start": 690,
                          "end": 694
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": true,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [
                        {
                          "name": {
                            "parts": [
                              "Attr"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 684,
                              "end": 688
                            }
                          },
                          "args": [],
                          "span": {
                            "start": 684,
                            "end": 688
                          }
                        }
                      ],
                      "span": {
                        "start": 682,
                        "end": 701
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 654,
                "end": 705
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 630,
        "end": 707
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 707
  }
}
