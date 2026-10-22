===source===
<?php
class Foo {
    public string $name {
        get => strtoupper($this->name);
        set(string $value) => strtolower($value);
    }
    public int $count {
        get { return $this->count; }
        set { $this->count = max(0, $value); }
    }
    public int $id {
        &get { return $this->id; }
    }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
'property hooks' requires PHP 8.4 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "name",
                    "span": {
                      "start": 36,
                      "end": 41
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
                          "start": 29,
                          "end": 35
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 35
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "strtoupper"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 59,
                                      "end": 69
                                    }
                                  }
                                },
                                "span": {
                                  "start": 59,
                                  "end": 69
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "kind": {
                                    "Value": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 70,
                                              "end": 75
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "name"
                                            },
                                            "span": {
                                              "start": 77,
                                              "end": 81
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 70,
                                        "end": 81
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 70,
                                    "end": 81
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 82
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 52,
                        "end": 83
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "FunctionCall": {
                              "name": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "strtolower"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 114,
                                      "end": 124
                                    }
                                  }
                                },
                                "span": {
                                  "start": 114,
                                  "end": 124
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
                                        "start": 125,
                                        "end": 131
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 125,
                                    "end": 131
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 114,
                            "end": 132
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "value",
                            "span": {
                              "start": 103,
                              "end": 109
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "string"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 96,
                                  "end": 102
                                }
                              }
                            },
                            "span": {
                              "start": 96,
                              "end": 102
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 96,
                            "end": 109
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 92,
                        "end": 133
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 139
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "count",
                    "span": {
                      "start": 155,
                      "end": 161
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
                          "start": 151,
                          "end": 154
                        }
                      }
                    },
                    "span": {
                      "start": 151,
                      "end": 154
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
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
                                        "start": 185,
                                        "end": 190
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "count"
                                      },
                                      "span": {
                                        "start": 192,
                                        "end": 197
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 185,
                                  "end": 197
                                }
                              }
                            },
                            "span": {
                              "start": 178,
                              "end": 198
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 172,
                        "end": 200
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
                                  "Assign": {
                                    "target": {
                                      "kind": {
                                        "PropertyAccess": {
                                          "object": {
                                            "kind": {
                                              "Variable": "this"
                                            },
                                            "span": {
                                              "start": 215,
                                              "end": 220
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "count"
                                            },
                                            "span": {
                                              "start": 222,
                                              "end": 227
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 215,
                                        "end": 227
                                      }
                                    },
                                    "op": "Assign",
                                    "value": {
                                      "kind": {
                                        "FunctionCall": {
                                          "name": {
                                            "kind": {
                                              "Name": {
                                                "parts": [
                                                  "max"
                                                ],
                                                "kind": "Unqualified",
                                                "span": {
                                                  "start": 230,
                                                  "end": 233
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 230,
                                              "end": 233
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Int": 0
                                                  },
                                                  "span": {
                                                    "start": 234,
                                                    "end": 235
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 234,
                                                "end": 235
                                              }
                                            },
                                            {
                                              "name": null,
                                              "kind": {
                                                "Value": {
                                                  "kind": {
                                                    "Variable": "value"
                                                  },
                                                  "span": {
                                                    "start": 237,
                                                    "end": 243
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 237,
                                                "end": 243
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 230,
                                        "end": 244
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 215,
                                  "end": 244
                                }
                              }
                            },
                            "span": {
                              "start": 215,
                              "end": 245
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 209,
                        "end": 247
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 144,
                "end": 253
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "id",
                    "span": {
                      "start": 269,
                      "end": 272
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
                          "start": 265,
                          "end": 268
                        }
                      }
                    },
                    "span": {
                      "start": 265,
                      "end": 268
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
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
                                        "start": 297,
                                        "end": 302
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "id"
                                      },
                                      "span": {
                                        "start": 304,
                                        "end": 306
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 297,
                                  "end": 306
                                }
                              }
                            },
                            "span": {
                              "start": 290,
                              "end": 307
                            }
                          }
                        ]
                      },
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 283,
                        "end": 309
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 258,
                "end": 315
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 317
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 317
  }
}
