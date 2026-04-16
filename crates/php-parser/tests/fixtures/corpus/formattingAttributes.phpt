===source===
<?php

0b1100;
0o14;
12;
0xc;
1_2_3_4_5_6;
3.141_592_653;

'foo';
"bar";
"foo
bar";
"foo\nbar";
"foo\nbar{$x}";
`foo\nbar`;
`foo\nbar{$x}`;

<<<'ABC'
ABC;
<<<'ABC'
foo bar
ABC;
<<<'ABC'
    foo bar
    ABC;
<<<ABC
foo\nbar
ABC;
<<<ABC
    foo\nbar
    ABC;
<<<ABC
foo\nbar{$x}baz
ABC;
<<<ABC
    foo\nbar{$x}baz
    ABC;

array();
[];
list($x) = $y;
[$x] = $y;
(int) $int;
(integer) $integer;
(bool) $bool;
(boolean) $boolean;
(string) $string;
(binary) $binary;
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 12
          },
          "span": {
            "start": 7,
            "end": 13
          }
        }
      },
      "span": {
        "start": 7,
        "end": 14
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 12
          },
          "span": {
            "start": 15,
            "end": 19
          }
        }
      },
      "span": {
        "start": 15,
        "end": 20
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 12
          },
          "span": {
            "start": 21,
            "end": 23
          }
        }
      },
      "span": {
        "start": 21,
        "end": 24
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 12
          },
          "span": {
            "start": 25,
            "end": 28
          }
        }
      },
      "span": {
        "start": 25,
        "end": 29
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 123456
          },
          "span": {
            "start": 30,
            "end": 41
          }
        }
      },
      "span": {
        "start": 30,
        "end": 42
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Float": 3.141592653
          },
          "span": {
            "start": 43,
            "end": 56
          }
        }
      },
      "span": {
        "start": 43,
        "end": 57
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "foo"
          },
          "span": {
            "start": 59,
            "end": 64
          }
        }
      },
      "span": {
        "start": 59,
        "end": 65
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "bar"
          },
          "span": {
            "start": 66,
            "end": 71
          }
        }
      },
      "span": {
        "start": 66,
        "end": 72
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "foo\nbar"
          },
          "span": {
            "start": 73,
            "end": 82
          }
        }
      },
      "span": {
        "start": 73,
        "end": 83
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "foo\nbar"
          },
          "span": {
            "start": 84,
            "end": 94
          }
        }
      },
      "span": {
        "start": 84,
        "end": 95
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "InterpolatedString": [
              {
                "Literal": "foo\nbar"
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 106,
                    "end": 108
                  }
                }
              }
            ]
          },
          "span": {
            "start": 96,
            "end": 110
          }
        }
      },
      "span": {
        "start": 96,
        "end": 111
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "foo\nbar"
              }
            ]
          },
          "span": {
            "start": 112,
            "end": 122
          }
        }
      },
      "span": {
        "start": 112,
        "end": 123
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ShellExec": [
              {
                "Literal": "foo\nbar"
              },
              {
                "Expr": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 134,
                    "end": 136
                  }
                }
              }
            ]
          },
          "span": {
            "start": 124,
            "end": 138
          }
        }
      },
      "span": {
        "start": 124,
        "end": 139
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Nowdoc": {
              "label": "ABC",
              "value": ""
            }
          },
          "span": {
            "start": 141,
            "end": 153
          }
        }
      },
      "span": {
        "start": 141,
        "end": 154
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Nowdoc": {
              "label": "ABC",
              "value": "foo bar"
            }
          },
          "span": {
            "start": 155,
            "end": 175
          }
        }
      },
      "span": {
        "start": 155,
        "end": 176
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Nowdoc": {
              "label": "ABC",
              "value": "foo bar"
            }
          },
          "span": {
            "start": 177,
            "end": 205
          }
        }
      },
      "span": {
        "start": 177,
        "end": 206
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "ABC",
              "parts": [
                {
                  "Literal": "foo\\nbar"
                }
              ]
            }
          },
          "span": {
            "start": 207,
            "end": 226
          }
        }
      },
      "span": {
        "start": 207,
        "end": 227
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "ABC",
              "parts": [
                {
                  "Literal": "foo\\nbar"
                }
              ]
            }
          },
          "span": {
            "start": 228,
            "end": 255
          }
        }
      },
      "span": {
        "start": 228,
        "end": 256
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "ABC",
              "parts": [
                {
                  "Literal": "foo\nbar"
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 273,
                      "end": 275
                    }
                  }
                },
                {
                  "Literal": "baz"
                }
              ]
            }
          },
          "span": {
            "start": 257,
            "end": 283
          }
        }
      },
      "span": {
        "start": 257,
        "end": 284
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Heredoc": {
              "label": "ABC",
              "parts": [
                {
                  "Literal": "foo\nbar"
                },
                {
                  "Expr": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 305,
                      "end": 307
                    }
                  }
                },
                {
                  "Literal": "baz"
                }
              ]
            }
          },
          "span": {
            "start": 285,
            "end": 319
          }
        }
      },
      "span": {
        "start": 285,
        "end": 320
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": []
          },
          "span": {
            "start": 322,
            "end": 329
          }
        }
      },
      "span": {
        "start": 322,
        "end": 330
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Array": []
          },
          "span": {
            "start": 331,
            "end": 333
          }
        }
      },
      "span": {
        "start": 331,
        "end": 334
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 340,
                          "end": 342
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 340,
                        "end": 342
                      }
                    }
                  ]
                },
                "span": {
                  "start": 335,
                  "end": 343
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 346,
                  "end": 348
                }
              }
            }
          },
          "span": {
            "start": 335,
            "end": 348
          }
        }
      },
      "span": {
        "start": 335,
        "end": 349
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 351,
                          "end": 353
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 351,
                        "end": 353
                      }
                    }
                  ]
                },
                "span": {
                  "start": 350,
                  "end": 354
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 357,
                  "end": 359
                }
              }
            }
          },
          "span": {
            "start": 350,
            "end": 359
          }
        }
      },
      "span": {
        "start": 350,
        "end": 360
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Variable": "int"
                },
                "span": {
                  "start": 367,
                  "end": 371
                }
              }
            ]
          },
          "span": {
            "start": 361,
            "end": 371
          }
        }
      },
      "span": {
        "start": 361,
        "end": 372
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Int",
              {
                "kind": {
                  "Variable": "integer"
                },
                "span": {
                  "start": 383,
                  "end": 391
                }
              }
            ]
          },
          "span": {
            "start": 373,
            "end": 391
          }
        }
      },
      "span": {
        "start": 373,
        "end": 392
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Bool",
              {
                "kind": {
                  "Variable": "bool"
                },
                "span": {
                  "start": 400,
                  "end": 405
                }
              }
            ]
          },
          "span": {
            "start": 393,
            "end": 405
          }
        }
      },
      "span": {
        "start": 393,
        "end": 406
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Bool",
              {
                "kind": {
                  "Variable": "boolean"
                },
                "span": {
                  "start": 417,
                  "end": 425
                }
              }
            ]
          },
          "span": {
            "start": 407,
            "end": 425
          }
        }
      },
      "span": {
        "start": 407,
        "end": 426
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "String",
              {
                "kind": {
                  "Variable": "string"
                },
                "span": {
                  "start": 436,
                  "end": 443
                }
              }
            ]
          },
          "span": {
            "start": 427,
            "end": 443
          }
        }
      },
      "span": {
        "start": 427,
        "end": 444
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "String",
              {
                "kind": {
                  "Variable": "binary"
                },
                "span": {
                  "start": 454,
                  "end": 461
                }
              }
            ]
          },
          "span": {
            "start": 445,
            "end": 461
          }
        }
      },
      "span": {
        "start": 445,
        "end": 462
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 462
  }
}
