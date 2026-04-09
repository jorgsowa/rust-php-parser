===source===
<?php
// Simple variable interpolation
$greeting = "Hello $name";

// Variable with property access
$msg = "Name: $obj->name";

// Variable with array access (integer index)
$item = "Item: $arr[0]";

// Variable with array access (bare key)
$val = "Value: $arr[key]";

// Complex expression with curly braces
$full = "Full: {$user->getName()}";

// Mixed literal and variable
$mixed = "Start $x middle $y end";

// Escaped dollar (no interpolation)
$escaped = "Price: \$100";

// Curly brace with array key
$nested = "Key: {$arr['key']}";

// Variable at the start
$start = "$name is great";

// Variable at the end
$end = "Hello $name";

// No interpolation in double-quoted string
$plain = "just a plain string";

// Escape sequences
$escapes = "line1\nline2\ttab";
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "greeting"
                },
                "span": {
                  "start": 39,
                  "end": 48,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "Hello "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 58,
                          "end": 63,
                          "start_line": 3,
                          "start_col": 19
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 51,
                  "end": 64,
                  "start_line": 3,
                  "start_col": 12
                }
              }
            }
          },
          "span": {
            "start": 39,
            "end": 64,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 39,
        "end": 100,
        "start_line": 3,
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
                  "Variable": "msg"
                },
                "span": {
                  "start": 100,
                  "end": 104,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "Name: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "PropertyAccess": {
                            "object": {
                              "kind": {
                                "Variable": "obj"
                              },
                              "span": {
                                "start": 114,
                                "end": 118,
                                "start_line": 6,
                                "start_col": 14
                              }
                            },
                            "property": {
                              "kind": {
                                "Identifier": "name"
                              },
                              "span": {
                                "start": 120,
                                "end": 124,
                                "start_line": 6,
                                "start_col": 20
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 114,
                          "end": 124,
                          "start_line": 6,
                          "start_col": 14
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 107,
                  "end": 125,
                  "start_line": 6,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 100,
            "end": 125,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 100,
        "end": 174,
        "start_line": 6,
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
                  "Variable": "item"
                },
                "span": {
                  "start": 174,
                  "end": 179,
                  "start_line": 9,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "Item: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 189,
                                "end": 193,
                                "start_line": 9,
                                "start_col": 15
                              }
                            },
                            "index": {
                              "kind": {
                                "Int": 0
                              },
                              "span": {
                                "start": 194,
                                "end": 195,
                                "start_line": 9,
                                "start_col": 20
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 189,
                          "end": 196,
                          "start_line": 9,
                          "start_col": 15
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 182,
                  "end": 197,
                  "start_line": 9,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 174,
            "end": 197,
            "start_line": 9,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 174,
        "end": 241,
        "start_line": 9,
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
                  "Variable": "val"
                },
                "span": {
                  "start": 241,
                  "end": 245,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "Value: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 256,
                                "end": 260,
                                "start_line": 12,
                                "start_col": 15
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "key"
                              },
                              "span": {
                                "start": 261,
                                "end": 264,
                                "start_line": 12,
                                "start_col": 20
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 256,
                          "end": 265,
                          "start_line": 12,
                          "start_col": 15
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 248,
                  "end": 266,
                  "start_line": 12,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 241,
            "end": 266,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 241,
        "end": 309,
        "start_line": 12,
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
                  "Variable": "full"
                },
                "span": {
                  "start": 309,
                  "end": 314,
                  "start_line": 15,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "Full: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "user"
                              },
                              "span": {
                                "start": 325,
                                "end": 330,
                                "start_line": 15,
                                "start_col": 16
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getName"
                              },
                              "span": {
                                "start": 332,
                                "end": 339,
                                "start_line": 15,
                                "start_col": 23
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 325,
                          "end": 341,
                          "start_line": 15,
                          "start_col": 16
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 317,
                  "end": 343,
                  "start_line": 15,
                  "start_col": 8
                }
              }
            }
          },
          "span": {
            "start": 309,
            "end": 343,
            "start_line": 15,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 309,
        "end": 376,
        "start_line": 15,
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
                  "Variable": "mixed"
                },
                "span": {
                  "start": 376,
                  "end": 382,
                  "start_line": 18,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "Start "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "x"
                        },
                        "span": {
                          "start": 392,
                          "end": 394,
                          "start_line": 18,
                          "start_col": 16
                        }
                      }
                    },
                    {
                      "Literal": " middle "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "y"
                        },
                        "span": {
                          "start": 402,
                          "end": 404,
                          "start_line": 18,
                          "start_col": 26
                        }
                      }
                    },
                    {
                      "Literal": " end"
                    }
                  ]
                },
                "span": {
                  "start": 385,
                  "end": 409,
                  "start_line": 18,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 376,
            "end": 409,
            "start_line": 18,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 376,
        "end": 449,
        "start_line": 18,
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
                  "Variable": "escaped"
                },
                "span": {
                  "start": 449,
                  "end": 457,
                  "start_line": 21,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "Price: $100"
                },
                "span": {
                  "start": 460,
                  "end": 474,
                  "start_line": 21,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 449,
            "end": 474,
            "start_line": 21,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 449,
        "end": 507,
        "start_line": 21,
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
                  "Variable": "nested"
                },
                "span": {
                  "start": 507,
                  "end": 514,
                  "start_line": 24,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "Key: "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "ArrayAccess": {
                            "array": {
                              "kind": {
                                "Variable": "arr"
                              },
                              "span": {
                                "start": 524,
                                "end": 528,
                                "start_line": 24,
                                "start_col": 17
                              }
                            },
                            "index": {
                              "kind": {
                                "String": "key"
                              },
                              "span": {
                                "start": 529,
                                "end": 534,
                                "start_line": 24,
                                "start_col": 22
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 524,
                          "end": 535,
                          "start_line": 24,
                          "start_col": 17
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 517,
                  "end": 537,
                  "start_line": 24,
                  "start_col": 10
                }
              }
            }
          },
          "span": {
            "start": 507,
            "end": 537,
            "start_line": 24,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 507,
        "end": 565,
        "start_line": 24,
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
                  "Variable": "start"
                },
                "span": {
                  "start": 565,
                  "end": 571,
                  "start_line": 27,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 575,
                          "end": 580,
                          "start_line": 27,
                          "start_col": 10
                        }
                      }
                    },
                    {
                      "Literal": " is great"
                    }
                  ]
                },
                "span": {
                  "start": 574,
                  "end": 590,
                  "start_line": 27,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 565,
            "end": 590,
            "start_line": 27,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 565,
        "end": 616,
        "start_line": 27,
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
                  "Variable": "end"
                },
                "span": {
                  "start": 616,
                  "end": 620,
                  "start_line": 30,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "Hello "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "name"
                        },
                        "span": {
                          "start": 630,
                          "end": 635,
                          "start_line": 30,
                          "start_col": 14
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 623,
                  "end": 636,
                  "start_line": 30,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 616,
            "end": 636,
            "start_line": 30,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 616,
        "end": 683,
        "start_line": 30,
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
                  "Variable": "plain"
                },
                "span": {
                  "start": 683,
                  "end": 689,
                  "start_line": 33,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "just a plain string"
                },
                "span": {
                  "start": 692,
                  "end": 713,
                  "start_line": 33,
                  "start_col": 9
                }
              }
            }
          },
          "span": {
            "start": 683,
            "end": 713,
            "start_line": 33,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 683,
        "end": 736,
        "start_line": 33,
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
                  "Variable": "escapes"
                },
                "span": {
                  "start": 736,
                  "end": 744,
                  "start_line": 36,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "String": "line1\nline2\ttab"
                },
                "span": {
                  "start": 747,
                  "end": 766,
                  "start_line": 36,
                  "start_col": 11
                }
              }
            }
          },
          "span": {
            "start": 736,
            "end": 766,
            "start_line": 36,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 736,
        "end": 767,
        "start_line": 36,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 767,
    "start_line": 1,
    "start_col": 0
  }
}
