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

    // Edge case 14: Self in intersection
    public function test14(self&A $x) {}

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
          "name": "test1",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test2",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test3",
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
          "name": "test4",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test5",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test6",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test7",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test8",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test9",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test10",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "test11",
          "params": [
            {
              "name": "x",
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
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
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
          "name": "TestDNFProperties",
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
                  "name": "prop1",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                  "name": "prop2",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                  "name": "test13",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
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
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": null,
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
                  "name": "test14",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
                      "type_hint": {
                        "kind": {
                          "Intersection": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "self"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 1172,
                                    "end": 1176
                                  }
                                }
                              },
                              "span": {
                                "start": 1172,
                                "end": 1176
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
                                    "start": 1177,
                                    "end": 1178
                                  }
                                }
                              },
                              "span": {
                                "start": 1177,
                                "end": 1178
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 1172,
                          "end": 1178
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
                        "start": 1172,
                        "end": 1181
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 1149,
                "end": 1185
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "test15",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "x",
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
                                          "start": 1263,
                                          "end": 1264
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1263,
                                      "end": 1264
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
                                          "start": 1265,
                                          "end": 1266
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1265,
                                      "end": 1266
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
                                          "start": 1267,
                                          "end": 1268
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1267,
                                      "end": 1268
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
                                          "start": 1269,
                                          "end": 1270
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1269,
                                      "end": 1270
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 1262,
                                "end": 1271
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
                                          "start": 1273,
                                          "end": 1274
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1273,
                                      "end": 1274
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
                                          "start": 1275,
                                          "end": 1276
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1275,
                                      "end": 1276
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
                                          "start": 1277,
                                          "end": 1278
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1277,
                                      "end": 1278
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
                                          "start": 1279,
                                          "end": 1280
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1279,
                                      "end": 1280
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 1272,
                                "end": 1281
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 1262,
                          "end": 1281
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
                        "start": 1262,
                        "end": 1284
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 1239,
                "end": 1288
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 929,
        "end": 1290
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test16",
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
                              "start": 1376,
                              "end": 1377
                            }
                          }
                        },
                        "span": {
                          "start": 1376,
                          "end": 1377
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
                              "start": 1378,
                              "end": 1379
                            }
                          }
                        },
                        "span": {
                          "start": 1378,
                          "end": 1379
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1375,
                    "end": 1380
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
                              "start": 1382,
                              "end": 1383
                            }
                          }
                        },
                        "span": {
                          "start": 1382,
                          "end": 1383
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
                              "start": 1384,
                              "end": 1385
                            }
                          }
                        },
                        "span": {
                          "start": 1384,
                          "end": 1385
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1381,
                    "end": 1386
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
                              "start": 1388,
                              "end": 1389
                            }
                          }
                        },
                        "span": {
                          "start": 1388,
                          "end": 1389
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
                              "start": 1390,
                              "end": 1391
                            }
                          }
                        },
                        "span": {
                          "start": 1390,
                          "end": 1391
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1387,
                    "end": 1392
                  }
                }
              ]
            },
            "span": {
              "start": 1375,
              "end": 1392
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 1356,
        "end": 1395
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test17",
          "params": [
            {
              "name": "x",
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
                            "start": 1443,
                            "end": 1446
                          }
                        }
                      },
                      "span": {
                        "start": 1443,
                        "end": 1446
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
                            "start": 1447,
                            "end": 1451
                          }
                        }
                      },
                      "span": {
                        "start": 1447,
                        "end": 1451
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1443,
                  "end": 1451
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
                "start": 1443,
                "end": 1454
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
        "start": 1427,
        "end": 1458
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test18",
          "params": [
            {
              "name": "x",
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
                            "start": 1507,
                            "end": 1512
                          }
                        }
                      },
                      "span": {
                        "start": 1507,
                        "end": 1512
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
                            "start": 1513,
                            "end": 1516
                          }
                        }
                      },
                      "span": {
                        "start": 1513,
                        "end": 1516
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1507,
                  "end": 1516
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
                "start": 1507,
                "end": 1519
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
        "start": 1491,
        "end": 1523
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test19",
          "params": [
            {
              "name": "x",
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
                            "start": 1593,
                            "end": 1596
                          }
                        }
                      },
                      "span": {
                        "start": 1593,
                        "end": 1596
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
                            "start": 1597,
                            "end": 1603
                          }
                        }
                      },
                      "span": {
                        "start": 1597,
                        "end": 1603
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
                            "start": 1604,
                            "end": 1615
                          }
                        }
                      },
                      "span": {
                        "start": 1604,
                        "end": 1615
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1593,
                  "end": 1615
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
                "start": 1593,
                "end": 1618
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
        "start": 1577,
        "end": 1622
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test20",
          "params": [
            {
              "name": "x",
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
                                  "start": 1698,
                                  "end": 1699
                                }
                              }
                            },
                            "span": {
                              "start": 1698,
                              "end": 1699
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
                                  "start": 1700,
                                  "end": 1701
                                }
                              }
                            },
                            "span": {
                              "start": 1700,
                              "end": 1701
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
                                  "start": 1702,
                                  "end": 1703
                                }
                              }
                            },
                            "span": {
                              "start": 1702,
                              "end": 1703
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
                                  "start": 1704,
                                  "end": 1705
                                }
                              }
                            },
                            "span": {
                              "start": 1704,
                              "end": 1705
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
                                  "start": 1706,
                                  "end": 1707
                                }
                              }
                            },
                            "span": {
                              "start": 1706,
                              "end": 1707
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1697,
                        "end": 1708
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
                                  "start": 1710,
                                  "end": 1711
                                }
                              }
                            },
                            "span": {
                              "start": 1710,
                              "end": 1711
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
                                  "start": 1712,
                                  "end": 1713
                                }
                              }
                            },
                            "span": {
                              "start": 1712,
                              "end": 1713
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1709,
                        "end": 1714
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1697,
                  "end": 1714
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
                "start": 1697,
                "end": 1717
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
        "start": 1681,
        "end": 1721
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test21",
          "params": [
            {
              "name": "x",
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
                                  "start": 1787,
                                  "end": 1796
                                }
                              }
                            },
                            "span": {
                              "start": 1787,
                              "end": 1796
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
                                  "start": 1797,
                                  "end": 1806
                                }
                              }
                            },
                            "span": {
                              "start": 1797,
                              "end": 1806
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1786,
                        "end": 1807
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
                                  "start": 1809,
                                  "end": 1818
                                }
                              }
                            },
                            "span": {
                              "start": 1809,
                              "end": 1818
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
                                  "start": 1819,
                                  "end": 1828
                                }
                              }
                            },
                            "span": {
                              "start": 1819,
                              "end": 1828
                            }
                          }
                        ]
                      },
                      "span": {
                        "start": 1808,
                        "end": 1829
                      }
                    }
                  ]
                },
                "span": {
                  "start": 1786,
                  "end": 1829
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
                "start": 1786,
                "end": 1832
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
        "start": 1770,
        "end": 1836
      }
    },
    {
      "kind": {
        "Class": {
          "name": "TestStaticReturn",
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
                  "name": "test",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
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
                                "start": 1927,
                                "end": 1933
                              }
                            }
                          },
                          "span": {
                            "start": 1927,
                            "end": 1933
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
                                "start": 1934,
                                "end": 1935
                              }
                            }
                          },
                          "span": {
                            "start": 1934,
                            "end": 1935
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 1927,
                      "end": 1935
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
                            "start": 1953,
                            "end": 1958
                          }
                        }
                      },
                      "span": {
                        "start": 1946,
                        "end": 1959
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 1903,
                "end": 1965
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 1874,
        "end": 1967
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test23",
          "params": [
            {
              "name": "x",
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
                            "start": 2020,
                            "end": 2028
                          }
                        }
                      },
                      "span": {
                        "start": 2020,
                        "end": 2028
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
                            "start": 2029,
                            "end": 2030
                          }
                        }
                      },
                      "span": {
                        "start": 2029,
                        "end": 2030
                      }
                    }
                  ]
                },
                "span": {
                  "start": 2020,
                  "end": 2030
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
                "start": 2020,
                "end": 2033
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
        "start": 2004,
        "end": 2037
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test24",
          "params": [
            {
              "name": "x",
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
                            "start": 2088,
                            "end": 2094
                          }
                        }
                      },
                      "span": {
                        "start": 2088,
                        "end": 2094
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
                            "start": 2095,
                            "end": 2098
                          }
                        }
                      },
                      "span": {
                        "start": 2095,
                        "end": 2098
                      }
                    }
                  ]
                },
                "span": {
                  "start": 2088,
                  "end": 2098
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
                "start": 2088,
                "end": 2101
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
        "start": 2072,
        "end": 2105
      }
    },
    {
      "kind": {
        "Function": {
          "name": "test25",
          "params": [
            {
              "name": "x",
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
                            "start": 2158,
                            "end": 2166
                          }
                        }
                      },
                      "span": {
                        "start": 2158,
                        "end": 2166
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
                            "start": 2167,
                            "end": 2168
                          }
                        }
                      },
                      "span": {
                        "start": 2167,
                        "end": 2168
                      }
                    }
                  ]
                },
                "span": {
                  "start": 2158,
                  "end": 2168
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
                "start": 2158,
                "end": 2171
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
        "start": 2142,
        "end": 2175
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 2175
  }
}
