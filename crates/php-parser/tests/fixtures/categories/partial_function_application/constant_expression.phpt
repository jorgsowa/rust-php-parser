===source===
<?php
const A = f(?);
const B = f(1, ?, ...);
const C = Foo::m(a: ?);
const D = f(?, 1 + 2, Foo::BAR);
class K {
    const E = strlen(?);
    public $p = Foo::m(1, ?);
    function m($x = f(?, ...)) {}
}
#[Attr(f(?))]
function g() {}
===errors <=7.4===
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'named arguments' requires PHP 8.0 or higher
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
===errors 8.0-8.5===
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
'partial function application' requires PHP 8.6 or higher
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
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
                          "start": 16,
                          "end": 17
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 20
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 20
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 28,
                "end": 29
              }
            },
            "value": {
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
                          "start": 32,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 34,
                            "end": 35
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 35
                      }
                    },
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 37,
                        "end": 38
                      }
                    },
                    {
                      "name": null,
                      "kind": "SpreadPlaceholder",
                      "span": {
                        "start": 40,
                        "end": 43
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 32,
                "end": 44
              }
            },
            "attributes": [],
            "span": {
              "start": 28,
              "end": 44
            }
          }
        ]
      },
      "span": {
        "start": 22,
        "end": 45
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 52,
                "end": 53
              }
            },
            "value": {
              "kind": {
                "StaticMethodCall": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 56,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "m"
                    },
                    "span": {
                      "start": 61,
                      "end": 62
                    }
                  },
                  "args": [
                    {
                      "name": {
                        "parts": [
                          "a"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 63,
                          "end": 64
                        }
                      },
                      "kind": "Placeholder",
                      "span": {
                        "start": 63,
                        "end": 67
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 56,
                "end": 68
              }
            },
            "attributes": [],
            "span": {
              "start": 52,
              "end": 68
            }
          }
        ]
      },
      "span": {
        "start": 46,
        "end": 69
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 76,
                "end": 77
              }
            },
            "value": {
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
                          "start": 80,
                          "end": 81
                        }
                      }
                    },
                    "span": {
                      "start": 80,
                      "end": 81
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 82,
                        "end": 83
                      }
                    },
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 85,
                                  "end": 86
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 89,
                                  "end": 90
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 85,
                            "end": 90
                          }
                        }
                      },
                      "span": {
                        "start": 85,
                        "end": 90
                      }
                    },
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "Foo"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 92,
                                      "end": 95
                                    }
                                  }
                                },
                                "span": {
                                  "start": 92,
                                  "end": 95
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "BAR"
                                },
                                "span": {
                                  "start": 97,
                                  "end": 100
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 92,
                            "end": 100
                          }
                        }
                      },
                      "span": {
                        "start": 92,
                        "end": 100
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 80,
                "end": 101
              }
            },
            "attributes": [],
            "span": {
              "start": 76,
              "end": 101
            }
          }
        ]
      },
      "span": {
        "start": 70,
        "end": 102
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
            "span": {
              "start": 109,
              "end": 110
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "E",
                    "span": {
                      "start": 123,
                      "end": 124
                    }
                  },
                  "value": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "strlen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 127,
                                "end": 133
                              }
                            }
                          },
                          "span": {
                            "start": 127,
                            "end": 133
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 134,
                              "end": 135
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 127,
                      "end": 136
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 117,
                "end": 137
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 149,
                      "end": 151
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "StaticMethodCall": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 154,
                                "end": 157
                              }
                            }
                          },
                          "span": {
                            "start": 154,
                            "end": 157
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 159,
                            "end": 160
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 161,
                                  "end": 162
                                }
                              }
                            },
                            "span": {
                              "start": 161,
                              "end": 162
                            }
                          },
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 164,
                              "end": 165
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 154,
                      "end": 166
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 142,
                "end": 166
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 181,
                      "end": 182
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 183,
                          "end": 185
                        }
                      },
                      "type_hint": null,
                      "default": {
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
                                    "start": 188,
                                    "end": 189
                                  }
                                }
                              },
                              "span": {
                                "start": 188,
                                "end": 189
                              }
                            },
                            "args": [
                              {
                                "name": null,
                                "kind": "Placeholder",
                                "span": {
                                  "start": 190,
                                  "end": 191
                                }
                              },
                              {
                                "name": null,
                                "kind": "SpreadPlaceholder",
                                "span": {
                                  "start": 193,
                                  "end": 196
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 188,
                          "end": 197
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 183,
                        "end": 197
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 172,
                "end": 201
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 103,
        "end": 203
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 227,
              "end": 228
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 218,
        "end": 233
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 233
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
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
                          "start": 16,
                          "end": 17
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 17
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 20
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 20
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 21
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 28,
                "end": 29
              }
            },
            "value": {
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
                          "start": 32,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 34,
                            "end": 35
                          }
                        }
                      },
                      "span": {
                        "start": 34,
                        "end": 35
                      }
                    },
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 37,
                        "end": 38
                      }
                    },
                    {
                      "name": null,
                      "kind": "SpreadPlaceholder",
                      "span": {
                        "start": 40,
                        "end": 43
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 32,
                "end": 44
              }
            },
            "attributes": [],
            "span": {
              "start": 28,
              "end": 44
            }
          }
        ]
      },
      "span": {
        "start": 22,
        "end": 45
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 52,
                "end": 53
              }
            },
            "value": {
              "kind": {
                "StaticMethodCall": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 56,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59
                    }
                  },
                  "method": {
                    "kind": {
                      "Identifier": "m"
                    },
                    "span": {
                      "start": 61,
                      "end": 62
                    }
                  },
                  "args": [
                    {
                      "name": {
                        "parts": [
                          "a"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 63,
                          "end": 64
                        }
                      },
                      "kind": "Placeholder",
                      "span": {
                        "start": 63,
                        "end": 67
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 56,
                "end": 68
              }
            },
            "attributes": [],
            "span": {
              "start": 52,
              "end": 68
            }
          }
        ]
      },
      "span": {
        "start": 46,
        "end": 69
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 76,
                "end": 77
              }
            },
            "value": {
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
                          "start": 80,
                          "end": 81
                        }
                      }
                    },
                    "span": {
                      "start": 80,
                      "end": 81
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 82,
                        "end": 83
                      }
                    },
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Binary": {
                              "left": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 85,
                                  "end": 86
                                }
                              },
                              "op": "Add",
                              "right": {
                                "kind": {
                                  "Int": 2
                                },
                                "span": {
                                  "start": 89,
                                  "end": 90
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 85,
                            "end": 90
                          }
                        }
                      },
                      "span": {
                        "start": 85,
                        "end": 90
                      }
                    },
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "ClassConstAccess": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "Foo"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 92,
                                      "end": 95
                                    }
                                  }
                                },
                                "span": {
                                  "start": 92,
                                  "end": 95
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "BAR"
                                },
                                "span": {
                                  "start": 97,
                                  "end": 100
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 92,
                            "end": 100
                          }
                        }
                      },
                      "span": {
                        "start": 92,
                        "end": 100
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 80,
                "end": 101
              }
            },
            "attributes": [],
            "span": {
              "start": 76,
              "end": 101
            }
          }
        ]
      },
      "span": {
        "start": 70,
        "end": 102
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
            "span": {
              "start": 109,
              "end": 110
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "E",
                    "span": {
                      "start": 123,
                      "end": 124
                    }
                  },
                  "value": {
                    "kind": {
                      "FunctionCall": {
                        "name": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "strlen"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 127,
                                "end": 133
                              }
                            }
                          },
                          "span": {
                            "start": 127,
                            "end": 133
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 134,
                              "end": 135
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 127,
                      "end": 136
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 117,
                "end": 137
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "p",
                    "span": {
                      "start": 149,
                      "end": 151
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "StaticMethodCall": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 154,
                                "end": 157
                              }
                            }
                          },
                          "span": {
                            "start": 154,
                            "end": 157
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 159,
                            "end": 160
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": {
                              "Value": {
                                "kind": {
                                  "Int": 1
                                },
                                "span": {
                                  "start": 161,
                                  "end": 162
                                }
                              }
                            },
                            "span": {
                              "start": 161,
                              "end": 162
                            }
                          },
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 164,
                              "end": 165
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 154,
                      "end": 166
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 142,
                "end": 166
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 181,
                      "end": 182
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 183,
                          "end": 185
                        }
                      },
                      "type_hint": null,
                      "default": {
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
                                    "start": 188,
                                    "end": 189
                                  }
                                }
                              },
                              "span": {
                                "start": 188,
                                "end": 189
                              }
                            },
                            "args": [
                              {
                                "name": null,
                                "kind": "Placeholder",
                                "span": {
                                  "start": 190,
                                  "end": 191
                                }
                              },
                              {
                                "name": null,
                                "kind": "SpreadPlaceholder",
                                "span": {
                                  "start": 193,
                                  "end": 196
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 188,
                          "end": 197
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 183,
                        "end": 197
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 172,
                "end": 201
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 103,
        "end": 203
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "g",
            "span": {
              "start": 227,
              "end": 228
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attr"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 206,
                  "end": 210
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
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
                                  "start": 211,
                                  "end": 212
                                }
                              }
                            },
                            "span": {
                              "start": 211,
                              "end": 212
                            }
                          },
                          "args": [
                            {
                              "name": null,
                              "kind": "Placeholder",
                              "span": {
                                "start": 213,
                                "end": 214
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 211,
                        "end": 215
                      }
                    }
                  },
                  "span": {
                    "start": 211,
                    "end": 215
                  }
                }
              ],
              "span": {
                "start": 206,
                "end": 216
              }
            }
          ]
        }
      },
      "span": {
        "start": 218,
        "end": 233
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 233
  }
}
