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
            "end": 13,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 15,
        "start_line": 3,
        "start_col": 0
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
            "end": 19,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 15,
        "end": 21,
        "start_line": 4,
        "start_col": 0
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
            "end": 23,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 21,
        "end": 25,
        "start_line": 5,
        "start_col": 0
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
            "end": 28,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 25,
        "end": 30,
        "start_line": 6,
        "start_col": 0
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
            "end": 41,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 30,
        "end": 43,
        "start_line": 7,
        "start_col": 0
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
            "end": 56,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 43,
        "end": 59,
        "start_line": 8,
        "start_col": 0
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
            "end": 64,
            "start_line": 10,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 59,
        "end": 66,
        "start_line": 10,
        "start_col": 0
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
            "end": 71,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 66,
        "end": 73,
        "start_line": 11,
        "start_col": 0
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
            "end": 82,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 73,
        "end": 84,
        "start_line": 12,
        "start_col": 0
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
            "end": 94,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 84,
        "end": 96,
        "start_line": 14,
        "start_col": 0
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
                    "end": 108,
                    "start_line": 15,
                    "start_col": 10
                  }
                }
              }
            ]
          },
          "span": {
            "start": 96,
            "end": 110,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 96,
        "end": 112,
        "start_line": 15,
        "start_col": 0
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
            "end": 122,
            "start_line": 16,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 112,
        "end": 124,
        "start_line": 16,
        "start_col": 0
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
                    "end": 136,
                    "start_line": 17,
                    "start_col": 10
                  }
                }
              }
            ]
          },
          "span": {
            "start": 124,
            "end": 138,
            "start_line": 17,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 124,
        "end": 141,
        "start_line": 17,
        "start_col": 0
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
            "end": 153,
            "start_line": 19,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 141,
        "end": 155,
        "start_line": 19,
        "start_col": 0
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
            "end": 175,
            "start_line": 21,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 155,
        "end": 177,
        "start_line": 21,
        "start_col": 0
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
            "end": 205,
            "start_line": 24,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 177,
        "end": 207,
        "start_line": 24,
        "start_col": 0
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
            "end": 226,
            "start_line": 27,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 207,
        "end": 228,
        "start_line": 27,
        "start_col": 0
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
            "end": 255,
            "start_line": 30,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 228,
        "end": 257,
        "start_line": 30,
        "start_col": 0
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
                      "end": 275,
                      "start_line": 34,
                      "start_col": 9
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
            "end": 283,
            "start_line": 33,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 257,
        "end": 285,
        "start_line": 33,
        "start_col": 0
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
                      "end": 307,
                      "start_line": 37,
                      "start_col": 13
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
            "end": 319,
            "start_line": 36,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 285,
        "end": 322,
        "start_line": 36,
        "start_col": 0
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
            "end": 329,
            "start_line": 40,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 322,
        "end": 331,
        "start_line": 40,
        "start_col": 0
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
            "end": 333,
            "start_line": 41,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 331,
        "end": 335,
        "start_line": 41,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 340,
                          "end": 342,
                          "start_line": 42,
                          "start_col": 5
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 340,
                        "end": 342,
                        "start_line": 42,
                        "start_col": 5
                      }
                    }
                  ]
                },
                "span": {
                  "start": 335,
                  "end": 343,
                  "start_line": 42,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 346,
                  "end": 348,
                  "start_line": 42,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 335,
            "end": 348,
            "start_line": 42,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 335,
        "end": 350,
        "start_line": 42,
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 351,
                          "end": 353,
                          "start_line": 43,
                          "start_col": 1
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 351,
                        "end": 353,
                        "start_line": 43,
                        "start_col": 1
                      }
                    }
                  ]
                },
                "span": {
                  "start": 350,
                  "end": 354,
                  "start_line": 43,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "y"
                },
                "span": {
                  "start": 357,
                  "end": 359,
                  "start_line": 43,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 350,
            "end": 359,
            "start_line": 43,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 350,
        "end": 361,
        "start_line": 43,
        "start_col": 0
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
                  "end": 371,
                  "start_line": 44,
                  "start_col": 6
                }
              }
            ]
          },
          "span": {
            "start": 361,
            "end": 371,
            "start_line": 44,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 361,
        "end": 373,
        "start_line": 44,
        "start_col": 0
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
                  "end": 391,
                  "start_line": 45,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 373,
            "end": 391,
            "start_line": 45,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 373,
        "end": 393,
        "start_line": 45,
        "start_col": 0
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
                  "end": 405,
                  "start_line": 46,
                  "start_col": 7
                }
              }
            ]
          },
          "span": {
            "start": 393,
            "end": 405,
            "start_line": 46,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 393,
        "end": 407,
        "start_line": 46,
        "start_col": 0
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
                  "end": 425,
                  "start_line": 47,
                  "start_col": 10
                }
              }
            ]
          },
          "span": {
            "start": 407,
            "end": 425,
            "start_line": 47,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 407,
        "end": 427,
        "start_line": 47,
        "start_col": 0
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
                  "end": 443,
                  "start_line": 48,
                  "start_col": 9
                }
              }
            ]
          },
          "span": {
            "start": 427,
            "end": 443,
            "start_line": 48,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 427,
        "end": 445,
        "start_line": 48,
        "start_col": 0
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
                  "end": 461,
                  "start_line": 49,
                  "start_col": 9
                }
              }
            ]
          },
          "span": {
            "start": 445,
            "end": 461,
            "start_line": 49,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 445,
        "end": 462,
        "start_line": 49,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 462,
    "start_line": 1,
    "start_col": 0
  }
}
