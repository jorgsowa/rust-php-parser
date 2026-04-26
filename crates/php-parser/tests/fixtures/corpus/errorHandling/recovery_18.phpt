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
                  "end": 15
                }
              },
              "alias": null,
              "span": {
                "start": 14,
                "end": 15
              }
            }
          ]
        }
      },
      "span": {
        "start": 7,
        "end": 19
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
                  "end": 37
                }
              },
              "alias": null,
              "span": {
                "start": 36,
                "end": 37
              }
            }
          ]
        }
      },
      "span": {
        "start": 20,
        "end": 41
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
                  "end": 47
                }
              },
              "alias": null,
              "span": {
                "start": 46,
                "end": 47
              }
            }
          ]
        }
      },
      "span": {
        "start": 42,
        "end": 50
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
                "end": 63
              }
            },
            "attributes": [],
            "span": {
              "start": 57,
              "end": 63
            }
          }
        ]
      },
      "span": {
        "start": 51,
        "end": 66
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
                "end": 88
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
                        "end": 101
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 96,
                "end": 104
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
                        "end": 114
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
                              "end": 127
                            }
                          },
                          "method": {
                            "parts": [
                              "b"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 129,
                              "end": 130
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "C"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 141,
                                "end": 142
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 126,
                        "end": 145
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 109,
                "end": 151
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": "A",
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 42
                    },
                    "span": {
                      "start": 166,
                      "end": 168
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 156,
                "end": 171
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
                "end": 185
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 68,
        "end": 190
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
                "end": 212
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 191,
        "end": 216
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
              "end": 226
            }
          }
        ]
      },
      "span": {
        "start": 218,
        "end": 230
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
                  "end": 239
                }
              }
            ]
          },
          "span": {
            "start": 231,
            "end": 242
          }
        }
      },
      "span": {
        "start": 231,
        "end": 243
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
                  "end": 257
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 245,
        "end": 261
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
              "end": 272
            }
          }
        ]
      },
      "span": {
        "start": 263,
        "end": 275
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
              "end": 285
            }
          }
        ]
      },
      "span": {
        "start": 276,
        "end": 288
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
              "end": 296
            }
          }
        ]
      },
      "span": {
        "start": 289,
        "end": 299
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
                "end": 308
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
                "end": 314
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
                "end": 320
              }
            }
          ],
          "body": {
            "kind": "Nop",
            "span": {
              "start": 323,
              "end": 324
            }
          }
        }
      },
      "span": {
        "start": 301,
        "end": 324
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 324
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting identifier or fully qualified name or namespaced name in Standard input code on line 5
