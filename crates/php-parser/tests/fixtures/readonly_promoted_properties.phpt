===config===
min_php=8.2
===source===
<?php
readonly class Point {
    public function __construct(
        public int $x,
        public int $y,
        public int $z = 0,
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
                              "start": 77,
                              "end": 80,
                              "start_line": 4,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 80,
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
                        "start": 70,
                        "end": 83,
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
                              "start": 100,
                              "end": 103,
                              "start_line": 5,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 100,
                          "end": 103,
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
                        "start": 93,
                        "end": 106,
                        "start_line": 5,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "z",
                      "type_hint": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 123,
                              "end": 126,
                              "start_line": 6,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 123,
                          "end": 126,
                          "start_line": 6,
                          "start_col": 15
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 132,
                          "end": 133,
                          "start_line": 6,
                          "start_col": 24
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
                        "start": 116,
                        "end": 133,
                        "start_line": 6,
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
                "start": 33,
                "end": 144,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 145,
        "start_line": 2,
        "start_col": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 145,
    "start_line": 1,
    "start_col": 0
  }
}
