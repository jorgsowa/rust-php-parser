===source===
<?php

class Point {
    public function __construct(
        public float $x = 0.0,
        protected array $y = [],
        private string $z = 'hello',
        public readonly int $a = 0,
        public $h { set => $value; },
        public $g = 1 { get => 2; },
        final $i,
    ) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Point",
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
                      "name": "x",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 69,
                              "end": 74,
                              "start_line": 5,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 69,
                          "end": 74,
                          "start_line": 5,
                          "start_col": 15
                        }
                      },
                      "default": {
                        "kind": {
                          "Float": 0.0
                        },
                        "span": {
                          "start": 80,
                          "end": 83,
                          "start_line": 5,
                          "start_col": 26
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 62,
                        "end": 83,
                        "start_line": 5,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "y",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "array"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 103,
                              "end": 108,
                              "start_line": 6,
                              "start_col": 18
                            }
                          }
                        },
                        "span": {
                          "start": 103,
                          "end": 108,
                          "start_line": 6,
                          "start_col": 18
                        }
                      },
                      "default": {
                        "kind": {
                          "Array": []
                        },
                        "span": {
                          "start": 114,
                          "end": 116,
                          "start_line": 6,
                          "start_col": 29
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Protected",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 93,
                        "end": 116,
                        "start_line": 6,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "z",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 134,
                              "end": 140,
                              "start_line": 7,
                              "start_col": 16
                            }
                          }
                        },
                        "span": {
                          "start": 134,
                          "end": 140,
                          "start_line": 7,
                          "start_col": 16
                        }
                      },
                      "default": {
                        "kind": {
                          "String": "hello"
                        },
                        "span": {
                          "start": 146,
                          "end": 153,
                          "start_line": 7,
                          "start_col": 28
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 126,
                        "end": 153,
                        "start_line": 7,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "a",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 179,
                              "end": 182,
                              "start_line": 8,
                              "start_col": 24
                            }
                          }
                        },
                        "span": {
                          "start": 179,
                          "end": 182,
                          "start_line": 8,
                          "start_col": 24
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 188,
                          "end": 189,
                          "start_line": 8,
                          "start_col": 33
                        }
                      },
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 163,
                        "end": 189,
                        "start_line": 8,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "h",
                      "type_hint": null,
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
                          "kind": "Set",
                          "body": {
                            "Expression": {
                              "kind": {
                                "Variable": "value"
                              },
                              "span": {
                                "start": 218,
                                "end": 224,
                                "start_line": 9,
                                "start_col": 27
                              }
                            }
                          },
                          "is_final": false,
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 211,
                            "end": 226,
                            "start_line": 9,
                            "start_col": 20
                          }
                        }
                      ],
                      "span": {
                        "start": 199,
                        "end": 227,
                        "start_line": 9,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "g",
                      "type_hint": null,
                      "default": {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 249,
                          "end": 250,
                          "start_line": 10,
                          "start_col": 20
                        }
                      },
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
                                "Int": 2
                              },
                              "span": {
                                "start": 260,
                                "end": 261,
                                "start_line": 10,
                                "start_col": 31
                              }
                            }
                          },
                          "is_final": false,
                          "by_ref": false,
                          "params": [],
                          "attributes": [],
                          "span": {
                            "start": 253,
                            "end": 263,
                            "start_line": 10,
                            "start_col": 24
                          }
                        }
                      ],
                      "span": {
                        "start": 237,
                        "end": 264,
                        "start_line": 10,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "i",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": true,
                      "visibility": null,
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 274,
                        "end": 282,
                        "start_line": 11,
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
                "start": 25,
                "end": 293,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 294,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 294,
    "start_line": 1,
    "start_col": 0
  }
}
