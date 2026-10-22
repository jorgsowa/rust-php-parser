===source===
<?php
class C {
    public Foo $a { set(callable $v) {} }
    public ?Foo $b { set(callable|null $v) {} }
    public Closure|int $c { set(callable|int $v) {} }
    public A&B $d { set(callable $v) {} }
    public self $e { set(callable $v) {} }
}
===errors 8.4===
Type of parameter $v of hook C::$a::set must be compatible with property type
Type of parameter $v of hook C::$b::set must be compatible with property type
Type of parameter $v of hook C::$c::set must be compatible with property type
Type of parameter $v of hook C::$d::set must be compatible with property type
Type of parameter $v of hook C::$e::set must be compatible with property type
===errors >=8.5===
Type of parameter $v of hook C::$d::set must be compatible with property type
Type of parameter $v of hook C::$e::set must be compatible with property type
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error 8.4===
PHP Fatal error:  Type of parameter $v of hook C::$a::set must be compatible with property type in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Type of parameter $v of hook C::$d::set must be compatible with property type in Standard input code on line 6
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                      "start": 31,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Foo"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 30
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 49,
                              "end": 51
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
                                  "start": 40,
                                  "end": 48
                                }
                              }
                            },
                            "span": {
                              "start": 40,
                              "end": 48
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 40,
                            "end": 51
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 36,
                        "end": 55
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 57
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 74,
                      "end": 76
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 70,
                              "end": 73
                            }
                          }
                        },
                        "span": {
                          "start": 70,
                          "end": 73
                        }
                      }
                    },
                    "span": {
                      "start": 69,
                      "end": 73
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 97,
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
                                        "callable"
                                      ],
                                      "kind": "Unqualified",
                                      "span": {
                                        "start": 83,
                                        "end": 91
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 83,
                                    "end": 91
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
                                        "start": 92,
                                        "end": 96
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 92,
                                    "end": 96
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 83,
                              "end": 96
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 83,
                            "end": 99
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 79,
                        "end": 103
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 62,
                "end": 105
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 129,
                      "end": 131
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Closure"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 117,
                                "end": 124
                              }
                            }
                          },
                          "span": {
                            "start": 117,
                            "end": 124
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
                                "start": 125,
                                "end": 128
                              }
                            }
                          },
                          "span": {
                            "start": 125,
                            "end": 128
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 117,
                      "end": 128
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 151,
                              "end": 153
                            }
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
                                        "start": 138,
                                        "end": 146
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 138,
                                    "end": 146
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
                                        "start": 147,
                                        "end": 150
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 147,
                                    "end": 150
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 138,
                              "end": 150
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 138,
                            "end": 153
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 134,
                        "end": 157
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 110,
                "end": 159
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 175,
                      "end": 177
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 171,
                                "end": 172
                              }
                            }
                          },
                          "span": {
                            "start": 171,
                            "end": 172
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "B"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 173,
                                "end": 174
                              }
                            }
                          },
                          "span": {
                            "start": 173,
                            "end": 174
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 171,
                      "end": 174
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 193,
                              "end": 195
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
                                  "start": 184,
                                  "end": 192
                                }
                              }
                            },
                            "span": {
                              "start": 184,
                              "end": 192
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 184,
                            "end": 195
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 180,
                        "end": 199
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 164,
                "end": 201
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "e",
                    "span": {
                      "start": 218,
                      "end": 220
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 213,
                          "end": 217
                        }
                      }
                    },
                    "span": {
                      "start": 213,
                      "end": 217
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 236,
                              "end": 238
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
                                  "start": 227,
                                  "end": 235
                                }
                              }
                            },
                            "span": {
                              "start": 227,
                              "end": 235
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 227,
                            "end": 238
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 223,
                        "end": 242
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 206,
                "end": 244
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 246
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 246
  }
}
