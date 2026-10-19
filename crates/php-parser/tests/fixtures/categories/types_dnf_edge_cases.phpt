===config===
min_php=8.2

===source===
<?php
// Edge case 1: Three-way union of intersections
function test1((A&B)|(C&D)|(E&F) $x) {}

// Edge case 2: Mixed single types and intersections in union
function test2((A&B)|C|D $x) {}

// Edge case 3: Return type with DNF
function test3(): (A&B)|(C&D) {}

// Edge case 4: Multiple intersections in union
function test4((A&B&C)|(D&E&F) $x) {}

// Edge case 5: Unparenthesized union
function test5(A|B|C $x) {}

// Edge case 6: Unparenthesized intersection
function test6(A&B&C $x) {}

// Edge case 7: Builtin types in union
function test7(int|string|bool $x) {}

// Edge case 8: Builtin in intersection
function test8(A&Traversable $x) {}

// Edge case 9: Builtin in DNF
function test9((A&Traversable)|(B&Iterator) $x) {}

// Edge case 10: Qualified types
function test10((A\B&C\D)|(E\F&G\H) $x) {}

// Edge case 11: Array type in union
function test11(array|A $x) {}

// Edge case 12: DNF in property with multiple members
class TestDNFProperties {
    public (A&B)|(C&D) $prop1;
    public (X&Y&Z)|(P&Q)|(M&N&O) $prop2;

    // Edge case 13: Self type
    public function test13(self|int $x) {}

    // Edge case 15: Complex 4-way intersection
    public function test15((A&B&C&D)|(E&F&G&H) $x) {}
}

// Edge case 16: DNF in return type with multiple intersections
function test16(): (A&B)|(C&D)|(E&F) {}

// Edge case 17: Builtin null
function test17(int|null $x) {}

// Edge case 18: Builtin false
function test18(false|int $x) {}

// Edge case 19: Mix of builtin and custom in union
function test19(int|string|CustomClass $x) {}

// Edge case 20: Many intersections in one side of union
function test20((A&B&C&D&E)|(F&G) $x) {}

// Edge case 21: Deeply nested namespace types
function test21((NS1\NS2\A&NS3\NS4\B)|(NS5\NS6\C&NS7\NS8\D) $x) {}

// Edge case 22: Static return type
class TestStaticReturn {
    public function test(): static|A {
        return $this;
    }
}

// Edge case 23: Callable in union
function test23(callable|A $x) {}

// Edge case 24: Object in union
function test24(object|int $x) {}

