===source===
<?php
class C {
    const A = [new Foo];
    public static $b = new Foo;
    public $c, $d = new Foo;
    const E = (object) [];
    public $f = (object) [];
}
enum E: int {
    case A = new Foo;
    const B = (object) [];
}
interface I {
    const A = new Foo;
}
===errors===
New expressions are not supported in this context
New expressions are not supported in this context
New expressions are not supported in this context
Object casts are not supported in this context
Object casts are not supported in this context
New expressions are not supported in this context
Object casts are not supported in this context
New expressions are not supported in this context
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 9
===php_error >=8.1===
PHP Fatal error:  New expressions are not supported in this context in Standard input code on line 3
===ast===
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
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Array": [
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
                                          "Foo"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 35,
                                          "end": 38
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 35,
                                      "end": 38
                                    }
                                  },
                                  "args": []
                                }
                              },
                              "span": {
                                "start": 31,
                                "end": 38
                              }
                            }
                          },
                          "span": {
                            "start": 31,
                            "end": 38
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 30,
                      "end": 39
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 40
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 59,
                      "end": 61
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 68,
                                "end": 71
                              }
                            }
                          },
                          "span": {
                            "start": 68,
                            "end": 71
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 64,
                      "end": 71
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 45,
                "end": 71
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 84,
                      "end": 86
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 77,
                "end": 86
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 88,
                      "end": 90
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 97,
                                "end": 100
                              }
                            }
                          },
                          "span": {
                            "start": 97,
                            "end": 100
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 93,
                      "end": 100
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 77,
                "end": 100
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "E",
                    "span": {
                      "start": 112,
                      "end": 113
                    }
                  },
                  "value": {
                    "kind": {
                      "Cast": [
                        "Object",
                        {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 125,
                            "end": 127
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 116,
                      "end": 127
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 106,
                "end": 128
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 140,
                      "end": 142
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Cast": [
                        "Object",
                        {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 154,
                            "end": 156
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 145,
                      "end": 156
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 133,
                "end": 156
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 159
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 165,
              "end": 166
            }
          },
          "scalar_type": {
            "parts": [
              "int"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 168,
              "end": 171
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 183,
                      "end": 184
                    }
                  },
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 191,
                                "end": 194
                              }
                            }
                          },
                          "span": {
                            "start": 191,
                            "end": 194
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 187,
                      "end": 194
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 178,
                "end": 195
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
                    "span": {
                      "start": 206,
                      "end": 207
                    }
                  },
                  "value": {
                    "kind": {
                      "Cast": [
                        "Object",
                        {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 219,
                            "end": 221
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 210,
                      "end": 221
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 200,
                "end": 222
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 160,
        "end": 224
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 235,
              "end": 236
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 249,
                      "end": 250
                    }
                  },
                  "value": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "Foo"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 257,
                                "end": 260
                              }
                            }
                          },
                          "span": {
                            "start": 257,
                            "end": 260
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 253,
                      "end": 260
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 243,
                "end": 261
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 225,
        "end": 263
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 263
  }
}
