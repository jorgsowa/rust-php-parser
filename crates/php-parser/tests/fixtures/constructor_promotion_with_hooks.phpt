===source===
<?php
class Point {
    public function __construct(
        public readonly int $x,
        public private(set) int $y,
        protected int $z = 0,
    ) {}
}
===ast >=8.4===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Point",
            "span": {
              "start": 12,
              "end": 17
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
                      "start": 40,
                      "end": 51
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": {
                        "name": "x",
                        "span": {
                          "start": 81,
                          "end": 83
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 77,
                              "end": 80
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 80
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "is_readonly": true
                      },
                      "attributes": [],
                      "span": {
                        "start": 61,
                        "end": 83
                      }
                    },
                    {
                      "name": {
                        "name": "y",
                        "span": {
                          "start": 117,
                          "end": 119
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 113,
                              "end": 116
                            }
                          }
                        },
                        "span": {
                          "start": 113,
                          "end": 116
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Public",
                        "set_visibility": "Private"
                      },
                      "attributes": [],
                      "span": {
                        "start": 93,
                        "end": 119
                      }
                    },
                    {
                      "name": {
                        "name": "z",
                        "span": {
                          "start": 143,
                          "end": 145
                        }
                      },
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 139,
                              "end": 142
                            }
                          }
                        },
                        "span": {
                          "start": 139,
                          "end": 142
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 148,
                          "end": 149
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "modifiers": {
                        "visibility": "Protected"
                      },
                      "attributes": [],
                      "span": {
                        "start": 129,
                        "end": 149
                      }
                    }
                  ],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 159
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 161
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 161
  }
}