// Edge case 25: Iterable in union
function test25(iterable|A $x) {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test1",
            "span": {
              "start": 64,
              "end": 69
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 88,
                  "end": 90
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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 71,
                                  "end": 72
                                }
                              }
                            },
                            "span": {
                              "start": 71,
                              "end": 72
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 73,
                                  "end": 74
                                }
                              }
                            },
                            "span": {
                              "start": 73,
                              "end": 74
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 70,
                        "end": 75
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "C"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 77,
                                  "end": 78
                                }
                              }
                            },
                            "span": {
                              "start": 77,
                              "end": 78
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "D"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 79,
                                  "end": 80
                                }
                              }
                            },
                            "span": {
                              "start": 79,
                              "end": 80
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 76,
                        "end": 81
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 83,
                                  "end": 84
                                }
                              }
                            },
                            "span": {
                              "start": 83,
                              "end": 84
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "F"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 85,
                                  "end": 86
                                }
                              }
                            },
                            "span": {
                              "start": 85,
                              "end": 86
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 82,
                        "end": 87
                      }
                    }
                  ]
                },
                "span": {
                  "start": 70,
                  "end": 87
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 70,
                "end": 90
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
        "start": 55,
        "end": 94
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test2",
            "span": {
              "start": 167,
              "end": 172
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 183,
                  "end": 185
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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 174,
                                  "end": 175
                                }
                              }
                            },
                            "span": {
                              "start": 174,
                              "end": 175
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 176,
                                  "end": 177
                                }
                              }
                            },
                            "span": {
                              "start": 176,
                              "end": 177
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 173,
                        "end": 178
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 179,
                            "end": 180
                          }
                        }
                      },
                      "span": {
                        "start": 179,
                        "end": 180
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "D"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 181,
                            "end": 182
                          }
                        }
                      },
                      "span": {
                        "start": 181,
                        "end": 182
                      }
                    }
                  ]
                },
                "span": {
                  "start": 173,
                  "end": 182
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 173,
                "end": 185
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
        "start": 158,
        "end": 189
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test3",
            "span": {
              "start": 237,
              "end": 242
            }
          },
          "params": [],
          "body": [],
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
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 247,
                              "end": 248
                            }
                          }
                        },
                        "span": {
                          "start": 247,
                          "end": 248
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 249,
                              "end": 250
                            }
                          }
                        },
                        "span": {
                          "start": 249,
                          "end": 250
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 246,
                    "end": 251
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "C"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 253,
                              "end": 254
                            }
                          }
                        },
                        "span": {
                          "start": 253,
                          "end": 254
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "D"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 255,
                              "end": 256
                            }
                          }
                        },
                        "span": {
                          "start": 255,
                          "end": 256
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 252,
                    "end": 257
                  }
                }
              ]
            },
            "span": {
              "start": 246,
              "end": 257
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 228,
        "end": 260
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test4",
            "span": {
              "start": 319,
              "end": 324
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 341,
                  "end": 343
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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 326,
                                  "end": 327
                                }
                              }
                            },
                            "span": {
                              "start": 326,
                              "end": 327
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 328,
                                  "end": 329
                                }
                              }
                            },
                            "span": {
                              "start": 328,
                              "end": 329
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "C"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 330,
                                  "end": 331
                                }
                              }
                            },
                            "span": {
                              "start": 330,
                              "end": 331
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 325,
                        "end": 332
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "D"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 334,
                                  "end": 335
                                }
                              }
                            },
                            "span": {
                              "start": 334,
                              "end": 335
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 336,
                                  "end": 337
                                }
                              }
                            },
                            "span": {
                              "start": 336,
                              "end": 337
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "F"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 338,
                                  "end": 339
                                }
                              }
                            },
                            "span": {
                              "start": 338,
                              "end": 339
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 333,
                        "end": 340
                      }
                    }
                  ]
                },
                "span": {
                  "start": 325,
                  "end": 340
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 325,
                "end": 343
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
        "start": 310,
        "end": 347
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test5",
            "span": {
              "start": 396,
              "end": 401
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 408,
                  "end": 410
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 402,
                            "end": 403
                          }
                        }
                      },
                      "span": {
                        "start": 402,
                        "end": 403
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 404,
                            "end": 405
                          }
                        }
                      },
                      "span": {
                        "start": 404,
                        "end": 405
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 406,
                            "end": 407
                          }
                        }
                      },
                      "span": {
                        "start": 406,
                        "end": 407
                      }
                    }
                  ]
                },
                "span": {
                  "start": 402,
                  "end": 407
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 402,
                "end": 410
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
        "start": 387,
        "end": 414
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test6",
            "span": {
              "start": 470,
              "end": 475
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 482,
                  "end": 484
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 476,
                            "end": 477
                          }
                        }
                      },
                      "span": {
                        "start": 476,
                        "end": 477
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "B"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 478,
                            "end": 479
                          }
                        }
                      },
                      "span": {
                        "start": 478,
                        "end": 479
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "C"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 480,
                            "end": 481
                          }
                        }
                      },
                      "span": {
                        "start": 480,
                        "end": 481
                      }
                    }
                  ]
                },
                "span": {
                  "start": 476,
                  "end": 481
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 476,
                "end": 484
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
        "start": 461,
        "end": 488
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test7",
            "span": {
              "start": 538,
              "end": 543
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 560,
                  "end": 562
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 544,
                            "end": 547
                          }
                        }
                      },
                      "span": {
                        "start": 544,
                        "end": 547
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 548,
                            "end": 554
                          }
                        }
                      },
                      "span": {
                        "start": 548,
                        "end": 554
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
                            "start": 555,
                            "end": 559
                          }
                        }
                      },
                      "span": {
                        "start": 555,
                        "end": 559
                      }
                    }
                  ]
                },
                "span": {
                  "start": 544,
                  "end": 559
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 544,
                "end": 562
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
        "start": 529,
        "end": 566
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test8",
            "span": {
              "start": 617,
              "end": 622
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 637,
                  "end": 639
                }
              },
              "type_hint": {
                "kind": {
                  "Intersection": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 623,
                            "end": 624
                          }
                        }
                      },
                      "span": {
                        "start": 623,
                        "end": 624
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
                            "start": 625,
                            "end": 636
                          }
                        }
                      },
                      "span": {
                        "start": 625,
                        "end": 636
                      }
                    }
                  ]
                },
                "span": {
                  "start": 623,
                  "end": 636
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 623,
                "end": 639
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
        "start": 608,
        "end": 643
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test9",
            "span": {
              "start": 685,
              "end": 690
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 720,
                  "end": 722
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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 692,
                                  "end": 693
                                }
                              }
                            },
                            "span": {
                              "start": 692,
                              "end": 693
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
                                  "start": 694,
                                  "end": 705
                                }
                              }
                            },
                            "span": {
                              "start": 694,
                              "end": 705
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 691,
                        "end": 706
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 708,
                                  "end": 709
                                }
                              }
                            },
                            "span": {
                              "start": 708,
                              "end": 709
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Iterator"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 710,
                                  "end": 718
                                }
                              }
                            },
                            "span": {
                              "start": 710,
                              "end": 718
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 707,
                        "end": 719
                      }
                    }
                  ]
                },
                "span": {
                  "start": 691,
                  "end": 719
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 691,
                "end": 722
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
        "start": 676,
        "end": 726
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test10",
            "span": {
              "start": 770,
              "end": 776
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 797,
                  "end": 799
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
                                  "A",
                                  "B"
                                ],
                                "kind": "Qualified",
                                "span": {
                                  "start": 778,
                                  "end": 781
                                }
                              }
                            },
                            "span": {
                              "start": 778,
                              "end": 781
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "C",
                                  "D"
                                ],
                                "kind": "Qualified",
                                "span": {
                                  "start": 782,
                                  "end": 785
                                }
                              }
                            },
                            "span": {
                              "start": 782,
                              "end": 785
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 777,
                        "end": 786
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "E",
                                  "F"
                                ],
                                "kind": "Qualified",
                                "span": {
                                  "start": 788,
                                  "end": 791
                                }
                              }
                            },
                            "span": {
                              "start": 788,
                              "end": 791
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "G",
                                  "H"
                                ],
                                "kind": "Qualified",
                                "span": {
                                  "start": 792,
                                  "end": 795
                                }
                              }
                            },
                            "span": {
                              "start": 792,
                              "end": 795
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 787,
                        "end": 796
                      }
                    }
                  ]
                },
                "span": {
                  "start": 777,
                  "end": 796
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 777,
                "end": 799
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
        "start": 761,
        "end": 803
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test11",
            "span": {
              "start": 851,
              "end": 857
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 866,
                  "end": 868
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "array"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 858,
                            "end": 863
                          }
                        }
                      },
                      "span": {
                        "start": 858,
                        "end": 863
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 864,
                            "end": 865
                          }
                        }
                      },
                      "span": {
                        "start": 864,
                        "end": 865
                      }
                    }
                  ]
                },
                "span": {
                  "start": 858,
                  "end": 865
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 858,
                "end": 868
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
        "start": 842,
        "end": 872
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "TestDNFProperties",
            "span": {
              "start": 935,
              "end": 952
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
                    "name": "prop1",
                    "span": {
                      "start": 978,
                      "end": 984
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                      "A"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 967,
                                      "end": 968
                                    }
                                  }
                                },
                                "span": {
                                  "start": 967,
                                  "end": 968
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "B"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 969,
                                      "end": 970
                                    }
                                  }
                                },
                                "span": {
                                  "start": 969,
                                  "end": 970
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 966,
                            "end": 971
                          }
                        },
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "C"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 973,
                                      "end": 974
                                    }
                                  }
                                },
                                "span": {
                                  "start": 973,
                                  "end": 974
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "D"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 975,
                                      "end": 976
                                    }
                                  }
                                },
                                "span": {
                                  "start": 975,
                                  "end": 976
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 972,
                            "end": 977
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 966,
                      "end": 977
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 959,
                "end": 984
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop2",
                    "span": {
                      "start": 1019,
                      "end": 1025
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                      "X"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 998,
                                      "end": 999
                                    }
                                  }
                                },
                                "span": {
                                  "start": 998,
                                  "end": 999
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Y"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1000,
                                      "end": 1001
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1000,
                                  "end": 1001
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Z"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1002,
                                      "end": 1003
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1002,
                                  "end": 1003
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 997,
                            "end": 1004
                          }
                        },
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "P"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1006,
                                      "end": 1007
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1006,
                                  "end": 1007
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Q"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1008,
                                      "end": 1009
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1008,
                                  "end": 1009
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 1005,
                            "end": 1010
                          }
                        },
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "M"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1012,
                                      "end": 1013
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1012,
                                  "end": 1013
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "N"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1014,
                                      "end": 1015
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1014,
                                  "end": 1015
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "O"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 1016,
                                      "end": 1017
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1016,
                                  "end": 1017
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 1011,
                            "end": 1018
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 997,
                      "end": 1018
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 990,
                "end": 1025
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "test13",
                    "span": {
                      "start": 1079,
                      "end": 1085
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 1095,
                          "end": 1097
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "self"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 1086,
                                    "end": 1090
                                  }
                                }
                              },
                              "span": {
                                "start": 1086,
                                "end": 1090
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
                                    "start": 1091,
                                    "end": 1094
                                  }
                                }
                              },
                              "span": {
                                "start": 1091,
                                "end": 1094
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 1086,
                          "end": 1094
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1086,
                        "end": 1097
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 1063,
                "end": 1101
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "test15",
                    "span": {
                      "start": 1171,
                      "end": 1177
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 1198,
                          "end": 1200
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
                                          "A"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1179,
                                          "end": 1180
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1179,
                                      "end": 1180
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "B"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1181,
                                          "end": 1182
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1181,
                                      "end": 1182
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "C"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1183,
                                          "end": 1184
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1183,
                                      "end": 1184
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "D"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1185,
                                          "end": 1186
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1185,
                                      "end": 1186
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 1178,
                                "end": 1187
                              }
                            },
                            {
                              "kind": {
                                "Intersection": [
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "E"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1189,
                                          "end": 1190
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1189,
                                      "end": 1190
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "F"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1191,
                                          "end": 1192
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1191,
                                      "end": 1192
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "G"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1193,
                                          "end": 1194
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1193,
                                      "end": 1194
                                    }
                                  },
                                  {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "H"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 1195,
                                          "end": 1196
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1195,
                                      "end": 1196
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 1188,
                                "end": 1197
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 1178,
                          "end": 1197
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 1178,
                        "end": 1200
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 1155,
                "end": 1204
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 929,
        "end": 1206
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test16",
            "span": {
              "start": 1281,
              "end": 1287
            }
          },
          "params": [],
          "body": [],
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
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1292,
                              "end": 1293
                            }
                          }
                        },
                        "span": {
                          "start": 1292,
                          "end": 1293
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "B"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1294,
                              "end": 1295
                            }
                          }
                        },
                        "span": {
                          "start": 1294,
                          "end": 1295
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1291,
                    "end": 1296
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "C"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1298,
                              "end": 1299
                            }
                          }
                        },
                        "span": {
                          "start": 1298,
                          "end": 1299
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "D"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1300,
                              "end": 1301
                            }
                          }
                        },
                        "span": {
                          "start": 1300,
                          "end": 1301
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1297,
                    "end": 1302
                  }
                },
                {
                  "kind": {
                    "Intersection": [
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "E"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1304,
                              "end": 1305
                            }
                          }
                        },
                        "span": {
                          "start": 1304,
                          "end": 1305
                        }
                      },
                      {
                        "kind": {
                          "Named": {
                            "parts": [
                              "F"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1306,
                              "end": 1307
                            }
                          }
                        },
                        "span": {
                          "start": 1306,
                          "end": 1307
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1303,
                    "end": 1308
                  }
                }
              ]
            },
            "span": {
              "start": 1291,
              "end": 1308
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 1272,
        "end": 1311
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test17",
            "span": {
              "start": 1352,
              "end": 1358
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 1368,
                  "end": 1370
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1359,
                            "end": 1362
                          }
                        }
                      },
                      "span": {
                        "start": 1359,
                        "end": 1362
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
                            "start": 1363,
                            "end": 1367
                          }
                        }
                      },
                      "span": {
                        "start": 1363,
                        "end": 1367
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1359,
                  "end": 1367
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 1359,
                "end": 1370
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
        "start": 1343,
        "end": 1374
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test18",
            "span": {
              "start": 1416,
              "end": 1422
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 1433,
                  "end": 1435
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "false"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1423,
                            "end": 1428
                          }
                        }
                      },
                      "span": {
                        "start": 1423,
                        "end": 1428
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
                            "start": 1429,
                            "end": 1432
                          }
                        }
                      },
                      "span": {
                        "start": 1429,
                        "end": 1432
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1423,
                  "end": 1432
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 1423,
                "end": 1435
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
        "start": 1407,
        "end": 1439
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test19",
            "span": {
              "start": 1502,
              "end": 1508
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 1532,
                  "end": 1534
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1509,
                            "end": 1512
                          }
                        }
                      },
                      "span": {
                        "start": 1509,
                        "end": 1512
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "string"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1513,
                            "end": 1519
                          }
                        }
                      },
                      "span": {
                        "start": 1513,
                        "end": 1519
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "CustomClass"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1520,
                            "end": 1531
                          }
                        }
                      },
                      "span": {
                        "start": 1520,
                        "end": 1531
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1509,
                  "end": 1531
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 1509,
                "end": 1534
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
        "start": 1493,
        "end": 1538
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test20",
            "span": {
              "start": 1606,
              "end": 1612
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 1631,
                  "end": 1633
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
                                  "A"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1614,
                                  "end": 1615
                                }
                              }
                            },
                            "span": {
                              "start": 1614,
                              "end": 1615
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "B"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1616,
                                  "end": 1617
                                }
                              }
                            },
                            "span": {
                              "start": 1616,
                              "end": 1617
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "C"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1618,
                                  "end": 1619
                                }
                              }
                            },
                            "span": {
                              "start": 1618,
                              "end": 1619
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "D"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1620,
                                  "end": 1621
                                }
                              }
                            },
                            "span": {
                              "start": 1620,
                              "end": 1621
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "E"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1622,
                                  "end": 1623
                                }
                              }
                            },
                            "span": {
                              "start": 1622,
                              "end": 1623
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1613,
                        "end": 1624
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "F"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1626,
                                  "end": 1627
                                }
                              }
                            },
                            "span": {
                              "start": 1626,
                              "end": 1627
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "G"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 1628,
                                  "end": 1629
                                }
                              }
                            },
                            "span": {
                              "start": 1628,
                              "end": 1629
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1625,
                        "end": 1630
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1613,
                  "end": 1630
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 1613,
                "end": 1633
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
        "start": 1597,
        "end": 1637
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test21",
            "span": {
              "start": 1695,
              "end": 1701
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 1746,
                  "end": 1748
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
                                  "NS1",
                                  "NS2",
                                  "A"
                                ],
                                "kind": "Qualified",
                                "span": {
                                  "start": 1703,
                                  "end": 1712
                                }
                              }
                            },
                            "span": {
                              "start": 1703,
                              "end": 1712
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "NS3",
                                  "NS4",
                                  "B"
                                ],
                                "kind": "Qualified",
                                "span": {
                                  "start": 1713,
                                  "end": 1722
                                }
                              }
                            },
                            "span": {
                              "start": 1713,
                              "end": 1722
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1702,
                        "end": 1723
                      }
                    },
                    {
                      "kind": {
                        "Intersection": [
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "NS5",
                                  "NS6",
                                  "C"
                                ],
                                "kind": "Qualified",
                                "span": {
                                  "start": 1725,
                                  "end": 1734
                                }
                              }
                            },
                            "span": {
                              "start": 1725,
                              "end": 1734
                            }
                          },
                          {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "NS7",
                                  "NS8",
                                  "D"
                                ],
                                "kind": "Qualified",
                                "span": {
                                  "start": 1735,
                                  "end": 1744
                                }
                              }
                            },
                            "span": {
                              "start": 1735,
                              "end": 1744
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1724,
                        "end": 1745
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1702,
                  "end": 1745
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 1702,
                "end": 1748
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
        "start": 1686,
        "end": 1752
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "TestStaticReturn",
            "span": {
              "start": 1796,
              "end": 1812
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
                    "name": "test",
                    "span": {
                      "start": 1835,
                      "end": 1839
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "static"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1843,
                                "end": 1849
                              }
                            }
                          },
                          "span": {
                            "start": 1843,
                            "end": 1849
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 1850,
                                "end": 1851
                              }
                            }
                          },
                          "span": {
                            "start": 1850,
                            "end": 1851
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 1843,
                      "end": 1851
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Variable": "this"
                          },
                          "span": {
                            "start": 1869,
                            "end": 1874
                          }
                        }
                      },
                      "span": {
                        "start": 1862,
                        "end": 1875
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1819,
                "end": 1881
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1790,
        "end": 1883
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test23",
            "span": {
              "start": 1929,
              "end": 1935
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 1947,
                  "end": 1949
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "callable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1936,
                            "end": 1944
                          }
                        }
                      },
                      "span": {
                        "start": 1936,
                        "end": 1944
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 1945,
                            "end": 1946
                          }
                        }
                      },
                      "span": {
                        "start": 1945,
                        "end": 1946
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1936,
                  "end": 1946
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 1936,
                "end": 1949
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
        "start": 1920,
        "end": 1953
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test24",
            "span": {
              "start": 1997,
              "end": 2003
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 2015,
                  "end": 2017
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "object"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 2004,
                            "end": 2010
                          }
                        }
                      },
                      "span": {
                        "start": 2004,
                        "end": 2010
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
                            "start": 2011,
                            "end": 2014
                          }
                        }
                      },
                      "span": {
                        "start": 2011,
                        "end": 2014
                      }
                    }
                  ]
                },
                "span": {
                  "start": 2004,
                  "end": 2014
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 2004,
                "end": 2017
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
        "start": 1988,
        "end": 2021
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "test25",
            "span": {
              "start": 2067,
              "end": 2073
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 2085,
                  "end": 2087
                }
              },
              "type_hint": {
                "kind": {
                  "Union": [
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "iterable"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 2074,
                            "end": 2082
                          }
                        }
                      },
                      "span": {
                        "start": 2074,
                        "end": 2082
                      }
                    },
                    {
                      "kind": {
                        "Named": {
                          "parts": [
                            "A"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 2083,
                            "end": 2084
                          }
                        }
                      },
                      "span": {
                        "start": 2083,
                        "end": 2084
                      }
                    }
                  ]
                },
                "span": {
                  "start": 2074,
                  "end": 2084
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 2074,
                "end": 2087
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
        "start": 2058,
        "end": 2091
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 2091
  }
}
