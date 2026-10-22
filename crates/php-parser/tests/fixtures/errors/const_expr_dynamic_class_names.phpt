===source===
<?php
const A = $foo::BAR;
const B = $foo::{'BAR'};
const C = $foo::class;
const D = static::BAR;
const E = static::{'BAR'};
class Foo {
    const F = static::class;
    public $g = static::BAR;
    public function m($h = static::class) {}
}
===errors <=8.2===
Dynamic class names are not allowed in compile-time class constant references
'dynamic class constant fetch' requires PHP 8.3 or higher
Dynamic class names are not allowed in compile-time class constant references
(expression)::class cannot be used in constant expressions
"static::" is not allowed in compile-time constants
'dynamic class constant fetch' requires PHP 8.3 or higher
"static::" is not allowed in compile-time constants
"static::" is not allowed in compile-time constants
static::class cannot be used for compile-time class name resolution
static::class cannot be used for compile-time class name resolution
===errors >=8.3===
Dynamic class names are not allowed in compile-time class constant references
Dynamic class names are not allowed in compile-time class constant references
(expression)::class cannot be used in constant expressions
"static::" is not allowed in compile-time constants
"static::" is not allowed in compile-time constants
"static::" is not allowed in compile-time constants
static::class cannot be used for compile-time class name resolution
static::class cannot be used for compile-time class name resolution
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting '(' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token ";", expecting "(" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Dynamic class names are not allowed in compile-time class constant references in Standard input code on line 2
===ast===
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
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Variable": "foo"
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "BAR"
                    },
                    "span": {
                      "start": 22,
                      "end": 25
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 25
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 25
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 33,
                "end": 34
              }
            },
            "value": {
              "kind": {
                "ClassConstAccessDynamic": {
                  "class": {
                    "kind": {
                      "Variable": "foo"
                    },
                    "span": {
                      "start": 37,
                      "end": 41
                    }
                  },
                  "member": {
                    "kind": {
                      "String": "BAR"
                    },
                    "span": {
                      "start": 44,
                      "end": 49
                    }
                  }
                }
              },
              "span": {
                "start": 37,
                "end": 50
              }
            },
            "attributes": [],
            "span": {
              "start": 33,
              "end": 50
            }
          }
        ]
      },
      "span": {
        "start": 27,
        "end": 51
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 58,
                "end": 59
              }
            },
            "value": {
              "kind": {
                "ClassConstAccess": {
                  "class": {
                    "kind": {
                      "Variable": "foo"
                    },
                    "span": {
                      "start": 62,
                      "end": 66
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "class"
                    },
                    "span": {
                      "start": 68,
                      "end": 73
                    }
                  }
                }
              },
              "span": {
                "start": 62,
                "end": 73
              }
            },
            "attributes": [],
            "span": {
              "start": 58,
              "end": 73
            }
          }
        ]
      },
      "span": {
        "start": 52,
        "end": 74
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 81,
                "end": 82
              }
            },
            "value": {
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
                          "start": 85,
                          "end": 91
                        }
                      }
                    },
                    "span": {
                      "start": 85,
                      "end": 91
                    }
                  },
                  "member": {
                    "kind": {
                      "Identifier": "BAR"
                    },
                    "span": {
                      "start": 93,
                      "end": 96
                    }
                  }
                }
              },
              "span": {
                "start": 85,
                "end": 96
              }
            },
            "attributes": [],
            "span": {
              "start": 81,
              "end": 96
            }
          }
        ]
      },
      "span": {
        "start": 75,
        "end": 97
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "E",
              "span": {
                "start": 104,
                "end": 105
              }
            },
            "value": {
              "kind": {
                "ClassConstAccessDynamic": {
                  "class": {
                    "kind": {
                      "Name": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 108,
                          "end": 114
                        }
                      }
                    },
                    "span": {
                      "start": 108,
                      "end": 114
                    }
                  },
                  "member": {
                    "kind": {
                      "String": "BAR"
                    },
                    "span": {
                      "start": 117,
                      "end": 122
                    }
                  }
                }
              },
              "span": {
                "start": 108,
                "end": 123
              }
            },
            "attributes": [],
            "span": {
              "start": 104,
              "end": 123
            }
          }
        ]
      },
      "span": {
        "start": 98,
        "end": 124
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 131,
              "end": 134
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
                      "start": 147,
                      "end": 148
                    }
                  },
                  "value": {
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
                                "start": 151,
                                "end": 157
                              }
                            }
                          },
                          "span": {
                            "start": 151,
                            "end": 157
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 159,
                            "end": 164
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 151,
                      "end": 164
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 141,
                "end": 165
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "g",
                    "span": {
                      "start": 177,
                      "end": 179
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
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
                                "start": 182,
                                "end": 188
                              }
                            }
                          },
                          "span": {
                            "start": 182,
                            "end": 188
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "BAR"
                          },
                          "span": {
                            "start": 190,
                            "end": 193
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 182,
                      "end": 193
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 170,
                "end": 193
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 215,
                      "end": 216
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "h",
                        "span": {
                          "start": 217,
                          "end": 219
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
                                    "start": 222,
                                    "end": 228
                                  }
                                }
                              },
                              "span": {
                                "start": 222,
                                "end": 228
                              }
                            },
                            "member": {
                              "kind": {
                                "Identifier": "class"
                              },
                              "span": {
                                "start": 230,
                                "end": 235
                              }
                            }
                          }
                        },
                        "span": {
                          "start": 222,
                          "end": 235
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 217,
                        "end": 235
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 199,
                "end": 239
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 125,
        "end": 241
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 241
  }
}
