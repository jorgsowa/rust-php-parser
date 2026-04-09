===source===
<?php
class Foo {
    public readonly Countable&Traversable $prop;
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
                  "name": "prop",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Countable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 38,
                                "end": 47,
                                "start_line": 3,
                                "start_col": 20
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 47,
                            "start_line": 3,
                            "start_col": 20
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "Traversable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 48,
                                "end": 60,
                                "start_line": 3,
                                "start_col": 30
                              }
                            }
                          },
                          "span": {
                            "start": 48,
                            "end": 60,
                            "start_line": 3,
                            "start_col": 30
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 38,
                      "end": 60,
                      "start_line": 3,
                      "start_col": 20
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 65,
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
        "end": 68,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68,
    "start_line": 1,
    "start_col": 0
  }
}
