===source===
<?php
$x = "{$a[/*}*/0]}";
$x = "{$a[0 /* } */]}";
$x = "{$a[0 // }
]}";
$x = "{$a[0 # }
]}";
$x = "{$a["x{$b["c}"]}"]}";
$x = "{$a["x${b}"]}";
$x = "{$a[`}`]}";
$x = `{$a[`}`]}`;
$x = `{$a["`"]}`;
$x = "${a[0] /* c */}";
$x = "${a[0] // c
}";
$x = "{$a[<<<EOT
}
EOT]}";
$x = "{$a[<<<'EOT'
}
EOT]}";
$x = <<<X
{$a[/*}*/0]}
X;
$x = <<<X
  {$a["}"]} {$b[/* } */0]}
  X;
$x = "{$a[f(function() { return '}'; })]}";
$x = "{$a[f(#[A] fn() => 1)]}";
$x = "{$a[<<<EOT
{$b["}"]}
EOT]}";
$x = "{$a[0 /* " */]}";
$x = "{$a["{$b}" . '"']}";
===errors <=7.4===
expected expression, found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting ')' in Standard input code on line 32
===ast <=7.4===
{
  "stmts": [
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
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 13,
                                "end": 15
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 21,
                                "end": 22
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 23
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
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
                  "start": 27,
                  "end": 29
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 34,
                                "end": 36
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 37,
                                "end": 38
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 47
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 32,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 49
          }
        }
      },
      "span": {
        "start": 27,
        "end": 50
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
                  "start": 51,
                  "end": 53
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 58,
                                "end": 60
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 61,
                                "end": 62
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 58,
                          "end": 69
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 56,
                  "end": 71
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 71
          }
        }
      },
      "span": {
        "start": 51,
        "end": 72
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
                  "start": 73,
                  "end": 75
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 80,
                                "end": 82
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 83,
                                "end": 84
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 80,
                          "end": 90
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 78,
                  "end": 92
                }
              }
            }
          },
          "span": {
            "start": 73,
            "end": 92
          }
        }
      },
      "span": {
        "start": 73,
        "end": 93
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
                  "start": 94,
                  "end": 96
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 101,
                                "end": 103
                              }
                            },
                            "index": {
                              "kind": {
                                "InterpolatedString": [
                                  {
                                    "Literal": "x"
                                  },
                                  {
                                    "Expr": {
                                      "kind": {
                                        "ArrayAccess": {
                                          "array": {
                                            "kind": {
                                              "Variable": "b"
                                            },
                                            "span": {
                                              "start": 107,
                                              "end": 109
                                            }
                                          },
                                          "index": {
                                            "kind": {
                                              "String": "c}"
                                            },
                                            "span": {
                                              "start": 110,
                                              "end": 114
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 107,
                                        "end": 115
                                      }
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 104,
                                "end": 117
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 101,
                          "end": 118
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 99,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 94,
            "end": 120
          }
        }
      },
      "span": {
        "start": 94,
        "end": 121
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
                  "start": 122,
                  "end": 124
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 129,
                                "end": 131
                              }
                            },
                            "index": {
                              "kind": {
                                "InterpolatedString": [
                                  {
                                    "Literal": "x"
                                  },
                                  {
                                    "Expr": {
                                      "kind": {
                                        "Variable": "b"
                                      },
                                      "span": {
                                        "start": 136,
                                        "end": 137
                                      }
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 132,
                                "end": 139
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 129,
                          "end": 140
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 127,
                  "end": 142
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 142
          }
        }
      },
      "span": {
        "start": 122,
        "end": 143
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
                  "start": 144,
                  "end": 146
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 151,
                                "end": 153
                              }
                            },
                            "index": {
                              "kind": {
                                "ShellExec": [
                                  {
                                    "Literal": "}"
                                  }
                                ]
                              },
                              "span": {
                                "start": 154,
                                "end": 157
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 151,
                          "end": 158
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 149,
                  "end": 160
                }
              }
            }
          },
          "span": {
            "start": 144,
            "end": 160
          }
        }
      },
      "span": {
        "start": 144,
        "end": 161
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
                  "start": 162,
                  "end": 164
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 169,
                                "end": 171
                              }
                            },
                            "index": {
                              "kind": {
                                "ShellExec": [
                                  {
                                    "Literal": "}"
                                  }
                                ]
                              },
                              "span": {
                                "start": 172,
                                "end": 175
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 169,
                          "end": 176
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 167,
                  "end": 178
                }
              }
            }
          },
          "span": {
            "start": 162,
            "end": 178
          }
        }
      },
      "span": {
        "start": 162,
        "end": 179
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
                  "start": 180,
                  "end": 182
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 187,
                                "end": 189
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "`"
                              },
                              "span": {
                                "start": 190,
                                "end": 193
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 187,
                          "end": 194
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 185,
                  "end": 196
                }
              }
            }
          },
          "span": {
            "start": 180,
            "end": 196
          }
        }
      },
      "span": {
        "start": 180,
        "end": 197
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
                  "start": 198,
                  "end": 200
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 206,
                                "end": 207
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 208,
                                "end": 209
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 204,
                          "end": 219
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 203,
                  "end": 220
                }
              }
            }
          },
          "span": {
            "start": 198,
            "end": 220
          }
        }
      },
      "span": {
        "start": 198,
        "end": 221
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
                  "start": 222,
                  "end": 224
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 230,
                                "end": 231
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 232,
                                "end": 233
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 228,
                          "end": 241
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 227,
                  "end": 242
                }
              }
            }
          },
          "span": {
            "start": 222,
            "end": 242
          }
        }
      },
      "span": {
        "start": 222,
        "end": 243
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
                  "start": 244,
                  "end": 246
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 251,
                                "end": 253
                              }
                            },
                            "index": {
                              "kind": {
                                "Heredoc": {
                                  "label": "EOT",
                                  "parts": [
                                    {
                                      "Literal": "}"
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 254,
                                "end": 266
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 251,
                          "end": 267
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 249,
                  "end": 269
                }
              }
            }
          },
          "span": {
            "start": 244,
            "end": 269
          }
        }
      },
      "span": {
        "start": 244,
        "end": 270
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
                  "start": 271,
                  "end": 273
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 278,
                                "end": 280
                              }
                            },
                            "index": {
                              "kind": {
                                "Nowdoc": {
                                  "label": "EOT",
                                  "value": "}"
                                }
                              },
                              "span": {
                                "start": 281,
                                "end": 295
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 278,
                          "end": 296
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 276,
                  "end": 298
                }
              }
            }
          },
          "span": {
            "start": 271,
            "end": 298
          }
        }
      },
      "span": {
        "start": 271,
        "end": 299
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
                  "start": 300,
                  "end": 302
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "X",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 311,
                                  "end": 313
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 319,
                                  "end": 320
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 311,
                            "end": 321
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 305,
                  "end": 324
                }
              }
            }
          },
          "span": {
            "start": 300,
            "end": 324
          }
        }
      },
      "span": {
        "start": 300,
        "end": 325
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
                  "start": 326,
                  "end": 328
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "X",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 339,
                                  "end": 341
                                }
                              },
                              "index": {
                                "kind": {
                                  "String": "}"
                                },
                                "span": {
                                  "start": 342,
                                  "end": 345
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 339,
                            "end": 346
                          }
                        }
                      },
                      {
                        "Literal": " "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 349,
                                  "end": 351
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 359,
                                  "end": 360
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 349,
                            "end": 361
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 331,
                  "end": 366
                }
              }
            }
          },
          "span": {
            "start": 326,
            "end": 366
          }
        }
      },
      "span": {
        "start": 326,
        "end": 367
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
                  "start": 368,
                  "end": 370
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 375,
                                "end": 377
                              }
                            },
                            "index": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "f"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 378,
                                          "end": 379
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 378,
                                      "end": 379
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Closure": {
                                              "is_static": false,
                                              "by_ref": false,
                                              "params": [],
                                              "use_vars": [],
                                              "return_type": null,
                                              "body": [
                                                {
                                                  "kind": {
                                                    "Return": {
                                                      "kind": {
                                                        "String": "}"
                                                      },
                                                      "span": {
                                                        "start": 400,
                                                        "end": 403
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 393,
                                                    "end": 404
                                                  }
                                                }
                                              ],
                                              "attributes": []
                                            }
                                          },
                                          "span": {
                                            "start": 380,
                                            "end": 406
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 380,
                                        "end": 406
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 378,
                                "end": 407
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 375,
                          "end": 408
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 373,
                  "end": 410
                }
              }
            }
          },
          "span": {
            "start": 368,
            "end": 410
          }
        }
      },
      "span": {
        "start": 368,
        "end": 411
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
                  "start": 412,
                  "end": 414
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 419,
                                "end": 421
                              }
                            },
                            "index": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "f"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 422,
                                          "end": 423
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 422,
                                      "end": 423
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": "Error",
                                          "span": {
                                            "start": 424,
                                            "end": 424
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 424,
                                        "end": 424
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 422,
                                "end": 424
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 419,
                          "end": 424
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 417,
                  "end": 442
                }
              }
            }
          },
          "span": {
            "start": 412,
            "end": 442
          }
        }
      },
      "span": {
        "start": 412,
        "end": 443
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
                  "start": 444,
                  "end": 446
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 451,
                                "end": 453
                              }
                            },
                            "index": {
                              "kind": {
                                "Heredoc": {
                                  "label": "EOT",
                                  "parts": [
                                    {
                                      "Expr": {
                                        "kind": {
                                          "ArrayAccess": {
                                            "array": {
                                              "kind": {
                                                "Variable": "b"
                                              },
                                              "span": {
                                                "start": 462,
                                                "end": 464
                                              }
                                            },
                                            "index": {
                                              "kind": {
                                                "String": "}"
                                              },
                                              "span": {
                                                "start": 465,
                                                "end": 468
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 462,
                                          "end": 469
                                        }
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 454,
                                "end": 474
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 451,
                          "end": 475
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 449,
                  "end": 477
                }
              }
            }
          },
          "span": {
            "start": 444,
            "end": 477
          }
        }
      },
      "span": {
        "start": 444,
        "end": 478
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
                  "start": 479,
                  "end": 481
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 486,
                                "end": 488
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 489,
                                "end": 490
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 486,
                          "end": 499
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 484,
                  "end": 501
                }
              }
            }
          },
          "span": {
            "start": 479,
            "end": 501
          }
        }
      },
      "span": {
        "start": 479,
        "end": 502
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
                  "start": 503,
                  "end": 505
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 510,
                                "end": 512
                              }
                            },
                            "index": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "InterpolatedString": [
                                        {
                                          "Expr": {
                                            "kind": {
                                              "Variable": "b"
                                            },
                                            "span": {
                                              "start": 515,
                                              "end": 517
                                            }
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 513,
                                      "end": 519
                                    }
                                  },
                                  "op": "Concat",
                                  "right": {
                                    "kind": {
                                      "String": "\""
                                    },
                                    "span": {
                                      "start": 522,
                                      "end": 525
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 513,
                                "end": 525
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 510,
                          "end": 526
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 508,
                  "end": 528
                }
              }
            }
          },
          "span": {
            "start": 503,
            "end": 528
          }
        }
      },
      "span": {
        "start": 503,
        "end": 529
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 529
  }
}
===ast >=8.0===
{
  "stmts": [
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
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 13,
                                "end": 15
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 21,
                                "end": 22
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 13,
                          "end": 23
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 25
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 25
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
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
                  "start": 27,
                  "end": 29
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 34,
                                "end": 36
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 37,
                                "end": 38
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 34,
                          "end": 47
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 32,
                  "end": 49
                }
              }
            }
          },
          "span": {
            "start": 27,
            "end": 49
          }
        }
      },
      "span": {
        "start": 27,
        "end": 50
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
                  "start": 51,
                  "end": 53
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 58,
                                "end": 60
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 61,
                                "end": 62
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 58,
                          "end": 69
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 56,
                  "end": 71
                }
              }
            }
          },
          "span": {
            "start": 51,
            "end": 71
          }
        }
      },
      "span": {
        "start": 51,
        "end": 72
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
                  "start": 73,
                  "end": 75
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 80,
                                "end": 82
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 83,
                                "end": 84
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 80,
                          "end": 90
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 78,
                  "end": 92
                }
              }
            }
          },
          "span": {
            "start": 73,
            "end": 92
          }
        }
      },
      "span": {
        "start": 73,
        "end": 93
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
                  "start": 94,
                  "end": 96
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 101,
                                "end": 103
                              }
                            },
                            "index": {
                              "kind": {
                                "InterpolatedString": [
                                  {
                                    "Literal": "x"
                                  },
                                  {
                                    "Expr": {
                                      "kind": {
                                        "ArrayAccess": {
                                          "array": {
                                            "kind": {
                                              "Variable": "b"
                                            },
                                            "span": {
                                              "start": 107,
                                              "end": 109
                                            }
                                          },
                                          "index": {
                                            "kind": {
                                              "String": "c}"
                                            },
                                            "span": {
                                              "start": 110,
                                              "end": 114
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 107,
                                        "end": 115
                                      }
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 104,
                                "end": 117
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 101,
                          "end": 118
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 99,
                  "end": 120
                }
              }
            }
          },
          "span": {
            "start": 94,
            "end": 120
          }
        }
      },
      "span": {
        "start": 94,
        "end": 121
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
                  "start": 122,
                  "end": 124
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 129,
                                "end": 131
                              }
                            },
                            "index": {
                              "kind": {
                                "InterpolatedString": [
                                  {
                                    "Literal": "x"
                                  },
                                  {
                                    "Expr": {
                                      "kind": {
                                        "Variable": "b"
                                      },
                                      "span": {
                                        "start": 136,
                                        "end": 137
                                      }
                                    }
                                  }
                                ]
                              },
                              "span": {
                                "start": 132,
                                "end": 139
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 129,
                          "end": 140
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 127,
                  "end": 142
                }
              }
            }
          },
          "span": {
            "start": 122,
            "end": 142
          }
        }
      },
      "span": {
        "start": 122,
        "end": 143
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
                  "start": 144,
                  "end": 146
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 151,
                                "end": 153
                              }
                            },
                            "index": {
                              "kind": {
                                "ShellExec": [
                                  {
                                    "Literal": "}"
                                  }
                                ]
                              },
                              "span": {
                                "start": 154,
                                "end": 157
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 151,
                          "end": 158
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 149,
                  "end": 160
                }
              }
            }
          },
          "span": {
            "start": 144,
            "end": 160
          }
        }
      },
      "span": {
        "start": 144,
        "end": 161
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
                  "start": 162,
                  "end": 164
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 169,
                                "end": 171
                              }
                            },
                            "index": {
                              "kind": {
                                "ShellExec": [
                                  {
                                    "Literal": "}"
                                  }
                                ]
                              },
                              "span": {
                                "start": 172,
                                "end": 175
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 169,
                          "end": 176
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 167,
                  "end": 178
                }
              }
            }
          },
          "span": {
            "start": 162,
            "end": 178
          }
        }
      },
      "span": {
        "start": 162,
        "end": 179
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
                  "start": 180,
                  "end": 182
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ShellExec": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 187,
                                "end": 189
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "`"
                              },
                              "span": {
                                "start": 190,
                                "end": 193
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 187,
                          "end": 194
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 185,
                  "end": 196
                }
              }
            }
          },
          "span": {
            "start": 180,
            "end": 196
          }
        }
      },
      "span": {
        "start": 180,
        "end": 197
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
                  "start": 198,
                  "end": 200
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 206,
                                "end": 207
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 208,
                                "end": 209
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 204,
                          "end": 219
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 203,
                  "end": 220
                }
              }
            }
          },
          "span": {
            "start": 198,
            "end": 220
          }
        }
      },
      "span": {
        "start": 198,
        "end": 221
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
                  "start": 222,
                  "end": 224
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 230,
                                "end": 231
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 232,
                                "end": 233
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 228,
                          "end": 241
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 227,
                  "end": 242
                }
              }
            }
          },
          "span": {
            "start": 222,
            "end": 242
          }
        }
      },
      "span": {
        "start": 222,
        "end": 243
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
                  "start": 244,
                  "end": 246
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 251,
                                "end": 253
                              }
                            },
                            "index": {
                              "kind": {
                                "Heredoc": {
                                  "label": "EOT",
                                  "parts": [
                                    {
                                      "Literal": "}"
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 254,
                                "end": 266
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 251,
                          "end": 267
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 249,
                  "end": 269
                }
              }
            }
          },
          "span": {
            "start": 244,
            "end": 269
          }
        }
      },
      "span": {
        "start": 244,
        "end": 270
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
                  "start": 271,
                  "end": 273
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 278,
                                "end": 280
                              }
                            },
                            "index": {
                              "kind": {
                                "Nowdoc": {
                                  "label": "EOT",
                                  "value": "}"
                                }
                              },
                              "span": {
                                "start": 281,
                                "end": 295
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 278,
                          "end": 296
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 276,
                  "end": 298
                }
              }
            }
          },
          "span": {
            "start": 271,
            "end": 298
          }
        }
      },
      "span": {
        "start": 271,
        "end": 299
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
                  "start": 300,
                  "end": 302
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "X",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 311,
                                  "end": 313
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 319,
                                  "end": 320
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 311,
                            "end": 321
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 305,
                  "end": 324
                }
              }
            }
          },
          "span": {
            "start": 300,
            "end": 324
          }
        }
      },
      "span": {
        "start": 300,
        "end": 325
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
                  "start": 326,
                  "end": 328
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Heredoc": {
                    "label": "X",
                    "parts": [
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "a"
                                },
                                "span": {
                                  "start": 339,
                                  "end": 341
                                }
                              },
                              "index": {
                                "kind": {
                                  "String": "}"
                                },
                                "span": {
                                  "start": 342,
                                  "end": 345
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 339,
                            "end": 346
                          }
                        }
                      },
                      {
                        "Literal": " "
                      },
                      {
                        "Expr": {
                          "kind": {
                            "ArrayAccess": {
                              "array": {
                                "kind": {
                                  "Variable": "b"
                                },
                                "span": {
                                  "start": 349,
                                  "end": 351
                                }
                              },
                              "index": {
                                "kind": {
                                  "Int": 0
                                },
                                "span": {
                                  "start": 359,
                                  "end": 360
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 349,
                            "end": 361
                          }
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 331,
                  "end": 366
                }
              }
            }
          },
          "span": {
            "start": 326,
            "end": 366
          }
        }
      },
      "span": {
        "start": 326,
        "end": 367
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
                  "start": 368,
                  "end": 370
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 375,
                                "end": 377
                              }
                            },
                            "index": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "f"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 378,
                                          "end": 379
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 378,
                                      "end": 379
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "Closure": {
                                              "is_static": false,
                                              "by_ref": false,
                                              "params": [],
                                              "use_vars": [],
                                              "return_type": null,
                                              "body": [
                                                {
                                                  "kind": {
                                                    "Return": {
                                                      "kind": {
                                                        "String": "}"
                                                      },
                                                      "span": {
                                                        "start": 400,
                                                        "end": 403
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 393,
                                                    "end": 404
                                                  }
                                                }
                                              ],
                                              "attributes": []
                                            }
                                          },
                                          "span": {
                                            "start": 380,
                                            "end": 406
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 380,
                                        "end": 406
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 378,
                                "end": 407
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 375,
                          "end": 408
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 373,
                  "end": 410
                }
              }
            }
          },
          "span": {
            "start": 368,
            "end": 410
          }
        }
      },
      "span": {
        "start": 368,
        "end": 411
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
                  "start": 412,
                  "end": 414
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 419,
                                "end": 421
                              }
                            },
                            "index": {
                              "kind": {
                                "FunctionCall": {
                                  "name": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "f"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 422,
                                          "end": 423
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 422,
                                      "end": 423
                                    }
                                  },
                                  "args": [
                                    {
                                      "name": null,
                                      "kind": {
                                        "Value": {
                                          "kind": {
                                            "ArrowFunction": {
                                              "is_static": false,
                                              "by_ref": false,
                                              "params": [],
                                              "return_type": null,
                                              "body": {
                                                "kind": {
                                                  "Int": 1
                                                },
                                                "span": {
                                                  "start": 437,
                                                  "end": 438
                                                }
                                              },
                                              "attributes": [
                                                {
                                                  "name": {
                                                    "parts": [
                                                      "A"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 426,
                                                      "end": 427
                                                    }
                                                  },
                                                  "args": [],
                                                  "span": {
                                                    "start": 426,
                                                    "end": 427
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 424,
                                            "end": 438
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 424,
                                        "end": 438
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 422,
                                "end": 439
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 419,
                          "end": 440
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 417,
                  "end": 442
                }
              }
            }
          },
          "span": {
            "start": 412,
            "end": 442
          }
        }
      },
      "span": {
        "start": 412,
        "end": 443
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
                  "start": 444,
                  "end": 446
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 451,
                                "end": 453
                              }
                            },
                            "index": {
                              "kind": {
                                "Heredoc": {
                                  "label": "EOT",
                                  "parts": [
                                    {
                                      "Expr": {
                                        "kind": {
                                          "ArrayAccess": {
                                            "array": {
                                              "kind": {
                                                "Variable": "b"
                                              },
                                              "span": {
                                                "start": 462,
                                                "end": 464
                                              }
                                            },
                                            "index": {
                                              "kind": {
                                                "String": "}"
                                              },
                                              "span": {
                                                "start": 465,
                                                "end": 468
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 462,
                                          "end": 469
                                        }
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 454,
                                "end": 474
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 451,
                          "end": 475
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 449,
                  "end": 477
                }
              }
            }
          },
          "span": {
            "start": 444,
            "end": 477
          }
        }
      },
      "span": {
        "start": 444,
        "end": 478
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
                  "start": 479,
                  "end": 481
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 486,
                                "end": 488
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 489,
                                "end": 490
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 486,
                          "end": 499
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 484,
                  "end": 501
                }
              }
            }
          },
          "span": {
            "start": 479,
            "end": 501
          }
        }
      },
      "span": {
        "start": 479,
        "end": 502
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
                  "start": 503,
                  "end": 505
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "a"
                              },
                              "span": {
                                "start": 510,
                                "end": 512
                              }
                            },
                            "index": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "InterpolatedString": [
                                        {
                                          "Expr": {
                                            "kind": {
                                              "Variable": "b"
                                            },
                                            "span": {
                                              "start": 515,
                                              "end": 517
                                            }
                                          }
                                        }
                                      ]
                                    },
                                    "span": {
                                      "start": 513,
                                      "end": 519
                                    }
                                  },
                                  "op": "Concat",
                                  "right": {
                                    "kind": {
                                      "String": "\""
                                    },
                                    "span": {
                                      "start": 522,
                                      "end": 525
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 513,
                                "end": 525
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 510,
                          "end": 526
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 508,
                  "end": 528
                }
              }
            }
          },
          "span": {
            "start": 503,
            "end": 528
          }
        }
      },
      "span": {
        "start": 503,
        "end": 529
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 529
  }
}
