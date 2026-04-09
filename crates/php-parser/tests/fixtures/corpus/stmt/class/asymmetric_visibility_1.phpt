===source===
<?php

class Test {
    protected private(set) $a;
    private public(set) $b;
    protected(set) $c;

    public function __construct(
        protected private(set) $d,
        private public(set) $e,
        protected(set) $f,
    ) {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Test",
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
                  "name": "a",
                  "visibility": "Protected",
                  "set_visibility": "Private",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 24,
                "end": 49,
                "start_line": 4,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "b",
                  "visibility": "Private",
                  "set_visibility": "Public",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 55,
                "end": 77,
                "start_line": 5,
                "start_col": 4
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "c",
                  "visibility": "Protected",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "set"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 93,
                                "end": 96,
                                "start_line": 6,
                                "start_col": 14
                              }
                            }
                          },
                          "span": {
                            "start": 93,
                            "end": 96,
                            "start_line": 6,
                            "start_col": 14
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 92,
                      "end": 97,
                      "start_line": 6,
                      "start_col": 13
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 83,
                "end": 100,
                "start_line": 6,
                "start_col": 4
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
                      "name": "d",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Protected",
                      "set_visibility": "Private",
                      "attributes": [],
                      "span": {
                        "start": 144,
                        "end": 169,
                        "start_line": 9,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "e",
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Private",
                      "set_visibility": "Public",
                      "attributes": [],
                      "span": {
                        "start": 179,
                        "end": 201,
                        "start_line": 10,
                        "start_col": 8
                      }
                    },
                    {
                      "name": "f",
                      "type_hint": {
                        "kind": {
                          "Intersection": [
                            {
                              "kind": {
                                "Named": {
                                  "parts": [
                                    "set"
                                  ],
                                  "kind": "Unqualified",
                                  "span": {
                                    "start": 221,
                                    "end": 224,
                                    "start_line": 11,
                                    "start_col": 18
                                  }
                                }
                              },
                              "span": {
                                "start": 221,
                                "end": 224,
                                "start_line": 11,
                                "start_col": 18
                              }
                            }
                          ]
                        },
                        "span": {
                          "start": 220,
                          "end": 225,
                          "start_line": 11,
                          "start_col": 17
                        }
                      },
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "is_readonly": false,
                      "is_final": false,
                      "visibility": "Protected",
                      "set_visibility": null,
                      "attributes": [],
                      "span": {
                        "start": 211,
                        "end": 228,
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
                "start": 107,
                "end": 239,
                "start_line": 8,
                "start_col": 4
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 240,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 240,
    "start_line": 1,
    "start_col": 0
  }
}
