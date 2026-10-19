===source===
<?php
class B extends A {
    public $a = 1 { get => 2; }
    public int $b = 1 { set { } }
    public ?string $c = null { get => "x"; }
}
$o = new class extends A {
    public $d = 1 { get => 2; }
};
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
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
              "A"
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
                      "start": 37,
                      "end": 39
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
                      "start": 42,
                      "end": 43
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 53,
                            "end": 54
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 55
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 30,
                "end": 57
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 73,
                      "end": 75
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
                          "start": 69,
                          "end": 72
                        }
                      }
                    },
                    "span": {
                      "start": 69,
                      "end": 72
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 78,
                      "end": 79
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 82,
                        "end": 89
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 62,
                "end": 91
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "c",
                    "span": {
                      "start": 111,
                      "end": 113
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
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 104,
                              "end": 110
                            }
                          }
                        },
                        "span": {
                          "start": 104,
                          "end": 110
                        }
                      }
                    },
                    "span": {
                      "start": 103,
                      "end": 110
                    }
                  },
                  "default": {
                    "kind": "Null",
                    "span": {
                      "start": 116,
                      "end": 120
                    }
                  },
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "String": "x"
                          },
                          "span": {
                            "start": 130,
                            "end": 133
                          }
                        }
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 123,
                        "end": 134
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 96,
                "end": 136
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 138
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "o"
                },
                "span": {
                  "start": 139,
                  "end": 141
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
                          "extends": {
                            "parts": [
                              "A"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 162,
                              "end": 163
                            }
                          },
                          "implements": [],
                          "members": [
                            {
                              "kind": {
                                "Property": {
                                  "name": {
                                    "name": "d",
                                    "span": {
                                      "start": 177,
                                      "end": 179
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
                                      "start": 182,
                                      "end": 183
                                    }
                                  },
                                  "attributes": [],
                                  "hooks": [
                                    {
                                      "kind": "Get",
                                      "body": {
                                        "Expression": {
                                          "kind": {
                                            "Int": 2
                                          },
                                          "span": {
                                            "start": 193,
                                            "end": 194
                                          }
                                        }
                                      },
                                      "by_ref": false,
                                      "params": [],
                                      "attributes": [],
                                      "span": {
                                        "start": 186,
                                        "end": 195
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 170,
                                "end": 197
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 144,
                        "end": 199
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 144,
                  "end": 199
                }
              }
            }
          },
          "span": {
            "start": 139,
            "end": 199
          }
        }
      },
      "span": {
        "start": 139,
        "end": 200
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 200
  }
}
