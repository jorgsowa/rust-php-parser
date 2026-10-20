===source===
<?php
declare(ticks=FOO);
declare(ticks=-1);
declare(ticks=+1);
declare(ticks=1 + 1);
declare(ticks=__LINE__);
declare(ticks="a$b");
declare(ticks=<<<E
x$a
E);
declare(ticks=`x`);
declare(strict_types=true);
declare(strict_types=null);
declare(strict_types=[1]);
declare(strict_types=-0);
declare(STRICT_TYPES=PHP_INT_MAX);
declare(foo=FOO);
===errors===
declare(ticks) value must be a literal
declare(ticks) value must be a literal
declare(ticks) value must be a literal
declare(ticks) value must be a literal
declare(ticks) value must be a literal
declare(ticks) value must be a literal
declare(ticks) value must be a literal
declare(ticks) value must be a literal
declare(strict_types) value must be a literal
declare(strict_types) value must be a literal
declare(strict_types) value must be a literal
declare(strict_types) value must be a literal
declare(STRICT_TYPES) value must be a literal
declare(foo) value must be a literal
===php_error===
PHP Fatal error:  declare(ticks) value must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 20,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 25
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
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 41,
                        "end": 42
                      }
                    }
                  }
                },
                "span": {
                  "start": 40,
                  "end": 42
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 26,
        "end": 44
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
                  "UnaryPrefix": {
                    "op": "Plus",
                    "operand": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 60,
                        "end": 61
                      }
                    }
                  }
                },
                "span": {
                  "start": 59,
                  "end": 61
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 45,
        "end": 63
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
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 78,
                        "end": 79
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 82,
                        "end": 83
                      }
                    }
                  }
                },
                "span": {
                  "start": 78,
                  "end": 83
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 64,
        "end": 85
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
                  "MagicConst": "Line"
                },
                "span": {
                  "start": 100,
                  "end": 108
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 86,
        "end": 110
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
                  "InterpolatedString": [
                    {
                      "Literal": "a"
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "b"
                        },
                        "span": {
                          "start": 127,
                          "end": 129
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 125,
                  "end": 130
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 111,
        "end": 132
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
                  "Heredoc": {
                    "label": "E",
                    "parts": [
                      {
                        "Literal": "x"
                      },
                      {
                        "Expr": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 153,
                            "end": 155
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 147,
                  "end": 157
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 133,
        "end": 159
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
                  "ShellExec": [
                    {
                      "Literal": "x"
                    }
                  ]
                },
                "span": {
                  "start": 174,
                  "end": 177
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 160,
        "end": 179
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Bool": true
                },
                "span": {
                  "start": 201,
                  "end": 205
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 180,
        "end": 207
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": "Null",
                "span": {
                  "start": 229,
                  "end": 233
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 208,
        "end": 235
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 258,
                            "end": 259
                          }
                        }
                      },
                      "span": {
                        "start": 258,
                        "end": 259
                      }
                    }
                  ]
                },
                "span": {
                  "start": 257,
                  "end": 260
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 236,
        "end": 262
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Int": 0
                      },
                      "span": {
                        "start": 285,
                        "end": 286
                      }
                    }
                  }
                },
                "span": {
                  "start": 284,
                  "end": 286
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 263,
        "end": 288
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "STRICT_TYPES",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "PHP_INT_MAX"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 310,
                      "end": 321
                    }
                  }
                },
                "span": {
                  "start": 310,
                  "end": 321
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 289,
        "end": 323
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "foo",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 336,
                      "end": 339
                    }
                  }
                },
                "span": {
                  "start": 336,
                  "end": 339
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 324,
        "end": 341
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 341
  }
}
