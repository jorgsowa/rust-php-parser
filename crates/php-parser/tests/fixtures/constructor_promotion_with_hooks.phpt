===config===
min_php=8.4
===source===
<?php
class Point {
    public function __construct(
        public readonly int $x,
        public private(set) int $y,
        protected int $z = 0,
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
                              "int"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 77,
                              "end": 80,
                              "start_line": 4,
                              "start_col": 24
                            }
                          }
                        },
                        "span": {
                          "start": 77,
                          "end": 80,
                          "start_line": 4,
                          "start_col": 24
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": true,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 61,
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
                              "start": 113,
                              "end": 116,
                              "start_line": 5,
                              "start_col": 28
                            }
                          }
                        },
                        "span": {
                          "start": 113,
                          "end": 116,
                          "start_line": 5,
                          "start_col": 28
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Public",
                      "set_visibility": "Private",
                      "attributes": [],
                      "span": {
                        "start": 93,
                        "end": 119,
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
                              "start": 139,
                              "end": 142,
                              "start_line": 6,
                              "start_col": 18
                            }
                          }
                        },
                        "span": {
                          "start": 139,
                          "end": 142,
                          "start_line": 6,
                          "start_col": 18
                        }
                      },
                      "default": {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 148,
                          "end": 149,
                          "start_line": 6,
                          "start_col": 27
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
                        "start": 129,
                        "end": 149,
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
                "start": 24,
                "end": 160,
                "start_line": 3,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 161,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 161,
    "start_line": 1,
    "start_col": 0
  }
}
