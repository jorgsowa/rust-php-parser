===source===
<?php
class User {
    public string $name;
    private int $age = 0;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getName(): string {
        return $this->name;
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "User",
            "span": {
              "start": 12,
              "end": 16
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
                      "start": 37,
                      "end": 42
                    }
                  },
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
                          "start": 30,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 42
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "age",
                    "span": {
                      "start": 60,
                      "end": 64
                    }
                  },
                  "visibility": "Private",
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
                          "start": 56,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 67,
                      "end": 68
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 48,
                "end": 68
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 91,
                      "end": 102
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "name",
                        "span": {
                          "start": 110,
                          "end": 115
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
                              "start": 103,
                              "end": 109
                            }
                          }
                        },
                        "span": {
                          "start": 103,
                          "end": 109
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
                        "start": 103,
                        "end": 115
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [
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
                                        "start": 127,
                                        "end": 132
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "name"
                                      },
                                      "span": {
                                        "start": 134,
                                        "end": 138
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 127,
                                  "end": 138
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "name"
                                },
                                "span": {
                                  "start": 141,
                                  "end": 146
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 127,
                            "end": 146
                          }
                        }
                      },
                      "span": {
                        "start": 127,
                        "end": 147
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 75,
                "end": 153
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "getName",
                    "span": {
                      "start": 175,
                      "end": 182
                    }
                  },
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 186,
                          "end": 192
                        }
                      }
                    },
                    "span": {
                      "start": 186,
                      "end": 192
                    }
                  },
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
                                  "start": 210,
                                  "end": 215
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "name"
                                },
                                "span": {
                                  "start": 217,
                                  "end": 221
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 210,
                            "end": 221
                          }
                        }
                      },
                      "span": {
                        "start": 203,
                        "end": 222
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 228
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 230
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 230
  }
}
