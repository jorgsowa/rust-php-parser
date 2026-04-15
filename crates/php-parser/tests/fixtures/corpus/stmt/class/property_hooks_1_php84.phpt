===config===
min_php=8.4
max_php=8.4
===source===
<?php
class Test {
    public $prop {
        get { return 42; }
        set { echo $value; }
    }
    private $prop2 {
        get => 42;
        set => $value;
    }
    abstract $prop3 {
        &get;
        set;
    }
    public $prop4 {
        final get { return 42; }
        set(string $value) { }
    }
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
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
                                  "Int": 42
                                },
                                "span": {
                                  "start": 59,
                                  "end": 61
                                }
                              }
                            },
                            "span": {
                              "start": 52,
                              "end": 62
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 46,
                        "end": 64
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Echo": [
                                {
                                  "kind": {
                                    "Variable": "value"
                                  },
                                  "span": {
                                    "start": 84,
                                    "end": 90
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 79,
                              "end": 91
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 73,
                        "end": 93
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 23,
                "end": 99
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop2",
                  "visibility": "Private",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Int": 42
                          },
                          "span": {
                            "start": 136,
                            "end": 138
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 129,
                        "end": 139
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Expression": {
                          "kind": {
                            "Variable": "value"
                          },
                          "span": {
                            "start": 155,
                            "end": 161
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 148,
                        "end": 162
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 104,
                "end": 168
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop3",
                  "visibility": null,
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": true,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 199,
                        "end": 204
                      }
                    },
                    {
                      "kind": "Set",
                      "body": "Abstract",
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 213,
                        "end": 217
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 173,
                "end": 223
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "prop4",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
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
                                  "Int": 42
                                },
                                "span": {
                                  "start": 271,
                                  "end": 273
                                }
                              }
                            },
                            "span": {
                              "start": 264,
                              "end": 274
                            }
                          }
                        ]
                      },
                      "is_final": true,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 252,
                        "end": 276
                      }
                    },
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
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
                                  "start": 289,
                                  "end": 295
                                }
                              }
                            },
                            "span": {
                              "start": 289,
                              "end": 295
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
                            "start": 289,
                            "end": 302
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 285,
                        "end": 307
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 228,
                "end": 313
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 315
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 315
  }
}
===php_error===
PHP Fatal error:  Type of parameter $value of hook Test::$prop4::set must be compatible with property type in Standard input code on line 17
