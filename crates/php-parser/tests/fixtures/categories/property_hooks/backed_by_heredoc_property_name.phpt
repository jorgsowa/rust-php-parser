===source===
<?php
class C1 { public int $p = 1 { get => $this->{<<<'X'
p
X}; } }
class C2 { public int $p = 1 { get => $this->{<<<X
p
X}; } }
class C3 { public int $p = 1 { get => ${<<<'X'
this
X}->p; } }
class C4 { public int $p = 1 { get => $this->{<<<X
  p
  X . ''}; } }
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C1",
            "span": {
              "start": 12,
              "end": 14
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
                    "name": "p",
                    "span": {
                      "start": 28,
                      "end": 30
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 24,
                          "end": 27
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 27
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 33,
                      "end": 34
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 44,
                                  "end": 49
                                }
                              },
                              "property": {
                                "kind": {
                                  "Nowdoc": {
                                    "label": "X",
                                    "value": "p"
                                  }
                                },
                                "span": {
                                  "start": 52,
                                  "end": 62
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 44,
                            "end": 62
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 37,
                        "end": 64
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 17,
                "end": 66
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C2",
            "span": {
              "start": 75,
              "end": 77
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
                    "name": "p",
                    "span": {
                      "start": 91,
                      "end": 93
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 87,
                          "end": 90
                        }
                      }
                    },
                    "span": {
                      "start": 87,
                      "end": 90
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 96,
                      "end": 97
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 107,
                                  "end": 112
                                }
                              },
                              "property": {
                                "kind": {
                                  "Heredoc": {
                                    "label": "X",
                                    "parts": [
                                      {
                                        "Literal": "p"
                                      }
                                    ]
                                  }
                                },
                                "span": {
                                  "start": 115,
                                  "end": 123
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 107,
                            "end": 123
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 100,
                        "end": 125
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 80,
                "end": 127
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 69,
        "end": 129
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C3",
            "span": {
              "start": 136,
              "end": 138
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
                    "name": "p",
                    "span": {
                      "start": 152,
                      "end": 154
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 148,
                          "end": 151
                        }
                      }
                    },
                    "span": {
                      "start": 148,
                      "end": 151
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 157,
                      "end": 158
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "VariableVariable": {
                                    "kind": {
                                      "Nowdoc": {
                                        "label": "X",
                                        "value": "this"
                                      }
                                    },
                                    "span": {
                                      "start": 170,
                                      "end": 183
                                    }
                                  }
                                },
                                "span": {
                                  "start": 168,
                                  "end": 184
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "p"
                                },
                                "span": {
                                  "start": 186,
                                  "end": 187
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 168,
                            "end": 187
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 161,
                        "end": 188
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 141,
                "end": 190
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 130,
        "end": 192
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C4",
            "span": {
              "start": 199,
              "end": 201
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
                    "name": "p",
                    "span": {
                      "start": 215,
                      "end": 217
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 211,
                          "end": 214
                        }
                      }
                    },
                    "span": {
                      "start": 211,
                      "end": 214
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 220,
                      "end": 221
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 231,
                                  "end": 236
                                }
                              },
                              "property": {
                                "kind": {
                                  "Binary": {
                                    "left": {
                                      "kind": {
                                        "Heredoc": {
                                          "label": "X",
                                          "parts": [
                                            {
                                              "Literal": "p"
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 239,
                                        "end": 251
                                      }
                                    },
                                    "op": "Concat",
                                    "right": {
                                      "kind": {
                                        "String": ""
                                      },
                                      "span": {
                                        "start": 254,
                                        "end": 256
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 239,
                                  "end": 256
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 231,
                            "end": 256
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 224,
                        "end": 258
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 204,
                "end": 260
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 193,
        "end": 262
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 262
  }
}
