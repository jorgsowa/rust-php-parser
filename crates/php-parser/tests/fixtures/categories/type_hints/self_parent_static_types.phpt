===source===
<?php
class Builder {
    public function setName(string $name): self { return $this; }
    public static function create(): static { return new static(); }
}
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC) in Standard input code on line 4
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Builder",
            "span": {
              "start": 12,
              "end": 19
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
                    "name": "setName",
                    "span": {
                      "start": 42,
                      "end": 49
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "name",
                        "span": {
                          "start": 57,
                          "end": 62
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
                              "start": 50,
                              "end": 56
                            }
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 56
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 62
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 65,
                          "end": 69
                        }
                      }
                    },
                    "span": {
                      "start": 65,
                      "end": 69
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "Variable": "this"
                          },
                          "span": {
                            "start": 79,
                            "end": 84
                          }
                        }
                      },
                      "span": {
                        "start": 72,
                        "end": 85
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 87
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "create",
                    "span": {
                      "start": 115,
                      "end": 121
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_static": true
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "static"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 125,
                          "end": 131
                        }
                      }
                    },
                    "span": {
                      "start": 125,
                      "end": 131
                    }
                  },
                  "body": [
                    {
                      "kind": {
                        "Return": {
                          "kind": {
                            "New": {
                              "class": {
                                "kind": {
                                  "Name": {
                                    "parts": [
                                      "static"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 145,
                                      "end": 151
                                    }
                                  }
                                },
                                "span": {
                                  "start": 145,
                                  "end": 151
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 141,
                            "end": 153
                          }
                        }
                      },
                      "span": {
                        "start": 134,
                        "end": 154
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 92,
                "end": 156
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 158
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 158
  }
}
