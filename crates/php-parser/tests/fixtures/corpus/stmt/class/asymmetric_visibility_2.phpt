===source===
<?php
class Test {
    private(set) private(set) $x;
    private(set) public(set) $x;
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
                  "name": "x",
                  "visibility": null,
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
                                "start": 44,
                                "end": 47,
                                "start_line": 3,
                                "start_col": 25
                              }
                            }
                          },
                          "span": {
                            "start": 44,
                            "end": 47,
                            "start_line": 3,
                            "start_col": 25
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 43,
                      "end": 48,
                      "start_line": 3,
                      "start_col": 24
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 43,
                "end": 51,
                "start_line": 3,
                "start_col": 24
              }
            },
            {
              "kind": {
                "Property": {
                  "name": "x",
                  "visibility": null,
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
                        }
                      ]
                    },
                    "span": {
                      "start": 76,
                      "end": 81,
                      "start_line": 4,
                      "start_col": 23
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 76,
                "end": 84,
                "start_line": 4,
                "start_col": 23
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 87,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 87,
    "start_line": 1,
    "start_col": 0
  }
}
