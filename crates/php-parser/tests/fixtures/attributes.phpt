===config===
min_php=8.1
===source===
<?php

// Single attribute on function
#[Pure]
function add(int $a, int $b): int {
    return $a + $b;
}

// Attribute with arguments
#[Route("/api/users", methods: ["GET", "POST"])]
function listUsers() {}

// Multiple grouped attributes
#[A, B]
class Foo {}

// Stacked attributes
#[Attribute1]
#[Attribute2]
class Bar {}

// Attributes on class members
class User {
    #[Column("name")]
    public string $name;

    #[Id]
    #[GeneratedValue]
    private int $id;

    #[Deprecated("Use getName() instead")]
    public function name(): string {
        return $this->name;
    }
}

// Attribute on parameter
function greet(#[FromQuery] string $name) {}

// Hash comment still works
# This is a comment
$x = 1;

// Attribute on enum
#[EnumAttr]
enum Color {
    #[CaseAttr]
    case Red;
    case Blue;
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "add",
          "params": [
            {
              "name": "a",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 60,
                      "end": 63,
                      "start_line": 5,
                      "start_col": 13
                    }
                  }
                },
                "span": {
                  "start": 60,
                  "end": 63,
                  "start_line": 5,
                  "start_col": 13
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
                "start": 60,
                "end": 66,
                "start_line": 5,
                "start_col": 13
              }
            },
            {
              "name": "b",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 68,
                      "end": 71,
                      "start_line": 5,
                      "start_col": 21
                    }
                  }
                },
                "span": {
                  "start": 68,
                  "end": 71,
                  "start_line": 5,
                  "start_col": 21
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
                "start": 68,
                "end": 74,
                "start_line": 5,
                "start_col": 21
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 94,
                          "end": 96,
                          "start_line": 6,
                          "start_col": 11
                        }
                      },
                      "op": "Add",
                      "right": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 99,
                          "end": 101,
                          "start_line": 6,
                          "start_col": 16
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 94,
                    "end": 101,
                    "start_line": 6,
                    "start_col": 11
                  }
                }
              },
              "span": {
                "start": 87,
                "end": 103,
                "start_line": 6,
                "start_col": 4
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "int"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 77,
                  "end": 80,
                  "start_line": 5,
                  "start_col": 30
                }
              }
            },
            "span": {
              "start": 77,
              "end": 80,
              "start_line": 5,
              "start_col": 30
            }
          },
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Pure"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 41,
                  "end": 45,
                  "start_line": 4,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 41,
                "end": 45,
                "start_line": 4,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 47,
        "end": 104,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "listUsers",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Route"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 136,
                  "end": 141,
                  "start_line": 10,
                  "start_col": 2
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": "/api/users"
                    },
                    "span": {
                      "start": 142,
                      "end": 154,
                      "start_line": 10,
                      "start_col": 8
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 142,
                    "end": 154,
                    "start_line": 10,
                    "start_col": 8
                  }
                },
                {
                  "name": "methods",
                  "value": {
                    "kind": {
                      "Array": [
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "String": "GET"
                            },
                            "span": {
                              "start": 166,
                              "end": 171,
                              "start_line": 10,
                              "start_col": 32
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 166,
                            "end": 171,
                            "start_line": 10,
                            "start_col": 32
                          }
                        },
                        {
                          "key": null,
                          "value": {
                            "kind": {
                              "String": "POST"
                            },
                            "span": {
                              "start": 173,
                              "end": 179,
                              "start_line": 10,
                              "start_col": 39
                            }
                          },
                          "unpack": false,
                          "span": {
                            "start": 173,
                            "end": 179,
                            "start_line": 10,
                            "start_col": 39
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 165,
                      "end": 180,
                      "start_line": 10,
                      "start_col": 31
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 156,
                    "end": 180,
                    "start_line": 10,
                    "start_col": 22
                  }
                }
              ],
              "span": {
                "start": 136,
                "end": 181,
                "start_line": 10,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 183,
        "end": 206,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 241,
                  "end": 242,
                  "start_line": 14,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 241,
                "end": 242,
                "start_line": 14,
                "start_col": 2
              }
            },
            {
              "name": {
                "parts": [
                  "B"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 244,
                  "end": 245,
                  "start_line": 14,
                  "start_col": 5
                }
              },
              "args": [],
              "span": {
                "start": 244,
                "end": 245,
                "start_line": 14,
                "start_col": 5
              }
            }
          ]
        }
      },
      "span": {
        "start": 247,
        "end": 259,
        "start_line": 15,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "Bar",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute1"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 285,
                  "end": 295,
                  "start_line": 18,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 285,
                "end": 295,
                "start_line": 18,
                "start_col": 2
              }
            },
            {
              "name": {
                "parts": [
                  "Attribute2"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 299,
                  "end": 309,
                  "start_line": 19,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 299,
                "end": 309,
                "start_line": 19,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 311,
        "end": 323,
        "start_line": 20,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "User",
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
                  "name": "name",
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
                          "start": 402,
                          "end": 408,
                          "start_line": 25,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 402,
                      "end": 408,
                      "start_line": 25,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Column"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 375,
                          "end": 381,
                          "start_line": 24,
                          "start_col": 6
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "String": "name"
                            },
                            "span": {
                              "start": 382,
                              "end": 388,
                              "start_line": 24,
                              "start_col": 13
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 382,
                            "end": 388,
                            "start_line": 24,
                            "start_col": 13
                          }
                        }
                      ],
                      "span": {
                        "start": 375,
                        "end": 389,
                        "start_line": 24,
                        "start_col": 6
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 373,
                "end": 414,
                "start_line": 24,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "id",
                  "visibility": "Private",
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
                          "start": 461,
                          "end": 464,
                          "start_line": 29,
                          "start_col": 12
                        }
                      }
                    },
                    "span": {
                      "start": 461,
                      "end": 464,
                      "start_line": 29,
                      "start_col": 12
                    }
                  },
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Id"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 423,
                          "end": 425,
                          "start_line": 27,
                          "start_col": 6
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 423,
                        "end": 425,
                        "start_line": 27,
                        "start_col": 6
                      }
                    },
                    {
                      "name": {
                        "parts": [
                          "GeneratedValue"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 433,
                          "end": 447,
                          "start_line": 28,
                          "start_col": 6
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 433,
                        "end": 447,
                        "start_line": 28,
                        "start_col": 6
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 421,
                "end": 468,
                "start_line": 27,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "name",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 542,
                          "end": 548,
                          "start_line": 32,
                          "start_col": 28
                        }
                      }
                    },
                    "span": {
                      "start": 542,
                      "end": 548,
                      "start_line": 32,
                      "start_col": 28
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 566,
                                  "end": 571,
                                  "start_line": 33,
                                  "start_col": 15
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "name"
                                },
                                "span": {
                                  "start": 573,
                                  "end": 577,
                                  "start_line": 33,
                                  "start_col": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 566,
                            "end": 577,
                            "start_line": 33,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 559,
                        "end": 583,
                        "start_line": 33,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Deprecated"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 477,
                          "end": 487,
                          "start_line": 31,
                          "start_col": 6
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "value": {
                            "kind": {
                              "String": "Use getName() instead"
                            },
                            "span": {
                              "start": 488,
                              "end": 511,
                              "start_line": 31,
                              "start_col": 17
                            }
                          },
                          "unpack": false,
                          "by_ref": false,
                          "span": {
                            "start": 488,
                            "end": 511,
                            "start_line": 31,
                            "start_col": 17
                          }
                        }
                      ],
                      "span": {
                        "start": 477,
                        "end": 512,
                        "start_line": 31,
                        "start_col": 6
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 475,
                "end": 585,
                "start_line": 31,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 356,
        "end": 586,
        "start_line": 23,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "greet",
          "params": [
            {
              "name": "name",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "string"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 642,
                      "end": 648,
                      "start_line": 38,
                      "start_col": 28
                    }
                  }
                },
                "span": {
                  "start": 642,
                  "end": 648,
                  "start_line": 38,
                  "start_col": 28
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "is_readonly": false,
              "is_final": false,
              "visibility": null,
              "set_visibility": null,
              "attributes": [
                {
                  "name": {
                    "parts": [
                      "FromQuery"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 631,
                      "end": 640,
                      "start_line": 38,
                      "start_col": 17
                    }
                  },
                  "args": [],
                  "span": {
                    "start": 631,
                    "end": 640,
                    "start_line": 38,
                    "start_col": 17
                  }
                }
              ],
              "span": {
                "start": 629,
                "end": 654,
                "start_line": 38,
                "start_col": 15
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
        "start": 614,
        "end": 658,
        "start_line": 38,
        "start_col": 0
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
                  "start": 708,
                  "end": 710,
                  "start_line": 42,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 713,
                  "end": 714,
                  "start_line": 42,
                  "start_col": 5
                }
              }
            }
          },
          "span": {
            "start": 708,
            "end": 714,
            "start_line": 42,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 708,
        "end": 738,
        "start_line": 42,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Enum": {
          "name": "Color",
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": "Red",
                  "value": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "CaseAttr"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 769,
                          "end": 777,
                          "start_line": 47,
                          "start_col": 6
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 769,
                        "end": 777,
                        "start_line": 47,
                        "start_col": 6
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 783,
                "end": 797,
                "start_line": 48,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Case": {
                  "name": "Blue",
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 797,
                "end": 808,
                "start_line": 49,
                "start_col": 4
              }
            }
          ],
          "attributes": [
            {
              "name": {
                "parts": [
                  "EnumAttr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 740,
                  "end": 748,
                  "start_line": 45,
                  "start_col": 2
                }
              },
              "args": [],
              "span": {
                "start": 740,
                "end": 748,
                "start_line": 45,
                "start_col": 2
              }
            }
          ]
        }
      },
      "span": {
        "start": 750,
        "end": 809,
        "start_line": 46,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 809,
    "start_line": 1,
    "start_col": 0
  }
}
