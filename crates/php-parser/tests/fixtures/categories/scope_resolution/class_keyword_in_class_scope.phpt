===source===
<?php
class A extends B {
    public parent $a;
    const X = parent::class;
    function m(self $a): static {
        return [parent::m(), new self, static::$x, $a instanceof parent];
    }
}
interface I {
    function f(self $a): static;
}
enum E {
    case A;
    function f(): self {
        return self::A;
    }
}
function f() {
    return new class extends B {
        function g(): parent {
            return parent::g();
        }
    };
}
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 12
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
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 44,
                      "end": 46
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "parent"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 37,
                          "end": 43
                        }
                      }
                    },
                    "span": {
                      "start": 37,
                      "end": 43
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 46
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
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
                            "Name": {
                              "parts": [
                                "parent"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 62,
                                "end": 68
                              }
                            }
                          },
                          "span": {
                            "start": 62,
                            "end": 68
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "class"
                          },
                          "span": {
                            "start": 70,
                            "end": 75
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 62,
                      "end": 75
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 52,
                "end": 76
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 90,
                      "end": 91
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 97,
                          "end": 99
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
                              "start": 92,
                              "end": 96
                            }
                          }
                        },
                        "span": {
                          "start": 92,
                          "end": 96
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 92,
                        "end": 99
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 102,
                          "end": 108
                        }
                      }
                    },
                    "span": {
                      "start": 102,
                      "end": 108
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Array": [
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "StaticMethodCall": {
                                        "class": {
                                          "kind": {
                                            "Name": {
                                              "parts": [
                                                "parent"
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
                                        "method": {
                                          "kind": {
                                            "Identifier": "m"
                                          },
                                          "span": {
                                            "start": 135,
                                            "end": 136
                                          }
                                        },
                                        "args": []
                                      }
                                    },
                                    "span": {
                                      "start": 127,
                                      "end": 138
                                    }
                                  }
                                },
                                "span": {
                                  "start": 127,
                                  "end": 138
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "New": {
                                        "class": {
                                          "kind": {
                                            "Name": {
                                              "parts": [
                                                "self"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 144,
                                                "end": 148
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 144,
                                            "end": 148
                                          }
                                        },
                                        "args": []
                                      }
                                    },
                                    "span": {
                                      "start": 140,
                                      "end": 148
                                    }
                                  }
                                },
                                "span": {
                                  "start": 140,
                                  "end": 148
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "StaticPropertyAccess": {
                                        "class": {
                                          "kind": {
                                            "Name": {
                                              "parts": [
                                                "static"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 150,
                                                "end": 156
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 150,
                                            "end": 156
                                          }
                                        },
                                        "member": {
                                          "kind": {
                                            "Identifier": "x"
                                          },
                                          "span": {
                                            "start": 158,
                                            "end": 160
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 150,
                                      "end": 160
                                    }
                                  }
                                },
                                "span": {
                                  "start": 150,
                                  "end": 160
                                }
                              },
                              {
                                "key": null,
                                "kind": {
                                  "Value": {
                                    "kind": {
                                      "Binary": {
                                        "left": {
                                          "kind": {
                                            "Variable": "a"
                                          },
                                          "span": {
                                            "start": 162,
                                            "end": 164
                                          }
                                        },
                                        "op": "Instanceof",
                                        "right": {
                                          "kind": {
                                            "Name": {
                                              "parts": [
                                                "parent"
                                              ],
                                              "kind": "Unqualified",
                                              "span": {
                                                "start": 176,
                                                "end": 182
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 176,
                                            "end": 182
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 162,
                                      "end": 182
                                    }
                                  }
                                },
                                "span": {
                                  "start": 162,
                                  "end": 182
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 126,
                            "end": 183
                          }
                        }
                      },
                      "span": {
                        "start": 119,
                        "end": 184
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 81,
                "end": 190
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 192
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 203,
              "end": 204
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 220,
                      "end": 221
                    }
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "a",
                        "span": {
                          "start": 227,
                          "end": 229
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
                              "start": 222,
                              "end": 226
                            }
                          }
                        },
                        "span": {
                          "start": 222,
                          "end": 226
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 222,
                        "end": 229
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 232,
                          "end": 238
                        }
                      }
                    },
                    "span": {
                      "start": 232,
                      "end": 238
                    }
                  },
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 211,
                "end": 239
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 193,
        "end": 241
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 247,
              "end": 248
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 260,
                      "end": 261
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 255,
                "end": 262
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 276,
                      "end": 277
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 281,
                          "end": 285
                        }
                      }
                    },
                    "span": {
                      "start": 281,
                      "end": 285
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
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
                                      "start": 303,
                                      "end": 307
                                    }
                                  }
                                },
                                "span": {
                                  "start": 303,
                                  "end": 307
                                }
                              },
                              "member": {
                                "kind": {
                                  "Identifier": "A"
                                },
                                "span": {
                                  "start": 309,
                                  "end": 310
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 303,
                            "end": 310
                          }
                        }
                      },
                      "span": {
                        "start": 296,
                        "end": 311
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 267,
                "end": 317
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 242,
        "end": 319
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 329,
              "end": 330
            }
          },
          "params": [],
          "body": [
            {
              "kind": {
                "Return": {
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
                            "extends": {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 364,
                                "end": 365
                              }
                            },
                            "implements": [],
                            "members": [
                              {
                                "kind": {
                                  "Method": {
                                    "name": {
                                      "name": "g",
                                      "span": {
                                        "start": 385,
                                        "end": 386
                                      }
                                    },
                                    "by_ref": false,
                                    "params": [],
                                    "return_type": {
                                      "kind": {
                                        "Named": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 390,
                                            "end": 396
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 390,
                                        "end": 396
                                      }
                                    },
                                    "body": [
                                      {
                                        "kind": {
                                          "Return": {
                                            "kind": {
                                              "StaticMethodCall": {
                                                "class": {
                                                  "kind": {
                                                    "Name": {
                                                      "parts": [
                                                        "parent"
                                                      ],
                                                      "kind": "Unqualified",
                                                      "span": {
                                                        "start": 418,
                                                        "end": 424
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 418,
                                                    "end": 424
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "g"
                                                  },
                                                  "span": {
                                                    "start": 426,
                                                    "end": 427
                                                  }
                                                },
                                                "args": []
                                              }
                                            },
                                            "span": {
                                              "start": 418,
                                              "end": 429
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 411,
                                          "end": 430
                                        }
                                      }
                                    ],
                                    "attributes": []
                                  }
                                },
                                "span": {
                                  "start": 376,
                                  "end": 440
                                }
                              }
                            ],
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 346,
                          "end": 446
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 346,
                    "end": 446
                  }
                }
              },
              "span": {
                "start": 339,
                "end": 447
              }
            }
          ],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 320,
        "end": 449
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 449
  }
}
