===source===
<?php
const A = f(?, $x);
const B = f(?, g());
const C = f(?, ...[1]);
const D = (function () {})(?);
const E = f(?)(?);
class K {
    const F = static::m(?);
    const G = $o->m(?);
}
===errors >=8.6===
Constant expression contains invalid operations
Constant expression contains invalid operations
Argument unpacking in constant expressions is not supported
Cannot use dynamic function name in constant expression
Cannot use dynamic function name in constant expression
"static" is not allowed in compile-time constants
Constant expression contains invalid operations
===php_error <=8.5===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 2
===php_error >=8.6===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast >=8.6===
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
                    },
                    {
                      "name": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 21,
                            "end": 23
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 23
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 24
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 24
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 32,
                "end": 33
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
                          "start": 36,
                          "end": 37
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 38,
                        "end": 39
                      }
                    },
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
                                      "g"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 41,
                                      "end": 42
                                    }
                                  }
                                },
                                "span": {
                                  "start": 41,
                                  "end": 42
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 44
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 44
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 36,
                "end": 45
              }
            },
            "attributes": [],
            "span": {
              "start": 32,
              "end": 45
            }
          }
        ]
      },
      "span": {
        "start": 26,
        "end": 46
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 53,
                "end": 54
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
                          "start": 57,
                          "end": 58
                        }
                      }
                    },
                    "span": {
                      "start": 57,
                      "end": 58
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 59,
                        "end": 60
                      }
                    },
                    {
                      "name": null,
                      "kind": {
                        "Spread": {
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
                                      "start": 66,
                                      "end": 67
                                    }
                                  }
                                },
                                "span": {
                                  "start": 66,
                                  "end": 67
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 65,
                            "end": 68
                          }
                        }
                      },
                      "span": {
                        "start": 62,
                        "end": 68
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 57,
                "end": 69
              }
            },
            "attributes": [],
            "span": {
              "start": 53,
              "end": 69
            }
          }
        ]
      },
      "span": {
        "start": 47,
        "end": 70
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 77,
                "end": 78
              }
            },
            "value": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Parenthesized": {
                        "kind": {
                          "Closure": {
                            "is_static": false,
                            "by_ref": false,
                            "params": [],
                            "use_vars": [],
                            "return_type": null,
                            "body": [],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 82,
                          "end": 96
                        }
                      }
                    },
                    "span": {
                      "start": 81,
                      "end": 97
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 98,
                        "end": 99
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 81,
                "end": 100
              }
            },
            "attributes": [],
            "span": {
              "start": 77,
              "end": 100
            }
          }
        ]
      },
      "span": {
        "start": 71,
        "end": 101
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
              "span": {
                "start": 108,
                "end": 109
              }
            },
            "value": {
              "kind": {
                "FunctionCall": {
                  "name": {
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
                                "start": 112,
                                "end": 113
                              }
                            }
                          },
                          "span": {
                            "start": 112,
                            "end": 113
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 114,
                              "end": 115
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 112,
                      "end": 116
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "kind": "Placeholder",
                      "span": {
                        "start": 117,
                        "end": 118
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 112,
                "end": 119
              }
            },
            "attributes": [],
            "span": {
              "start": 108,
              "end": 119
            }
          }
        ]
      },
      "span": {
        "start": 102,
        "end": 120
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "K",
            "span": {
              "start": 127,
              "end": 128
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
                    "name": "F",
                    "span": {
                      "start": 141,
                      "end": 142
                    }
                  },
                  "value": {
                    "kind": {
                      "StaticMethodCall": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "static"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 145,
                                "end": 151
                              }
                            }
                          },
                          "span": {
                            "start": 145,
                            "end": 151
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 153,
                            "end": 154
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 155,
                              "end": 156
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 145,
                      "end": 157
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 135,
                "end": 158
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "G",
                    "span": {
                      "start": 169,
                      "end": 170
                    }
                  },
                  "value": {
                    "kind": {
                      "MethodCall": {
                        "object": {
                          "kind": {
                            "Variable": "o"
                          },
                          "span": {
                            "start": 173,
                            "end": 175
                          }
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 177,
                            "end": 178
                          }
                        },
                        "args": [
                          {
                            "name": null,
                            "kind": "Placeholder",
                            "span": {
                              "start": 179,
                              "end": 180
                            }
                          }
                        ]
                      }
                    },
                    "span": {
                      "start": 173,
                      "end": 181
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 163,
                "end": 182
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 121,
        "end": 184
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 184
  }
}
