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
          "name": "User",
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
                          "start": 30,
                          "end": 36,
                          "start_line": 3,
                          "start_col": 11
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36,
                      "start_line": 3,
                      "start_col": 11
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 42,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "age",
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
                          "end": 59,
                          "start_line": 4,
                          "start_col": 12
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59,
                      "start_line": 4,
                      "start_col": 12
                    }
                  },
                  "default": {
                    "kind": {
                      "Int": 0
                    },
                    "span": {
                      "start": 67,
                      "end": 68,
                      "start_line": 4,
                      "start_col": 23
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 48,
                "end": 68,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "__construct",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "name",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 103,
                              "end": 109,
                              "start_line": 6,
                              "start_col": 32
                            }
                          }
                        },
                        "span": {
                          "start": 103,
                          "end": 109,
                          "start_line": 6,
                          "start_col": 32
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
                        "end": 115,
                        "start_line": 6,
                        "start_col": 32
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
                                        "end": 132,
                                        "start_line": 7,
                                        "start_col": 8
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "name"
                                      },
                                      "span": {
                                        "start": 134,
                                        "end": 138,
                                        "start_line": 7,
                                        "start_col": 15
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 127,
                                  "end": 138,
                                  "start_line": 7,
                                  "start_col": 8
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "Variable": "name"
                                },
                                "span": {
                                  "start": 141,
                                  "end": 146,
                                  "start_line": 7,
                                  "start_col": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 127,
                            "end": 146,
                            "start_line": 7,
                            "start_col": 8
                          }
                        }
                      },
                      "span": {
                        "start": 127,
                        "end": 152,
                        "start_line": 7,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 75,
                "end": 159,
                "start_line": 6,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "getName",
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
                          "end": 192,
                          "start_line": 10,
                          "start_col": 31
                        }
                      }
                    },
                    "span": {
                      "start": 186,
                      "end": 192,
                      "start_line": 10,
                      "start_col": 31
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
                                  "end": 215,
                                  "start_line": 11,
                                  "start_col": 15
                                }
                              },
                              "property": {
                                "kind": {
                                  "Identifier": "name"
                                },
                                "span": {
                                  "start": 217,
                                  "end": 221,
                                  "start_line": 11,
                                  "start_col": 22
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 210,
                            "end": 221,
                            "start_line": 11,
                            "start_col": 15
                          }
                        }
                      },
                      "span": {
                        "start": 203,
                        "end": 227,
                        "start_line": 11,
                        "start_col": 8
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 159,
                "end": 229,
                "start_line": 10,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 230,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 230,
    "start_line": 1,
    "start_col": 0
  }
}
