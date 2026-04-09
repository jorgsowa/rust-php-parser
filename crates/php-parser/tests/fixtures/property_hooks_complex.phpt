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
                          "end": 35,
                          "start_line": 3,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 35,
                      "start_line": 3,
                      "start_col": 11
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
                                  "end": 69,
                                  "start_line": 4,
                                  "start_col": 15
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
                                            "end": 75,
                                            "start_line": 4,
                                            "start_col": 26
                                          }
                                        },
                                        "property": {
                                          "kind": {
                                            "Identifier": "name"
                                          },
                                          "span": {
                                            "start": 77,
                                            "end": 81,
                                            "start_line": 4,
                                            "start_col": 33
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 70,
                                      "end": 81,
                                      "start_line": 4,
                                      "start_col": 26
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 70,
                                    "end": 81,
                                    "start_line": 4,
                                    "start_col": 26
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 59,
                            "end": 82,
                            "start_line": 4,
                            "start_col": 15
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 52,
                        "end": 92,
                        "start_line": 4,
                        "start_col": 8
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
                                  "end": 124,
                                  "start_line": 5,
                                  "start_col": 30
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
                                      "end": 131,
                                      "start_line": 5,
                                      "start_col": 41
                                    }
                                  },
                                  "unpack": false,
                                  "by_ref": false,
                                  "span": {
                                    "start": 125,
                                    "end": 131,
                                    "start_line": 5,
                                    "start_col": 41
                                  }
                                }
                              ]
                            }
                          },
                          "span": {
                            "start": 114,
                            "end": 132,
                            "start_line": 5,
                            "start_col": 30
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
                                  "end": 102,
                                  "start_line": 5,
                                  "start_col": 12
                                }
                              }
                            },
                            "span": {
                              "start": 96,
                              "end": 102,
                              "start_line": 5,
                              "start_col": 12
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
                            "end": 109,
                            "start_line": 5,
                            "start_col": 12
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 92,
                        "end": 138,
                        "start_line": 5,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 144,
                "start_line": 3,
                "start_col": 4
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
                          "end": 154,
                          "start_line": 7,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 151,
                      "end": 154,
                      "start_line": 7,
                      "start_col": 11
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
                                        "end": 190,
                                        "start_line": 8,
                                        "start_col": 21
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "count"
                                      },
                                      "span": {
                                        "start": 192,
                                        "end": 197,
                                        "start_line": 8,
                                        "start_col": 28
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 185,
                                  "end": 197,
                                  "start_line": 8,
                                  "start_col": 21
                                }
                              }
                            },
                            "span": {
                              "start": 178,
                              "end": 199,
                              "start_line": 8,
                              "start_col": 14
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
                        "end": 209,
                        "start_line": 8,
                        "start_col": 8
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
                                              "end": 220,
                                              "start_line": 9,
                                              "start_col": 14
                                            }
                                          },
                                          "property": {
                                            "kind": {
                                              "Identifier": "count"
                                            },
                                            "span": {
                                              "start": 222,
                                              "end": 227,
                                              "start_line": 9,
                                              "start_col": 21
                                            }
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 215,
                                        "end": 227,
                                        "start_line": 9,
                                        "start_col": 14
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
                                              "end": 233,
                                              "start_line": 9,
                                              "start_col": 29
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
                                                  "end": 235,
                                                  "start_line": 9,
                                                  "start_col": 33
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 234,
                                                "end": 235,
                                                "start_line": 9,
                                                "start_col": 33
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
                                                  "end": 243,
                                                  "start_line": 9,
                                                  "start_col": 36
                                                }
                                              },
                                              "unpack": false,
                                              "by_ref": false,
                                              "span": {
                                                "start": 237,
                                                "end": 243,
                                                "start_line": 9,
                                                "start_col": 36
                                              }
                                            }
                                          ]
                                        }
                                      },
                                      "span": {
                                        "start": 230,
                                        "end": 244,
                                        "start_line": 9,
                                        "start_col": 29
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 215,
                                  "end": 244,
                                  "start_line": 9,
                                  "start_col": 14
                                }
                              }
                            },
                            "span": {
                              "start": 215,
                              "end": 246,
                              "start_line": 9,
                              "start_col": 14
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
                        "end": 252,
                        "start_line": 9,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 144,
                "end": 258,
                "start_line": 7,
                "start_col": 4
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
                          "end": 268,
                          "start_line": 11,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 265,
                      "end": 268,
                      "start_line": 11,
                      "start_col": 11
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
                                        "end": 302,
                                        "start_line": 12,
                                        "start_col": 22
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "id"
                                      },
                                      "span": {
                                        "start": 304,
                                        "end": 306,
                                        "start_line": 12,
                                        "start_col": 29
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 297,
                                  "end": 306,
                                  "start_line": 12,
                                  "start_col": 22
                                }
                              }
                            },
                            "span": {
                              "start": 290,
                              "end": 308,
                              "start_line": 12,
                              "start_col": 15
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
                        "end": 314,
                        "start_line": 12,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 258,
                "end": 316,
                "start_line": 11,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 317,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 317,
    "start_line": 1,
    "start_col": 0
  }
}
