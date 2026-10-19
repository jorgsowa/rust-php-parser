===source===
<?php
use A, ;
const X = 1,;
echo 1,;
for ($i = 0,; $i < 1; $i++,);
declare(ticks=1,);
function f() { global $a,; static $b,; }
interface I extends A, {}
class C implements I, {
    use T, { T::x insteadof U,; }
    const Y = 1,;
    public $a, $b,;
}
?>
<?= 1, ?>
===errors===
expected name, found ';'
expected constant name, found ';'
expected expression, found ';'
expected expression, found ';'
expected expression, found ')'
expected identifier, found ')'
expected variable, found ';'
expected variable, found ';'
expected class name, found '{'
expected class name, found '{'
expected trait name, found '{'
expected trait name, found ';'
expected constant name, found ';'
expected variable, found ';'
expected expression, found '?>'
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting identifier or fully qualified name or namespaced name in Standard input code on line 2
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
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 11
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "X",
              "span": {
                "start": 21,
                "end": 22
              }
            },
            "value": {
              "kind": {
                "Int": 1
              },
              "span": {
                "start": 25,
                "end": 26
              }
            },
            "attributes": [],
            "span": {
              "start": 21,
              "end": 26
            }
          }
        ]
      },
      "span": {
        "start": 15,
        "end": 28
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 34,
              "end": 35
            }
          }
        ]
      },
      "span": {
        "start": 29,
        "end": 37
      }
    },
    {
      "kind": {
        "For": {
          "init": [
            {
              "kind": {
                "Assign": {
                  "target": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 43,
                      "end": 45
                    }
                  },
                  "op": "Assign",
                  "value": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 48,
                      "end": 49
                    }
                  }
                }
              },
              "span": {
                "start": 43,
                "end": 49
              }
            }
          ],
          "condition": [
            {
              "kind": {
                "Binary": {
                  "left": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 52,
                      "end": 54
                    }
                  },
                  "op": "Less",
                  "right": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 57,
                      "end": 58
                    }
                  }
                }
              },
              "span": {
                "start": 52,
                "end": 58
              }
            }
          ],
          "update": [
            {
              "kind": {
                "UnaryPostfix": {
                  "operand": {
                    "kind": {
                      "Variable": "i"
                    },
                    "span": {
                      "start": 60,
                      "end": 62
                    }
                  },
                  "op": "PostIncrement"
                }
              },
              "span": {
                "start": 60,
                "end": 64
              }
            }
          ],
          "body": {
            "kind": "Nop",
            "span": {
              "start": 66,
              "end": 67
            }
          }
        }
      },
      "span": {
        "start": 38,
        "end": 67
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 82,
                  "end": 83
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 68,
        "end": 86
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 96,
              "end": 97
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Global": [
                  {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 109,
                      "end": 111
                    }
                  }
                ]
              },
              "span": {
                "start": 102,
                "end": 113
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "b",
                      "span": {
                        "start": 121,
                        "end": 123
                      }
                    },
                    "default": null,
                    "span": {
                      "start": 121,
                      "end": 123
                    }
                  }
                ]
              },
              "span": {
                "start": 114,
                "end": 125
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 87,
        "end": 127
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 138,
              "end": 139
            }
          },
          "extends": [
            {
              "parts": [
                "A"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 148,
                "end": 149
              }
            }
          ],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 128,
        "end": 153
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 160,
              "end": 161
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [
            {
              "parts": [
                "I"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 173,
                "end": 174
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
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 186,
                        "end": 187
                      }
                    }
                  ],
                  "adaptations": [
                    {
                      "kind": {
                        "Precedence": {
                          "trait_name": {
                            "parts": [
                              "T"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 191,
                              "end": 192
                            }
                          },
                          "method": {
                            "parts": [
                              "x"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 194,
                              "end": 195
                            }
                          },
                          "insteadof": [
                            {
                              "parts": [
                                "U"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 206,
                                "end": 207
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 191,
                        "end": 209
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 182,
                "end": 211
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "Y",
                    "span": {
                      "start": 222,
                      "end": 223
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 226,
                      "end": 227
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 216,
                "end": 229
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 241,
                      "end": 243
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
                "start": 234,
                "end": 243
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 245,
                      "end": 247
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
                "start": 234,
                "end": 247
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 154,
        "end": 251
      }
    },
    {
      "kind": {
        "InlineHtml": "\n"
      },
      "span": {
        "start": 254,
        "end": 255
      }
    },
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Int": 1
            },
            "span": {
              "start": 259,
              "end": 260
            }
          }
        ]
      },
      "span": {
        "start": 259,
        "end": 261
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 261
  }
}
