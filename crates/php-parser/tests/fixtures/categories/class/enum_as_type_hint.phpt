===source===
<?php
class Foo {
    public Enum $x;
    public static Enum $y;
    public function bar(Enum $a): Enum { return new Enum(); }
}
function baz(Enum $x): Enum { return $x; }
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
                  "name": "x",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Enum"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 29,
                          "end": 33
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 33
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 36
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "y",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": true,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Enum"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 56,
                          "end": 60
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 60
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 42,
                "end": 63
              }
            },
            {
              "kind": {
                "Method": {
                  "name": "bar",
                  "visibility": "Public",
                  "is_static": false,
                  "is_abstract": false,
                  "is_final": false,
                  "by_ref": false,
                  "params": [
                    {
                      "name": "a",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "Enum"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 89,
                              "end": 93
                            }
                          }
                        },
                        "span": {
                          "start": 89,
                          "end": 93
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
                        "start": 89,
                        "end": 96
                      }
                    }
                  ],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "Enum"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 99,
                          "end": 103
                        }
                      }
                    },
                    "span": {
                      "start": 99,
                      "end": 103
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
                                  "Identifier": "Enum"
                                },
                                "span": {
                                  "start": 117,
                                  "end": 121
                                }
                              },
                              "args": []
                            }
                          },
                          "span": {
                            "start": 113,
                            "end": 123
                          }
                        }
                      },
                      "span": {
                        "start": 106,
                        "end": 124
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 126
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 128
      }
    },
    {
      "kind": {
        "Function": {
          "name": "baz",
          "params": [
            {
              "name": "x",
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "Enum"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 142,
                      "end": 146
                    }
                  }
                },
                "span": {
                  "start": 142,
                  "end": 146
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
                "start": 142,
                "end": 149
              }
            }
          ],
          "body": [
            {
              "kind": {
                "Return": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 166,
                    "end": 168
                  }
                }
              },
              "span": {
                "start": 159,
                "end": 169
              }
            }
          ],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "Enum"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 152,
                  "end": 156
                }
              }
            },
            "span": {
              "start": 152,
              "end": 156
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 129,
        "end": 171
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 171
  }
}
