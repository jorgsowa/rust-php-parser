===config===
min_php=8.4
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
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
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
                  "name": "name",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                                  "Identifier": "strtoupper"
                                },
                                "span": {
                                  "start": 59,
                                  "end": 69
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
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
                                  },
                                  "unpack": false,
                                  "by_ref": false,
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
                      "is_final": false,
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
                                  "Identifier": "strtolower"
                                },
                                "span": {
                                  "start": 114,
                                  "end": 124
                                }
                              },
                              "args": [
                                {
                                  "name": null,
                                  "value": {
                                    "kind": {
                                      "Variable": "value"
                                    },
                                    "span": {
                                      "start": 125,
                                      "end": 131
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
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
                      "is_final": false,
                      "by_ref": false,
                      "params": [
                        {
                          "name": "value",
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
                          "is_readonly": false,
                          "is_final": false,
                          "visibility": null,
                          "set_visibility": null,
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
                  "name": "count",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                      "is_final": false,
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
                                              "Identifier": "max"
                                            },
                                            "span": {
                                              "start": 230,
                                              "end": 233
                                            }
                                          },
                                          "args": [
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Int": 0
                                                },
                                                "span": {
                                                  "start": 234,
                                                  "end": 235
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 234,
                                                "end": 235
                                              }
                                            },
                                            {
                                              "name": null,
                                              "value": {
                                                "kind": {
                                                  "Variable": "value"
                                                },
                                                "span": {
                                                  "start": 237,
                                                  "end": 243
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
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
                      "is_final": false,
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
                  "name": "id",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
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
                      "is_final": false,
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
