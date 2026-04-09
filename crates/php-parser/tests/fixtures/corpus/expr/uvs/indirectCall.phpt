===source===
<?php

id('var_dump')(1);
id('id')('var_dump')(2);
id()()('var_dump')(4);
id(['udef', 'id'])[1]()('var_dump')(5);
(function($x) { return $x; })('id')('var_dump')(8);
($f = function($x = null) use (&$f) {
    return $x ?: $f;
})()()()('var_dump')(9);
[$obj, 'id']()('id')($id)('var_dump')(10);
'id'()('id')('var_dump')(12);
('i' . 'd')()('var_dump')(13);
'\id'('var_dump')(14);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "id"
                      },
                      "span": {
                        "start": 7,
                        "end": 9,
                        "start_line": 3,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 10,
                            "end": 20,
                            "start_line": 3,
                            "start_col": 3
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 10,
                          "end": 20,
                          "start_line": 3,
                          "start_col": 3
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 7,
                  "end": 21,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 22,
                      "end": 23,
                      "start_line": 3,
                      "start_col": 15
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 22,
                    "end": 23,
                    "start_line": 3,
                    "start_col": 15
                  }
                }
              ]
            }
          },
          "span": {
            "start": 7,
            "end": 24,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 7,
        "end": 26,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Identifier": "id"
                            },
                            "span": {
                              "start": 26,
                              "end": 28,
                              "start_line": 4,
                              "start_col": 0
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "value": {
                                "kind": {
                                  "String": "id"
                                },
                                "span": {
                                  "start": 29,
                                  "end": 33,
                                  "start_line": 4,
                                  "start_col": 3
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 29,
                                "end": 33,
                                "start_line": 4,
                                "start_col": 3
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 26,
                        "end": 34,
                        "start_line": 4,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 35,
                            "end": 45,
                            "start_line": 4,
                            "start_col": 9
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 35,
                          "end": 45,
                          "start_line": 4,
                          "start_col": 9
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 26,
                  "end": 46,
                  "start_line": 4,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 47,
                      "end": 48,
                      "start_line": 4,
                      "start_col": 21
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 47,
                    "end": 48,
                    "start_line": 4,
                    "start_col": 21
                  }
                }
              ]
            }
          },
          "span": {
            "start": 26,
            "end": 49,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 26,
        "end": 51,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "Identifier": "id"
                                  },
                                  "span": {
                                    "start": 51,
                                    "end": 53,
                                    "start_line": 5,
                                    "start_col": 0
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 51,
                              "end": 55,
                              "start_line": 5,
                              "start_col": 0
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 51,
                        "end": 57,
                        "start_line": 5,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 58,
                            "end": 68,
                            "start_line": 5,
                            "start_col": 7
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 58,
                          "end": 68,
                          "start_line": 5,
                          "start_col": 7
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 51,
                  "end": 69,
                  "start_line": 5,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 4
                    },
                    "span": {
                      "start": 70,
                      "end": 71,
                      "start_line": 5,
                      "start_col": 19
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 70,
                    "end": 71,
                    "start_line": 5,
                    "start_col": 19
                  }
                }
              ]
            }
          },
          "span": {
            "start": 51,
            "end": 72,
            "start_line": 5,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 51,
        "end": 74,
        "start_line": 5,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "ArrayAccess": {
                                "array": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Identifier": "id"
                                        },
                                        "span": {
                                          "start": 74,
                                          "end": 76,
                                          "start_line": 6,
                                          "start_col": 0
                                        }
                                      },
                                      "args": [
                                        {
                                          "name": null,
                                          "value": {
                                            "kind": {
                                              "Array": [
                                                {
                                                  "key": null,
                                                  "value": {
                                                    "kind": {
                                                      "String": "udef"
                                                    },
                                                    "span": {
                                                      "start": 78,
                                                      "end": 84,
                                                      "start_line": 6,
                                                      "start_col": 4
                                                    }
                                                  },
                                                  "unpack": false,
                                                  "span": {
                                                    "start": 78,
                                                    "end": 84,
                                                    "start_line": 6,
                                                    "start_col": 4
                                                  }
                                                },
                                                {
                                                  "key": null,
                                                  "value": {
                                                    "kind": {
                                                      "String": "id"
                                                    },
                                                    "span": {
                                                      "start": 86,
                                                      "end": 90,
                                                      "start_line": 6,
                                                      "start_col": 12
                                                    }
                                                  },
                                                  "unpack": false,
                                                  "span": {
                                                    "start": 86,
                                                    "end": 90,
                                                    "start_line": 6,
                                                    "start_col": 12
                                                  }
                                                }
                                              ]
                                            },
                                            "span": {
                                              "start": 77,
                                              "end": 91,
                                              "start_line": 6,
                                              "start_col": 3
                                            }
                                          },
                                          "unpack": false,
                                          "by_ref": false,
                                          "span": {
                                            "start": 77,
                                            "end": 91,
                                            "start_line": 6,
                                            "start_col": 3
                                          }
                                        }
                                      ]
                                    }
                                  },
                                  "span": {
                                    "start": 74,
                                    "end": 92,
                                    "start_line": 6,
                                    "start_col": 0
                                  }
                                },
                                "index": {
                                  "kind": {
                                    "Int": 1
                                  },
                                  "span": {
                                    "start": 93,
                                    "end": 94,
                                    "start_line": 6,
                                    "start_col": 19
                                  }
                                }
                              }
                            },
                            "span": {
                              "start": 74,
                              "end": 95,
                              "start_line": 6,
                              "start_col": 0
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 74,
                        "end": 97,
                        "start_line": 6,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 98,
                            "end": 108,
                            "start_line": 6,
                            "start_col": 24
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 98,
                          "end": 108,
                          "start_line": 6,
                          "start_col": 24
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 74,
                  "end": 109,
                  "start_line": 6,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 5
                    },
                    "span": {
                      "start": 110,
                      "end": 111,
                      "start_line": 6,
                      "start_col": 36
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 110,
                    "end": 111,
                    "start_line": 6,
                    "start_col": 36
                  }
                }
              ]
            }
          },
          "span": {
            "start": 74,
            "end": 112,
            "start_line": 6,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 74,
        "end": 114,
        "start_line": 6,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Closure": {
                                    "is_static": false,
                                    "by_ref": false,
                                    "params": [
                                      {
                                        "name": "x",
                                        "type_hint": null,
                                        "default": null,
                                        "by_ref": false,
                                        "variadic": false,
                                        "is_readonly": false,
                                        "is_final": false,
                                        "visibility": null,
                                        "set_visibility": null,
                                        "attributes": [],
                                        "span": {
                                          "start": 124,
                                          "end": 126,
                                          "start_line": 7,
                                          "start_col": 10
                                        }
                                      }
                                    ],
                                    "use_vars": [],
                                    "return_type": null,
                                    "body": [
                                      {
                                        "kind": {
                                          "Return": {
                                            "kind": {
                                              "Variable": "x"
                                            },
                                            "span": {
                                              "start": 137,
                                              "end": 139,
                                              "start_line": 7,
                                              "start_col": 23
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 130,
                                          "end": 141,
                                          "start_line": 7,
                                          "start_col": 16
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 115,
                                  "end": 142,
                                  "start_line": 7,
                                  "start_col": 1
                                }
                              }
                            },
                            "span": {
                              "start": 114,
                              "end": 143,
                              "start_line": 7,
                              "start_col": 0
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "value": {
                                "kind": {
                                  "String": "id"
                                },
                                "span": {
                                  "start": 144,
                                  "end": 148,
                                  "start_line": 7,
                                  "start_col": 30
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 144,
                                "end": 148,
                                "start_line": 7,
                                "start_col": 30
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 114,
                        "end": 149,
                        "start_line": 7,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 150,
                            "end": 160,
                            "start_line": 7,
                            "start_col": 36
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 150,
                          "end": 160,
                          "start_line": 7,
                          "start_col": 36
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 114,
                  "end": 161,
                  "start_line": 7,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 8
                    },
                    "span": {
                      "start": 162,
                      "end": 163,
                      "start_line": 7,
                      "start_col": 48
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 162,
                    "end": 163,
                    "start_line": 7,
                    "start_col": 48
                  }
                }
              ]
            }
          },
          "span": {
            "start": 114,
            "end": 164,
            "start_line": 7,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 114,
        "end": 166,
        "start_line": 7,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Parenthesized": {
                                            "kind": {
                                              "Assign": {
                                                "target": {
                                                  "kind": {
                                                    "Variable": "f"
                                                  },
                                                  "span": {
                                                    "start": 167,
                                                    "end": 169,
                                                    "start_line": 8,
                                                    "start_col": 1
                                                  }
                                                },
                                                "op": "Assign",
                                                "value": {
                                                  "kind": {
                                                    "Closure": {
                                                      "is_static": false,
                                                      "by_ref": false,
                                                      "params": [
                                                        {
                                                          "name": "x",
                                                          "type_hint": null,
                                                          "default": {
                                                            "kind": "Null",
                                                            "span": {
                                                              "start": 186,
                                                              "end": 190,
                                                              "start_line": 8,
                                                              "start_col": 20
                                                            }
                                                          },
                                                          "by_ref": false,
                                                          "variadic": false,
                                                          "is_readonly": false,
                                                          "is_final": false,
                                                          "visibility": null,
                                                          "set_visibility": null,
                                                          "attributes": [],
                                                          "span": {
                                                            "start": 181,
                                                            "end": 190,
                                                            "start_line": 8,
                                                            "start_col": 15
                                                          }
                                                        }
                                                      ],
                                                      "use_vars": [
                                                        {
                                                          "name": "f",
                                                          "by_ref": true,
                                                          "span": {
                                                            "start": 197,
                                                            "end": 200,
                                                            "start_line": 8,
                                                            "start_col": 31
                                                          }
                                                        }
                                                      ],
                                                      "return_type": null,
                                                      "body": [
                                                        {
                                                          "kind": {
                                                            "Return": {
                                                              "kind": {
                                                                "Ternary": {
                                                                  "condition": {
                                                                    "kind": {
                                                                      "Variable": "x"
                                                                    },
                                                                    "span": {
                                                                      "start": 215,
                                                                      "end": 217,
                                                                      "start_line": 9,
                                                                      "start_col": 11
                                                                    }
                                                                  },
                                                                  "then_expr": null,
                                                                  "else_expr": {
                                                                    "kind": {
                                                                      "Variable": "f"
                                                                    },
                                                                    "span": {
                                                                      "start": 221,
                                                                      "end": 223,
                                                                      "start_line": 9,
                                                                      "start_col": 17
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 215,
                                                                "end": 223,
                                                                "start_line": 9,
                                                                "start_col": 11
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 208,
                                                            "end": 225,
                                                            "start_line": 9,
                                                            "start_col": 4
                                                          }
                                                        }
                                                      ],
                                                      "attributes": []
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 172,
                                                    "end": 226,
                                                    "start_line": 8,
                                                    "start_col": 6
                                                  }
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 167,
                                              "end": 226,
                                              "start_line": 8,
                                              "start_col": 1
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 166,
                                          "end": 227,
                                          "start_line": 8,
                                          "start_col": 0
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 166,
                                    "end": 229,
                                    "start_line": 8,
                                    "start_col": 0
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 166,
                              "end": 231,
                              "start_line": 8,
                              "start_col": 0
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 166,
                        "end": 233,
                        "start_line": 8,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 234,
                            "end": 244,
                            "start_line": 10,
                            "start_col": 9
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 234,
                          "end": 244,
                          "start_line": 10,
                          "start_col": 9
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 166,
                  "end": 245,
                  "start_line": 8,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 9
                    },
                    "span": {
                      "start": 246,
                      "end": 247,
                      "start_line": 10,
                      "start_col": 21
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 246,
                    "end": 247,
                    "start_line": 10,
                    "start_col": 21
                  }
                }
              ]
            }
          },
          "span": {
            "start": 166,
            "end": 248,
            "start_line": 8,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 166,
        "end": 250,
        "start_line": 8,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "FunctionCall": {
                                      "name": {
                                        "kind": {
                                          "Array": [
                                            {
                                              "key": null,
                                              "value": {
                                                "kind": {
                                                  "Variable": "obj"
                                                },
                                                "span": {
                                                  "start": 251,
                                                  "end": 255,
                                                  "start_line": 11,
                                                  "start_col": 1
                                                }
                                              },
                                              "unpack": false,
                                              "span": {
                                                "start": 251,
                                                "end": 255,
                                                "start_line": 11,
                                                "start_col": 1
                                              }
                                            },
                                            {
                                              "key": null,
                                              "value": {
                                                "kind": {
                                                  "String": "id"
                                                },
                                                "span": {
                                                  "start": 257,
                                                  "end": 261,
                                                  "start_line": 11,
                                                  "start_col": 7
                                                }
                                              },
                                              "unpack": false,
                                              "span": {
                                                "start": 257,
                                                "end": 261,
                                                "start_line": 11,
                                                "start_col": 7
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 250,
                                          "end": 262,
                                          "start_line": 11,
                                          "start_col": 0
                                        }
                                      },
                                      "args": []
                                    }
                                  },
                                  "span": {
                                    "start": 250,
                                    "end": 264,
                                    "start_line": 11,
                                    "start_col": 0
                                  }
                                },
                                "args": [
                                  {
                                    "name": null,
                                    "value": {
                                      "kind": {
                                        "String": "id"
                                      },
                                      "span": {
                                        "start": 265,
                                        "end": 269,
                                        "start_line": 11,
                                        "start_col": 15
                                      }
                                    },
                                    "unpack": false,
                                    "by_ref": false,
                                    "span": {
                                      "start": 265,
                                      "end": 269,
                                      "start_line": 11,
                                      "start_col": 15
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 250,
                              "end": 270,
                              "start_line": 11,
                              "start_col": 0
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "value": {
                                "kind": {
                                  "Variable": "id"
                                },
                                "span": {
                                  "start": 271,
                                  "end": 274,
                                  "start_line": 11,
                                  "start_col": 21
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 271,
                                "end": 274,
                                "start_line": 11,
                                "start_col": 21
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 250,
                        "end": 275,
                        "start_line": 11,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 276,
                            "end": 286,
                            "start_line": 11,
                            "start_col": 26
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 276,
                          "end": 286,
                          "start_line": 11,
                          "start_col": 26
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 250,
                  "end": 287,
                  "start_line": 11,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 10
                    },
                    "span": {
                      "start": 288,
                      "end": 290,
                      "start_line": 11,
                      "start_col": 38
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 288,
                    "end": 290,
                    "start_line": 11,
                    "start_col": 38
                  }
                }
              ]
            }
          },
          "span": {
            "start": 250,
            "end": 291,
            "start_line": 11,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 250,
        "end": 293,
        "start_line": 11,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "FunctionCall": {
                                "name": {
                                  "kind": {
                                    "String": "id"
                                  },
                                  "span": {
                                    "start": 293,
                                    "end": 297,
                                    "start_line": 12,
                                    "start_col": 0
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 293,
                              "end": 299,
                              "start_line": 12,
                              "start_col": 0
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "value": {
                                "kind": {
                                  "String": "id"
                                },
                                "span": {
                                  "start": 300,
                                  "end": 304,
                                  "start_line": 12,
                                  "start_col": 7
                                }
                              },
                              "unpack": false,
                              "by_ref": false,
                              "span": {
                                "start": 300,
                                "end": 304,
                                "start_line": 12,
                                "start_col": 7
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 293,
                        "end": 305,
                        "start_line": 12,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 306,
                            "end": 316,
                            "start_line": 12,
                            "start_col": 13
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 306,
                          "end": 316,
                          "start_line": 12,
                          "start_col": 13
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 293,
                  "end": 317,
                  "start_line": 12,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 12
                    },
                    "span": {
                      "start": 318,
                      "end": 320,
                      "start_line": 12,
                      "start_col": 25
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 318,
                    "end": 320,
                    "start_line": 12,
                    "start_col": 25
                  }
                }
              ]
            }
          },
          "span": {
            "start": 293,
            "end": 321,
            "start_line": 12,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 293,
        "end": 323,
        "start_line": 12,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "String": "i"
                                      },
                                      "span": {
                                        "start": 324,
                                        "end": 327,
                                        "start_line": 13,
                                        "start_col": 1
                                      }
                                    },
                                    "op": "Concat",
                                    "right": {
                                      "kind": {
                                        "String": "d"
                                      },
                                      "span": {
                                        "start": 330,
                                        "end": 333,
                                        "start_line": 13,
                                        "start_col": 7
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 324,
                                  "end": 333,
                                  "start_line": 13,
                                  "start_col": 1
                                }
                              }
                            },
                            "span": {
                              "start": 323,
                              "end": 334,
                              "start_line": 13,
                              "start_col": 0
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 323,
                        "end": 336,
                        "start_line": 13,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 337,
                            "end": 347,
                            "start_line": 13,
                            "start_col": 14
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 337,
                          "end": 347,
                          "start_line": 13,
                          "start_col": 14
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 323,
                  "end": 348,
                  "start_line": 13,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 13
                    },
                    "span": {
                      "start": 349,
                      "end": 351,
                      "start_line": 13,
                      "start_col": 26
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 349,
                    "end": 351,
                    "start_line": 13,
                    "start_col": 26
                  }
                }
              ]
            }
          },
          "span": {
            "start": 323,
            "end": 352,
            "start_line": 13,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 323,
        "end": 354,
        "start_line": 13,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "String": "\\id"
                      },
                      "span": {
                        "start": 354,
                        "end": 359,
                        "start_line": 14,
                        "start_col": 0
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "String": "var_dump"
                          },
                          "span": {
                            "start": 360,
                            "end": 370,
                            "start_line": 14,
                            "start_col": 6
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 360,
                          "end": 370,
                          "start_line": 14,
                          "start_col": 6
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 354,
                  "end": 371,
                  "start_line": 14,
                  "start_col": 0
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Int": 14
                    },
                    "span": {
                      "start": 372,
                      "end": 374,
                      "start_line": 14,
                      "start_col": 18
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 372,
                    "end": 374,
                    "start_line": 14,
                    "start_col": 18
                  }
                }
              ]
            }
          },
          "span": {
            "start": 354,
            "end": 375,
            "start_line": 14,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 354,
        "end": 376,
        "start_line": 14,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 376,
    "start_line": 1,
    "start_col": 0
  }
}
