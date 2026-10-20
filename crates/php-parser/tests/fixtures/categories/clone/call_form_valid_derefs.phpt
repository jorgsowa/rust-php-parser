===source===
<?php
clone($a)->b;
clone($a)['k'];
clone($a)();
clone($a)::C;
clone($a)?->b;
clone ($a)->b;
clone($a /* , */)->b;
clone($a // ,
)->b;
(clone($a, []))->b;
(clone($a, ))->b;
(clone(...))->b;
clone($a, []);
clone($a, ) + 1;
clone($a, []) . "x";
clone($a, []) instanceof A;
\clone($a, [])->b;
A\clone($a)->b;
namespace\clone($a)->b;
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected token "," in Standard input code on line 11
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 12,
                          "end": 14
                        }
                      }
                    },
                    "span": {
                      "start": 11,
                      "end": 15
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  }
                }
              },
              "span": {
                "start": 11,
                "end": 18
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "ArrayAccess": {
                  "array": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 26,
                          "end": 28
                        }
                      }
                    },
                    "span": {
                      "start": 25,
                      "end": 29
                    }
                  },
                  "index": {
                    "kind": {
                      "String": "k"
                    },
                    "span": {
                      "start": 30,
                      "end": 33
                    }
                  }
                }
              },
              "span": {
                "start": 25,
                "end": 34
              }
            }
          },
          "span": {
            "start": 20,
            "end": 34
          }
        }
      },
      "span": {
        "start": 20,
        "end": 35
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 42,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 45
                    }
                  },
                  "args": []
                }
              },
              "span": {
                "start": 41,
                "end": 47
              }
            }
          },
          "span": {
            "start": 36,
            "end": 47
          }
        }
      },
      "span": {
        "start": 36,
        "end": 48
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 55,
                          "end": 57
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 58
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "C"
                    },
                    "span": {
                      "start": 60,
                      "end": 61
                    }
                  }
                }
              },
              "span": {
                "start": 54,
                "end": 61
              }
            }
          },
          "span": {
            "start": 49,
            "end": 61
          }
        }
      },
      "span": {
        "start": 49,
        "end": 62
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "NullsafePropertyAccess": {
                  "object": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 69,
                          "end": 71
                        }
                      }
                    },
                    "span": {
                      "start": 68,
                      "end": 72
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 75,
                      "end": 76
                    }
                  }
                }
              },
              "span": {
                "start": 68,
                "end": 76
              }
            }
          },
          "span": {
            "start": 63,
            "end": 76
          }
        }
      },
      "span": {
        "start": 63,
        "end": 77
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 85,
                          "end": 87
                        }
                      }
                    },
                    "span": {
                      "start": 84,
                      "end": 88
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 90,
                      "end": 91
                    }
                  }
                }
              },
              "span": {
                "start": 84,
                "end": 91
              }
            }
          },
          "span": {
            "start": 78,
            "end": 91
          }
        }
      },
      "span": {
        "start": 78,
        "end": 92
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 99,
                          "end": 101
                        }
                      }
                    },
                    "span": {
                      "start": 98,
                      "end": 110
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 112,
                      "end": 113
                    }
                  }
                }
              },
              "span": {
                "start": 98,
                "end": 113
              }
            }
          },
          "span": {
            "start": 93,
            "end": 113
          }
        }
      },
      "span": {
        "start": 93,
        "end": 114
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Clone": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 121,
                          "end": 123
                        }
                      }
                    },
                    "span": {
                      "start": 120,
                      "end": 130
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "b"
                    },
                    "span": {
                      "start": 132,
                      "end": 133
                    }
                  }
                }
              },
              "span": {
                "start": 120,
                "end": 133
              }
            }
          },
          "span": {
            "start": 115,
            "end": 133
          }
        }
      },
      "span": {
        "start": 115,
        "end": 134
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "CloneWith": [
                        {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 142,
                            "end": 144
                          }
                        },
                        {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 146,
                            "end": 148
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 136,
                      "end": 149
                    }
                  }
                },
                "span": {
                  "start": 135,
                  "end": 150
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 152,
                  "end": 153
                }
              }
            }
          },
          "span": {
            "start": 135,
            "end": 153
          }
        }
      },
      "span": {
        "start": 135,
        "end": 154
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Clone": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 162,
                          "end": 164
                        }
                      }
                    },
                    "span": {
                      "start": 156,
                      "end": 167
                    }
                  }
                },
                "span": {
                  "start": 155,
                  "end": 168
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 170,
                  "end": 171
                }
              }
            }
          },
          "span": {
            "start": 155,
            "end": 171
          }
        }
      },
      "span": {
        "start": 155,
        "end": 172
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "Function": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "clone"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 174,
                                  "end": 179
                                }
                              }
                            },
                            "span": {
                              "start": 174,
                              "end": 179
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 174,
                      "end": 184
                    }
                  }
                },
                "span": {
                  "start": 173,
                  "end": 185
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 187,
                  "end": 188
                }
              }
            }
          },
          "span": {
            "start": 173,
            "end": 188
          }
        }
      },
      "span": {
        "start": 173,
        "end": 189
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "CloneWith": [
              {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 196,
                  "end": 198
                }
              },
              {
                "kind": {
                  "Array": []
                },
                "span": {
                  "start": 200,
                  "end": 202
                }
              }
            ]
          },
          "span": {
            "start": 190,
            "end": 203
          }
        }
      },
      "span": {
        "start": 190,
        "end": 204
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Clone": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 211,
                      "end": 213
                    }
                  }
                },
                "span": {
                  "start": 205,
                  "end": 216
                }
              },
              "op": "Add",
              "right": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 219,
                  "end": 220
                }
              }
            }
          },
          "span": {
            "start": 205,
            "end": 220
          }
        }
      },
      "span": {
        "start": 205,
        "end": 221
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "CloneWith": [
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 228,
                        "end": 230
                      }
                    },
                    {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 232,
                        "end": 234
                      }
                    }
                  ]
                },
                "span": {
                  "start": 222,
                  "end": 235
                }
              },
              "op": "Concat",
              "right": {
                "kind": {
                  "String": "x"
                },
                "span": {
                  "start": 238,
                  "end": 241
                }
              }
            }
          },
          "span": {
            "start": 222,
            "end": 241
          }
        }
      },
      "span": {
        "start": 222,
        "end": 242
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "CloneWith": [
                    {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 249,
                        "end": 251
                      }
                    },
                    {
                      "kind": {
                        "Array": []
                      },
                      "span": {
                        "start": 253,
                        "end": 255
                      }
                    }
                  ]
                },
                "span": {
                  "start": 243,
                  "end": 256
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 268,
                      "end": 269
                    }
                  }
                },
                "span": {
                  "start": 268,
                  "end": 269
                }
              }
            }
          },
          "span": {
            "start": 243,
            "end": 269
          }
        }
      },
      "span": {
        "start": 243,
        "end": 270
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "clone"
                          ],
                          "kind": "FullyQualified",
                          "span": {
                            "start": 271,
                            "end": 277
                          }
                        }
                      },
                      "span": {
                        "start": 271,
                        "end": 277
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 278,
                              "end": 280
                            }
                          }
                        },
                        "span": {
                          "start": 278,
                          "end": 280
                        }
                      },
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Array": []
                            },
                            "span": {
                              "start": 282,
                              "end": 284
                            }
                          }
                        },
                        "span": {
                          "start": 282,
                          "end": 284
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 271,
                  "end": 285
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 287,
                  "end": 288
                }
              }
            }
          },
          "span": {
            "start": 271,
            "end": 288
          }
        }
      },
      "span": {
        "start": 271,
        "end": 289
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "A",
                            "clone"
                          ],
                          "kind": "Qualified",
                          "span": {
                            "start": 290,
                            "end": 297
                          }
                        }
                      },
                      "span": {
                        "start": 290,
                        "end": 297
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 298,
                              "end": 300
                            }
                          }
                        },
                        "span": {
                          "start": 298,
                          "end": 300
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 290,
                  "end": 301
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 303,
                  "end": 304
                }
              }
            }
          },
          "span": {
            "start": 290,
            "end": 304
          }
        }
      },
      "span": {
        "start": 290,
        "end": 305
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "PropertyAccess": {
              "object": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "clone"
                          ],
                          "kind": "Relative",
                          "span": {
                            "start": 306,
                            "end": 321
                          }
                        }
                      },
                      "span": {
                        "start": 306,
                        "end": 321
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "kind": {
                          "Value": {
                            "kind": {
                              "Variable": "a"
                            },
                            "span": {
                              "start": 322,
                              "end": 324
                            }
                          }
                        },
                        "span": {
                          "start": 322,
                          "end": 324
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 306,
                  "end": 325
                }
              },
              "property": {
                "kind": {
                  "Identifier": "b"
                },
                "span": {
                  "start": 327,
                  "end": 328
                }
              }
            }
          },
          "span": {
            "start": 306,
            "end": 328
          }
        }
      },
      "span": {
        "start": 306,
        "end": 329
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 329
  }
}
