===config===
min_php=8.3
===source===
<?php
$obj = new readonly class(1, 2) {
    public function __construct(
        public int $x,
        public int $y,
    ) {}
};
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "obj"
                },
                "span": {
                  "start": 6,
                  "end": 10,
                  "start_line": 2,
                  "start_col": 0
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": true
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
                                              "int"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 88,
                                              "end": 91,
                                              "start_line": 4,
                                              "start_col": 15
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 88,
                                          "end": 91,
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
                                      "span": {
                                        "start": 81,
                                        "end": 94,
                                        "start_line": 4,
                                        "start_col": 8
                                      }
                                    },
                                    {
                                      "name": "y",
                                      "type_hint": {
                                        "kind": {
                                          "Named": {
                                            "parts": [
                                              "int"
                                            ],
                                            "kind": "Unqualified",
                                            "span": {
                                              "start": 111,
                                              "end": 114,
                                              "start_line": 5,
                                              "start_col": 15
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 111,
                                          "end": 114,
                                          "start_line": 5,
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
                                      "span": {
                                        "start": 104,
                                        "end": 117,
                                        "start_line": 5,
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
                                "start": 44,
                                "end": 128,
                                "start_line": 3,
                                "start_col": 4
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 129,
                        "start_line": 2,
                        "start_col": 7
                      }
                    },
                    "args": [
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 32,
                            "end": 33,
                            "start_line": 2,
                            "start_col": 26
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 32,
                          "end": 33,
                          "start_line": 2,
                          "start_col": 26
                        }
                      },
                      {
                        "name": null,
                        "value": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 35,
                            "end": 36,
                            "start_line": 2,
                            "start_col": 29
                          }
                        },
                        "unpack": false,
                        "by_ref": false,
                        "span": {
                          "start": 35,
                          "end": 36,
                          "start_line": 2,
                          "start_col": 29
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 13,
                  "end": 129,
                  "start_line": 2,
                  "start_col": 7
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 129,
            "start_line": 2,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 6,
        "end": 130,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 130,
    "start_line": 1,
    "start_col": 0
  }
}
