===config===
min_php=8.4
===source===
<?php
class Foo {
    public readonly string $bar {
        get { return $this->bar; }
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
                  "name": "bar",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": true,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 38,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 38,
                      "end": 44
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
                                        "start": 73,
                                        "end": 78
                                      }
                                    },
                                    "property": {
                                      "kind": {
                                        "Identifier": "bar"
                                      },
                                      "span": {
                                        "start": 80,
                                        "end": 83
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 73,
                                  "end": 83
                                }
                              }
                            },
                            "span": {
                              "start": 66,
                              "end": 84
                            }
                          }
                        ]
                      },
                      "is_final": false,
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 60,
                        "end": 86
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 22,
                "end": 92
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
===php_error===
PHP Fatal error:  Hooked properties cannot be readonly in Standard input code on line 3
