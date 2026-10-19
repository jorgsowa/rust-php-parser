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
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 60,
                      "end": 65
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_readonly": true
                  },
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
                                "end": 47
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 47
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
                                "end": 59
                              }
                            }
                          },
                          "span": {
                            "start": 48,
                            "end": 59
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 38,
                      "end": 59
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
