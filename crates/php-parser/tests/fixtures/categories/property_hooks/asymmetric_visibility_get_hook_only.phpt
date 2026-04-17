===config===
min_php=8.4
===source===
<?php
class Foo {
    public protected(set) string $name {
        get { return $this->name; }
    }
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
                  "name": "name",
                  "visibility": "Public",
                  "set_visibility": "Protected",
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 44,
                          "end": 50
                        }
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 50
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Return": {
                                "kind": {
                                  "PropertyAccess": {
                                    "object": {
                                      "kind": {
                                        "Variable": "this"
                                      },
                                      "span": {
                                        "start": 80,
                                        "end": 85
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "name"
                                      },
                                      "span": {
                                        "start": 87,
                                        "end": 91
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 80,
                                  "end": 91
                                }
                              }
                            },
                            "span": {
                              "start": 73,
                              "end": 92
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 67,
                        "end": 94
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 100
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 102
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 102
  }
}
