===config===
min_php=8.3
===description===
Every identifier carries the span of its token; variable names include the `$`.
===source===
<?php
use A\B as C;
const K = 1;
function f(int $p) {
    static $s;
    try {} catch (E $e) {}
    $c = function () use (&$u) {};
    goto l;
    l:
}
class D {
    public const X = 1;
    public $q;
    public function __construct(public $r) {}
}
enum M { case Y; }
interface I {}
trait T {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 10,
                  "end": 13
                }
              },
              "alias": {
                "name": "C",
                "span": {
                  "start": 17,
                  "end": 18
                }
              },
              "span": {
                "start": 10,
                "end": 18
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "K",
              "span": {
                "start": 26,
                "end": 27
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 30,
                "end": 31
              }
            },
            "attributes": [],
            "span": {
              "start": 26,
              "end": 31
            }
          }
        ]
      },
      "span": {
        "start": 20,
        "end": 32
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 42,
              "end": 43
            }
          },
          "params": [
            {
              "name": {
                "name": "p",
                "span": {
                  "start": 48,
                  "end": 50
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 44,
                      "end": 47
                    }
                  }
                },
                "span": {
                  "start": 44,
                  "end": 47
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
                "start": 44,
                "end": 50
              }
            }
          ],
          "body": [
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "s",
                      "span": {
                        "start": 65,
                        "end": 67
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 65,
                      "end": 67
                    }
                  }
                ]
              },
              "span": {
                "start": 58,
                "end": 68
              }
            },
            {
              "kind": {
                "TryCatch": {
                  "body": [],
                  "catches": [
                    {
                      "types": [
                        {
                          "parts": [
                            "E"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 87,
                            "end": 88
                          }
                        }
                      ],
                      "var": {
                        "name": "e",
                        "span": {
                          "start": 89,
                          "end": 91
                        }
                      },
                      "body": [],
                      "span": {
                        "start": 86,
                        "end": 95
                      }
                    }
                  ],
                  "finally": null
                }
              },
              "span": {
                "start": 73,
                "end": 95
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "c"
                        },
                        "span": {
                          "start": 100,
                          "end": 102
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "Closure": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [],
                            "use_vars": [
                              {
                                "name": {
                                  "name": "u",
                                  "span": {
                                    "start": 123,
                                    "end": 125
                                  }
                                },
                                "by_ref": true,
                                "span": {
                                  "start": 122,
                                  "end": 125
                                }
                              }
                            ],
                            "return_type": null,
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 105,
                          "end": 129
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 100,
                    "end": 129
                  }
                }
              },
              "span": {
                "start": 100,
                "end": 130
              }
            },
            {
              "kind": {
                "Goto": {
                  "name": "l",
                  "span": {
                    "start": 140,
                    "end": 141
                  }
                }
              },
              "span": {
                "start": 135,
                "end": 142
              }
            },
            {
              "kind": {
                "Label": {
                  "name": "l",
                  "span": {
                    "start": 147,
                    "end": 148
                  }
                }
              },
              "span": {
                "start": 147,
                "end": 149
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 33,
        "end": 151
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 158,
              "end": 159
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
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 179,
                      "end": 180
                    }
                  },
                  "visibility": "Public",
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 183,
                      "end": 184
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 166,
                "end": 185
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "q",
                    "span": {
                      "start": 197,
                      "end": 199
                    }
                  },
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 190,
                "end": 199
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 221,
                      "end": 232
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
                        "name": "r",
                        "span": {
                          "start": 240,
                          "end": 242
                        }
                      },
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 233,
                        "end": 242
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 205,
                "end": 246
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 152,
        "end": 248
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "M",
            "span": {
              "start": 254,
              "end": 255
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 263,
                      "end": 264
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 258,
                "end": 265
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 249,
        "end": 267
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 278,
              "end": 279
            }
          },
          "extends": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 268,
        "end": 282
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 289,
              "end": 290
            }
          },
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 283,
        "end": 293
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 293
  }
}
