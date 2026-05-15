===config===
min_php=8.4
===source===
<?php

class Foo {
    private(set) string $type;
    protected(set) int $count = 0;
    public(set) string $label;

    public function __construct(
        private(set) string $name,
        protected(set) int $age,
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
                "Property": {
                  "name": "type",
                  "visibility": null,
                  "set_visibility": "Private",
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
                          "start": 36,
                          "end": 42
                        }
                      }
                    },
                    "span": {
                      "start": 36,
                      "end": 42
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 48
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "count",
                  "visibility": null,
                  "set_visibility": "Protected",
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
                      "Int": 0
                    },
                    "span": {
                      "start": 82,
                      "end": 83
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 54,
                "end": 83
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "label",
                  "visibility": null,
                  "set_visibility": "Public",
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
                          "start": 101,
                          "end": 107
                        }
                      }
                    },
                    "span": {
                      "start": 101,
                      "end": 107
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 89,
                "end": 114
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
                              "start": 171,
                              "end": 177
                            }
                          }
                        },
                        "span": {
                          "start": 171,
                          "end": 177
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": "Private",
                      "attributes": [],
                      "span": {
                        "start": 158,
                        "end": 183
                      }
                    },
                    {
                      "name": "age",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 208,
                              "end": 211
                            }
                          }
                        },
                        "span": {
                          "start": 208,
                          "end": 211
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": null,
                      "set_visibility": "Protected",
                      "attributes": [],
                      "span": {
                        "start": 193,
                        "end": 216
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 121,
                "end": 226
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 228
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 228
  }
}
