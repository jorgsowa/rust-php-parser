===source===
<?php
namespace N;

enum E
{
    case A;
    public string $name;
    var $a, $b = 1;
    public static ?int $c = null;
    #[Attr]
    private readonly int $d;

    public function f() { return $this->name; }
}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Enums may not include properties
Enums may not include properties
Enums may not include properties
Enums may not include properties
===errors 8.1===
Enums may not include properties
Enums may not include properties
Enums may not include properties
Enums may not include properties
===errors >=8.2===
Enum N\E cannot include properties
Enum N\E cannot include properties
Enum N\E cannot include properties
Enum N\E cannot include properties
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 4
===php_error 8.1===
PHP Fatal error:  Enums may not include properties in Standard input code on line 7
===php_error >=8.2===
PHP Fatal error:  Enum N\E cannot include properties in Standard input code on line 7
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 25,
              "end": 26
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
                      "start": 38,
                      "end": 39
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 40
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "name",
                    "span": {
                      "start": 59,
                      "end": 64
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 52,
                          "end": 58
                        }
                      }
                    },
                    "span": {
                      "start": 52,
                      "end": 58
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 45,
                "end": 64
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 74,
                      "end": 76
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
                "start": 70,
                "end": 76
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 78,
                      "end": 80
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 83,
                      "end": 84
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 78,
                "end": 84
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 109,
                      "end": 111
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 105,
                              "end": 108
                            }
                          }
                        },
                        "span": {
                          "start": 105,
                          "end": 108
                        }
                      }
                    },
                    "span": {
                      "start": 104,
                      "end": 108
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 114,
                      "end": 118
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 90,
                "end": 118
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 157,
                      "end": 159
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 153,
                          "end": 156
                        }
                      }
                    },
                    "span": {
                      "start": 153,
                      "end": 156
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 136,
                "end": 159
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 182,
                      "end": 183
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 195,
                                  "end": 200
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "name"
                                },
                                "span": {
                                  "start": 202,
                                  "end": 206
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 195,
                            "end": 206
                          }
                        }
                      },
                      "span": {
                        "start": 188,
                        "end": 207
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 166,
                "end": 209
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 20,
        "end": 211
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 211
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "N"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 25,
              "end": 26
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
                      "start": 38,
                      "end": 39
                    }
                  },
                  "value": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 33,
                "end": 40
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "name",
                    "span": {
                      "start": 59,
                      "end": 64
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 52,
                          "end": 58
                        }
                      }
                    },
                    "span": {
                      "start": 52,
                      "end": 58
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 45,
                "end": 64
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 74,
                      "end": 76
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
                "start": 70,
                "end": 76
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 78,
                      "end": 80
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 83,
                      "end": 84
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 78,
                "end": 84
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 109,
                      "end": 111
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 105,
                              "end": 108
                            }
                          }
                        },
                        "span": {
                          "start": 105,
                          "end": 108
                        }
                      }
                    },
                    "span": {
                      "start": 104,
                      "end": 108
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 114,
                      "end": 118
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 90,
                "end": 118
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 157,
                      "end": 159
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 153,
                          "end": 156
                        }
                      }
                    },
                    "span": {
                      "start": 153,
                      "end": 156
                    }
                  },
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Attr"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 126,
                          "end": 130
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 126,
                        "end": 130
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 124,
                "end": 159
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 182,
                      "end": 183
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "PropertyAccess": {
                              "object": {
                                "kind": {
                                  "Variable": "this"
                                },
                                "span": {
                                  "start": 195,
                                  "end": 200
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "name"
                                },
                                "span": {
                                  "start": 202,
                                  "end": 206
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 195,
                            "end": 206
                          }
                        }
                      },
                      "span": {
                        "start": 188,
                        "end": 207
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 166,
                "end": 209
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 20,
        "end": 211
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 211
  }
}
