===config===
min_php=8.1

===source===
<?php
class A {
    public void $a;
    public static never $b;
    var callable $c;
    protected ?callable $d;
    private callable|int|null $e;
    public function __construct(public callable $f, public void $g) {}
}
trait T {
    public void $h;
}
$i = new class {
    public callable $i;
};
===errors===
Property A::$a cannot have type void
Property A::$b cannot have type never
Property A::$c cannot have type callable
Property A::$d cannot have type ?callable
Property A::$e cannot have type callable|int|null
Property A::$f cannot have type callable
void cannot be used as a parameter type
Property T::$h cannot have type void
Property class@anonymous::$i cannot have type callable
===php_error===
PHP Fatal error:  Property A::$a cannot have type void in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 31
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 31
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 34
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 60,
                      "end": 62
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "never"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 54,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 54,
                      "end": 59
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 62
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 81,
                      "end": 83
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "callable"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 72,
                          "end": 80
                        }
                      }
                    },
                    "span": {
                      "start": 72,
                      "end": 80
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 68,
                "end": 83
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 109,
                      "end": 111
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
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
                              "start": 100,
                              "end": 108
                            }
                          }
                        },
                        "span": {
                          "start": 100,
                          "end": 108
                        }
                      }
                    },
                    "span": {
                      "start": 99,
                      "end": 108
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 89,
                "end": 111
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 143,
                      "end": 145
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "callable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 125,
                                "end": 133
                              }
                            }
                          },
                          "span": {
                            "start": 125,
                            "end": 133
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 134,
                                "end": 137
                              }
                            }
                          },
                          "span": {
                            "start": 134,
                            "end": 137
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "null"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 138,
                                "end": 142
                              }
                            }
                          },
                          "span": {
                            "start": 138,
                            "end": 142
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 125,
                      "end": 142
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 117,
                "end": 145
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 167,
                      "end": 178
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "f",
                        "span": {
                          "start": 195,
                          "end": 197
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
                              "start": 186,
                              "end": 194
                            }
                          }
                        },
                        "span": {
                          "start": 186,
                          "end": 194
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 179,
                        "end": 197
                      }
                    },
                    {
                      "name": {
                        "name": "g",
                        "span": {
                          "start": 211,
                          "end": 213
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
                              "start": 206,
                              "end": 210
                            }
                          }
                        },
                        "span": {
                          "start": 206,
                          "end": 210
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public"
                      },
                      "attributes": [],
                      "span": {
                        "start": 199,
                        "end": 213
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 151,
                "end": 217
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 219
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 226,
              "end": 227
            }
          },
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "h",
                    "span": {
                      "start": 246,
                      "end": 248
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 241,
                          "end": 245
                        }
                      }
                    },
                    "span": {
                      "start": 241,
                      "end": 245
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 234,
                "end": 248
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 220,
        "end": 251
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "i"
                },
                "span": {
                  "start": 252,
                  "end": 254
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
                                "Property": {
                                  "name": {
                                    "name": "i",
                                    "span": {
                                      "start": 289,
                                      "end": 291
                                    }
                                  },
                                  "modifiers": {
                                    "visibility": "Public"
                                  },
                                  "type_hint": {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "callable"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 280,
                                          "end": 288
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 280,
                                      "end": 288
                                    }
                                  },
                                  "default": null,
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 273,
                                "end": 291
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 257,
                        "end": 294
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 257,
                  "end": 294
                }
              }
            }
          },
          "span": {
            "start": 252,
            "end": 294
          }
        }
      },
      "span": {
        "start": 252,
        "end": 295
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 295
  }
}
