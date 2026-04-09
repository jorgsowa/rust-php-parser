===config===
min_php=8.4
===source===
<?php
class Foo {
    public function __construct(
        public string $name {
            get => strtoupper($this->name);
            set(string $value) { $this->name = trim($value); }
        },
    ) {}
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
                              "start": 66,
                              "end": 72,
                              "start_line": 4,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 66,
                          "end": 72,
                          "start_line": 4,
                          "start_col": 15
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
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
                                      "start": 100,
                                      "end": 110,
                                      "start_line": 5,
                                      "start_col": 19
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
                                                "start": 111,
                                                "end": 116,
                                                "start_line": 5,
                                                "start_col": 30
                                              }
                                            },
                                            "property": {
                                              "kind": {
                                                "Identifier": "name"
                                              },
                                              "span": {
                                                "start": 118,
                                                "end": 122,
                                                "start_line": 5,
                                                "start_col": 37
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 111,
                                          "end": 122,
                                          "start_line": 5,
                                          "start_col": 30
                                        }
                                      },
                                      "unpack": false,
                                      "by_ref": false,
                                      "span": {
                                        "start": 111,
                                        "end": 122,
                                        "start_line": 5,
                                        "start_col": 30
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 100,
                                "end": 123,
                                "start_line": 5,
                                "start_col": 19
                              }
                            }
                          },
                          "is_final": false,
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 93,
                            "end": 137,
                            "start_line": 5,
                            "start_col": 12
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
                                                  "start": 158,
                                                  "end": 163,
                                                  "start_line": 6,
                                                  "start_col": 33
                                                }
                                              },
                                              "property": {
                                                "kind": {
                                                  "Identifier": "name"
                                                },
                                                "span": {
                                                  "start": 165,
                                                  "end": 169,
                                                  "start_line": 6,
                                                  "start_col": 40
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 158,
                                            "end": 169,
                                            "start_line": 6,
                                            "start_col": 33
                                          }
                                        },
                                        "op": "Assign",
                                        "value": {
                                          "kind": {
                                            "FunctionCall": {
                                              "name": {
                                                "kind": {
                                                  "Identifier": "trim"
                                                },
                                                "span": {
                                                  "start": 172,
                                                  "end": 176,
                                                  "start_line": 6,
                                                  "start_col": 47
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
                                                      "start": 177,
                                                      "end": 183,
                                                      "start_line": 6,
                                                      "start_col": 52
                                                    }
                                                  },
                                                  "unpack": false,
                                                  "by_ref": false,
                                                  "span": {
                                                    "start": 177,
                                                    "end": 183,
                                                    "start_line": 6,
                                                    "start_col": 52
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 172,
                                            "end": 184,
                                            "start_line": 6,
                                            "start_col": 47
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 158,
                                      "end": 184,
                                      "start_line": 6,
                                      "start_col": 33
                                    }
                                  }
                                },
                                "span": {
                                  "start": 158,
                                  "end": 186,
                                  "start_line": 6,
                                  "start_col": 33
                                }
                              }
                            ]
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
                                      "start": 141,
                                      "end": 147,
                                      "start_line": 6,
                                      "start_col": 16
                                    }
                                  }
                                },
                                "span": {
                                  "start": 141,
                                  "end": 147,
                                  "start_line": 6,
                                  "start_col": 16
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
                                "start": 141,
                                "end": 154,
                                "start_line": 6,
                                "start_col": 16
                              }
                            }
                          ],
                          "attributes": [],
                          "span": {
                            "start": 137,
                            "end": 196,
                            "start_line": 6,
                            "start_col": 12
                          }
                        }
                      ],
                      "span": {
                        "start": 59,
                        "end": 197,
                        "start_line": 4,
                        "start_col": 8
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 208,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 209,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 209,
    "start_line": 1,
    "start_col": 0
  }
}
