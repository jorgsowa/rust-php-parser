===source===
<?php

use A\{B, };
use function A\{b, };
use A, ;
const A = 42, ;

class X implements Y, {
    use A, ;
    use A, {
        A::b insteadof C, ;
    }
    const A = 42, ;
    public $x, ;
}
interface I extends J, {}

unset($x, );
isset($x, );

declare(a=42, );

global $a, ;
static $a, ;
echo $a, ;

for ($a, ; $b, ; $c, );
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
                  "start": 11,
                  "end": 15,
                  "start_line": 3,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 14,
                "end": 15,
                "start_line": 3,
                "start_col": 7
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 20,
        "start_line": 3,
        "start_col": 0
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
                  "A",
                  "b"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 33,
                  "end": 37,
                  "start_line": 4,
                  "start_col": 13
                }
              },
              "alias": null,
              "span": {
                "start": 36,
                "end": 37,
                "start_line": 4,
                "start_col": 16
              }
            }
          ]
        }
      },
      "span": {
        "start": 20,
        "end": 42,
        "start_line": 4,
        "start_col": 0
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
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 46,
                  "end": 47,
                  "start_line": 5,
                  "start_col": 4
                }
              },
              "alias": null,
              "span": {
                "start": 46,
                "end": 47,
                "start_line": 5,
                "start_col": 4
              }
            }
          ]
        }
      },
      "span": {
        "start": 42,
        "end": 51,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": "A",
            "value": {
              "kind": {
                "Int": 42
              },
              "span": {
                "start": 61,
                "end": 63,
                "start_line": 6,
                "start_col": 10
              }
            },
            "attributes": [],
            "span": {
              "start": 57,
              "end": 63,
              "start_line": 6,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 51,
        "end": 68,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Class": {
          "name": "X",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "Y"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 87,
                "end": 88,
                "start_line": 8,
                "start_col": 19
              }
            }
          ],
          "members": [
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 100,
                        "end": 101,
                        "start_line": 9,
                        "start_col": 8
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 96,
                "end": 109,
                "start_line": 9,
                "start_col": 4
              }
            },
            {
              "kind": {
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 113,
                        "end": 114,
                        "start_line": 10,
                        "start_col": 8
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 126,
                              "end": 127,
                              "start_line": 11,
                              "start_col": 8
                            }
                          },
                          "method": "b",
                          "insteadof": [
                            {
                              "parts": [
                                "C"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 141,
                                "end": 142,
                                "start_line": 11,
                                "start_col": 23
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 126,
                        "end": 150,
                        "start_line": 11,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 109,
                "end": 156,
                "start_line": 10,
                "start_col": 4
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "A",
                  "visibility": null,
                  "value": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 166,
                      "end": 168,
                      "start_line": 13,
                      "start_col": 14
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 156,
                "end": 176,
                "start_line": 13,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "x",
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
                "start": 176,
                "end": 185,
                "start_line": 14,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 68,
        "end": 190,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Interface": {
          "name": "I",
          "extends": [
            {
              "parts": [
                "J"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 211,
                "end": 212,
                "start_line": 16,
                "start_col": 20
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 191,
        "end": 216,
        "start_line": 16,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Unset": [
          {
            "kind": {
              "Variable": "x"
            },
            "span": {
              "start": 224,
              "end": 226,
              "start_line": 18,
              "start_col": 6
            }
          }
        ]
      },
      "span": {
        "start": 218,
        "end": 231,
        "start_line": 18,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Isset": [
              {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 237,
                  "end": 239,
                  "start_line": 19,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 231,
            "end": 242,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 231,
        "end": 245,
        "start_line": 19,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "a",
              {
                "kind": {
                  "Int": 42
                },
                "span": {
                  "start": 255,
                  "end": 257,
                  "start_line": 21,
                  "start_col": 10
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 245,
        "end": 263,
        "start_line": 21,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Global": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 270,
              "end": 272,
              "start_line": 23,
              "start_col": 7
            }
          }
        ]
      },
      "span": {
        "start": 263,
        "end": 276,
        "start_line": 23,
        "start_col": 0
      }
    },
    {
      "kind": {
        "StaticVar": [
          {
            "name": "a",
            "default": null,
            "span": {
              "start": 283,
              "end": 285,
              "start_line": 24,
              "start_col": 7
            }
          }
        ]
      },
      "span": {
        "start": 276,
        "end": 289,
        "start_line": 24,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 294,
              "end": 296,
              "start_line": 25,
              "start_col": 5
            }
          }
        ]
      },
      "span": {
        "start": 289,
        "end": 301,
        "start_line": 25,
        "start_col": 0
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Variable": "a"
              },
              "span": {
                "start": 306,
                "end": 308,
                "start_line": 27,
                "start_col": 5
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Variable": "b"
              },
              "span": {
                "start": 312,
                "end": 314,
                "start_line": 27,
                "start_col": 11
              }
            }
          ],
          "update": [
            {
              "kind": {
                "Variable": "c"
              },
              "span": {
                "start": 318,
                "end": 320,
                "start_line": 27,
                "start_col": 17
              }
            }
          ],
          "body": {
            "kind": "Nop",
            "span": {
              "start": 323,
              "end": 324,
              "start_line": 27,
              "start_col": 22
            }
          }
        }
      },
      "span": {
        "start": 301,
        "end": 324,
        "start_line": 27,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 324,
    "start_line": 1,
    "start_col": 0
  }
}
