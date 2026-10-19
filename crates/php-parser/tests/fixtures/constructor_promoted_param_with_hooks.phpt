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
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 38,
                      "end": 49
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
                          "start": 73,
                          "end": 78
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
                              "start": 66,
                              "end": 72
                            }
                          }
                        },
                        "span": {
                          "start": 66,
                          "end": 72
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
                                      "Name": {
                                        "parts": [
                                          "strtoupper"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 100,
                                          "end": 110
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 100,
                                      "end": 110
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
                                                  "start": 111,
                                                  "end": 116
                                                }
                                              },
                                              "property": {
                                                "kind": {
                                                  "Identifier": "name"
                                                },
                                                "span": {
                                                  "start": 118,
                                                  "end": 122
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 111,
                                            "end": 122
                                          }
                                        }
                                      },
                                      "span": {
                                        "start": 111,
                                        "end": 122
                                      }
                                    }
                                  ]
                                }
                              },
                              "span": {
                                "start": 100,
                                "end": 123
                              }
                            }
                          },
                          "is_final": false,
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 93,
                            "end": 124
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
                                                  "end": 163
                                                }
                                              },
                                              "property": {
                                                "kind": {
                                                  "Identifier": "name"
                                                },
                                                "span": {
                                                  "start": 165,
                                                  "end": 169
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 158,
                                            "end": 169
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
                                                      "trim"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 172,
                                                      "end": 176
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 172,
                                                  "end": 176
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
                                                        "start": 177,
                                                        "end": 183
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 177,
                                                    "end": 183
                                                  }
                                                }
                                              ]
                                            }
                                          },
                                          "span": {
                                            "start": 172,
                                            "end": 184
                                          }
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 158,
                                      "end": 184
                                    }
                                  }
                                },
                                "span": {
                                  "start": 158,
                                  "end": 185
                                }
                              }
                            ]
                          },
                          "is_final": false,
                          "by_ref": false,
                          "params": [
                            {
                              "name": {
                                "name": "value",
                                "span": {
                                  "start": 148,
                                  "end": 154
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
                                      "start": 141,
                                      "end": 147
                                    }
                                  }
                                },
                                "span": {
                                  "start": 141,
                                  "end": 147
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
                                "end": 154
                              }
                            }
                          ],
                          "attributes": [],
                          "span": {
                            "start": 137,
                            "end": 187
                          }
                        }
                      ],
                      "span": {
                        "start": 59,
                        "end": 197
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
                "end": 207
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 209
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 209
  }
}
