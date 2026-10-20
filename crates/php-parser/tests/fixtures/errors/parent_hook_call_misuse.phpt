===source===
<?php
parent::$a::get();
$f = function () { return parent::$a::set(1); };
class A extends B {
    function m() {
        parent::$a::get();
    }
    public $a {
        get => parent::$b::get();
        set {
            parent::$a::get();
            $f = fn() => parent::$a::set($value);
            $g = parent::$a::set(...);
        }
    }
}
===errors===
Cannot use "parent" when no class scope is active
Cannot use "parent" when no class scope is active
Must not use parent::$a::get() outside a property hook
Must not use parent::$b::get() in a different property ($a)
Must not use parent::$a::get() in a different property hook (set)
Must not use parent::$a::set() outside a property hook
Cannot create Closure for parent property hook call
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 8
===php_error >=8.4===
PHP Fatal error:  Cannot use "parent" when no class scope is active in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "StaticMethodCall": {
              "class": {
                "kind": {
                  "StaticPropertyAccess": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "parent"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 6,
                            "end": 12
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 12
                      }
                    },
                    "member": {
                      "kind": {
                        "Identifier": "a"
                      },
                      "span": {
                        "start": 14,
                        "end": 16
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16
                }
              },
              "method": {
                "kind": {
                  "Identifier": "get"
                },
                "span": {
                  "start": 18,
                  "end": 21
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 24
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
                  "start": 25,
                  "end": 27
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Closure": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "use_vars": [],
                    "return_type": null,
                    "body": [
                      {
                        "kind": {
                          "Return": {
                            "kind": {
                              "StaticMethodCall": {
                                "class": {
                                  "kind": {
                                    "StaticPropertyAccess": {
                                      "class": {
                                        "kind": {
                                          "Name": {
                                            "parts": [
                                              "parent"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 51,
                                              "end": 57
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 51,
                                          "end": 57
                                        }
                                      },
                                      "member": {
                                        "kind": {
                                          "Identifier": "a"
                                        },
                                        "span": {
                                          "start": 59,
                                          "end": 61
                                        }
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 51,
                                    "end": 61
                                  }
                                },
                                "method": {
                                  "kind": {
                                    "Identifier": "set"
                                  },
                                  "span": {
                                    "start": 63,
                                    "end": 66
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
                                          "start": 67,
                                          "end": 68
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 67,
                                      "end": 68
                                    }
                                  }
                                ]
                              }
                            },
                            "span": {
                              "start": 51,
                              "end": 69
                            }
                          }
                        },
                        "span": {
                          "start": 44,
                          "end": 70
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 30,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 25,
            "end": 72
          }
        }
      },
      "span": {
        "start": 25,
        "end": 73
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 80,
              "end": 81
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
              "start": 90,
              "end": 91
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 107,
                      "end": 108
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 121,
                                            "end": 127
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 121,
                                        "end": 127
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "a"
                                      },
                                      "span": {
                                        "start": 129,
                                        "end": 131
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 121,
                                  "end": 131
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 133,
                                  "end": 136
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 121,
                            "end": 138
                          }
                        }
                      },
                      "span": {
                        "start": 121,
                        "end": 139
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 98,
                "end": 145
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 157,
                      "end": 159
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "StaticMethodCall": {
                              "class": {
                                "kind": {
                                  "StaticPropertyAccess": {
                                    "class": {
                                      "kind": {
                                        "Name": {
                                          "parts": [
                                            "parent"
                                          ],
                                          "kind": "Unqualified",
                                          "span": {
                                            "start": 177,
                                            "end": 183
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 177,
                                        "end": 183
                                      }
                                    },
                                    "member": {
                                      "kind": {
                                        "Identifier": "b"
                                      },
                                      "span": {
                                        "start": 185,
                                        "end": 187
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 177,
                                  "end": 187
                                }
                              },
                              "method": {
                                "kind": {
                                  "Identifier": "get"
                                },
                                "span": {
                                  "start": 189,
                                  "end": 192
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 177,
                            "end": 194
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 170,
                        "end": 195
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "StaticMethodCall": {
                                    "class": {
                                      "kind": {
                                        "StaticPropertyAccess": {
                                          "class": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "parent"
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
                                              "Identifier": "a"
                                            },
                                            "span": {
                                              "start": 230,
                                              "end": 232
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 222,
                                        "end": 232
                                      }
                                    },
                                    "method": {
                                      "kind": {
                                        "Identifier": "get"
                                      },
                                      "span": {
                                        "start": 234,
                                        "end": 237
                                      }
                                    },
                                    "args": []
                                  }
                                },
                                "span": {
                                  "start": 222,
                                  "end": 239
                                }
                              }
                            },
                            "span": {
                              "start": 222,
                              "end": 240
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
                                        "start": 253,
                                        "end": 255
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "ArrowFunction": {
                                          "is_static": false,
                                          "by_ref": false,
                                          "params": [],
                                          "return_type": null,
                                          "body": {
                                            "kind": {
                                              "StaticMethodCall": {
                                                "class": {
                                                  "kind": {
                                                    "StaticPropertyAccess": {
                                                      "class": {
                                                        "kind": {
                                                          "Name": {
                                                            "parts": [
                                                              "parent"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 266,
                                                              "end": 272
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 266,
                                                          "end": 272
                                                        }
                                                      },
                                                      "member": {
                                                        "kind": {
                                                          "Identifier": "a"
                                                        },
                                                        "span": {
                                                          "start": 274,
                                                          "end": 276
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 266,
                                                    "end": 276
                                                  }
                                                },
                                                "method": {
                                                  "kind": {
                                                    "Identifier": "set"
                                                  },
                                                  "span": {
                                                    "start": 278,
                                                    "end": 281
                                                  }
                                                },
                                                "args": [
                                                  {
                                                    "name": null,
                                                    "kind": {
                                                      "Value": {
                                                        "kind": {
                                                          "Variable": "value"
                                                        },
                                                        "span": {
                                                          "start": 282,
                                                          "end": 288
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 282,
                                                      "end": 288
                                                    }
                                                  }
                                                ]
                                              }
                                            },
                                            "span": {
                                              "start": 266,
                                              "end": 289
                                            }
                                          },
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 258,
                                        "end": 289
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 253,
                                  "end": 289
                                }
                              }
                            },
                            "span": {
                              "start": 253,
                              "end": 290
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
                                        "start": 303,
                                        "end": 305
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
                                                  "StaticPropertyAccess": {
                                                    "class": {
                                                      "kind": {
                                                        "Name": {
                                                          "parts": [
                                                            "parent"
                                                          ],
                                                          "kind": "Unqualified",
                                                          "span": {
                                                            "start": 308,
                                                            "end": 314
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 308,
                                                        "end": 314
                                                      }
                                                    },
                                                    "member": {
                                                      "kind": {
                                                        "Identifier": "a"
                                                      },
                                                      "span": {
                                                        "start": 316,
                                                        "end": 318
                                                      }
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 308,
                                                  "end": 318
                                                }
                                              },
                                              "method": {
                                                "kind": {
                                                  "Identifier": "set"
                                                },
                                                "span": {
                                                  "start": 320,
                                                  "end": 323
                                                }
                                              }
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 308,
                                        "end": 328
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 303,
                                  "end": 328
                                }
                              }
                            },
                            "span": {
                              "start": 303,
                              "end": 329
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 204,
                        "end": 339
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 150,
                "end": 345
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 74,
        "end": 347
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 347
  }
}
