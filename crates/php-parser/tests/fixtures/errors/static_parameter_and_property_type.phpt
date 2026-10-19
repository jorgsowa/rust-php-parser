===source===
<?php
class C {
    public ?static $a;
    public function __construct(private int|static $b) {}
    public function f(): ?static {}
}
function f(static $x) {}
===errors===
static cannot be used as a property type
static cannot be used as a parameter type
Cannot use the static modifier on a parameter
===php_error===
PHP Parse error:  syntax error, unexpected token "static" in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "a",
                    "span": {
                      "start": 35,
                      "end": 37
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
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 28,
                              "end": 34
                            }
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 34
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 37
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "__construct",
                    "span": {
                      "start": 59,
                      "end": 70
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "b",
                        "span": {
                          "start": 90,
                          "end": 92
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Union": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "int"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 79,
                                    "end": 82
                                  }
                                }
                              },
                              "span": {
                                "start": 79,
                                "end": 82
                              }
                            },
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "static"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 83,
                                    "end": 89
                                  }
                                }
                              },
                              "span": {
                                "start": 83,
                                "end": 89
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 79,
                          "end": 89
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 71,
                        "end": 92
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 96
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 117,
                      "end": 118
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 123,
                              "end": 129
                            }
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 129
                        }
                      }
                    },
                    "span": {
                      "start": 122,
                      "end": 129
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 101,
                "end": 132
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 134
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 144,
              "end": 145
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 153,
                  "end": 155
                }
              },
              "type_hint": null,
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 146,
                "end": 155
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 135,
        "end": 159
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 159
  }
}
