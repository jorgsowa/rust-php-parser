===source===
<?php
class A {
    const void A = 1, B = 2;
    const ?callable C = null;
    const int|callable D = 1;
}
interface I {
    const never E = 1;
}
enum E {
    const callable F = 1;
}
$g = new class {
    const void G = 1;
};
===errors <=7.4===
'typed class constants' requires PHP 8.3 or higher
Class constant A::A cannot have type void
'typed class constants' requires PHP 8.3 or higher
Class constant A::C cannot have type ?callable
'typed class constants' requires PHP 8.3 or higher
'union types' requires PHP 8.0 or higher
Class constant A::D cannot have type callable|int
'typed class constants' requires PHP 8.3 or higher
Cannot use int as value for class constant I::E of type never
'enums' requires PHP 8.1 or higher
'typed enum constants' requires PHP 8.3 or higher
Class constant E::F cannot have type callable
'typed class constants' requires PHP 8.3 or higher
Class constant class@anonymous::G cannot have type void
===errors 8.0===
'typed class constants' requires PHP 8.3 or higher
Class constant A::A cannot have type void
'typed class constants' requires PHP 8.3 or higher
Class constant A::C cannot have type ?callable
'typed class constants' requires PHP 8.3 or higher
Class constant A::D cannot have type callable|int
'typed class constants' requires PHP 8.3 or higher
Cannot use int as value for class constant I::E of type never
'enums' requires PHP 8.1 or higher
'typed enum constants' requires PHP 8.3 or higher
Class constant E::F cannot have type callable
'typed class constants' requires PHP 8.3 or higher
Class constant class@anonymous::G cannot have type void
===errors 8.1-8.2===
'typed class constants' requires PHP 8.3 or higher
Class constant A::A cannot have type void
'typed class constants' requires PHP 8.3 or higher
Class constant A::C cannot have type ?callable
'typed class constants' requires PHP 8.3 or higher
Class constant A::D cannot have type callable|int
'typed class constants' requires PHP 8.3 or higher
Class constant I::E cannot have type never
'typed enum constants' requires PHP 8.3 or higher
Class constant E::F cannot have type callable
'typed class constants' requires PHP 8.3 or higher
Class constant class@anonymous::G cannot have type void
===errors >=8.3===
Class constant A::A cannot have type void
Class constant A::C cannot have type ?callable
Class constant A::D cannot have type callable|int
Class constant I::E cannot have type never
Class constant E::F cannot have type callable
Class constant class@anonymous::G cannot have type void
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'A' (T_STRING), expecting '=' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "A", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Class constant A::A cannot have type void in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
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
                    "name": "A",
                    "span": {
                      "start": 31,
                      "end": 32
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 26,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 30
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 36
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 38,
                      "end": 39
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 26,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 30
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
                    },
                    "span": {
                      "start": 42,
                      "end": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 38,
                "end": 44
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 65,
                      "end": 66
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 56,
                              "end": 64
                            }
                          }
                        },
                        "span": {
                          "start": 56,
                          "end": 64
                        }
                      }
                    },
                    "span": {
                      "start": 55,
                      "end": 64
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 69,
                      "end": 73
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 49,
                "end": 74
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "D",
                    "span": {
                      "start": 98,
                      "end": 99
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 85,
                                "end": 88
                              }
                            }
                          },
                          "span": {
                            "start": 85,
                            "end": 88
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "callable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 89,
                                "end": 97
                              }
                            }
                          },
                          "span": {
                            "start": 89,
                            "end": 97
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 85,
                      "end": 97
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 102,
                      "end": 103
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 79,
                "end": 104
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 106
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 117,
              "end": 118
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "E",
                    "span": {
                      "start": 137,
                      "end": 138
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 131,
                          "end": 136
                        }
                      }
                    },
                    "span": {
                      "start": 131,
                      "end": 136
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 141,
                      "end": 142
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 125,
                "end": 143
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 107,
        "end": 145
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 151,
              "end": 152
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "F",
                    "span": {
                      "start": 174,
                      "end": 175
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "callable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 165,
                          "end": 173
                        }
                      }
                    },
                    "span": {
                      "start": 165,
                      "end": 173
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 178,
                      "end": 179
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 180
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 146,
        "end": 182
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "g"
                },
                "span": {
                  "start": 183,
                  "end": 185
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
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
                                    "name": "G",
                                    "span": {
                                      "start": 215,
                                      "end": 216
                                    }
                                  },
                                  "type_hint": {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "void"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 210,
                                          "end": 214
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 210,
                                      "end": 214
                                    }
                                  },
                                  "value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 219,
                                      "end": 220
                                    }
                                  },
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 204,
                                "end": 221
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 188,
                        "end": 223
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 188,
                  "end": 223
                }
              }
            }
          },
          "span": {
            "start": 183,
            "end": 223
          }
        }
      },
      "span": {
        "start": 183,
        "end": 224
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 224
  }
}
