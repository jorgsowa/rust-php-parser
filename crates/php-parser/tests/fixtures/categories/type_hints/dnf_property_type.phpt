===config===
min_php=8.2
===source===
<?php
class Foo {
    public (Iterator&Countable)|(ArrayAccess&Stringable) $prop;
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
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Iterator"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 30,
                                      "end": 38
                                    }
                                  }
                                },
                                "span": {
                                  "start": 30,
                                  "end": 38
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Countable"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 39,
                                      "end": 48
                                    }
                                  }
                                },
                                "span": {
                                  "start": 39,
                                  "end": 48
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 29,
                            "end": 49
                          }
                        },
                        {
                          "kind": {
                            "Intersection": [
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "ArrayAccess"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 51,
                                      "end": 62
                                    }
                                  }
                                },
                                "span": {
                                  "start": 51,
                                  "end": 62
                                }
                              },
                              {
                                "kind": {
                                  "Named": {
                                    "parts": [
                                      "Stringable"
                                    ],
                                    "kind": "Unqualified",
                                    "span": {
                                      "start": 63,
                                      "end": 73
                                    }
                                  }
                                },
                                "span": {
                                  "start": 63,
                                  "end": 73
                                }
                              }
                            ]
                          },
                          "span": {
                            "start": 50,
                            "end": 74
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 29,
                      "end": 74
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 80
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 83
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 83
  }
}
