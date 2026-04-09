===config===
min_php=8.2
===source===
<?php
readonly class Point {
    public function __construct(
        public float $x,
        public float $y,
        public float $z = 0.0,
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
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 77,
                              "end": 82,
                              "start_line": 4,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 82,
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
                        "end": 85,
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
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 102,
                              "end": 107,
                              "start_line": 5,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 102,
                          "end": 107,
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
                        "start": 95,
                        "end": 110,
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
                              "float"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 127,
                              "end": 132,
                              "start_line": 6,
                              "start_col": 15
                            }
                          }
                        },
                        "span": {
                          "start": 127,
                          "end": 132,
                          "start_line": 6,
                          "start_col": 15
                        }
                      },
                      "default": {
                        "kind": {
                          "Float": 0.0
                        },
                        "span": {
                          "start": 138,
                          "end": 141,
                          "start_line": 6,
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
                        "start": 120,
                        "end": 141,
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
                "end": 152,
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
        "end": 153,
        "start_line": 2,
        "start_col": 9
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 153,
    "start_line": 1,
    "start_col": 0
  }
}
