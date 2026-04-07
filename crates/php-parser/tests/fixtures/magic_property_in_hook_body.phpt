===config===
min_php=8.4
===source===
<?php
class Foo {
    public string $name {
        get {
            echo __PROPERTY__;
            return $this->name;
        }
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
                  "set_visibility": null,
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
                          "start": 29,
                          "end": 35
                        }
                      }
                    },
                    "span": {
                      "start": 29,
                      "end": 35
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
                              "Echo": [
                                {
                                  "kind": {
                                    "MagicConst": "Property"
                                  },
                                  "span": {
                                    "start": 75,
                                    "end": 87
                                  }
                                }
                              ]
                            },
                            "span": {
                              "start": 70,
                              "end": 101
                            }
                          },
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
                                        "start": 108,
                                        "end": 113
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "name"
                                      },
                                      "span": {
                                        "start": 115,
                                        "end": 119
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 108,
                                  "end": 119
                                }
                              }
                            },
                            "span": {
                              "start": 101,
                              "end": 129
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 52,
                        "end": 135
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 137
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 138
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 138
  }
}
