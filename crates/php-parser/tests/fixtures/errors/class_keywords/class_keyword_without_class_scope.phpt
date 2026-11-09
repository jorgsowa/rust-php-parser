===source===
<?php
function f(self $a, $b = static::class): ?parent {
    self::g();
    new static;
    echo parent::X, Self::$y, self::{'Z'};
    $a instanceof static;
    $f = self::g(...);
    static $c = parent::class;
    return "{${self::X}}";
}
class A {
    function m() {
        function g(): static {}
    }
}
===errors <=7.4===
'dynamic class constant fetch' requires PHP 8.3 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'static type' requires PHP 8.0 or higher
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
===errors 8.0===
'dynamic class constant fetch' requires PHP 8.3 or higher
'first-class callable syntax' requires PHP 8.1 or higher
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
===errors 8.1-8.2===
'dynamic class constant fetch' requires PHP 8.3 or higher
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
===errors >=8.3===
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "parent" when no class scope is active
Cannot use "self" when no class scope is active
Cannot use "static" when no class scope is active
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '(' in Standard input code on line 5
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 5
===php_error >=8.3===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 22,
                  "end": 24
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "self"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 17,
                      "end": 21
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 21
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 24
              }
            },
            {
              "name": {
                "name": "b",
                "span": {
                  "start": 26,
                  "end": 28
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "ClassConstAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "static"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 31,
                            "end": 37
                          }
                        }
                      },
                      "span": {
                        "start": 31,
                        "end": 37
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "class"
                      },
                      "span": {
                        "start": 39,
                        "end": 44
                      }
                    }
                  }
                },
                "span": {
                  "start": 31,
                  "end": 44
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 26,
                "end": 44
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "StaticMethodCall": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "self"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 61,
                              "end": 65
                            }
                          }
                        },
                        "span": {
                          "start": 61,
                          "end": 65
                        }
                      },
                      "method": {
                        "kind": {
                          "Identifier": "g"
                        },
                        "span": {
                          "start": 67,
                          "end": 68
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 61,
                    "end": 70
                  }
                }
              },
              "span": {
                "start": 61,
                "end": 71
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "New": {
                      "class": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 80,
                              "end": 86
                            }
                          }
                        },
                        "span": {
                          "start": 80,
                          "end": 86
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 76,
                    "end": 86
                  }
                }
              },
              "span": {
                "start": 76,
                "end": 87
              }
            },
            {
              "kind": {
                "Echo": [
                  {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 97,
                                "end": 103
                              }
                            }
                          },
                          "span": {
                            "start": 97,
                            "end": 103
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "X"
                          },
                          "span": {
                            "start": 105,
                            "end": 106
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 97,
                      "end": 106
                    }
                  },
                  {
                    "kind": {
                      "StaticPropertyAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 108,
                                "end": 112
                              }
                            }
                          },
                          "span": {
                            "start": 108,
                            "end": 112
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "y"
                          },
                          "span": {
                            "start": 114,
                            "end": 116
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 108,
                      "end": 116
                    }
                  },
                  {
                    "kind": {
                      "ClassConstAccessDynamic": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "self"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 118,
                                "end": 122
                              }
                            }
                          },
                          "span": {
                            "start": 118,
                            "end": 122
                          }
                        },
                        "member": {
                          "kind": {
                            "String": "Z"
                          },
                          "span": {
                            "start": 125,
                            "end": 128
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 118,
                      "end": 129
                    }
                  }
                ]
              },
              "span": {
                "start": 92,
                "end": 130
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Binary": {
                      "left": {
                        "kind": {
                          "Variable": "a"
                        },
                        "span": {
                          "start": 135,
                          "end": 137
                        }
                      },
                      "op": "Instanceof",
                      "right": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 149,
                              "end": 155
                            }
                          }
                        },
                        "span": {
                          "start": 149,
                          "end": 155
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 135,
                    "end": 155
                  }
                }
              },
              "span": {
                "start": 135,
                "end": 156
              }
            },
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "Assign": {
                      "target": {
                        "kind": {
                          "Variable": "f"
                        },
                        "span": {
                          "start": 161,
                          "end": 163
                        }
                      },
                      "op": "Assign",
                      "value": {
                        "kind": {
                          "CallableCreate": {
                            "kind": {
                              "StaticMethod": {
                                "class": {
                                  "kind": {
                                    "Name": {
                                      "parts": [
                                        "self"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 166,
                                        "end": 170
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 166,
                                    "end": 170
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "g"
                                  },
                                  "span": {
                                    "start": 172,
                                    "end": 173
                                  }
                                }
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 166,
                          "end": 178
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 161,
                    "end": 178
                  }
                }
              },
              "span": {
                "start": 161,
                "end": 179
              }
            },
            {
              "kind": {
                "StaticVar": [
                  {
                    "name": {
                      "name": "c",
                      "span": {
                        "start": 191,
                        "end": 193
                      }
                    },
                    "default": {
                      "kind": {
                        "ClassConstAccess": {
                          "class": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "parent"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 196,
                                  "end": 202
                                }
                              }
                            },
                            "span": {
                              "start": 196,
                              "end": 202
                            }
                          },
                          "member": {
                            "kind": {
                              "Identifier": "class"
                            },
                            "span": {
                              "start": 204,
                              "end": 209
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 196,
                        "end": 209
                      }
                    },
                    "span": {
                      "start": 191,
                      "end": 209
                    }
                  }
                ]
              },
              "span": {
                "start": 184,
                "end": 210
              }
            },
            {
              "kind": {
                "Return": {
                  "kind": {
                    "InterpolatedString": [
                      {
                        "Expr": {
                          "kind": {
                            "VariableVariable": {
                              "kind": {
                                "ClassConstAccess": {
                                  "class": {
                                    "kind": {
                                      "Name": {
                                        "parts": [
                                          "self"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 226,
                                          "end": 230
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 226,
                                      "end": 230
                                    }
                                  },
                                  "member": {
                                    "kind": {
                                      "Identifier": "X"
                                    },
                                    "span": {
                                      "start": 232,
                                      "end": 233
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 226,
                                "end": 233
                              }
                            }
                          },
                          "span": {
                            "start": 224,
                            "end": 234
                          }
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 222,
                    "end": 236
                  }
                }
              },
              "span": {
                "start": 215,
                "end": 237
              }
            }
          ],
          "return_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "parent"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 48,
                      "end": 54
                    }
                  }
                },
                "span": {
                  "start": 48,
                  "end": 54
                }
              }
            },
            "span": {
              "start": 47,
              "end": 54
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 239
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 246,
              "end": 247
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 263,
                      "end": 264
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Function": {
                          "name": {
                            "name": "g",
                            "span": {
                              "start": 286,
                              "end": 287
                            }
                          },
                          "params": [],
                          "body": [],
                          "return_type": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "static"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 291,
                                  "end": 297
                                }
                              }
                            },
                            "span": {
                              "start": 291,
                              "end": 297
                            }
                          },
                          "by_ref": false,
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 277,
                        "end": 300
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 254,
                "end": 306
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 240,
        "end": 308
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 308
  }
}
