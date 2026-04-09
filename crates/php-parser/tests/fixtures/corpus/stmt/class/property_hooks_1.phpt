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
                                  "end": 61,
                                  "start_line": 4,
                                  "start_col": 21
                                }
                              }
                            },
                            "span": {
                              "start": 52,
                              "end": 63,
                              "start_line": 4,
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
                        "start": 46,
                        "end": 73,
                        "start_line": 4,
                        "start_col": 8
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
                                    "end": 90,
                                    "start_line": 5,
                                    "start_col": 19
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 79,
                              "end": 92,
                              "start_line": 5,
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
                        "start": 73,
                        "end": 98,
                        "start_line": 5,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 23,
                "end": 104,
                "start_line": 3,
                "start_col": 4
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
                            "end": 138,
                            "start_line": 8,
                            "start_col": 15
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 129,
                        "end": 148,
                        "start_line": 8,
                        "start_col": 8
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
                            "end": 161,
                            "start_line": 9,
                            "start_col": 15
                          }
                        }
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 148,
                        "end": 167,
                        "start_line": 9,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 104,
                "end": 173,
                "start_line": 7,
                "start_col": 4
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
                        "end": 213,
                        "start_line": 12,
                        "start_col": 8
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
                        "end": 222,
                        "start_line": 13,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 173,
                "end": 228,
                "start_line": 11,
                "start_col": 4
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
                                  "end": 273,
                                  "start_line": 16,
                                  "start_col": 27
                                }
                              }
                            },
                            "span": {
                              "start": 264,
                              "end": 275,
                              "start_line": 16,
                              "start_col": 20
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
                        "end": 285,
                        "start_line": 16,
                        "start_col": 8
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
                                  "end": 295,
                                  "start_line": 17,
                                  "start_col": 12
                                }
                              }
                            },
                            "span": {
                              "start": 289,
                              "end": 295,
                              "start_line": 17,
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
                            "start": 289,
                            "end": 302,
                            "start_line": 17,
                            "start_col": 12
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 285,
                        "end": 312,
                        "start_line": 17,
                        "start_col": 8
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 228,
                "end": 314,
                "start_line": 15,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 315,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 315,
    "start_line": 1,
    "start_col": 0
  }
}
